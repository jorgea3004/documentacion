<?php
/*
* Archivo de Funciones para la Documentacion
*
*
*
*
*/
function getMainDir(){
	return "/jorge/htdocs/televisainternacional/";
}
function limpiachar($cadena){
	$cadena = trim($cadena);
	$cadena = str_ireplace(")", "", $cadena);
	$cadena = str_ireplace("{", "", $cadena);
	$cadena = str_ireplace("){", "", $cadena);
	$cadena = str_ireplace(") {", "", $cadena);
	$cadena = str_ireplace("'", "", $cadena);
	$cadena = str_ireplace('"', '', $cadena);
	$cadena = str_ireplace(';', '', $cadena);
	$cadena = str_ireplace('.', '', $cadena);
	$cadena = str_ireplace(',', '', $cadena);
	return $cadena;
}


?>