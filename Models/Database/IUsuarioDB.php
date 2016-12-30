<?php namespace Models\Database;

use Models\Usuario;

interface IUsuarioDB
{
	public function EmailUnico($email);
	public function GuardarUsuario(Usuario $usuario);
}