<?php 
namespace Views\WebPages;

use Views\WebPages\Includes;
use Views\WebPages\BaseWebPage;

	class Registro extends BaseWebPage
	{
		public function __construct($usVal, $nomVal = true, $apeVal = true, $passVal = true, $repPass = true, $emailVal = true, $emailUn = true){

			$this->contenido = Includes::Head();
			if($usVal){
				//Si el usuario es valido, mostrarle un mensaje indicando exito y que se ha enviado el email de activacion.
				$this->contenido .= "<h1>Casi listo</h1>" 
									. "<p>Se ha enviado un correo electronico a la direccion de email proporcionada."
									. "Para completar el proceso de registro ingrese a su cuenta de correo haga click en"
									. " el email de activacion</p>";
			} else{
				//Si el usuario no es valido, volver a mostrarle el formulario de registro con los correspondientes errores
				$mensNom = ($nomVal) ? "" : "Este campo puede ser de hasta 100 caracteres, no se aceptan numeros.";
				$mensApe = ($apeVal) ? "" : "Este campo puede ser de hasta 100 caracteres, no se aceptan numeros.";
				$mensPass = ($passVal) ? "" : "La contraseña debe tener entre 8 y 50 caracteres, se aceptan numeros y letras tanto en mayuscula como en minuscula.";
				$mensRepPass = ($repPass) ? "" : "Las contraseñas especificadas no coinciden.";
				$mensEmail = ($emailVal) ? "" : "El email ingresado no es valido.";
				$mensEmailUn = ($emailUn) ? "" : "El email ingresado ya se encuentra registrado, no puede usarse dos veces.";

				$this->contenido .= "<body>
						<form method='post' action='". WEBROOT . "index.php?controlador=registro&metodo=registrar' enctype='multipart/form-data'>
							Nombres: <input name='nombres' id='nombres' type='text'> " . $mensNom . "<br>
							Apellidos: <input name='apellidos' id='apellidos' type='text'> " . $mensApe . "<br>
							Email: <input name='email' id='email' type='email'> " . $mensEmail .  $mensEmailUn . "<br>
							Contraseña: <input name='pass' id='pass' type='password'> " . $mensPass . "<br>
							Repita su contraseña: <input name='repPass' id='repPass' type='password'> " . $mensRepPass . "<br>
							<input name='submit' id='submit' type='submit'>
						</form>
					</body>
				";

			}
		}

	}