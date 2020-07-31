<?php 
    class Delete{
        private $D;


        public function setPaciente($condição)
        {
            $this->D = "DELETE FROM paciente WHERE id = $condição";
        }

        public function setMedico($condição)
        {
            $this->D = "DELETE FROM medicos WHERE id = $condição";
        }

        public function setConsulta($condição)
        {
            $this->D = "DELETE FROM consultas WHERE id = $condição";
        }


        public function get()
        {
            return $this->D;
        }
    }
?>