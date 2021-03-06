<?php namespace Config;


use Controllers\BaseController;
use Controllers\NonIntranetController;
use Controllers\RegistrationController;
use \Views\WebPages\NotFound;

class Enrutador
{
	public static function run(Request $request){
		$controlador = $request->get("controlador");
		$metodo = $request->get("metodo");

		switch($controlador){
			case "index":
				$nonInCont = new NonIntranetController($metodo);
				break;
			case "registro":
				$regCont = new RegistrationController($metodo);
				break;
			default:
				//Error 404, que haaaaacesss chango?
				NotFound::show();
				break;
		}
	}
}