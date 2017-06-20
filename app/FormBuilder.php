<?php

namespace App;

use \DomDocument;


class FormBuilder
{

	protected static function createAttribute($dom, $name, $value)
	{
		$attr = $dom->createAttribute($name);
		if ($value !== Null)
			$attr->value = $value;
		return $attr;
	}

	public static function createInputField($type, $class, $name, $id, $value, $extras = [])
	{
		$dom = new DomDocument('1.0', 'UTF-8');

		$element = $dom->createElement('input');
		$element->appendChild(self::createAttribute($dom, 'type', $type));
		if ($class !== Null)
			$element->appendChild(self::createAttribute($dom, 'class', $class));
		if ($name !== Null)
			$element->appendChild(self::createAttribute($dom, 'name', $name));
		if ($id !== Null)
			$element->appendChild(self::createAttribute($dom, 'id', $id));
		if ($value !== Null)
			$element->appendChild(self::createAttribute($dom, 'value', $value));

		foreach($extras as $attr=>$attrValue)
			if ($attrValue !== Null)
				$element->appendChild(self::createAttribute($dom, $attr, $attrValue));

		$dom->appendChild($element);
		return $dom->saveXML();
	}

	public static function email($class, $name, $id, $value, $placeHolder)
	{
		$extras = ['placeholder' => $placeHolder];
		return self::createInputField('email', $class, $name, $id, $value, $extras);
	}

	public static function input($class, $name, $id, $value, $placeHolder)
	{
		$extras = ['placeholder' => $placeHolder];
		return self::createInputField('text', $class, $name, $id, $value, $extras);
	}

	public static function checkbox($class, $name, $id, $value, $checked = False)
	{
		$extras = $checked ? ['checked' => 'checked'] : [];
		return self::createInputField('checkbox', $class, $name, $id, $value, $extras);
	}
}