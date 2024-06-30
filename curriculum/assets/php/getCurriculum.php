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

?>