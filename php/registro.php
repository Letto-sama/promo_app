<?php
$response_recaptcha = $_POST['g-recaptcha-response'];
if(isset($response_recaptcha)&& $response_recaptcha){
	$secret = "6Lc6MysUAAAAAAUbxjrMnFvbUfUVqkItuZIRvdJO";
	$ip = $_SERVER['REMOTE_ADDR'];
	$validation_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response_recaptcha&remoteip=$ip");
	var_dump($validation_server);
}
	
$db_host="mysql.appfeelingco.com";
$db_user="promo_app";
$db_password="Ju24toro";
$db_name="promoapp";
$db_table_name="registro";
$db_connection = mysql_connect($db_host, $db_user, $db_password);

if (!$db_connection) {
	die('No se ha podido conectar a la base de datos');
}
$subs_name = utf8_decode($_POST['nombre']);
$subs_cc = utf8_decode($_POST['cc']);
$subs_punto_venta = utf8_decode($_POST['punto_venta']);
$subs_numero_factura = utf8_decode($_POST['numero_factura']);
$subs_foto_fact = utf8_decode($_POST['foto_fact']);
$subs_numero_cel = utf8_decode($_POST['numero_cel']);
$subs_email = utf8_decode($_POST['email']);

$resultado=mysql_query("SELECT * FROM ".$db_table_name." WHERE Email = '".$subs_email."'", $db_connection);

if (mysql_num_rows($resultado)>0)
{

header('Location: ../Fail.html');

} else {
	
	$insert_value = 'INSERT INTO `' . $db_name . '`.`'.$db_table_name.'` (`Nombre` , `Cc` , `Punto_de_Venta` , `Numero_de_Factura` , `Foto_de_la_factura` , `Numero_de_Celular` , `Email`) VALUES ("' . $subs_name . '", "' . $subs_cc . '", "' . $subs_punto_venta . '", "' . $subs_numero_factura . '", "' . $subs_foto_fact . '", "' . $subs_numero_cel . '", "' . $subs_email . '")';

mysql_select_db($db_name, $db_connection);
$retry_value = mysql_query($insert_value, $db_connection);

if (!$retry_value) {
   die('Error: ' . mysql_error());
}
	
header('Location: ../Success.html');

}

mysql_close($db_connection);

		
?>