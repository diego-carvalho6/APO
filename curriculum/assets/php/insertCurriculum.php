<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $servername = "localhost";
    $username = "seu_usuario";
    $password = "sua_senha";
    $dbname = "seu_banco_de_dados";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $name = $_POST['name'];
    $birthDay = $_POST['birthDay'];
    $age = $_POST['age'];
    $experiencies = $_POST['experiencies'];

    if ($conn->connect_error) {
        echo "<h1>Erro gerando Curriculo, não foi possivel conectar ao banco</h1>";
        echo "<p>Nome: $name</p>";
        echo "<p>Data de Nascimento: $birthDay</p>";
        echo "<p>Idade: $age</p>";
        echo "<h2>Experiências Profissionais</h2>";
        foreach ($experience as $experiencies) {
            echo "<p>$experience</p>";
        }
        echo '<a href="index.html">Voltar</a>';
    }

    $nullValues = [$name, $birthDay, $age].filter(function($value) {
        return $value == null;
    });

    if ($nullValues.length > 0) {
        echo "<h1>Erro gerando Curriculo, campos obrigatórios não preenchidos</h1>";
        foreach ($nullValue as $nullValues) {
            echo "<p>$nullValue</p>";
        }
        echo '<a href="index.html">Voltar</a>';
    }

    $sql = "INSERT INTO resumes (id, name, birthday, age, experiences) VALUES ('$name', '$birthDay', '$age')";

    echo "<h1>Currículo Gerado</h1>";
    echo "<p>Nome: $name</p>";
    echo "<p>Data de Nascimento: $birthDay</p>";
    echo "<p>Idade: $age</p>";
    echo "<h2>Experiências Profissionais</h2>";
    foreach ($experience as $experiencies) {
        echo "<p>$experience</p>";
    }
    echo '<a href="index.html">Voltar</a>';
}
?>