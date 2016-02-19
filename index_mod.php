<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta description="Admin de mapas" />
        <title>Documentacion Models</title>
        <style type="text/css">
        </style> 
    </head>
	<body>
	<?php
	include "funciones.php";
	$cadena = "function ";
	$varcad = "protected ";
	$arrNombresFunc = array();
	$url = getMainDir() . "application/models/";
	if(file_exists($url)){
		$directorio = opendir($url); //ruta actual
		while ($archivo = readdir($directorio))
		{
			if($archivo!= "." && $archivo!= ".." && $archivo!= "thumb.db"){
				$owner = "";
				$clss = str_ireplace(".php", "", $archivo);
				$create_date=traduceFecha(date("F d Y.", filectime($url . $archivo)));
				$mod_date=traduceFecha(date("F d Y.", filemtime($url . $archivo)));

				echo "<br><hr><br>Archivo: <b>" . $archivo . "</b><br>";
				echo "* Author: usuario < email@esmas.net > <br>";
				echo "* Type: Class " . "<br>";
				echo "* Description: Class " . $clss . "<br>";
				//echo "* Creation Date: ".$create_date."<br>";
				echo "* Last Modification Date: ".$mod_date."<br>";
				//echo "<br>";
				$fichero_url = fopen ($url . $archivo, "r");
				while ($trozo = fgets($fichero_url, 1024)){
					$trozo = trim($trozo);
					$pos1 = stripos($trozo, $cadena);
					$cnt=0;
					$acc=0;
					$arr='';
					$acct="";
					if ($pos1 !== false) {
						$arr = explode(" ",$trozo);
						for($a=0;$a<count($arr);$a++){
							if($arr[$a]=="protected"){
								$gvar = str_ireplace("protected ", "", $trozo);
								echo "* Protected : " . $gvar . "<br>";
							} 
							if($arr[$a]=="const"){
								$gvar = str_ireplace("const ", "", $trozo);
								echo "* Constant : " . $gvar . "<br>";
							}
							if($arr[$a]=="function"){
								$cnt = $a + 1;
								$acc = $a;
								$a=count($arr);
							} else {
								$cnt = 1;
							}

						}
						for($b=0;$b<$acc;$b++){
							$acct .= $arr[$b] . " ";
						}
						$prm = explode("(",$trozo);
						$prmv="";
						if(count($prm)>0){
							$prms = $prm[1];
							$prmss = explode(",",$prms);
							for ($i=0; $i < count($prmss); $i++) { 
								if(strlen(limpiachar($prmss[$i]))>0) {
									$prmv .= limpiachar($prmss[$i]) . ",";
								}
							}
						} else {
							$prmv = "none";
						}
						if(strlen($prmv)<=0){$prmv = "none";}

						$returna = 'none';

						$cm = substr_count($arr[$cnt],"Action");
						($cm==0) ? $cmr='Function' : $cmr='Action';

						/*$arrFuncPar = explode("(",strtolower($arr[$cnt]));
						$f=true;

						if(strlen($arrFuncPar[0])>0){
							for ($q=0; $q < count($arrNombresFunc); $q++) { 
								if ($arrNombresFunc[$q]==$arrFuncPar[0]) {
									$f=false; 
								}
							}
							if ($f==true) {
								$arrNombresFunc[]=strtolower($arrFuncPar[0]);
							}
						}*/
						$arrFuncPar = explode("(",$arr[$cnt]);
						if(strlen($arrFuncPar[0])>0){
						echo "<br> - " . $arrFuncPar[0] . "<br>";
						} else {
						echo "<br> - " . $arr[$cnt] . "<br>";
						}
						echo "* @author: usuario < email@esmas.net ><br>";
						echo "* @access: ".$acct."<br>";
						echo "* @params: ". $prmv."<br>";
						//echo "* @return: ".$returna."<br>";
						echo "* @Type: " . $cmr . "<br>";
						//echo "* Description: <br>";
					} else {
						if (strpos($trozo,"return") !== false) { 
							$ret = trim($trozo);
							$ret = str_ireplace("return ", "", $ret);
							$returna='none';
							$describe='';
							if (strpos($ret,"$") !== false) { $returna = 'Value';$describe='Devuelve un valor.'; }
							if (strpos($ret,"fetchAll") !== false) { $returna = 'Array';$describe='Devuelve un listado de registros.'; }
							if (strpos($ret,"fetchRow") !== false) { $returna = 'Array';$describe='Devuelve un registro encontrado.'; }
							if (strpos($ret,"insert") !== false) { $returna = 'True/False';$describe='Agrega un registro.'; }
							if (strpos($ret,"delete") !== false) { $returna = 'True/False';$describe='Borra un registro.'; }
							if (strpos($ret,"update") !== false) { $returna = 'True/False';$describe='Actualiza un registro.'; }
							if (strpos($ret,"lastInsertId") !== false) { $returna = 'Array';$describe='El último registro agregado.'; }
							if (strpos($ret,"true") !== false) { $returna = 'True/False';$describe='Proceso exitoso/erroneo.'; }
							if (strpos($ret,"false") !== false) { $returna = 'True/False';$describe='Proceso exitoso/erroneo.'; }
							if (strpos($ret,"find") !== false) { $returna = 'Array';$describe='Devuelve un registro encontrado.'; }
							echo "* @return: " . $returna . "<br>";
							echo "* Description: " . $describe . "<br>";
						} else {
						$arr = explode(" ",$trozo);
						for($a=0;$a<count($arr);$a++){
							if($arr[$a]=="protected"){
								$gvar = str_ireplace("protected ", "", $trozo);
								$dscr="";
								if(limpiachar($arr[$a+1])=='$_name'){ $dscr = "Nombre de table en BD.";}
								if(limpiachar($arr[$a+1])=='$_primary'){ $dscr = "PrimaryKey de table.";}
								if(limpiachar($arr[$a+1])=='$_sequence'){ $dscr = "PrimaryKey incrementable de table.";}
								echo "<br>";
								echo "* Global type : Protected <br>";
								echo "* Global var : " . limpiachar($arr[$a+1]) . " <br>";
								echo "* Global value : " . limpiachar($arr[$a+3]) . " <br>";
								echo "* Global description : ".$dscr." <br>";
							}
							if($arr[$a]=="const"){
								$gvar = str_ireplace("const ", "", $trozo);
								$dscr="";
								if(limpiachar($arr[$a+1])=='ITEMS_BY_PAGE'){ $dscr = "Constante de elementos a mostrar por página.";}
								echo "<br>";
								echo "* Global type : Constant <br>";
								echo "* Global var : " . limpiachar($arr[$a+1]) . " <br>";
								echo "* Global value : " . limpiachar($arr[$a+3]) . " <br>";
								echo "* Global description : ".$dscr." <br>";
							}
						}
						}
					}
				}
			}
		}
	}
	/*sort($arrNombresFunc);
	foreach ($arrNombresFunc as $key => $val) {
		$returna = '';
		if (strpos($val,"get") !== false) { $returna = 'array'; }
		if (strpos($val,"insert") !== false) { $returna = 'true/false'; }
		if (strpos($val,"del") !== false) { $returna = 'true/false'; }
		if (strpos($val,"add") !== false) { $returna = 'true/false'; }
		if (strpos($val,"upda") !== false) { $returna = 'true/false'; }
		if (strpos($val,"list") !== false) { $returna = 'array'; }
		if (strpos($val,"search") !== false) { $returna = 'array'; }
		if (strpos($val,"sele") !== false) { $returna = 'array'; }
	    echo $val . " -> " . $returna . "<br>";
	}*/
	?>
	</body>
</html>