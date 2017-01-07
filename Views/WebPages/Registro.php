<?php
namespace Views\WebPages;

use Views\WebPages\Includes;
use Views\WebPages\BaseWebPage;

	class Registro extends BaseWebPage
	{
		public function __construct($usVal, $nomVal = true, $apeVal = true, $passVal = true, $repPass = true, $emailVal = true, $emailUn = true){

			$this->contenido = Includes::Head();
			$this->contenido .= Includes::Header();
			if($usVal){
				//Si el usuario es valido, mostrarle un mensaje indicando exito y que se ha enviado el email de activacion.
				$this->contenido .= "<h1>Casi listo</h1>" 
									. "<p>Se ha enviado un correo electronico a la direccion de email proporcionada."
									. "Para completar el proceso de registro ingrese a su cuenta de correo haga click en"
									. " el email de activacion</p>";
			}else{
				//Si el usuario no es valido, volver a mostrarle el formulario de registro con los correspondientes errores
				$mensNom = ($nomVal) ? "" : "<span class='alert alert-danger col-sm-6'>Este campo puede ser de hasta 100 caracteres, no se aceptan numeros. </span>";
				$mensApe = ($apeVal) ? "" : "<span class='alert alert-danger col-sm-6'>Este campo puede ser de hasta 100 caracteres, no se aceptan numeros.  </span>";
				$mensPass = ($passVal) ? "" : "<span class='alert alert-danger col-sm-6'>La contraseña debe tener entre 8 y 50 caracteres, se aceptan numeros y letras tanto en mayuscula como en minuscula.  </span>";
				$mensRepPass = ($repPass) ? "" : "<span class='alert alert-danger col-sm-6'>Las contraseñas especificadas no coinciden.  </span>";
				$mensEmail = ($emailVal) ? "" : "El email ingresado no es valido. ";
				$mensEmail .= ($emailUn) ? "" : "El email ingresado ya se encuentra registrado, no puede usarse dos veces.";
				$mensEmail = "<span class='alert alert-danger col-sm-6'>" . $mensEmail . "</span>";

				$this->contenido .= "
					<div class='page-header'>	
						<h1>Registrese <small>(No se haga el dificil)</small></h1>
					</div>
						<form method='post' action='". WEBROOT . "index.php?controlador=registro&metodo=registrar' enctype='multipart/form-data' class='form-horizontal'>
							<div class='form-group'>
								<label for='nombres' class='control-label col-sm-2'>Nombres:</label>
								<div class='col-sm-4'>
									<input name='nombres' id='nombres' type='text' class='form-control' placeholder='Ingrese sus nombres'>
								</div>
								" . $mensNom . "
							</div>
							<div class='form-group'>
								<label for='apellidos' class='control-label col-sm-2'>Apellidos:</label>
								<div class='col-sm-4'>
									<input name='apellidos' id='apellidos' type='text' class='form-control' placeholder='Ingrese sus apellidos'>
								</div>
								" . $mensApe . "
							</div>
							<div class='form-group'>
								<label for='email' class='control-label col-sm-2'>Email:</label>
								<div class='col-sm-4'>
									<input name='email' id='email' type='email' class='form-control' placeholder='Ingrese su correo electronico'>
								</div>
								" . $mensEmail . "
							</div>
							<div class='row'>
								<label for='pass' class='control-label col-sm-2'>Contraseña:</label>
								<div class='col-sm-4'>		
									<input name='pass' id='pass' type='password' class='form-control' placeholder='Ingrese su contraseña'>
								</div> 
								" . $mensPass . "
							</div>
							<div class='form-group'>
								<label for='repPass' class='control-label col-sm-2'>Repita su contraseña:</label>
								<div class='col-sm-4'>
									<input name='repPass' id='repPass' type='password' class='form-control' placeholder='Por favor repita su contraseña'> 
								</div>
								" . $mensRepPass . "
							</div>
							<div class='container col-sm-6'>
								<input name='submit' id='submit' type='submit' class='btn btn-primary' value='Registrarme'>
							</div>
						</form>
					</body>
				";
			}
			$this->contenido .= Includes::Footer();
		}

	}