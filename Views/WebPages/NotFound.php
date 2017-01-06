<?php 
namespace Views\WebPages;

use Views\WebPages\Includes;

class NotFound
{
	public static function show(){
		echo 
			Includes::Head()
			. "<h1>Esta pagina no existe papilo, no te hagas el hacker</h1>";
	}
}