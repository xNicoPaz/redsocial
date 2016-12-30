<?php namespace Config;

class Request
{
	//Atributos
	private $controlador;
	private $metodo;
	private $post_data;

	//Metodos magicos

	/**
	 * Usado para setear una de las siguientes propiedades:
	 * 1. Controlador
	 * 2. Metodo
	 * 3. POST_DATA
	 * @param string $prop: La propiedad a setear
	 * @param mixed $value: El valor a asignar a la propiedad
	 */
	public function set($prop, $value)
	{
		$this->$prop = $value;
	}

	/**
	 * Usado para retornar el valor de una de las siguientes propiedades
	 * 1. Controlador
	 * 2. Metodo
	 * 3. POST_DATA
	 * @param $prop
	 * @return mixed
	 */
	public function get($prop){
		return $this->$prop;
	}

	public function __construct(){
		if(isset($_GET['controlador'])){
			//ver cual es
			$this->controlador = $_GET['controlador'];
		}else{
			//mandarlo por defecto al home
			$this->controlador = "index";
		}

		if(isset($_GET['metodo'])){
			$this->metodo = $_GET['metodo'];
		}else{
			//metodo por defecto
			$this->metodo = "default";
		}

		//Copio el contenido de $_POST a post_data, tal vez $_POST en algun momento se destruya si paso
		//el control a otro script.
		$this->post_data = $_POST;
	}
}