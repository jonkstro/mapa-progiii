
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>MAPA PROG III - Cadastrar Curso</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5"/>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="icon" href="../img/favicon.ico">


  </head>
  <body>
    <section class="home">
    <div class="container"></div>
    <h1>Cadastrar novo Curso</h1>
      <form method="POST">
          
        <input type="text" name="nome" id="nome" placeholder="Nome do Curso"><br><br>
        <input type="text" name="area" id="area" placeholder="Area de Conhecimento">
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
        <input type="text" name="coordenador" id="coordenador" placeholder="Matrícula do Coordenador do Curso">
        <center>
            <input type="submit" name="btn" id="btn">
            <a href="../index.php">Retornar</a>
        </center>
      </form>
      
<?php
        
    if(isset($_POST["btn"])){
        //REFERENTE A CAPTURA DOS DADOS
        $nomeCurso = $_POST["nome"];
        $areaConhecimento = $_POST["area"];
        $nivelCurso = $_POST["tpCso"];
        $coordenadorCurso = $_POST["coordenador"];
        
        
        //INSTANCIAR OBJETO CURSO
        include "../classes/curso.php";

        $curso = new Curso();
        $curso->setNomeCurso($nomeCurso);
        $curso->setAreaConhecimento($areaConhecimento);
        $curso->setNivelCurso($nivelCurso);
        $curso->setCoordenadorCurso($coordenadorCurso);
        
        //REFERENTE A CONEXAO
        $host = "localhost";
        $user = "";
        $pass = "";
        $dbname = "";
        
        $pdo = new PDO("mysql:host=$host;dbname=".$dbname, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //PARA CASO QUEIRA RECUPERAR A SENHA USAR O CODIGO ABAIXO
        //$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;
        
        //CHECAR SE TODOS OS DADOS FORAM PREENCHIDOS DEVIDAMENTE
        if(!empty($nomeCurso) && !empty($areaConhecimento) && !empty($nivelCurso) && !empty($coordenadorCurso)){
        
        
            
            //REFERENTE A CONEXÃO COM O BANCO DE DADOS
            try {
            
            
      
            //REFERENTE AO INSERT DO BANCO DE DADOS
            $stmt = $pdo->prepare('INSERT INTO CURSO (nome, areaConhecimento, nivelCorresp, coordenador) VALUES (:nome, :area, :nivel, :coordenador)');
             
            $stmt->bindValue(':nome', $curso->getNomeCurso());
            $stmt->bindValue(':area', $curso->getAreaConhecimento());
            $stmt->bindValue(':nivel', $curso->getNivelCurso());
            $stmt->bindValue(':coordenador', $curso->getCoordenadorCurso());
            
            
              $stmt->execute();
              echo "<p style='color: green;'>Cadastrado com sucesso</p>";
    
              //echo $stmt->rowCount();
            } catch(PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
        } else {
            echo "<p style='color: red;'>Preencha todos os campos</p>";
        }
        
        
    }    
      
?>
      
    </section>
  </body>
</html>