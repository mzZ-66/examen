<?php
    class Ejemplares {
        private $cod;
        private $isbn;
        private $prestado;

        public function __construct($cod, $isbn, $prestado) {
            $this->setCod($cod);
            $this->setIsbn($isbn);
            $this->setPrestado($prestado);
        }

        public function getCod() {
            return $this->cod;
        }
        public function setCod($cod) {
            $this->cod = $cod;
        }
        
        public function getIsbn() {
            return $this->isbn;
        }
        public function setIsbn($isbn) {
            $this->isbn = $isbn;
        }

        public function getPrestado() {
            return $this->prestado;
        }
        public function setPrestado($prestado) {
            $this->prestado = $prestado;
        }

        public function __toString() {
            return "Cod: " . $this->getCod() . "<br>" .
                "ISBN: " . $this->getIsbn() . "<br>" .
                "Prestado: " . $this->getPrestado() . "<br>";
        }
    }
?>