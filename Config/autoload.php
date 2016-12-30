<?php namespace Config;
define('ROOT', "C:\\wamp64\\www\\redsocial\\");
define('WEBROOT', "//localhost:63342/redsocial2/");

class autoload{
	public static function run(){
		spl_autoload_register(function($class){
			$script = ROOT . $class . ".php";

			if(is_readable($script)){
				require_once $script;
			}else{
				//echo "No se pudo encontrar a $class en $script" . PHP_EOL;
			}
		});
	}
}

?>