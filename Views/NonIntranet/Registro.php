<?php namespace Views\NonIntranet;
	use Views;

	class Registro extends \Views\BaseView
	{
		public function __construct($nomVal = true, $apeVal = true, $passVal = true, $repPass = true, $emailVal = true, $emailUn = true){
			$mensNom = ($nomVal) ? "" : "Este campo puede ser de hasta 100 caracteres, no se aceptan numeros.";
			$mensApe = ($apeVal) ? "" : "Este campo puede ser de hasta 100 caracteres, no se aceptan numeros.";
			$mensPass = ($passVal) ? "" : "La contraseña debe tener entre 8 y 50 caracteres, se aceptan numeros y letras tanto en mayuscula como en minuscula.";
			$mensRepPass = ($repPass) ? "" : "Las contraseñas especificadas no coinciden.";
			$mensEmail = ($emailVal) ? "" : "El email ingresado no es valido.";
			$mensEmailUn = ($emailUn) ? "" : "El email ingresado ya se encuentra registrado, no puede usarse dos veces.";

			$this->contenido = Views\Includes::Head();
			$this->contenido .=
				"<body>
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