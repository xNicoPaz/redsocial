<?php 
namespace Views\WebPages;

use Views\WebPages\Includes;

class NotFound
{
	public static function show(){
		/*echo 
			"<h1>Esta pagina no existe papilo, no te hagas el hacker</h1>"
			. Includes::Head()
*/
		echo 
			Includes::Head()
		 	. Includes::Header()
			. "<div class='page-header'>
			 	<h1>Error 404 - ¡Uuups!</h1>
			 </div>"
			 . "<p>La pagina a la que intenta acceder parece no existir.</p>
			 <div class='alert alert-danger'><strong>No se haga el hacker<strong>, vaya a estudiar.</div>"
			 . Includes::Footer();
	}
}