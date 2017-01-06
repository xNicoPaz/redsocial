<?php namespace Models;

use Models\Database;

class Usuario
{
	//Atributos publicos
	public $nombres;
	public $apellidos;
	public $contraseña;
	public $email;
	public $codigoActivacion;
	public $valido;

	//Atributos publicos para validacion
	public $nombresValido;
	public $apellidosValido;
	public $contraseñaValido;
	public $repContraseñaValido;
	public $emailValido;
	public $emailUnico;

	//Atributos privados
	private $capaDatos;

	//Metodos
	public function __construct($nombres, $apellidos, $contraseña, $repContraseña, $email, Database\IUsuarioDB $capaDatos){
		//TODO: Terminar la validacion del usuario
		$this->capaDatos = $capaDatos;

		if($this->NombreOApellidoValido($nombres, 'nombresValido') && $this->NombreOApellidoValido($apellidos, 'apellidosValido') && $this->ContraseñaValida($contraseña, $repContraseña) && $this->EmailValido($email)){
			//El usuario es valido y puede guardarse en la BD
			$this->valido = true;
			$this->nombres = $nombres;
			$this->apellidos = $apellidos;
			$this->contraseña = $contraseña;
			$this->email = $email;
			$this->codigoActivacion = md5(time());
			$this->capaDatos->GuardarUsuario($this);
		}else{
			//El usuario no es valido y no puede guardarse en la BD
			$this->valido = false;
		}
	}

	//Metodos para validar
	public function NombreOApellidoValido($nombres, $aValidar){
		//Buscar que cosas podrian hacer invalido al nombre y negar el resultado
		$ilegal = "#$%^&*()+=-[]';,./{}|:<>?~";
		if(strpbrk($nombres, $ilegal) === false && strlen($nombres) <= 100 && $nombres !== " " && $nombres !== "    "){
			$this->$aValidar = true;
			return true;
		}else{
			$this->$aValidar = false;
			return false;
		}
	}
	public function ContraseñaValida($contraseña, $repContraseña){
		if($contraseña === $repContraseña){
			$this->repContraseñaValido = true;
			if(strlen($contraseña) >= 8 && strlen($contraseña) <= 50 && preg_match("/^[a-zA-Z0-9]*$/", $contraseña)){
				$this->contraseñaValido = true;
				return true;
			}else{
				$this->contraseñaValido = false;
			}
		}else{
			$this->repContraseñaValido = false;
			return false;
		}
	}
	public function EmailValido($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->emailValido = true;
			if($this->capaDatos->EmailUnico($email)){
				$this->emailUnico = true;
				return true;
			}else{
				$this->emailUnico = false;
				return false;
			}
		}else{
			$this->emailValido = false;
			return false;
		}
	}

	//Metodos estaticos
	public static function Activar($codigoActivacion, Database\IUsuarioDB $capaDatos){
		$codigoActivacion = htmlspecialchars($codigoActivacion);
		return $capaDatos->ActivarUsuario($codigoActivacion);
	}
}