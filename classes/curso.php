<?php
    include "professor.php";
    
    class Curso {
        private $nomeCurso;
        private $areaConhecimento;
        private $nivelCurso;
        private $coordenadorCurso;
        
        public function setNomeCurso($nomeCurso){
            $this->nomeCurso = $nomeCurso;
        }
        
        public function getNomeCurso(){
            return $this->nomeCurso;
        }
        
        public function setAreaConhecimento($areaConhecimento){
            $this->areaConhecimento = $areaConhecimento;
        }
        
        public function getAreaConhecimento(){
            return $this->areaConhecimento;
        }
        
        public function setNivelCurso($nivelCurso){
            $this->nivelCurso = $nivelCurso;
        }
        
        public function getNivelCurso(){
            return $this->nivelCurso;
        }
        
        public function setCoordenadorCurso($coordenadorCurso){
            $this->coordenadorCurso = $coordenadorCurso;
        }
        
        public function getCoordenadorCurso(){
            return $this->coordenador;
        }
    }
    

?>