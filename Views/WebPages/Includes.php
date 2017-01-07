<?php 
namespace Views\WebPages;

	class Includes
	{
		public static function Head(){
			return "
					<!DOCTYPE html>
					<html lang=\"en\">
					<head>
						<meta charset=\"UTF-8\">
						<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
						<title>Red Socialization - Tu perdida de tiempo favorita</title>
						<link rel='stylesheet' href=' " . WEBROOT . "/vendor/twbs/bootstrap/dist/css/bootstrap.css'>
					</head>";
		}

		public static function Header(){
			return "
				<html>
				<body>
				<div class='container'>
					<div class='jumbotron'>
						<h1> Red Socialization - Tu perdida de tiempo favorita</h1>
					</div>
			";
		}

		public static function Footer(){
			return "
				</div>
				</body>
				<html>
			";
		}

	}