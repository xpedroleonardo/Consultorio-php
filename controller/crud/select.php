<?php 
    class Select{
        private $S;

        public function setPacienteAll($campos)
        {
            $this->S = "SELECT $campos FROM paciente";
        }

        public function setPaciente($campos,$condicao)
        {
            $this->S = "SELECT $campos FROM paciente WHERE id = $condicao";
        }

        public function setMedicoAll($campos)
        {
            $this->S = "SELECT $campos FROM medicos";
        }

        public function setMedico($campos,$condicao)
        {
            $this->S = "SELECT $campos FROM medicos WHERE id = $condicao";
        }

        public function setConsultaAll($campos)
        {
            $this->S = "SELECT $campos FROM consultas";
        }

        public function setConsulta($campos,$condicao)
        {
            $this->S = "SELECT $campos FROM consultas WHERE $condicao";
        }

        public function setInner($campos,$condicao)
        {
            $this->S = "SELECT $campos FROM medicos AS M INNER JOIN paciente AS P
            INNER JOIN consultas AS C ON P.id = C.fkPaciente AND M.id = fkMedico WHERE C.id = $condicao";
        }


        public function get()
        {
            return $this->S;
        }
    }
?>