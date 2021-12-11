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
    session_start();
        include('conexao.php');

        if(isset($_POST['inputEmail']) || isset($_POST['inputSenha'])){
            if(strlen($_POST['inputEmail']) == 0){
                //echo "Preencha seu email";
                $_SESSION['error'] = "Preencha seu email";
            }else if(strlen($_POST['inputSenha']) == 0){
                //echo "Preencha sua senha";
                $_SESSION['error'] = "Preencha sua senha";
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
                    $_SESSION['error'] = "Falha ao logar! Email ou senha incorretos.";
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
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="75" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
            </div>
            <div class="formulario">
                <?php 
                if(isset($_SESSION['error'])){?>
                    <p style= "margin: 0; color: red;"><?= $_SESSION['error'];?></p><?php
                    session_destroy();
                }else{ 
                    echo "";
                    }?>
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