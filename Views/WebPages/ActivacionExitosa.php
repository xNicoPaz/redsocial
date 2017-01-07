<?php
namespace Views\WebPages;

use Views\WebPages\IStaticWebPage;
use Views\WebPages\Includes;

class ActivacionExitosa implements IStaticWebPage{
	public static function show(){
		echo 
			Includes::Head()
			 . Includes::Header()
			 . "<div class='page-header'>
			 <h1 class='alert alert-info'>La cuenta esta activada</h1>
			 </div>"
			 . "<p>Puede loguearse para empezar a entrometerse en lo ajeno.</p>"
			 . Includes::Footer();
	}
}
?>