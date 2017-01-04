<?php
//Autoload
require "Config/autoload.php";
Config\autoload::run();
//Llamar al enrutador
Config\Enrutador::run(new \Config\Request());