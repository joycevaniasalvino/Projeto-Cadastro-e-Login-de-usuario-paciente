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

       //$nome = $_SESSION['nome'];

    //    $row = [
    //        ["id"=>1, "nome"=>"Jose Santos Silva", "idade"=>19, "peso"=>74.5, "altura"=>1.75],
    //        ["id"=>2, "nome"=>"Maria Santos Silva", "idade"=>23, "peso"=>75.7, "altura"=>1.68],
    //    ];

       $dados = [];

    //    if(!($result = mysqli_query($mysqli, "SELECT * FROM pacientes"))){
    //        echo "Erro ao listar pacientes" . mysqli_error($mysqli);
    //    }

    //    while($linhaPlinha = mysqli_fetch_row($result)){
    //        $dados[] = [
    //            "id" => (int)$linhaPlinha[0],
    //            "nome" => $linhaPlinha[1],
    //            "idade" => (int)$linhaPlinha[2],
    //            "peso" => (float)$linhaPlinha[3],
    //            "altura" => (float)$linhaPlinha[4],
    //        ];
    //    }
    //    mysqli_free_result($result);
    //    mysqli_close($mysqli);

    // ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark nav">
            <!-- Navbar content -->
            <a style="font-size: 18px; margin-right: 7px;" class="navbar-brand" href="./listarPacientes.php">Lista de Pacientes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a style="color: rgb(158, 156, 156); font-size:16px;" class="nav-link" href="./pacienteCadastro.php">Cadastrar Paciente<span class="sr-only"></span></a>
                    </li>
                    <li style="margin-top: 1px;" class="nav-item active">
                        <a style="font-size: 15px; color:rgb(158, 156, 156);" class="nav-link" href="./logout.html">Sair</a>
                    </li>
                </ul>
                <svg style="color: white; margin-right: 2px; margin-top: 1px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>
                <p style="margin-bottom: -2px;" >Olá, <?=$_SESSION['nome']?>!</p>
            </div>
        </nav>
    </header>
    <main>
        <div class="table-responsive-sm container">
        <?php

            if(!($result = mysqli_query($mysqli, "SELECT * FROM pacientes"))){?>
                <p style="color: red;"><?php echo "Erro ao listar pacientes: " . mysqli_error($mysqli)?>;</p>
            <?php }
            while($linhaPlinha = mysqli_fetch_row($result)){
                $dados[] = [
                    "id" => (int)$linhaPlinha[0],
                    "nome" => $linhaPlinha[1],
                    "idade" => (int)$linhaPlinha[2],
                    "peso" => (float)$linhaPlinha[3],
                    "altura" => (float)$linhaPlinha[4],
                ];
            }

            mysqli_free_result($result);
            mysqli_close($mysqli);

        ?>
            <table class="table table-striped table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Idade</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Altura</th>
                        <th scope="col">IMC</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados as $pacientes){?>
                        <tr>
                            <th scope="row"><?= $pacientes["id"]?></th>
                            <td><?= $pacientes["nome"]?></td>
                            <td><?= $pacientes["idade"]?></td>
                            <td><?= $pacientes["peso"]?></td>
                            <td><?= $pacientes["altura"]?></td>
                            <td><?= number_format( $pacientes["peso"] / ($pacientes["altura"] * $pacientes["altura"]),2)?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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