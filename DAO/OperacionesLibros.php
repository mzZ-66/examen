<?php
    include_once("ConexionDB.php");
    class OperacionesLibros {
        private $conexion;
        public function __construct() {
            $conexion = new conexionDB();
            $this->conexion = $conexion->getConexion();
        }

        function obtenerCategorias() {
            $consulta = $this->conexion->prepare("SELECT * FROM libros;");
            $consulta->execute();
            $resultado = $consulta->get_result();
            $categorias = [];
            while ($categoria = $resultado->fetch_assoc()) {
                if (!in_array($categoria['categoria'], $categorias)) {
                    $categorias[] = $categoria['categoria'];
                }
            }
            return $categorias;
        }
        
        function obtenerLibrosPorCategoria($categoria) {
            $consulta = $this->conexion->prepare("SELECT * FROM libros WHERE categoria = ?;");
            $consulta->bind_param("s", $categoria);
            $consulta->execute();
            $resultado = $consulta->get_result();
            if ($resultado->num_rows == 0) {
                throw new Exception("La categoría no contiene libros.");
            }
            $libros = [];
            while ($libro = $resultado->fetch_assoc()) {
                $libros[] = $libro;
            }
            return $libros;
        }
    }
?>