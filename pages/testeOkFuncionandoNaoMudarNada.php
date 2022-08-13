
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>MAPA PROG III - Cadastrar Aluno</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5"/>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="icon" href="../img/favicon.ico">


  </head>
  <body>
    <section class="home">
    <div class="container"></div>
    <h1>Cadastrar novo Aluno</h1>
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
        <div class="row">
            <br>
            <p>Tipo de Curso: </p>
            <div class="flex-container">
                <div class="radio">
                    <input type="radio" name="tpCso" id="Grad" value="Graduação">
                    <p>Graduação</p>
                </div>
                <div class="radio">
                    <input type="radio" name="tpCso" id="Mest" value="Mestrado">
                    <p>Mestrado</p>
                </div>
                <div class="radio">
                    <input type="radio" name="tpCso" id="Dout" value="Doutorado">
                    <p>Doutorado</p>
                </div>
            </div>
        </div>
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
        $tipoCurso = $_POST["tpCso"];
        
        //INSTANCIAR OBJETO ALUNO
        include "../classes/aluno.php";

        $aluno = new Aluno();
        $aluno->setNome($nome);
        $aluno->setTelefone($telefone);
        $aluno->setEmail($email);
        $aluno->setSenha($senha);
        $aluno->setEndereco($endereco);
        $aluno->setSexo($sexo);
        $aluno->setTipoCurso($tipoCurso);
        $aluno->gerarMatricula();

        $host = "localhost";
        $user = "";
        $pass = "";
        $dbname = "";
        
        $pdo = new PDO("mysql:host=$host;dbname=".$dbname, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //PARA CASO QUEIRA RECUPERAR A SENHA USAR O CODIGO ABAIXO
        //$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;
        
        //CHECAR SE TODOS OS DADOS FORAM PREENCHIDOS DEVIDAMENTE
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($endereco) && !empty($sexo) && !empty($tipoCurso)){
            
            //VALIDAÇÃO DOS DADOS
            $buscar = $pdo->prepare("SELECT email FROM ALUNO WHERE email = '$email'");
            $buscar->execute();
            if($buscar->rowCount()){
                echo "<p style='color: red;'>Email já cadastrado</p>";
               
            } else {
                try {
                    //REFERENTE AO INSERT DO BANCO DE DADOS
                    $stmt = $pdo->prepare('INSERT INTO ALUNO (nome, telefone, email, senha, endereco, sexo, tipoCurso, matricula) VALUES (:no, :te, :em, :sen, :en, :sex, :tp, :mat)');
                     
                    $stmt->bindValue(':no', $aluno->getNome());
                    $stmt->bindValue(':te', $aluno->getTelefone());
                    $stmt->bindValue(':em', $aluno->getEmail());
                    $stmt->bindValue(':sen', $aluno->getSenha());
                    $stmt->bindValue(':en', $aluno->getEndereco());
                    $stmt->bindValue(':sex', $aluno->getSexo());
                    $stmt->bindValue(':tp', $aluno->getTipoCurso());
                    $stmt->bindValue(':mat', $aluno->getMatricula());
                    
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