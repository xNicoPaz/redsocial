<?php
namespace Views\WebPages;

use Views\WebPages\IStaticWebPage;
use Views\WebPages\Includes;

class ActivacionExitosa implements IStaticWebPage{
	public static function show(){
		echo 
			Includes::Head()
			 . "<h1>La cuenta esta activada</h1>"
			 . "<p>Puede loguearse para empezar a entrometerse en lo ajeno.</p>";
	}
}
?>