<?php
include 'db.php';


function FindCurricullum($id) {
    $integer = filter_var($id, FILTER_VALIDATE_INT);

    $sqlResumes = "
    SELECT *
    FROM resumes r
    WHERE r.id = $integer
    ORDER BY r.id DESC";
    $resultResumes = $conn->query($sqlResumes);

    $sqlExperiences = "
    SELECT *
    FROM experiences e 
    LEFT JOIN resumes r ON r.id = e.resume_id AND r.id = $integer
    ORDER BY r.id DESC";
    $resultExperiences = $conn->query($sqlExperiences);

    if ($resultResumes->num_rows > 0) {
        $curriculo = $resultResumes->fetch_assoc().firs
        $experiences = [];


        while ($row = $resultExperiences->fetch_assoc()) {
            $experiences[] = $row;
        }   

        $curriculo['experiences'] = $experiences;

        return $curriculo;
    } else {
        return null;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "
        SELECT *
        FROM resumes r
        LEFT JOIN experiences e ON r.id = e.resume_id
        WHERE r.id = $id
        ORDER BY r.id DESC";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $current_resume_id = null;
        
        while ($row = $result->fetch_assoc()) {
            if ($row['id'] !== $current_resume_id) {
                echo "<strong>ID: " . $row['id'] . "</strong><br>";
                echo "Nome: " . $row['name'] . "<br>";
                echo "Idade: " . $row['age'] . "<br>";
                echo "Data de Nascimento: " . $row['birthday'] . "<br><br>";
                
                $current_resume_id = $row['id'];
            }
            
            echo "<strong>Experiência:</strong><br>";
            echo "Cargo: " . $row['position'] . "<br>";
            echo "Empresa: " . $row['company'] . "<br>";
            echo "Período: " . $row['start_date'] . " - " . $row['end_date'] . "<br>";
            echo "Descrição: " . $row['description'] . "<br>";
            echo "<hr>";
        }
    } else {
        echo "Currículo não encontrado.";
    }
} else {
    echo "ID não especificado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>