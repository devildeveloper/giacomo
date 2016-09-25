<?php
// Guardar los datos recibidos en variables:
$origen ="EDUCACCION - Website";
$empresa = utf8_decode($_POST['empresa']);
$nombres = utf8_decode($_POST['nombres']);
$apellidos = utf8_decode($_POST['apellidos']);
$cargo = utf8_decode($_POST['cargo']);
$sector = utf8_decode($_POST['sector']);
$tlf = $_POST['tlf'];
$email = $_POST['email'];
$interes = utf8_decode($_POST['interes']);
$comentario = utf8_decode($_POST['comentario']);

// Definir el correo de destino:
//$dest = "romeromarleny@gmail.com, giacomo1203@gmail.com, mromero@losmolinosinmobiliaria.com, dcarrizales@losmolinosinmobiliaria.com, ventas@losmolinosinmobiliaria.com, info@losmolinosinmobiliaria.com"; 
$dest = "romeromarleny@gmail.com, giacomo1203@gmail.com, dcarrizales@losmolinosinmobiliaria.com";
 
 
// Estas son cabeceras que se usan para evitar que el correo llegue a SPAM:
$headers = "From: $origen $email\r\n";
$headers .= "X-Mailer: PHP5\n";
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Aqui definimos el asunto y armamos el cuerpo del mensaje
//$asunto = "Contacto";
$cuerpo = "Empresa: ".$empresa."<br>";
$cuerpo .= "Nombre: ".$nombres."<br>";
$cuerpo .= "Apellido: ".$apellidos."<br>";
$cuerpo .= "Cargo: ".$cargo."<br>";
$cuerpo .= "Sector: ".$sector."<br>";
$cuerpo .= "Teléfono: ".$tlf."<br>";
$cuerpo .= "Email: ".$email."<br>";
$cuerpo .= "Interes: ".$interes."<br>";
$cuerpo .= "Comentario: ".$comentario;
 
// Esta es una pequena validación, que solo envie el correo si todas las variables tiene algo de contenido:
if($nombres != '' && $email != '' && $interes != '' && $comentario != ''){
    mail($dest,$interes,$cuerpo,$headers); //ENVIAR!
}
?>