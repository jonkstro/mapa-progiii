<?php
    
    class Disciplina {
        
        private $nomeDisciplina;
        private $codDisciplina;
        private $curso;
        private $cargaHoraria;
        private $nivelCorresp;
        
        public function setNomeDisciplina($nomeDisciplina){
            $this->nomeDisciplina = $nomeDisciplina;
        }
        
        public function getNomeDisciplina(){
            return $this->nomeDisciplina;
        }
        
        public function setCodDisciplina(){
            $texto = substr($this->nomeDisciplina, 0, 4);
            for ($i = 0; $i < 5; $i++){
                $rand = rand(0, 9);
                $codigo[$i] = $rand;
                //echo $matriculaAluno[$i]; 
            }
            $this->codDisciplina = strtoupper($texto.$codigo[0].$codigo[1].$codigo[2].$codigo[3].$codigo[4]);
        }
        
        public function getCodDisciplina(){
            return $this->codDisciplina;
        }
        
        public function setCurso($curso){
            $this->curso = $curso;
        }
        
        public function getCurso(){
            return $this->curso;
        }
        
        public function setCargaHoraria($cargaHoraria){
            $this->cargaHoraria = $cargaHoraria;
        }
        
        public function getCargaHoraria(){
            return $this->cargaHoraria;
        }
        
        public function setNivelCorresp($nivelCorresp){
            $this->nivelCorresp = $nivelCorresp;
        }
        
        public function getNivelCorresp(){
            return $this->nivelCorresp;
        }
        
    }    
?>