<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--css bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="./css/login.css">

    <title>Login</title>
</head>

<body>
    <?php

        include('conexao.php');

        if(isset($_POST['inputEmail']) || isset($_POST['inputSenha'])){
            if(strlen($_POST['inputEmail']) == 0){
                echo "Preencha seu email";
            }else if(strlen($_POST['inputSenha']) == 0){
                echo "Preencha sua senha";
            } else{
                $email = $mysqli->real_escape_string($_POST['inputEmail']);
                $senha = $mysqli->real_escape_string($_POST['inputSenha']);

                $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND  senha = '$senha'";

                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL:" . $mysqli->error);

                $quantidade = $sql_query->num_rows;

                if($quantidade == 1){

                    $usuario = $sql_query->fetch_assoc();

                    if(!isset($_SESSION)){
                        session_start();

                    }
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['nome'] = $usuario['nome'];

                    header("Location: listarPacientes.php");

                } else{
                    echo "Falha ao logar! Email ou senha incorretos";
                }
            }
        }
        mysqli_close($mysqli);

    ?>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">Login</span>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="75" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
            </div>
            <div class="formulario">
                <form id="login" action="" method="POST">
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="email" name ="inputEmail" aria-describedby="emailHelp" placeholder="Insira seu email">
                    </div>
                    <div class="form-group">
                        <label for="inputSenha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="inputSenha" placeholder="Insira sua senha">
                    </div>
                    <div class="button">
                        <button type="submit" id="
                        cadastrar" class="btn btn-primary">Entrar</button> 
                        <a href="./cadastro.php"><p>Cadastre-se</p></a>
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