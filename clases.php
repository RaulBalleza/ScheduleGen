<?php 
	/**
	 * Clase para el horario
	 */
	class Horario
	{
		private $nombre="";
		private $materias= [];
		
		public function setNombre($nombre)
		{
			$this->nombre = $nombre;
		}
		public function getNombre()
		{
			return $this->nombre;
		}

		public function addMaterias($materia)
		{
			$this->materias[] = $materia;
		}
		public function getMaterias()
		{
			return $this->materias;
		}
		//permite buscar una materia que coincida con la clave y el salon
		//si encontro la materia, anade la hora a la materia y retorna true , false si no la encontro
		public function buscarMateria($clave, $salon, $hora)
		{
			foreach ($this->materias as &$materia) {
				if ($materia->getClave() == $clave and $materia->getSalon() == $salon) {
					$materia->addHora($hora);
					return true;
				}
			}
			return false;
		}
		//muestra cada fila del horario (cada materia)
		public function mostrar()
		{
			$num = 0;
			foreach ($this->materias as $materia) {
				echo ($num == 4)? "<td colspan='9'><p class='h5' style='text-align: center;'>RECESO</p></td>" : "";
				$materia->mostrar();
				$num ++;
			}
			
		}
	}


	/**
	 * Clase para la materia
	 */
	class Materia
	{
		private $clave="";
		private $nombre="";
		private $profesor="";
		private $horas=[];
		private $salon;
		function __construct($clave, $nombre, $profesor, $salon)
		{
			$this->clave = $clave;
			$this->nombre = $nombre;
			$this->profesor = $profesor;
			$this->salon = $salon;
		}

		public function getClave()
		{
			return $this->clave;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getProfesor()
		{
			return $this->profesor;
		}
		public function addHora($hora)
		{
			$this->horas[] = $hora;
		}
		public function getHoras()
		{
			return $this->horas;
		}
		public function getSalon()
		{
			return $this->salon;
		}
		//muestra los datos y los coloca en cada campo de la fila de la tabla
		public function mostrar()
		{
			echo "<tr>";
			echo "<th><small>".utf8_encode($this->nombre)."</small></th>";
			echo "<td> <small>".utf8_encode($this->profesor)."</small></td>";
			echo "<td  class='text-uppercase'><small>".$this->clave."<br>".$this->salon."</small></td>";
			//para agregar las horas que contiene la materia, del 1 al 6 (dia de la semana)
			for ($i=1; $i < 7; $i++) { 
				$this->buscarHora($i);
			}
			echo "</tr>";
		}
		//busca la hora con el dia de la semana
		//imprime un campo de la fila de la materia
		private function buscarHora($diaSemana)
		{
			$valorInicial = 0;
			$valorFinal = 0;
			$esInicial = true;
			echo "<td> <small>";
			foreach ($this->horas as $hora) {

				if ($esInicial and $hora->getDiaSemana() == $diaSemana) {
					$valorInicial = $hora->getPeriodo();
					$valorFinal = $valorInicial+1;
					$esInicial = false;
				}elseif ($hora->getDiaSemana() == $diaSemana) {
					$valorFinal = $hora->getPeriodo() +1;
				}
			}
			echo $this->fijarHoraInicial($valorInicial)." - ".$this->fijarHoraFinal($valorFinal);
			echo  "</small></td>";
		}

		public function fijarHoraInicial($hora)
		{
			switch ($hora) {
				case 1:
					return "7:00 am";
				case 2:
					return "7:55 am";
				case 3:
					return "8:50 am";
				case 4:
					return "9:45 am";
				case 5:
					return "11:10 am";
				case 6:
					return "12:05 pm";
				case 7:
					return "1:00 pm";
				//anexa las demas entradas	
				default:
					return "";
			}
		}
		public function fijarHoraFinal($hora)
		{
			switch ($hora) {
				case 1:
					return "6:59 am";
				case 2:
					return "7:54 am";
				case 3:
					return "8:49 am";
				case 4:
					return "9:44 am";
				case 5:
					return "10:39 am";
				case 6:
					return "12:04 pm";
				case 7:
					return "12:59 pm";
				case 8:
					return "1:54 pm";	
				//anexa las demas salidas
				default:
					return "";
			}
		}
	}

	/**
	 * Clase para la hora
	 */
	class Hora
	{
		private $diaSemana;
		private $periodo;
		
		function __construct($diaSemana, $periodo)
		{
			$this->diaSemana = $diaSemana;
			$this->periodo = $periodo;
			
		}

		public function getDiaSemana()
		{
			return $this->diaSemana;
		}
		public function getPeriodo()
		{
			return $this->periodo;
		}

	}

 ?>