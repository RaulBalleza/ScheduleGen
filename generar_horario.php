<?php 
	//incluyo el archivo que contiene las clases necesarias
	include 'clases.php';
	//direccion del archivo
	$name_file = "iti 4-1.txt";
	//auxiliar para guardar el nombre del grupo o horario
	$name_group = "";
	//declaro el objecto en donde se guarda el horario
	$horario = new Horario;
	//se crea una variable para almacenar temporalmente el archivo
	$file = fopen($name_file, "r") ;
	//Para saber en que seccion del archivo se encuentra
	$aux = 0;
	//Para saber en que periodo
	$auxPeriodo = 0;
	//Linea en linea hasta encontrar el fin de cadena
	while(!feof($file)){
		//se guarda la linea
		$line = fgets($file);
		//se borra todos los saltos de linea de la linea
		$line = preg_replace("/[\r\n|\n|\r]+/", "", $line);
		//se busca el nombre de la materia a traves de expresiones regulares
		if (preg_match("/\[(.*?)\]/", $line)) {
			//y se hace un recorte para extraer el nombre
			$name_group = substr($line, 1, strlen($line)-2);
			//se guarda el nombre al horario
			$horario->setNombre($name_group);
		}
		//se checa en que seccion esta
		if ("LUNES:" == $line) {
			$aux = 1;
			$auxPeriodo = 0;
		}elseif ("MARTES:" == $line) {
			$aux = 2;
			$auxPeriodo = 0;
		}elseif ("MIERCOLES:" == $line) {
			$aux = 3;
			$auxPeriodo = 0;
		}elseif ("JUEVES:" == $line) {
			$aux = 4;
			$auxPeriodo = 0;
		}elseif ("VIERNES:" == $line) {
			$aux = 5;
			$auxPeriodo = 0;
		}elseif ("SABADO:" == $line) {
			$aux = 6;
			$auxPeriodo = 0;
		}
		//si anda una seccion
		if ($aux >=1 and $aux <= 6) {
			//se divide la linea en varias cadenas de texto con la coma 
			$datos = explode(",", $line);
			//se verifica que existan los datos de la materia
			if (isset($datos[0]) and isset($datos[1]) 
				and isset($datos[2]) and isset($datos[3])) {
				$auxPeriodo ++;
				$hora = new Hora($aux, $auxPeriodo );
				$materia = new Materia($datos[2],$datos[0],$datos[1], $datos[3]);
				//si la materia no existe, se agrega al horario
				if(! $horario->buscarMateria($materia->getClave(), $materia->getSalon(), $hora)){
					$horario->addMaterias($materia);
					//se vuelve a buscar para guardar la hora en la materia
					//checa la funcion buscarMateria
					$horario->buscarMateria($materia->getClave(), $materia->getSalon(), $hora);
				}
			}
		}
		
	}
	//cierra la lectura del archivo
	fclose($file);
?>