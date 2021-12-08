<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--css bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/listarPacientes.css">

    <title>Lista de Pacientes</title>
</head>
<body>
    <?php
       include('protect.php');
       include('conexao.php');

       $nome = $_SESSION['nome'];

       $row = [
           ["nome"=>"Jose Santos Silva", "idade"=>19, "peso"=>74.5, "altura"=>1.75],
       ];

       mysqli_close($mysqli);

    ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark nav">
            <!-- Navbar content -->
            <a class="navbar-brand listar" href="./listarPacientes.php">Lista de Pacientes</a>
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
                <p>Olá, <?=$nome?>!</p>
            </div>
        </nav>
    </header>
    <main>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Idade</th>
            <th>Peso</th>
            <th>Altura</th>
            <th>IMC</th>
        </tr>
        <?php foreach($row as $pacientes){?>
            <tr>
                <td><?= $pacientes["nome"]?></td>
                <td><?= $pacientes["idade"]?></td>
                <td><?= $pacientes["peso"]?></td>
                <td><?= $pacientes["altura"]?></td>
                <td><?= $pacientes["peso"] * $pacientes["altura"]?></td>
            </tr>
        <?php } ?>
    </table>
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