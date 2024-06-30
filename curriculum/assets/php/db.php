<?php

$servername = "localhost";
$username = "root";
$dbname = "APOC";

global $conn;
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    error_log("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}


$sql = "
CREATE TABLE IF NOT EXISTS resumes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT,
    birthday DATE
);

CREATE TABLE IF NOT EXISTS experiences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    resume_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    company VARCHAR(100) NOT NULL,
    start_date DATE,
    end_date DATE,
    description TEXT,
    FOREIGN KEY (resume_id) REFERENCES resumes(id)
);";

if ($conn->multi_query($sql) === TRUE) {
    error_log("Tabelas criadas com sucesso");
} else {
    error_log("Erro ao criar tabelas: " . $conn->error);
}

while ($conn->next_result()) {;}

?>
