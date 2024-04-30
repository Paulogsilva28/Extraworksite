<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se o formulário foi submetido
if (isset($_POST)) {
    // Captura os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Configurações do banco de dados
    $host = 'localhost'; // Host do MySQL (geralmente 'localhost')
    $banco = 'extrawork-formulario'; // Nome do banco de dados
    $senha_user = ''; // Senha do MySQL
    $user = 'root'; // Nome de usuário do MySQL

    // Conecta-se ao banco de dados
    $conn = mysqli_connect($host, $user, $senha_user, $banco);

    // Verifica se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Prepara a consulta SQL para inserir os dados no banco de dados
    $sql = "SELECT nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    //Verifica se existe o usuário ou os dados estão corretos
    if ($result->num_rows > 0) {
        // Iniciar sessão no browser
        session_start();
        
        // Obter os dados do usuário
        $row = $result->fetch_assoc();
        
        // Armazenar dados do usuário na sessão
        $_SESSION['nome'] = $row['nome'];
        
        // Redirecionar para a página do painel
        header("Location: ../painel.php");
        exit();
    } else {
        // Se as credenciais estiverem erradas, redireciona de volta para a página de login com uma mensagem de erro;
        header("Location: ../login.html");
        exit();
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);
}

?>
