<?php 
    class Update {
        private $U;

        public function setPaciente($campos,$condicao)
        {
            $this->U = "UPDATE paciente SET $campos WHERE id = $condicao";
        }

        public function setMedico($campos,$condicao)
        {
            $this->U = "UPDATE medicos SET $campos WHERE id = $condicao";
        }

        public function setConsulta($campos,$condicao)
        {
            $this->U = "UPDATE consultas SET $campos WHERE id = $condicao";
        }

        public function get()
        {
            return $this->U;
        }
    }
?>