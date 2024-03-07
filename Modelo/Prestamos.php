<?php
    class Prestamos {
        private $id;
        private $dni_socio;
        private $cod_ejemplar;
        private $fecha_prestamo;
        private $fecha_max_devolucion;
        private $fecha_devolucion;

        public function __construct($id, $dni_socio, $cod_ejemplar, $fecha_prestamo, $fecha_max_devolucion, $fecha_devolucion) {
            $this->setId($id);
            $this->setDni_socio($dni_socio);
            $this->setCod_ejemplar($cod_ejemplar);
            $this->setFecha_prestamo($fecha_prestamo);
            $this->setFecha_max_devolucion($fecha_max_devolucion);
            $this->setFecha_devolucion($fecha_devolucion);
        }
        
        public function getId() {
            return $this->id;
        }
        public function setId($id) {
            $this->id = $id;
        }

        public function getDni_socio() {
            return $this->dni_socio;
        }
        public function setDni_socio($dni_socio) {
            $this->dni_socio = $dni_socio;
        }

        public function getCod_ejemplar() {
            return $this->cod_ejemplar;
        }
        public function setCod_ejemplar($cod_ejemplar) {
            $this->cod_ejemplar = $cod_ejemplar;
        }

        public function getFecha_prestamo() {
            return $this->fecha_prestamo;
        }
        public function setFecha_prestamo($fecha_prestamo) {
            $this->fecha_prestamo = $fecha_prestamo;
        }

        public function getFecha_max_devolucion() {
            return $this->fecha_max_devolucion;
        }
        public function setFecha_max_devolucion($fecha_max_devolucion) {
            $this->fecha_max_devolucion = $fecha_max_devolucion;
        }

        public function getFecha_devolucion() {
            return $this->fecha_devolucion;
        }
        public function setFecha_devolucion($fecha_devolucion) {
            $this->fecha_devolucion = $fecha_devolucion;
        }

        public function __toString() {
            return "ID: " . $this->getId() . "<br>" 
                . "DNI Socio: " . $this->getDni_socio() . "<br>"
                . "Código Ejemplar: " . $this->getCod_ejemplar() . "<br>"
                . "Fecha Préstamo: " . $this->getFecha_prestamo() . "<br>"
                . "Fecha Máx. Devolución: " . $this->getFecha_max_devolucion() . "<br>"
                . "Fecha Devolución: " . $this->getFecha_devolucion() . "<br>";
        }
    }
?>