<?php
/**
 * Created by PhpStorm.
 * User: Nicolás
 * Date: 14/12/2016
 * Time: 16:02
 */

namespace Views;


class Includes
{
	public static function Head(){
		return "
				<!DOCTYPE html>
				<html lang=\"en\">
				<head>
					<meta charset=\"UTF-8\">
					<title>Red Socialization</title>
					<link rel='stylesheet' href=' " . WEBROOT . "/css/styles.css'>
				</head>	
			";
	}

}