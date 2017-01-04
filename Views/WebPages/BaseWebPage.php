<?php
namespace Views\WebPages;

use Views\BaseView;

class BaseWebPage extends BaseView{
	public function Mostrar(){
		echo $this->contenido;
	}
}
?>