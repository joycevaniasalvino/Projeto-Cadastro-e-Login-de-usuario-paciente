<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--css bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/cadastro.css">

    <title>Cadastre-se</title>
</head>
<body>
    <?php
        session_start();
        include('conexao.php');

        if(isset($_POST['inputNome']) || isset($_POST['inputEmail']) || isset($_POST['inputSenha']) || isset($_POST['inputConfSenha'])){
            if(strlen($_POST['inputNome']) == 0){
                //echo "Preencha seu nome";
                $_SESSION['error'] = "Preencha seu nome";
            }else if(strlen($_POST['inputEmail']) == 0){
                //echo "Preencha sua email";
                $_SESSION['error'] = "Preencha seu email";
            }else if(strlen($_POST['inputSenha']) == 0){
                //echo "Preencha sua senha";
                $_SESSION['error'] = "Preencha sua senha";
            }else if(strlen($_POST['inputConfSenha']) == 0){
                //echo "Confirme sua senha";
                $_SESSION['error'] = "Preencha sua senha";
            }else if($_POST['inputSenha'] != $_POST['inputConfSenha']){
                //echo "Senhas diferentes!";
                $_SESSION['error'] = "Senhas diferentes!";
            }
            else{

                $nome = $_POST['inputNome'];
                $email = $_POST['inputEmail'];
                $senha = $_POST['inputSenha'];
        
                $sql = "INSERT INTO usuarios(nome, email, senha) VALUES ('$nome', '$email', '$senha')";

        
                if(mysqli_query($mysqli, $sql)){
                    echo "Usuário cadastrado com sucesso";

                    $email = $mysqli->real_escape_string($_POST['inputEmail']);

                    $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";

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
                        echo "Falha ao verficar id";
                    }

                    //header("Location: listarPacientes.php");
                }else{
                    echo "Erro".mysqli_connect_error($mysqli);
                }
            }
        }
        mysqli_close($mysqli);
    ?>

    <header>
        <nav class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">Cadastra-se</span>
        </nav>
    </header>
    <main>
        <div class="voltar">
            <a class="svg2" href="./login.php"><svg xmlns="http://www.w3.org/2000/svg" width="16%" height="52" fill="currentColor" class="bi bi-backspace" viewBox="0 0 16 16">
                <path d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z"/>
                <path d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z"/>
            </svg></a>

        </div>
        <div class="container">
            <div class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="75" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </div>
            <div class="formulario">
                <form action="" method="POST">
                    <?php 
                    if(isset($_SESSION['error'])){?>
                        <p style= "margin: 0; color: red;"><?= $_SESSION['error'];?></p><?php
                        session_destroy();
                    }else{
                        echo "";
                        }?>
                    <div class="form-group">
                        <label for="inputNome">Nome:</label>
                        <input type="text" class="form-control" name="inputNome" aria-describedby="emailHelp" placeholder="Insira seu nome completo">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email:</label>
                        <input type="email" class="form-control" name="inputEmail" placeholder="Insira sua email">
                    </div>
                    <div class="form-group">
                        <label for="inputSenha">Senha:</label>
                        <input type="password" class="form-control" name="inputSenha" placeholder="Insira sua senha">
                    </div>
                    <div class="form-group">
                        <label for="inputConfSenha">Confirme senha:</label>
                        <input type="password" class="form-control" name="inputConfSenha" placeholder="Confirme sua senha">
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