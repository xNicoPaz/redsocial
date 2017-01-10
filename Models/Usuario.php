<?php namespace Models;

use Models\Database\IUsuarioDB;

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

	//Metodos magicos
	public function __construct($nombres, $apellidos, $contraseña, $repContraseña, $email, IUsuarioDB $capaDatos){
		//TODO: Terminar la validacion del usuario
		$this->capaDatos = $capaDatos;
		//Determinar si el usuario es valido
		$this->valido = true;
		$this->NombreOApellidoValido($nombres, 'nombresValido');
		$this->NombreOApellidoValido($apellidos, 'apellidosValido');
		$this->ContraseñaValida($contraseña, $repContraseña);
		$this->EmailValido($email);   //Este metodo hace un AND en su interior
		//Setear las propiedades basicas del usuario. A pesar de todo, sera necesario pasarlas a la vista
		$this->nombres = $nombres;
		$this->apellidos = $apellidos;
		$this->contraseña = $contraseña;
		$this->email = $email;
		//Si el usuario es valido y debe guardarse en la BD y enviarsele email de activacion
		if($this->valido){
			$this->codigoActivacion = md5(time());
			$this->capaDatos->GuardarUsuario($this);
		}
	}

	public function GetNombres(){
		return $this->nombres;
	}

	public function GetApellidos(){
		return $this->apellidos;
	}

	public function GetEmail(){
		return $this->email;
	}

	public function GetContraseña(){
		return $this->contraseña;
	}

	//Metodos para validar
	public function NombreOApellidoValido($nombres, $aValidar){
		//Buscar que cosas podrian hacer invalido al nombre y negar el resultado
		$exito = null;
		$ilegal = "#$%^&*()+=-[]';,./{}|:<>?~";
		if(strpbrk($nombres, $ilegal) === false && strlen($nombres) <= 100 && $nombres !== " " && $nombres !== "    "){
			$this->$aValidar = true;
			$exito = true;
		}else{
			$this->$aValidar = false;
			$exito = false;
		}

		$this->valido = $this->valido && $exito;
	}

	public function ContraseñaValida($contraseña, $repContraseña){
		$exito= true;

		if(strlen($contraseña) >= 8 && strlen($contraseña) <= 50 && preg_match("/^[a-zA-Z0-9]*$/", $contraseña)){
			$this->contraseñaValido = true;
			$exito = $exito && true;
		}else{
			$this->contraseñaValido = false;
			$exito = $exito && false;
		}	

		if($contraseña === $repContraseña){
			$this->repContraseñaValido = true;
			$exito = $exito && true;
		}else{
			$this->repContraseñaValido = false;
			$exito = $exito && false;
		}

		$this->valido = $this->valido && $exito;

	}
                        
	public function EmailValido($email){
		$exito = null;
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->emailValido = true;
			if($this->capaDatos->EmailUnico($email)){
				$this->emailUnico = true;
				$exito = true;
			}else{
				$this->emailUnico = false;
				$exito = false;
			}
		}else{
			$this->emailValido = false;
			$exito = false;
		}

		$this->valido = $this->valido && $exito;
	}
                
	//Metodos estaticos
	public static function Activar($codigoActivacion, IUsuarioDB $capaDatos){
		$codigoActivacion = htmlspecialchars($codigoActivacion);
		return $capaDatos->ActivarUsuario($codigoActivacion);
	}
}