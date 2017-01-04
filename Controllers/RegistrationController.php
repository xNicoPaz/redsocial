<?php namespace Controllers;

use Models\Database\UsuarioMySQL;
use Views\WebPages\Registro;

class RegistrationController extends BaseController
{
	public function __construct($metodo){
		switch($metodo){
			case "registrar":
				//Hay que registrar al usuario a traves del model Usuario
				$this->Registrar();
				break;
		}
	}

	private function Registrar(){
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$repPass = $_POST['repPass'];

		//Arbitrariamente aqui llamamos a MySQL,
		//PERO, esta configuracion deberia estar en un archivo XML o algo asi
		//y leerse desde ahi

		$capaDatos = new UsuarioMySQL();
		$usuario = new \Models\Usuario($nombres, $apellidos, $pass, $repPass, $email, $capaDatos);
		
		//Llamada a la vista
		$registro = new Registro(
				$usuario->nombresValido,
				$usuario->apellidosValido,
				$usuario->contraseñaValido,
				$usuario->repContraseñaValido,
				$usuario->emailValido,
				$usuario->emailUnico
			);
		$registro->Mostrar();
	}
}