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
	public function __construct($nombres, $apellidos, $contraseña, $repContraseña, $email, IUsuarioDB $CapaDatos){
		//TODO: Terminar la validacion del usuario
		$this->capaDatos = $CapaDatos;
		//Determinar si el usuario es valido
		$this->valido = 1;
		
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
			$this->$aValidar = 1;
			$exito = 1;
		}else{
			$this->$aValidar = 0;
			$exito = 0;
		}

		$this->valido = $this->valido && $exito;
	}

	public function ContraseñaValida($contraseña, $repContraseña){
		$exito= 1;

		if(strlen($contraseña) >= 8 && strlen($contraseña) <= 50 && preg_match("/^[a-zA-Z0-9]*$/", $contraseña)){
			$this->contraseñaValido = 1;
			$exito = $exito && 1;
		}else{
			$this->contraseñaValido = 0;
			$exito = $exito && 0;
		}	

		if($contraseña === $repContraseña){
			$this->repContraseñaValido = 1;
			$exito = $exito && 1;
		}else{
			$this->repContraseñaValido = 0;
			$exito = $exito && 0;
		}

		$this->valido = $this->valido && $exito;
		
	}
                        
	public function EmailValido($email){
		$exito = null;
		if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$this->emailValido = 1;
			if($this->capaDatos->EmailUnico($email)){
				$this->emailUnico = 1;
				$exito = 1;
			}else{
				$this->emailUnico = 0;
				$exito = 0;
			}
		}else{
			$this->emailValido = 0;
			$exito = 0;
		}

		$this->valido = $this->valido && $exito;
		
	}
                
	//Metodos estaticos
	public static function Activar($codigoActivacion, IUsuarioDB $capaDatos){
		$codigoActivacion = htmlspecialchars($codigoActivacion);
		return $capaDatos->ActivarUsuario($codigoActivacion);
	}
}