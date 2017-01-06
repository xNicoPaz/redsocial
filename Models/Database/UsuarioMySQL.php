<?php namespace Models\Database;

use Models\Usuario;

class UsuarioMySQL implements IUsuarioDB
{
	//Atributos
	private $con;
	//Metodos
	private function IniciarConexionMySQL(){
		$this->con = new \PDO("mysql:host=" . ConfigMySQL::$host . ";dbname=" . ConfigMySQL::$db , ConfigMySQL::$user, ConfigMySQL::$pass);
		$this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	//Implementacion de IUsuarioDB
	public function EmailUnico($email)
	{
		// TODO: prueba de unidad
		try{
			$this->IniciarConexionMySQL();
			$stmt = $this->con->query("SELECT COUNT(*) FROM usuarios WHERE email = '" . $email . "'");
			//Segun la documentacion de PHP, esta es una forma estandar de preguntar por la cantidad de columnas
			//de una consulta, pues hay algunas BD donde rowCount() no funcionara correctamente.
			$cantidadEmail = (int) $stmt->fetchColumn();
			if($cantidadEmail === 0)
				//El email no se encuentra registrado. Puede usarse
				$exito = 1;
			else
				//El email se encuentra registrado. No puede usarse de vuelta
				$exito = 0;
		}
		catch(\PDOException $ex){
			$exito = FALSE;
		}
		catch(\Exception $ex){
			echo $ex->getMessage() . PHP_EOL;
		}
		finally{
			$con = null;
			return $exito;
		}
	}
	public function GuardarUsuario(Usuario $usuario)
	{
		//TODO: Este metodo estaria bueno que sirva para guardar y para sobreescribir el usuario
		//TODO: prueba de unidad
		try{
			$this->IniciarConexionMySQL();
			$stmt = $this->con->prepare("INSERT INTO usuarios (nombres, apellidos, pass, email, codigoActivacion, activada)"
					. " VALUES (:nombres, :apellidos, :pass, :email, :codigoActivacion, false)");
			$stmt->bindParam(":nombres", $usuario->nombres);
			$stmt->bindParam(":apellidos", $usuario->apellidos);
			$stmt->bindParam(":pass", $usuario->contraseña);
			$stmt->bindParam(":email", $usuario->email);
			$stmt->bindParam(":codigoActivacion", $usuario->codigoActivacion);

			$stmt->execute();
			$exito = 1;
		}
		catch(\PDOException $ex){
			$exito = FALSE;
		}
		finally{
			$con = null;
			return $exito;
		}

	}

	public function ActivarUsuario($codigoActivacion){
		try{
			$this->IniciarConexionMySQL();
			$stmt = $this->con->prepare("UPDATE usuarios SET activada = true WHERE codigoActivacion = :codigoActivacion AND activada = false");
			$stmt->bindParam(":codigoActivacion", $codigoActivacion);

			$stmt->execute();
			$exito = 1;
		}
		catch(\PDOException $ex){
			$exito = FALSE;
		}
		finally{
			$con = null;
			return $exito;
		}
	}
}