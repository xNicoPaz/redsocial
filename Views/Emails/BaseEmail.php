<?php 
namespace Views\Emails;

use Views\BaseView;

class BaseEmail extends BaseView{
	protected $listaDestinatarios = array();

	//Contenido alternativo que no esta en HTML. Algunos clientes SMTP no soportan HTML.
	//Esta propiedad tiene que ser puro texto, sin tags html.
	protected $altContenido;

	//To do: Implementar el metodo enviar
	public function Enviar(){
		$mail = new \PHPMailer;
	    $mail->isSMTP();
	    //Enable SMTP debugging
	    // 0 = off (for production use)
	    // 1 = client messages
	    // 2 = client and server messages
	    $mail->SMTPDebug = 0;
	    $mail->Host = 'smtp.gmail.com';
	    $mail->Port = 587;
	    $mail->SMTPSecure = 'tls';
	    $mail->SMTPOptions = array(
	        'ssl' => array(
	            'verify_peer' => false,
	            'verify_peer_name' => false,
	            'allow_self_signed' => true
	        )
	    );
	    $mail->CharSet = "UTF-8";
	    $mail->SMTPAuth = true;
	    $mail->Username = "noreply.imt.tune@gmail.com";
	    $mail->Password = "samsungbangho";
	    $mail->setFrom('from@example.com', 'Red Social - Su perdida de tiempo favorita');
	    $mail->addReplyTo('noreply.imt.tune@gmail.com', 'Servicio de Email');
                      //Añadir todos los destinatarios
                      foreach($this->listaDestinatarios as $email => $nomApe){
                          $mail->addAddress($email, $nomApe);
                      }
                      
	    $mail->Subject = 'Red Social - Activar cuenta';
	    //Read an HTML message body from an external file, convert referenced images to embedded,
	    //convert HTML into a basic plain-text alternative body
	    $mail->msgHTML($this->contenido);
	    $mail->AltBody = $this->altContenido;
	    if (!$mail->send()) {
	        //To do: ¿Que hago si no se envia el email?
	    }
	}

	//To do: Implementar el metodo AddDestinatario
	public function AddDestinatario($email, $nombre){
		$this->listaDestinatarios = array_merge($this->listaDestinatarios, array($email => $nombre));
	}
}
?>