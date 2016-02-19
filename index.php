<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta description="Admin de mapas" />
        <title>Documentacion</title>
        <style type="text/css">
        </style> 
    </head>
	<body>
	<?php
	include "funciones.php";
	$cadena = "function ";
	$url = getMainDir() . "application/controllers/";
	if(file_exists($url)){
		$directorio = opendir($url); //ruta actual
		while ($archivo = readdir($directorio))
		{
			if($archivo!= "." && $archivo!= ".." && $archivo!= "thumb.db"){
				$axo = date ("Y", filemtime($url . $archivo));
				$mes = date ("m", filemtime($url . $archivo));
				if($axo >= 2014){
					//$owner = fileowner($url.$archivo);
					$clss = str_ireplace("Controller.php", "", $archivo);
					$clss = str_ireplace(".php", "", $archivo);
					$create_date=traduceFecha(date("F d Y.", filectime($url . $archivo)));
					$mod_date=traduceFecha(date("F d Y.", filemtime($url . $archivo)));

					echo "<br><hr><br>Archivo: <b>" . $archivo . "</b><br>";
					echo "* Author: usuario < email@esmas.net > <br>";
					echo "* Type: Class Controller" . "<br>";
					echo "* Description: Class " . $clss . "<br>";
					echo "* Creation Date: ".$create_date."<br>";
					echo "* Last Modification Date: ".$mod_date."<br><br>";
					echo "<br>";
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
								if($arr[$a]=="function"){
									$cnt = $a + 1;
									$acc = $a;
									$a=count($arr);
								} else {$cnt = 1;}
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

							$cm = substr_count($arr[$cnt],"Action");
							($cm==0) ? $cmr='Function' : $cmr='Action';

							echo " - " . $arr[$cnt] . "<br>";
							echo "* @author: usuario < email@esmas.net ><br>";
							echo "* @access: ".$acct."<br>";
							echo "* @params: ". $prmv."<br>";
							echo "* @return: none<br>";
							echo "* Type: " . $cmr . "<br>";
							echo "* Description: <br><br>";
						}
					}
				}
			}
		}
	}
	?>
	</body>
</html>