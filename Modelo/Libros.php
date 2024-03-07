<?php
    class Libros {
        private $isbn;
        private $titulo;
        private $categoria;
        private $resumen;

        public function __construct($isbn, $titulo, $categoria, $resumen) {
            $this->setIsbn($isbn);
            $this->setTitulo($titulo);
            $this->setCategoria($categoria);
            $this->setResumen($resumen);
        }
        
        public function getIsbn() {
            return $this->isbn;
        }
        public function setIsbn($isbn) {
            $this->isbn = $isbn;
        }

        public function getTitulo() {
            return $this->titulo;
        }
        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

        public function getCategoria() {
            return $this->categoria;
        }
        public function setCategoria($categoria) {
            $this->categoria = $categoria;
        }
        
        public function getResumen() {
            return $this->resumen;
        }
        public function setResumen($resumen) {
            $this->resumen = $resumen;
        }

        public function __toString() {
            return "ISBN: " . $this->getIsbn() . "<br>" .
                "Título: " . $this->getTitulo() . "<br>" .
                "Categoría: " . $this->getCategoria() . "<br>" .
                "Resumen: " . $this->getResumen() . "<br>";
        }
    }
?>