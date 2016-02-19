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
function traduceFecha($cadena){
	$cadena = str_ireplace('January', 'Enero', $cadena);
	$cadena = str_ireplace('February', 'Febrero', $cadena);
	$cadena = str_ireplace('March', 'Marzo', $cadena);
	$cadena = str_ireplace('April', 'Abril', $cadena);
	$cadena = str_ireplace('May', 'Mayo', $cadena);
	$cadena = str_ireplace('June', 'Junio', $cadena);
	$cadena = str_ireplace('July', 'Julio', $cadena);
	$cadena = str_ireplace('August', 'Agosto', $cadena);
	$cadena = str_ireplace('September', 'Septiembre', $cadena);
	$cadena = str_ireplace('October', 'Octubre', $cadena);
	$cadena = str_ireplace('November', 'Noviembre', $cadena);
	$cadena = str_ireplace('December', 'Diciembre', $cadena);
	return $cadena;
}


?>