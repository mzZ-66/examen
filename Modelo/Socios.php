<?php
    class Socios {
        private $dni;
        private $nombre;
        private $direccion;
        private $email;

        public function __construct($dni, $nombre, $direccion, $email) {
            $this->setDni($dni);
            $this->setNombre($nombre);
            $this->setDireccion($direccion);
            $this->setEmail($email);
        }
        
        public function getDni() {
            return $this->dni;
        }
        public function setDni($dni) {
            $this->dni = $dni;
        }

        public function getNombre() {
            return $this->nombre;
        }
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function getDireccion() {
            return $this->direccion;
        }
        public function setDireccion($direccion) {
            $this->direccion = $direccion;
        }
        
        public function getEmail() {
            return $this->email;
        }
        public function setEmail($email) {
            $this->email = $email;
        }

        public function __toString() {
            return "DNI: " . $this->getDni() . "<br>" .
                "Nombre: " . $this->getNombre() . "<br>" .
                "Dirección: " . $this->getDireccion() . "<br>" .
                "e-mail: " . $this->getEmail() . "<br>";
        }
    }
?>