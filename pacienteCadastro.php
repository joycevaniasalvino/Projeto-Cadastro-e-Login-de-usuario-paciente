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
                echo "Preencha o campo Nome";
            }else if(strlen($_POST['inputIdade']) == 0){
                echo "Preencha o campo Idade";
            }else if(strlen($_POST['inputPeso']) == 0){
                echo "Preencha o campo Peso";
            }else if(filter_var($_POST['inputPeso'], FILTER_VALIDATE_INT)){
                echo "Preencha o campo Peso no formato 00.0";
            }else if(strlen($_POST['inputAltura']) == 0){
                echo "Preencha o campo Altura";
            }else if(filter_var($_POST['inputAltura'], FILTER_VALIDATE_INT)){
                echo "Preencha o campo Peso no formato 0.00";
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
            <a class="navbar-brand" href="./listarPacientes.php">Lista de Pacientes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./pacienteCadastro.php">Cadastrar Paciente<span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="formulario">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="inputNomeP">Nome:</label>
                        <input type="text" class="form-control" name="inputNomeP" aria-describedby="emailHelp" placeholder="Insira nome do paciente">
                    </div>
                    <div class="form-group">
                        <label for="inputIdade">Idade:</label>
                        <input type="number" class="form-control" name="inputIdade" placeholder="Insira idade do paciente">
                    </div>
                    <div class="form-group">
                        <label for="inputPeso">Peso:</label>
                        <input type="number" class="form-control" name="inputPeso" placeholder="Insira peso do paciente" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="inputAltura">Altura:</label>
                        <input type="number" class="form-control" name="inputAltura" placeholder="Insira altura do paciente" step="0.01">
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