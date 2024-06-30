<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $idade = $_POST['idade'];
    $experiencias = $_POST['experiencia'];

    // Processamento dos dados e criação do currículo

    // Por exemplo, exibir os dados na tela
    echo "<h1>Currículo Gerado</h1>";
    echo "<p>Nome: $nome</p>";
    echo "<p>Data de Nascimento: $data_nascimento</p>";
    echo "<p>Idade: $idade</p>";
    echo "<h2>Experiências Profissionais</h2>";
    foreach ($experiencias as $experiencia) {
        echo "<p>$experiencia</p>";
    }
    echo '<a href="index.html">Voltar</a>';
}
?>