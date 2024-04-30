<?php
session_start(); // Inicia a sessão (se ainda não estiver iniciada)

// Verifica se o botão foi clicado
if (isset($_GET['destroy_session'])) {
    // Destrói a sessão
    session_destroy();
    // Redireciona para alguma página, se desejar
    header("Location: ../login.html");
    exit; // Garante que o script termina aqui
}
?>