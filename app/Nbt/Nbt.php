<?php
/**
 * Class for reading in NBT-format files.
 * Original cody by Justin Martin <frozenfire@thefrozenfire.com>
 * Updated and modified by David Ludwig <davidludwigii@gmail.com>
 *
 */

namespace App\Nbt;

class Nbt {

	private $_root = [];
	private $_verbose = false;
	
	public function loadFile($filename, $wrapper = "compress.zlib://")
	{
		if(is_string($wrapper) && is_file($filename)) {
			if($this->_verbose) trigger_error("Loading file \"{$filename}\" with stream wrapper \"{$wrapper}\".", E_USER_NOTICE);
			$fp = fopen("{$wrapper}{$filename}", "rb");
		} elseif(is_null($wrapper) && is_resource($filename)) {
			if($this->_verbose) trigger_error("Loading file from existing resource.", E_USER_NOTICE);
			$fp = $filename;
		} else {
			trigger_error("First parameter must be a filename or a resource.", E_USER_WARNING);
			return false;
		}
		if($this->_verbose) trigger_error("Traversing first tag in file.", E_USER_NOTICE);
		$this->traverseTag($fp, $this->_root);
		if($this->_verbose) trigger_error("Encountered end tag for first tag; finished.", E_USER_NOTICE);
		return end($this->_root);
	}
	
	public function writeFile($filename, $wrapper = "compress.zlib://")
	{
		if(is_string($wrapper)) {
			if($this->_verbose) trigger_error("Writing file \"{$filename}\" with stream wrapper \"{$wrapper}\".", E_USER_NOTICE);
			$fp = fopen("{$wrapper}{$filename}", "wb");
		} elseif(is_null($wrapper) && is_resource($fp)) {
			if($this->_verbose) trigger_error("Writing file to existing resource.", E_USER_NOTICE);
			$fp = $filename;
		} else {
			trigger_error("First parameter must be a filename or a resource.", E_USER_WARNING);
			return false;
		}
		if($this->_verbose) trigger_error("Writing ".count($this->_root)." root tag(s) to file/resource.", E_USER_NOTICE);
		foreach($this->_root as $rootNum => $rootTag) if(!$this->writeTag($fp, $rootTag)) trigger_error("Failed to write root tag #{$rootNum} to file/resource.", E_USER_WARNING);
		return true;
	}
	
	public function purge()
	{
		if($this->_verbose) trigger_error("Purging all loaded data", E_USER_ERROR);
		$this->_root = [];
	}
	
	public function traverseTag($fp, &$tree)
	{
		if(feof($fp)) {
			if($this->_verbose) trigger_error("Reached end of file/resource.", E_USER_NOTICE);
			return false;
		}
		$tagType = $this->readType($fp, NbtTag::TAG_BYTE); // Read type byte.
		if($tagType == NbtTag::TAG_END) {
			return false;
		} else {
			if($this->_verbose) $position = ftell($fp);
			$tagName = $this->readType($fp, NbtTag::TAG_STRING);
			if($this->_verbose) trigger_error("Reading tag \"{$tagName}\" at offset {$position}.", E_USER_NOTICE);
			$tagData = $this->readType($fp, $tagType);
			$tree[] = new NbtTag($tagName, $tagType, $tagData);
			return true;
		}
	}
	
	public function writeTag($fp, $tag)
	{
		if($this->_verbose) {
			$position = ftell($fp);
			trigger_error("Writing tag \"{$tag["name"]}\" of type {$tag["type"]} at offset {$position}.", E_USER_NOTICE);
		}
		return $this->writeType($fp, NbtTag::TAG_BYTE, $tag["type"]) && $this->writeType($fp, NbtTag::TAG_STRING, $tag["name"]) && $this->writeType($fp, $tag["type"], $tag["value"]);
	}
	
