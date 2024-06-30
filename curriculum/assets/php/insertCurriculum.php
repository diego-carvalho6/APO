<?php
include 'db.php';

function insertExperience($resumeId, $position, $company, $startDate, $endDate, $description) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO experiences (resume_id, position, company, start_date, end_date, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $resumeId, $position, $company, $startDate, $endDate, $description);

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function insertCurriculum($nome, $dataNascimento, $idade) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO resumes (name, age, birthday) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $nome, $idade, $dataNascimento);

    if ($stmt->execute()) {
        $resumeId = $stmt->insert_id;
        $stmt->close();
        return $resumeId;
    } else {
        $stmt->close();
        return false;
    }
}

function handleValidate() {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Erro ao decodificar JSON"]);
        exit;
    }

    $name = $data['name'] ?? null;
    $birthDay = $data['birthday'] ?? null;
    $age = $data['age'] ?? null;
    $experiences = $data['experiencies'] ?? [];

    if (!is_array($experiences)) {
        http_response_code(400);
        echo json_encode(["errorMessage" => "<h4>Experiências deve ser um array</h4>"]);
        exit;
    }

    if (count($experiences) != 0) {

        foreach ($experiences as $experience) {
            $position = $experience['position'] ?? null;
            $company = $experience['company'] ?? null;
            $startDate = $experience['startDate'] ?? null;
            $endDate = $experience['endDate'] ?? null;
            $description = $experience['description'] ?? null;

            if ($position === null || $company === null || $startDate === null || $endDate === null || $description === null) {
                http_response_code(400);
                echo json_encode(["errorMessage" => "<h4>Experiências deve conter todos os campos</h4>"]);
                exit;
            }
        }
    }

    $nullValues = array_filter([$name, $birthDay, $age], function($value) {
        return $value === null || $value === '';
    });

    if (!empty($nullValues)) {

        $objeto = [
            'errorMessage' => '<h4>Erro gerando Currículo, campos obrigatórios não preenchidos.</h4>',
        ];
    
        http_response_code(400);
        echo json_encode($objeto);

        return false;
    }

    return $data;
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = handleValidate();
    
        if ($data === false) {
            return; 
        }

        $resumeId = insertCurriculum($data['name'], $data['birthDay'], $data['age']);

        foreach($data['experiences'] as $experience) {
            insertExperience($resumeId, $experience['position'], $experience['company'], $experience['startDate'], $experience['endDate'], $experience['description']);
        }

        $data['id'] = $resumeId;

        http_response_code(201);
        echo json_encode($data);
    }
}

catch (Exception $e){
    http_response_code(500);
    header('Content-Type: application/json');
    $objeto = [
        'errorMessage' => '<h4>Um erro desconhecido aconteceu tente, novamente mais tarde.</h4>',
    ];

    echo json_encode($objeto);
    return false;

}


?>