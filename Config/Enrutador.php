<?php namespace Config;


use Controllers\BaseController;
use Controllers\NonIntranetController;

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

				break;
			default:
				//Error 404, que haaaaacesss chango?
				echo \Views\NotFound::show();
				break;
		}
	}
}