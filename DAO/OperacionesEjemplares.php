<?php
    include_once("ConexionDB.php");
    class OperacionesEjemplares {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        public function comprobarEjemplaresPorIsbn($isbn) {
            $consulta = $this->conexion->prepare("SELECT COUNT(*) FROM ejemplares WHERE isbn = ? AND prestado = 0");
            $consulta->bind_param("i", $isbn);
            $consulta->execute();
            $resultado = $consulta->get_result();
            
            if ($resultado->fetch_row()[0] > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function asignarEjemplarPorIsbn($isbn) {
            $consulta = $this->conexion->prepare("SELECT cod FROM ejemplares WHERE isbn = ? AND prestado = 0 LIMIT 1");
            $consulta->bind_param("i", $isbn);
            $consulta->execute();
            $resultado = $consulta->get_result();
            $codigoEjemplar = $resultado->fetch_row()[0];
            $consulta->close();

            $consulta = $this->conexion->prepare("UPDATE ejemplares SET prestado = 1 WHERE cod = ?");
            $consulta->bind_param("i", $codigoEjemplar);
            $consulta->execute();
            $consulta->close();

            return $codigoEjemplar;
        }
    }
?>