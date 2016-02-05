<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta description="Admin de mapas" />
        <title>Documentacion</title>
        <style type="text/css">
        h1,h2,h3,h4,h5 {font-size: 11px;}
        h1 {margin: 0px 0px 0px 0px; padding:0;} h1 p {margin: 0px 0px 0px 0px; padding:0;}
        h2 {margin: 0px 0px 0px 0px; padding:0;} h2 p {margin: 0px 0px 0px 10px; padding:0;}
        h3 {margin: 0px 0px 0px 0px; padding:0;} h3 p {margin: 0px 0px 0px 20px; padding:0;}
        h4 {margin: 0px 0px 0px 0px; padding:0;} h4 p {margin: 0px 0px 0px 30px; padding:0;}
        </style> 
    </head>
	<body>
	<?php
	include "funciones.php";
	$cadena = "function ";
	$url = getMainDir() . "application/";
	if(file_exists($url)){
		$directorio = opendir($url); //ruta actual
		while ($archivo = readdir($directorio))
		{
			if($archivo != "." && $archivo!= ".." && $archivo!= "thumb.db"){
				$sdir = $url . $archivo . "/";
				echo "<h1><p>" . $archivo . "</p></h1>";
				if(is_dir($sdir)){
					$sbdirec = opendir($sdir); //ruta actual
					while ($ssdir = readdir($sbdirec))
					{
						if($ssdir != "." && $ssdir!= ".." && $ssdir!= "thumb.db"){
							echo "<h2><p>- " . $ssdir . "</p></h2>";
							$sbdir = $url . $archivo . "/" . $ssdir . "/";
							if(is_dir($sbdir)){
								$sbdirect = opendir($sbdir); //ruta actual
								while ($sssdir = readdir($sbdirect))
								{
									if($sssdir != "." && $sssdir!= ".." && $sssdir!= "thumb.db"){
										echo "<h3><p>-- " . $sssdir . "</p></h3>";
										$sbddir = $url . $archivo . "/" . $ssdir . "/" . $sssdir . "/";
										if(is_dir($sbddir)){
											$sbddirect = opendir($sbddir); //ruta actual
											while ($sssddir = readdir($sbddirect))
											{
												if($sssddir != "." && $sssddir!= ".." && $sssddir!= "thumb.db"){
													echo "<h4><p>--- " . $sssddir . "</p></h4>";
												}
											}
										}
									}
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