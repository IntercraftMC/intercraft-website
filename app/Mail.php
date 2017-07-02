<?php

namespace App;

use PHPMailer;

class Mail
{
	public static function init()
	{
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = True;
		$mail->Username = config()['email']['email'];
		$mail->Password = config()['email']['password'];
		$mail->setFrom(config()['email']['email'], "InterCraft Team");
		return $mail;
	}

	public static function signUp($email, $username)
	{
		$template = email('signup', [
			'brand' => url('/assets/img/brand_email.png'),
			'background' => url('assets/img/' . config()['email']['signup_background']),
			'discord' => config()['discord']['link'],
			'email' => config()['email']['email'],
			'facebook' => config()['social_media']['facebook'],
			'twitter' => config()['social_media']['twitter'],
			'hostName' => config()['general']['hostname'],
			'url' => url(),
			'username' => $username
		]);
		$mail = self::init();
		$mail->addAddress($email);
		$mail->addAddress(config()['email']['email']);
		$mail->Subject = 'Re: InterCraft Application';
		$mail->msgHTML($template);
		return $mail->send();
	}
}