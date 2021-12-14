<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--css bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="./css/pacienteCadastro.css">

    <title>Cadastrar Paciente</title>
</head>
<body>
    <?php

        include('protect.php');
        include('conexao.php');


        if(isset($_POST['inputNomeP']) || isset($_POST['inputIdade']) || isset($_POST['inputPeso']) || isset($_POST['inputAltura'])){
            if(strlen($_POST['inputNomeP']) == 0){
                //echo "Preencha o campo Nome";
                $_SESSION['errorCP'] = "Preencha o campo Nome";
            }else if(strlen($_POST['inputIdade']) == 0){
                //echo "Preencha o campo Idade";
                $_SESSION['errorCP'] = "Preencha o campo Idade";
            }else if(strlen($_POST['inputPeso']) == 0){
                //echo "Preencha o campo Peso";
                $_SESSION['errorCP'] = "Preencha o campo Peso";
            }else if(filter_var($_POST['inputPeso'], FILTER_VALIDATE_INT)){
                //echo "Preencha o campo Peso no formato 00.0";
                $_SESSION['errorCP'] = "Preencha o campo Peso no formato 00.0";
            }else if(strlen($_POST['inputAltura']) == 0){
                // "Preencha o campo Altura";
                $_SESSION['errorCP'] = "Preencha o campo Altura";
            }else if(filter_var($_POST['inputAltura'], FILTER_VALIDATE_INT)){
                //echo "Preencha o campo Peso no formato 0.00";
                $_SESSION['errorCP'] = "Preencha o campo Peso no formato 0.00";
            }else{

                $nomeP = $_POST['inputNomeP'];
                $idade = $_POST['inputIdade'];
                $peso = $_POST['inputPeso'];
                $altura = $_POST['inputAltura'];
        
                $sql = "INSERT INTO pacientes(nome, idade, peso, altura) VALUES ('$nomeP', '$idade', '$peso', '$altura')";

        
                if(mysqli_query($mysqli, $sql)){
                    echo "Paciente cadastrado com sucesso";
                    
                    header("Location: listarPacientes.php");
                }else{
                    echo "Erro".mysqli_connect_error($mysqli);
                }
            }
        }
        mysqli_close($mysqli);
    ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <!-- Navbar content -->
            <a style="color: rgb(158, 156, 156); font-size:16px" class="navbar-brand cor" href="./listarPacientes.php">Lista de Pacientes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a style="font-size: 17px; margin-right: 4px; margin-left:-4px;" class="nav-link" href="./pacienteCadastro.php">Cadastrar Paciente<span class="sr-only"></span></a>
                    </li>
                    <li style="margin-top: 2px;" class="nav-item active">
                        <a style="font-size: 15px; color:rgb(158, 156, 156);" class="nav-link" href="./logout.html">Sair</a>
                    </li>
                </ul>
                <svg style="color: white; margin-right: 2px; margin-top: -1px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
                <p style="margin-bottom: 2px; color: #ffffff;" >Olá, <?=$_SESSION['nome']?>!</p>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="75" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </div>
            <div class="formulario">
                <form action="" method="POST">
                <?php 
                if(isset($_SESSION['errorCP'])){?>
                    <p class="p" style= "margin: 0; color: red;"><?= $_SESSION['errorCP'];?></p><?php
                    unset($_SESSION['errorCP']);
                }else{ 
                    echo "";
                    }?>
                    <div class="form-group">
                        <label for="inputNomeP">Nome:</label>
                        <input type="text" class="form-control" name="inputNomeP" aria-describedby="emailHelp" placeholder="Insira nome do paciente" value="<?php if(isset($_POST['inputNomeP']))
                            echo $_POST['inputNomeP'];?>">
                    </div>
                    <div class="form-group">
                        <label for="inputIdade">Idade:</label>
                        <input type="number" class="form-control" name="inputIdade" placeholder="Insira idade do paciente" value="<?php if(isset($_POST['inputIdade']))
                            echo $_POST['inputIdade'];?>">
                    </div>
                    <div class="form-group">
                        <label for="inputPeso">Peso:</label>
                        <input type="number" class="form-control" name="inputPeso" placeholder="Insira peso do paciente" step="0.01" value="<?php if(isset($_POST['inputPeso']))
                            echo $_POST['inputPeso'];?>">
                    </div>
                    <div class="form-group">
                        <label for="inputAltura">Altura:</label>
                        <input type="number" class="form-control" name="inputAltura" placeholder="Insira altura do paciente" step="0.01" value="<?php if(isset($_POST['inputAltura']))
                            echo $_POST['inputAltura'];?>">
                    </div>
                    <div class="button">
                        <button type="submit" class="btn btn-primary">Cadastrar</button> 
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-light text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3 mt-5 copy" style="background-color: rgba(0, 0, 0, 0.8);">
            © 2020 Copyright: Todos os direitos reservados.
        </div>
        <!-- Copyright -->
    </footer>
    <!--script bootstrap--> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>