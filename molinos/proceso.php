<?php
// Guardar los datos recibidos en variables:
$origen ="Web Los Molinos - ";
$nombre = utf8_decode($_POST['nombre']);
$email = $_POST['email'];
$asunto = utf8_decode($_POST['asunto']);
$mensaje = utf8_decode($_POST['mensaje']);

// Definir el correo de destino:
$dest = "romeromarleny@gmail.com, giacomo1203@gmail.com, mromero@losmolinosinmobiliaria.com, dcarrizales@losmolinosinmobiliaria.com, ventas@losmolinosinmobiliaria.com, info@losmolinosinmobiliaria.com"; 
 
// Estas son cabeceras que se usan para evitar que el correo llegue a SPAM:
$headers = "From: $origen $email\r\n";
$headers .= "X-Mailer: PHP5\n";
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Aqui definimos el asunto y armamos el cuerpo del mensaje
//$asunto = "Contacto";
$cuerpo = "Nombre: ".$nombre."<br>";
$cuerpo .= "Email: ".$email."<br>";
$cuerpo .= "Asunto: ".$asunto."<br>";
$cuerpo .= "Mensaje: ".$mensaje;
 
// Esta es una pequena validación, que solo envie el correo si todas las variables tiene algo de contenido:
if($nombre != '' && $email != '' && $asunto != '' && $mensaje != ''){
    mail($dest,$asunto,$cuerpo,$headers); //ENVIAR!
}
?>