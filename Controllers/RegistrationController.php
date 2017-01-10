<?php namespace Controllers;

use Models\Database\UsuarioMySQL;
use Models\Usuario;
use Views\WebPages\Registro;
use Views\Emails\ActivationEmail;
use Views\WebPages\ActivacionExitosa;

class RegistrationController extends BaseController
{
	public function __construct($metodo){
		switch($metodo){
			case "registrar":
				//Hay que registrar al usuario a traves del model Usuario
				$this->Registrar();
				break;
			case "activar":
                //To do: implementar activacion de cuenta
                $this->Activar();
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
		$usuario = new Usuario($nombres, $apellidos, $pass, $repPass, $email, $capaDatos);
		//Si el usuario es valido se envia el email de activacion
        if($usuario->valido){
			//To do: enviar el email de activacion
			$emailAct = new ActivationEmail($usuario->codigoActivacion);
			$emailAct->AddDestinatario($usuario->email, $usuario->nombres . " " . $usuario->apellidos);
			$emailAct->Enviar();
        }
		//Llamada a la vista
		//Si el usuario fue registrado exitosamente, muestra un mensaje informando que se envio email de activacion
		//Si no es asi, se muestra el formulario con los errores encontrados.
		$registro = new Registro(
				$usuario->valido,
				$usuario->nombresValido,
				$usuario->apellidosValido,
				$usuario->contraseñaValido,
				$usuario->repContraseñaValido,
				$usuario->emailValido,
				$usuario->emailUnico,
				$usuario->GetNombres(),
				$usuario->GetApellidos(),
				$usuario->GetEmail(),
				$usuario->GetContraseña()
		);
		$registro->Mostrar();
	}

	private function Activar(){
		$cuentaActivada = Usuario::Activar($_GET['codigo'], new UsuarioMySQL());
		if($cuentaActivada){
			//To do: redireccionar a una vista que le indique que la cuenta esta activada
			ActivacionExitosa::show();
		}else{
			//To do: redireccionar a algun lugar que diga que hay un problema en el servidor

		}
	}
}