	public function readType($fp, $tagType)
	{
		switch($tagType) {
			case NbtTag::TAG_BYTE: // Signed byte (8 bit)
				list(,$unpacked) = unpack("c", fread($fp, 1));
				return $unpacked;
			case NbtTag::TAG_SHORT: // Signed short (16 bit, big endian)
				list(,$unpacked) = unpack("n", fread($fp, 2));
				if($unpacked >= pow(2, 15)) $unpacked -= pow(2, 16); // Convert unsigned short to signed short.
				return $unpacked;
			case NbtTag::TAG_INT: // Signed integer (32 bit, big endian)
				list(,$unpacked) = unpack("N", fread($fp, 4));
				if($unpacked >= pow(2, 31)) $unpacked -= pow(2, 32); // Convert unsigned int to signed int
				return $unpacked;
			case NbtTag::TAG_LONG: // Signed long (64 bit, big endian)
				list(,$firstHalf) = unpack("N", fread($fp, 4));
				list(,$secondHalf) = unpack("N", fread($fp, 4));
				$value = ($firstHalf << 32) + $secondHalf;
				if($value >= pow(2, 63)) $value -= pow(2, 64);
				return $value;
			case NbtTag::TAG_FLOAT: // Floating point value (32 bit, big endian, IEEE 754-2008)
				list(,$value) = (pack('d', 1) == "\77\360\0\0\0\0\0\0")?unpack('f', fread($fp, 4)):unpack('f', strrev(fread($fp, 4)));
				return $value;
			case NbtTag::TAG_DOUBLE: // Double value (64 bit, big endian, IEEE 754-2008)
				list(,$value) = (pack('d', 1) == "\77\360\0\0\0\0\0\0")?unpack('d', fread($fp, 8)):unpack('d', strrev(fread($fp, 8)));
				return $value;
			case NbtTag::TAG_BYTE_ARRAY: // Byte array
				$arrayLength = $this->readType($fp, NbtTag::TAG_INT);
				$array = array();
				for($i = 0; $i < $arrayLength; $i++) $array[] = $this->readType($fp, NbtTag::TAG_BYTE);
				return $array;
			case NbtTag::TAG_STRING: // String
				if(!$stringLength = $this->readType($fp, NbtTag::TAG_SHORT)) return "";
				$string = utf8_decode(fread($fp, $stringLength)); // Read in number of bytes specified by string length, and decode from utf8.
				return $string;
			case NbtTag::TAG_LIST: // List
				$tagID = $this->readType($fp, NbtTag::TAG_BYTE);
				$listLength = $this->readType($fp, NbtTag::TAG_INT);
				if($this->_verbose) trigger_error("Reading in list of {$listLength} tags of type {$tagID}.", E_USER_NOTICE);
				$list = array("type"=>$tagID, "value"=>array());
				for($i = 0; $i < $listLength; $i++) {
					if(feof($fp)) break;
					$list["value"][] = $this->readType($fp, $tagID);
				}
				return $list;
			case NbtTag::TAG_COMPOUND: // Compound
				$tree = array();
				while($this->traverseTag($fp, $tree));
				return $tree;
			case NbtTag::TAG_INT_ARRAY:
				$arrLength = $this->readType($fp, NbtTag::TAG_INT);
				$arr = array();
				for($i = 0; $i < $arrLength; $i++) $arr[] = $this->readType($fp, NbtTag::TAG_INT);
				return $arr;
		}
	}
	
	public function writeType($fp, $tagType, $value)
	{
		switch($tagType) {
			case NbtTag::TAG_BYTE: // Signed byte (8 bit)
				return is_int(fwrite($fp, pack("c", $value)));
			case NbtTag::TAG_SHORT: // Signed short (16 bit, big endian)
				if($value < 0) $value += pow(2, 16); // Convert signed short to unsigned short
				return is_int(fwrite($fp, pack("n", $value)));
			case NbtTag::TAG_INT: // Signed integer (32 bit, big endian)
				if($value < 0) $value += pow(2, 32); // Convert signed int to unsigned int
				return is_int(fwrite($fp, pack("N", $value)));
			case NbtTag::TAG_LONG: // Signed long (64 bit, big endian)
				extension_loaded("gmp") or trigger_error (
					"This file contains a 64-bit number and execution cannot continue. ".
					"Please install the GMP extension for 64-bit number handling.", E_USER_ERROR
				);
				$secondHalf = gmp_mod($value, 2147483647);
				$firstHalf = gmp_sub($value, $secondHalf);
				return is_int(fwrite($fp, pack("N", gmp_intval($firstHalf)))) && is_int(fwrite($fp, pack("N", gmp_intval($secondHalf))));
			case NbtTag::TAG_FLOAT: // Floating point value (32 bit, big endian, IEEE 754-2008)
				return is_int(fwrite($fp, (pack('d', 1) == "\77\360\0\0\0\0\0\0")?pack('f', $value):strrev(pack('f', $value))));
			case NbtTag::TAG_DOUBLE: // Double value (64 bit, big endian, IEEE 754-2008)
				return is_int(fwrite($fp, (pack('d', 1) == "\77\360\0\0\0\0\0\0")?pack('d', $value):strrev(pack('d', $value))));
			case NbtTag::TAG_BYTE_ARRAY: // Byte array
				return $this->writeType($fp, NbtTag::TAG_INT, count($value)) && is_int(fwrite($fp, call_user_func_array("pack", array_merge(array("c".count($value)), $value))));
			case NbtTag::TAG_STRING: // String
				$value = utf8_encode($value);
				return $this->writeType($fp, NbtTag::TAG_SHORT, strlen($value)) && is_int(fwrite($fp, $value));
			case NbtTag::TAG_LIST: // List
				if($this->_verbose) trigger_error("Writing list of ".count($value["value"])." tags of type {$value["type"]}.", E_USER_NOTICE);
				if(!($this->writeType($fp, NbtTag::TAG_BYTE, $value["type"]) && $this->writeType($fp, NbtTag::TAG_INT, count($value["value"])))) return false;
				foreach($value["value"] as $listItem) if(!$this->writeType($fp, $value["type"], $listItem)) return false;
				return true;
			case NbtTag::TAG_COMPOUND: // Compound
				foreach($value as $listItem) if(!$this->writeTag($fp, $listItem)) return false;
				if(!is_int(fwrite($fp, "\0"))) return false;
				return true;
		}
	}

	public function root()
	{
		return $this->_root[0];
	}

	public function setVerbose(bool $verbose)
	{
		$this->_verbose = $verbose;
	}
}
