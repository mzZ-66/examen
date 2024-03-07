<?php
    include_once("ConexionDB.php");
    class OperacionesPrestamos {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }
        
        public function darDeAltaPrestamo($nuevoPrestamo) {
            $dni_socio = $nuevoPrestamo->getDni_socio();
            $cod_ejemplar = $nuevoPrestamo->getCod_ejemplar();
            $fecha_prestamo = $nuevoPrestamo->getFecha_prestamo();
            $fecha_max_devolucion = $nuevoPrestamo->getFecha_max_devolucion();
            $fecha_devolucion = $nuevoPrestamo->getFecha_devolucion();

            $consulta = $this->conexion->prepare("INSERT INTO prestamos (dni_socio, cod_ejemplar, fecha_prestamo, fecha_max_devolucion, fecha_devolucion) VALUES (?, ?, ?, ?, ?)");
            $consulta->bind_param("sisss", $dni_socio, $cod_ejemplar, $fecha_prestamo, $fecha_max_devolucion, $fecha_devolucion);
            $consulta->execute();
            $consulta->close();
        }

        public function obtenerEmailsSociosConRetraso() {
            $consulta = $this->conexion->prepare("SELECT s.email FROM socios s INNER JOIN prestamos p ON s.dni = p.dni_socio WHERE p.fecha_devolucion IS NULL AND p.fecha_max_devolucion < CURDATE()");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $emails = [];
            while ($fila = $resultado->fetch_assoc()) {
                $emails[] = $fila;
            }
            return $emails;
        }
    }
?>