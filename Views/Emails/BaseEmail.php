<?php 
namespace Views\Emails;

use Views\BaseView;

class BaseEmail{
	protected $listaDestinatarios = array();

	//To do: Implementar el metodo enviar
	protected Enviar(){}

	//To do: Implementar el metodo AddDestinatario
	protected AddDestinatario($destinatario){
		array_push($this->lista, $destinatario);
	}
}
?>