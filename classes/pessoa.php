<?php

    //CRIANDO A CLASSE PESSOA
    
    class Pessoa {
        //ATRIBUTOS EM COMUM ENTRE TODAS PESSOAS
        private $nome;
        private $telefone;
        private $email;
        private $senha;
        private $endereco;
        private $sexo;
        
        public function setNome($nome){
            $this->nome = $nome;
        }
        
        public function getNome(){
            return $this->nome;
        }
        
        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }
        
        public function getTelefone(){
            return $this->telefone;
        }
        
        public function setEmail($email){
            $this->email = $email;
        }
        
        public function getEmail(){
            return $this->email;
        }
        
        public function setSenha($senha){
            $this->senha = $senha;
        }
        
        public function getSenha(){
            return $this->senha;
        }
        
        public function setEndereco($end){
            $this->endereco = $end;
        }
        
        public function getEndereco(){
            return $this->endereco;
        }
        
        public function setSexo($sexo){
            $this->sexo = $sexo;
        }
        
        public function getSexo(){
            return $this->sexo;
        }
        
    }






?>