<?php 
namespace Views\Emails;

use Views\Emails\BaseEmail;

class ActivationEmail extends BaseEmail{
    public function __construct($md5){
        $this->contenido = "<h1>Bienvenido a \"Red Social\"</h1>"
                . "<p>Para completar el proceso de registro debe activar su cuenta. Para hacerlo por favor haga click"
                . "en el siguiente enlace.</p>"
                . "<span><a href='" . WEBROOT . "?controlador=registro&metodo=activar&codigo=". $md5 ."'>¡Activar cuenta!</a></span>";
        $this->altContenido = "Bienvenido a Red Social" . PHP_EOL . "Para completar el proceso de registro debe activar su". " cuenta. Para hacerlo por favor haga clicken el siguiente enlace.¡Activar cuenta!" . PHP_EOL 
        	. WEBROOT . "?controlador=registro&metodo=activar&codigo=". $md5;
    }
}
?>