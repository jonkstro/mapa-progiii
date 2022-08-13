
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>MAPA PROG III - Cadastrar Professor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5"/>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="icon" href="../img/favicon.ico">


  </head>
  <body>
    <section class="home">
    <div class="container"></div>
    <h1>Cadastrar novo Professor</h1>
      <form method="POST">
          
        <input type="text" name="nome" id="nome" placeholder="Nome Completo"><br><br>
        <input type="text" name="telefone" id="telefone" placeholder="Telefone"><br><br>
        <input type="email" name="email" id="email" placeholder="Email"><br><br>
        <input type="password" name="senha" id="senha" placeholder="Senha"><br><br>
        <input type="text" name="endereco" id="endereco" placeholder="Rua X, Casa Y...">
        <div class="row">
            <p>Sexo: </p>

            <div class="flex-container">
                <div class="radio">
                    <input type="radio" name="sexo" id="sexoM" value="Masculino">
                    <p>Masculino</p>
                </div>
                <div class="radio">
                    <input type="radio" name="sexo" id="sexoF" value="Feminino">
                    <p>Feminino</p>
                </div>
            </div>
        </div>
        <input type="text" name="vinculo" id="vinculo" placeholder="Vinculo Institucional:"><br><br>
        <input type="text" name="titulacao" id="titulacao" placeholder="Titulação:"><br><br>
        <input type="number" name="cargaHoraria" id="cargaHoraria" placeholder="Carga Horária:" step="any"><br><br>

        <center>
            <input type="submit" name="btn" id="btn">
            <a href="../index.php">Retornar</a>
        </center>
      </form>
<?php
        
    if(isset($_POST["btn"])){
        //REFERENTE A CAPTURA DOS DADOS
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $endereco = $_POST["endereco"];
        $sexo = $_POST["sexo"];
        $vinculo = $_POST["vinculo"];
        $titulacao = $_POST["titulacao"];
        $cargaHoraria = $_POST["cargaHoraria"];

        //INSTANCIAR OBJETO ALUNO
        include "../classes/professor.php";

        $professor = new Professor();
        $professor->setNome($nome);
        $professor->setTelefone($telefone);
        $professor->setEmail($email);
        $professor->setSenha($senha);
        $professor->setEndereco($endereco);
        $professor->setSexo($sexo);
        $professor->gerarMatricula();
        $professor->setVinculo($vinculo);
        $professor->setTitulacao($titulacao);
        $professor->setCargaHoraria($cargaHoraria);
        
        //REFERENTE CONEXAO
        $host = "localhost";
        $user = "";
        $pass = "";
        $dbname = "";
        
        $pdo = new PDO("mysql:host=$host;dbname=".$dbname, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        //PARA CASO QUEIRA RECUPERAR A SENHA USAR O CODIGO ABAIXO
        //$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;
        
        //CHECAR SE TODOS OS DADOS FORAM PREENCHIDOS DEVIDAMENTE
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($endereco) && !empty($sexo) && !empty($vinculo) && !empty($titulacao) && !empty($cargaHoraria)){
            
          //VALIDAÇÃO DOS DADOS - CHECAR SE O EMAIL JÁ FOI CADASTRADO
          $buscar = $pdo->prepare("SELECT email FROM PROFESSOR WHERE email = '$email'");
          $buscar->execute();
          if($buscar->rowCount()){
              echo "<p style='color: red;'>Email já cadastrado</p>";             
          } else {
                //REFERENTE A CONEXÃO COM O BANCO DE DADOS
                try { 
                //REFERENTE AO INSERT DO BANCO DE DADOS
                $stmt = $pdo->prepare('INSERT INTO PROFESSOR (nome, telefone, email, senha, endereco, sexo, matricula, vinculo, titulacao, cargaHoraria) VALUES (:no, :te, :em, :sen, :en, :sex, :mat, :vin, :ti, :car)');
                
                $stmt->bindValue(':no', $professor->getNome());
                $stmt->bindValue(':te', $professor->getTelefone());
                $stmt->bindValue(':em', $professor->getEmail());
                $stmt->bindValue(':sen', $professor->getSenha());
                $stmt->bindValue(':en', $professor->getEndereco());
                $stmt->bindValue(':sex', $professor->getSexo());
                $stmt->bindValue(':mat', $professor->getMatricula());
                $stmt->bindValue(':vin', $professor->getVinculo());
                $stmt->bindValue(':ti', $professor->getTitulacao());
                $stmt->bindValue(':car', $professor->getCargaHoraria());

                  $stmt->execute();
                  echo "<p style='color: green;'>Cadastrado com sucesso</p>";
        
                  //echo $stmt->rowCount();
                } catch(PDOException $e) {
                  echo 'Error: ' . $e->getMessage();
                }
              }

        } else {
            echo "<p style='color: red;'>Preencha todos os campos</p>";
        }
    }    
      
?>
    



    </section>
  </body>
</html>