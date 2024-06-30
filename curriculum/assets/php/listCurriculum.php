<?php
// Inclui o arquivo de configuração da conexão com o banco de dados
include 'db.php';

function ListCurriculum($conn) {
$sql = "
    SELECT *
    FROM resumes r
    ORDER BY r.id DESC";
$resultResumes = $conn->query($sql);

$sql = "
    SELECT *
    FROM experiences r
    ORDER BY r.id DESC";
$resultExperiences = $conn->query($sql);

$curriculos = array();

if ($resultResumes->num_rows > 0) {
    while ($row = $resultResumes->fetch_assoc()) {

        $experiences = array();

        if ($resultExperiences->num_rows > 0) {
            while ($rowExperiences = $resultExperiences->fetch_assoc()) {
                if ($rowExperiences['resume_id'] == $row['id']) {
                    $experiences[] = $rowExperiences;
                }
            }
        }

        $row['experiences'] = $experiences;
        $curriculos[] = $row;
    }
}

$conn->close();

return $curriculos;
}
?>