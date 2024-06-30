<?php

function ListCurriculum() {
    include 'db.php';

    $sqlResumes = "
        SELECT *
        FROM resumes r
        ORDER BY r.id DESC";
    $resultResumes = $conn->query($sqlResumes);

    $sqlExperiences = "
        SELECT *
        FROM experiences r
        ORDER BY r.id DESC";
    $resultExperiences = $conn->query($sqlExperiences);

    $curriculos = array();


    $dataExperiences = array();

    while ($rowExperiences = $resultExperiences->fetch_assoc()) {
        $dataExperiences[] = $rowExperiences;
    }

    if ($resultResumes->num_rows > 0) {
        while ($row = $resultResumes->fetch_assoc()) {
            // Filtra as experiências relacionadas ao currículo atual
            $experiences = array_filter($dataExperiences, function($experience) use ($row) {
                return $experience['resume_id'] == $row['id'];
            });

            $row['experiences'] = $experiences;
            $curriculos[] = $row;
        }
    }

    return $curriculos;
}

$curriculos = ListCurriculum();

echo json_encode($curriculos);
?>