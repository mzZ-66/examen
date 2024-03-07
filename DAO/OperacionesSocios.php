<?php
    include_once("ConexionDB.php");
    class OperacionesSocios {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }
        
        public function comprobarSocio($dniSocio) {
            $consulta = $this->conexion->prepare("SELECT * FROM socios WHERE dni = ?");
            $consulta->bind_param('s', $dniSocio);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->fetch_assoc() != null) {
                return true;
            } else {
                throw new Exception("El socio no existe");
            }
        }

        public function registrarSocio($nuevoSocio) {
            $dniSocio = $nuevoSocio->getDni();
            $nombreSocio = $nuevoSocio->getNombre();
            $direccionSocio = $nuevoSocio->getDireccion();
            $emailSocio = $nuevoSocio->getEmail();
            $consulta = $this->conexion->prepare("INSERT INTO socios (dni, nombre, direccion, email) VALUES (?, ?, ?, ?)");
            $consulta->bind_param('ssss', $dniSocio, $nombreSocio, $direccionSocio, $emailSocio);
            $consulta->execute();
        }

        // funciona pero siempre lo devulve, por lo que lo comento
        public function comprobarDevolucionSocio($dniSocio) {
            $consulta = $this->conexion->prepare("SELECT * FROM prestamos WHERE dni_socio = ? AND fecha_devolucion IS NULL");
            $consulta->bind_param('s', $dniSocio);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->num_rows > 0) {
                throw new Exception("No se puede solicitar otro libro ya que tienes un préstamo pendiente.");
            }
        }
    }
?>