
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>MAPA PROG III - Cadastrar Disciplina</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.5"/>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="icon" href="../img/favicon.ico">


  </head>
  <body>
    <section class="home">
    <div class="container"></div>
    <h1>Cadastrar nova Disciplina</h1>
      <form method="POST">
        <input type="text" name="nome" id="nome" placeholder="Nome da Disciplina"><br><br>
        <input type="text" name="curso" id="curso" placeholder="Curso Correspondente"><br><br>
        <input type="number" name="cargaHoraria" id="cargaHoraria" placeholder="Carga Horária" set="any">
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
        $nomeDisciplina = $_POST["nome"];
        $curso = $_POST["curso"];
        $cargaHoraria = $_POST["cargaHoraria"];
        $nivelCorresp = $_POST["tpCso"];

        //INSTANCIAR OBJETO CURSO
        include "../classes/disciplina.php";

        $disciplina = new Disciplina();
        $disciplina->setNomeDisciplina($nomeDisciplina);
        $disciplina->setCodDisciplina();
        $disciplina->setCurso($curso);
        $disciplina->setCargaHoraria($cargaHoraria);
        $disciplina->setNivelCorresp($nivelCorresp);
        
        $host = "localhost";
        $user = "";
        $pass = "";
        $dbname = "";
        
        $pdo = new PDO("mysql:host=$host;dbname=".$dbname, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //PARA CASO QUEIRA RECUPERAR A SENHA USAR O CODIGO ABAIXO
        //$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;
        
        //CHECAR SE TODOS OS DADOS FORAM PREENCHIDOS DEVIDAMENTE
        if(!empty($nomeDisciplina) && !empty($curso) && !empty($cargaHoraria) && !empty($nivelCorresp)){
        
        
            
            //REFERENTE A CONEXÃO COM O BANCO DE DADOS
            try {
            
            
      
            //REFERENTE AO INSERT DO BANCO DE DADOS
            $stmt = $pdo->prepare('INSERT INTO DISCIPLINA (codDisciplina, nome, curso, cargaHoraria, tipoCurso) VALUES (:codDisciplina, :nome, :curso, :carga, :tipoCurso)');
            $stmt->bindValue(':codDisciplina', $disciplina->getCodDisciplina()); 
            $stmt->bindValue(':nome', $disciplina->getNomeDisciplina());
            $stmt->bindValue(':curso', $disciplina->getCurso());
            $stmt->bindValue(':carga', $disciplina->getCargaHoraria());
            $stmt->bindValue(':tipoCurso', $disciplina->getNivelCorresp());
            
            
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