<?php
namespace Views\WebPages;

use Views\WebPages\Includes;
use Views\WebPages\BaseWebPage;

	class Registro extends BaseWebPage
	{
		public function __construct($usVal, $nomVal = true, $apeVal = true, $passVal = true, $repPass = true, $emailVal = true, $emailUn = true, $nombres = "", $apellidos = "", $email = "", $pass = ""){

			$this->contenido = Includes::Head();
			$this->contenido .= Includes::Header();
			if($usVal){
				//Si el usuario es valido, mostrarle un mensaje indicando exito y que se ha enviado el email de activacion.
				$this->contenido .= "<h1>Casi listo</h1>" 
									. "<p>Se ha enviado un correo electronico a la direccion de email proporcionada."
									. " Para completar el proceso de registro ingrese a su cuenta de correo haga click en"
									. " el email de activacion</p>";
			}else{
				//Mensaje de error de Nombres
				$mensNom = ($nomVal) ? "" : "<span class='alert alert-danger col-sm-6'>Este campo puede ser de hasta 100 caracteres, no se aceptan numeros ni caracteres especiales. </span>";
				//Mensaje de error de Apellidos
				$mensApe = ($apeVal) ? "" : "<span class='alert alert-danger col-sm-6'>Este campo puede ser de hasta 100 caracteres, no se aceptan numeros ni acaracteres especiales.  </span>";
				//Mensajes de error de Contraseña y Repeticion de Contraseña
				if(!$passVal){
					$mensPass = "<span class='alert alert-danger col-sm-6'>La contraseña debe tener entre 8 y 50 caracteres, se aceptan numeros y letras tanto en mayuscula como en minuscula.  </span>";
					$mensRepPass = "";
				}else{
					$mensPass = "";
					if(!$repPass){
						$mensRepPass = "<span class='alert alert-danger col-sm-6'>Las contraseñas especificadas no coinciden.  </span>";
					}else
						$mensRepPass = "";					
				}
				//Mensaje de error de Email
				if(!$emailVal)
					$mensEmail = "El email ingresado no es valido.";
				elseif(!$emailUn)
					$mensEmail = "El email ingresado ya se encuentra registrado.";
				$mensEmail = (!$emailVal || !$emailUn) ? "<span class='alert alert-danger col-sm-6'>" . $mensEmail . "</span>" : "";

				$mostrarEmail = $emailVal && $emailUn;
				$mostrarContraseña = $passVal && $repPass; 

				//Elaboracion el cuerpo de la vista
				$this->contenido .= "
					<div class='page-header'>	
						<h1>Registrese <small>(No se haga el dificil)</small></h1>
					</div>
						<form method='post' action='". WEBROOT . "index.php?controlador=registro&metodo=registrar' enctype='multipart/form-data' class='form-horizontal'>
							<div class='form-group'>
								<label for='nombres' class='control-label col-sm-2'>Nombres:</label>
								<div class='col-sm-4'>
									<input name='nombres' id='nombres' type='text' class='form-control' placeholder='Ingrese sus nombres' value='";
				//Colocaccion del mensaje de error de Nombres
				$this->contenido .= ($nomVal) ? $nombres : "";
				$this->contenido .= "'>
								</div>
								" . $mensNom . "
							</div>
							<div class='form-group'>
								<label for='apellidos' class='control-label col-sm-2'>Apellidos:</label>
								<div class='col-sm-4'>
									<input name='apellidos' id='apellidos' type='text' class='form-control' placeholder='Ingrese sus apellidos' value='";
				//Colocaccion del mensaje de error de Apellidos
				$this->contenido .= ($apeVal) ? $apellidos : "";
				$this->contenido .= "'>
								</div>
								" . $mensApe . "
							</div>
							<div class='form-group'>
								<label for='email' class='control-label col-sm-2'>Email:</label>
								<div class='col-sm-4'>
									<input name='email' id='email' type='email' class='form-control' placeholder='Ingrese su correo electronico' value='";
				//Colocaccion del mensaje de error de Email
				$this->contenido .= ($mostrarEmail) ? $email : "";
				$this->contenido .= "'>
								</div>
								" . $mensEmail . "
							</div>
							<div class='form-group'>
								<label for='pass' class='control-label col-sm-2'>Contraseña:</label>
								<div class='col-sm-4'>		
									<input name='pass' id='pass' type='password' class='form-control' placeholder='Ingrese su contraseña' value='";
				//Colocaccion del mensaje de error de Contraseña
				$this->contenido .= ($mostrarContraseña) ? $pass : "";
				$this->contenido .= "'>
								</div> 
								" . $mensPass . "
							</div>
							<div class='form-group'>
								<label for='repPass' class='control-label col-sm-2'>Repita su contraseña:</label>
								<div class='col-sm-4'>
									<input name='repPass' id='repPass' type='password' class='form-control' placeholder='Por favor repita su contraseña' value='";
				//Colocaccion del mensaje de error de Repeticion de Contraseña
				$this->contenido .= ($mostrarContraseña) ? $pass : "";
				$this->contenido .= "'> 
								</div>
								" . $mensRepPass . "
							</div>
							<div class='container col-sm-6'>
								<input name='submit' id='submit' type='submit' class='btn btn-primary' value='Registrarme'>
							</div>
						</form>
					</body>";
			}
			$this->contenido .= Includes::Footer();
		}

	}