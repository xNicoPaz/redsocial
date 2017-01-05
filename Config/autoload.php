<?php namespace Config;
//Constante usada para requerir archivos
define('ROOT', "/opt/lampp/htdocs/redsocial/");
//Constante usada para construir URLs
define('WEBROOT', "//localhost/redsocial/");

//Llamar al autoloader de las librerias de terceros
require ROOT . "vendor/autoload.php";

class autoload{
	public static function run(){
		spl_autoload_register(function($class){
			$script = ROOT . str_replace("\\", "/", $class) . ".php";

			if(is_readable($script)){
				require_once $script;
			}else{
				//echo "No se pudo encontrar a $class en $script" . PHP_EOL;
			}
		});
	}
}

?>