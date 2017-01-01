<?php namespace Config;
define('ROOT', "/opt/lampp/htdocs/redsocial/");
define('WEBROOT', "//localhost/redsocial/");

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