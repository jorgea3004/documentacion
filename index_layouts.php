<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta description="Admin de mapas" />
        <title>Documentacion Layouts</title>
        <style type="text/css">
        </style> 
    </head>
	<body>
	<?php
	include "funciones.php";
    $url = getMainDir() . "application/layouts/scripts/";
    if(file_exists($url)){
        $directorio = opendir($url); //ruta actual
        while ($archivo = readdir($directorio))
        {
            if($archivo!= "." && $archivo!= ".." && $archivo!= "thumb.db"){
                $create_date=traduceFecha(date("F d Y.", filectime($url . $archivo)));
                $mod_date=traduceFecha(date("F d Y.", filemtime($url . $archivo)));
                echo "<br><hr><br>Archivo: <b>" . $archivo . "</b><br>";
                echo "* Author: usuario < email@televisatim.com > <br>";
                echo "* Type: Layout" . "<br>";
                //echo "* Creation Date: ".$create_date."<br>";
                echo "* Last Modification Date: ".$mod_date."<br>";
                echo "* Description: Layout de sistema<br>";
                echo "Usado en: <br>";
                $urlContr = getMainDir() . "application/controllers/";
                if(file_exists($urlContr)){
                    $dirContr = opendir($urlContr);
                    while ($archContr = readdir($dirContr))
                    {
                        if($archContr!= "." && $archContr!= ".." && $archContr!= "thumb.db"){
                            //echo " -> " . $archContr ."<br>";
                            $fichero_url = fopen ($urlContr . $archContr, "r");
                            while ($trozo = fgets($fichero_url, 1024)){
                                $trozo = trim($trozo);
                                $strLayout = str_replace(".phtml", "", $archivo);
                                $cadena = "setLayout('".$strLayout."');";
                                $pos1 = stripos($trozo, $cadena);
                                if ($pos1 !== false) {
                                    echo " -> " . str_replace(".php", "", $archContr) ."<br>";
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    ?>
    </body>
</html>