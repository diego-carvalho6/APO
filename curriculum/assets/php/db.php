<?php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco_de_dados";

global $conn;
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    console_log("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS resumes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT,
    birthday DATE);
    
    CREATE TABLE IF NOT EXISTS experiences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    resume_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    start_date DATE,
    end_date DATE,
    description TEXT,
    FOREIGN KEY (resume_id) REFERENCES resumes(id));
    ";

if ($conn->query($sql) === TRUE) {
    echo "Tabela resumes criada com sucesso ou já existente.";
} else {
    echo "Erro ao criar tabela resumes: " . $conn->error;
}

?>
