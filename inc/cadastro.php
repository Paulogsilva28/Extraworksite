<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se o formulário foi submetido
if (isset($_POST)) {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone']; // Ajustado para 'Telefone'
    $genero = $_POST['genero'];
    $datanascimento = $_POST['datanascimento'];
    $cidade = $_POST['cidade'];
    $senha = $_POST['senha'];
    $check_senha = $_POST['check-senha']; // Ajustado para 'check-senha'

    // Verifica se as senhas coincidem
    if ($senha != $check_senha) {
        die("As senhas não coincidem.");
    }

    // Configurações do banco de dados
    $host = 'localhost'; // Host do MySQL (geralmente 'localhost')
    $banco = 'extrawork-formulario'; // Nome do banco de dados
    $senha_user = ''; // Senha do MySQL
    $user = 'root'; // Nome de usuário do MySQL

    // Conecta-se ao banco de dados
    $con = mysqli_connect($host, $user, $senha_user, $banco);

    // Verifica se a conexão foi estabelecida com sucesso
    if (!$con) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Prepara a consulta SQL para inserir os dados no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, telefone, genero, datanascimento, cidade, senha) 
            VALUES ('$nome', '$email', '$telefone', '$genero', '$datanascimento', '$cidade', '$senha')";

    // Executa a consulta SQL
    $rs = mysqli_query($con, $sql);

    if ($rs) {
        echo "Cadastrado com sucesso.";
        header("Location: ../login.html");
        exit();
    } else {
        echo "Erro ao cadastrar usuário: " . mysqli_error($con);
        header("Location: ../formulario.html");
        exit();
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($con);
}

?>
