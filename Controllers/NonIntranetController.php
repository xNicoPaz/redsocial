<?php namespace Controllers;

use Views\NonIntranet\Registro;

class NonIntranetController extends BaseController
{
	//Implementacion de metodo __default de BaseController

	public function __construct($metodo){
		switch($metodo){
			case "default":
				$this->Index();
				break;
		}
	}

	public function Index()
	{
		$registro = new Registro();
		$registro->Mostrar();
	}

}