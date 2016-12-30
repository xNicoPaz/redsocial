<?php namespace Views;

abstract class BaseView
{
	protected $contenido;

	/**
	 * Imprime el contenido de la vista
	 */
	public function Mostrar(){
		echo $this->contenido;
	}
}