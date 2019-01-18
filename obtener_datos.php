<?php 

	$name_file = $_POST["url_file"];

	$name_group = "";

	$file = fopen($name_file, "r") ;
	//Para saber en que seccion del archivo se encuentra
	$aux = 0;
	//Linea en linea hasta encontrar el fin de cadena
	while(!feof($file)){
		$line = fgets($file);
		$line = preg_replace("/[\r\n|\n|\r]+/", "", $line);

		if (preg_match("/\[(.*?)\]/", $line)) {
			$name_group = substr($line, 1, strlen($line)-2);
		}
		if ("LUNES:" == $line) {
			$aux = 1;
		}elseif ("MARTES:" == $line) {
			$aux = 2;
		}elseif ("MIERCOLES:" == $line) {
			$aux = 3;
		}elseif ("JUEVES:" == $line) {
			$aux = 4;
		}elseif ("VIERNES:" == $line) {
			$aux = 5;
		}elseif ("SABADO:" == $line) {
			$aux = 6;
		}

		if ($aux == 1 and ("LUNES:" != $line) and ($line != "\n") and ($line != "")) {
			$datos = explode(",", $line);
			if (isset($datos[0]) and isset($datos[1]) 
				and isset($datos[2]) and isset($datos[3])) {

				
			}
		}
		// if ($aux == 2) {
		// 	echo "MARTES";
		// }
		// if ($aux == 3) {
		// 	echo "MIERCOLES";
		// }
		// if ($aux == 4) {
		// 	echo "JUEVES";
		// }
		// if ($aux == 5) {
		// 	echo "VIERNES";
		// }
		// if ($aux == 6) {
		// 	echo "SABADO";
		// }
	}
	fclose($file);
 ?>