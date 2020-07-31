<?php 
    class Insert{
        private $I;

        public function setPaciente($campos)
        {
            $this->I = "INSERT INTO paciente (nome,idade,telefone,plano) VALUES ($campos)";
        }

        public function setMedico($campos)
        {
            $this->I = "INSERT INTO medicos (nome,especialidade,telefone,crm) VALUES ($campos)";
        }

        public function setConsulta($campos)
        {
            $this->I = "INSERT INTO consultas (dia,hora,fkPaciente,fkMedico) VALUES ($campos)";
        }

        public function get()
        {
            return $this->I;
        }
    }
?>