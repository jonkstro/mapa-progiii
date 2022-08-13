<?php

include "pessoa.php";

    

    class Aluno extends Pessoa{
        
        private $tipoCurso;
        
        private $matriculaAluno = [];
        private $matricula;

        
        public function setTipoCurso($tipoCurso){
        $this->tipoCurso = $tipoCurso;
        }
        
        public function getTipoCurso(){
            return $this->tipoCurso;
        }
        
        public function setMatricula($matricula){
        $this->matricula = $matricula;
        }
        
        public function getMatricula(){
            return $this->matricula;
            echo "get";
        }
        
        public function gerarMatricula(){
            
            for ($i = 0; $i < 5; $i++){
                $rand = rand(0, 9);
                $matriculaAluno[$i] = $rand;
                //echo $matriculaAluno[$i];
                
            }
            $this->matricula = "A".$matriculaAluno[0].$matriculaAluno[1].$matriculaAluno[2].$matriculaAluno[3].$matriculaAluno[4];
        }
    }


?>