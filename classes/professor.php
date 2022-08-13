<?php

require_once "pessoa.php";

    class Professor extends Pessoa{
        private $matricula;
        private $matriculaProf = [];
        private $vinculo;
        private $titulacao;
        private $cargaHoraria;
        
        public function setMatricula($matricula){
            $this->matricula = $matricula;
        }
        
        public function getMatricula(){
            return $this->matricula;
        }
        
        public function gerarMatricula(){
            
            for ($i = 0; $i < 5; $i++){
                $rand = rand(0, 9);
                $matriculaProf[$i] = $rand;
                //echo $matriculaProf[$i];
                
            }
            $this->matricula = "P".$matriculaProf[0].$matriculaProf[1].$matriculaProf[2].$matriculaProf[3].$matriculaProf[4];
        }
        
        public function setVinculo($vinculo){
            $this->vinculo = $vinculo;
        }
        
        public function getVinculo(){
            return $this->vinculo;
        }
        
        public function setTitulacao($titulacao){
            $this->titulacao = $titulacao;
        }
        
        public function getTitulacao(){
            return $this->titulacao;
        }
        
        public function setCargaHoraria($cargaHoraria){
            $this->cargaHoraria = $cargaHoraria;
        }
        
        public function getCargaHoraria(){
            return $this->cargaHoraria;
        }
    }
    
?>