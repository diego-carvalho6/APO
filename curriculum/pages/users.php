<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Currículos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</head>
<body>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../index.html">Home</a>
            </li>
        </ul>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Gerador de Currículos</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="pages/user-form.php">Vizualizador de Currículos</a>
            </li>
          
        </ul>
    </div>
</nav>

<main class="container mt-5">
<?php
            include 'listCurriculum.php';

            $curriculos = listCurriculum($conn);

            $currentId = null;

            foreach ($curriculos as $curriculo) {

                if ($currentId != $curriculo['id'])
                {
                    echo '<tr>';
                    echo '<th>Id: ' . $curriculo['id'] . '</th>';
                    echo '<th>Nome: ' . $curriculo['name'] . '</th>';
                    echo '<th>Idade: ' . $curriculo['age'] . '</th>';
                    echo '<th>Data de Nascimento: ' . $curriculo['birthday'] . '</th>';
                    echo '</tr>';
        
                    echo '<br>';
                }
                
                echo '<h4>Experiência Profissional: </h4>';
                echo '<tr>';
                echo '<th>Cargo: ' . $curriculo['position'] . '</th>';
                echo '<th>Empresa: ' . $curriculo['company'] . '</th>';
                echo '<th>Período: ' . $curriculo['start_date'] . ' - ' . $curriculo['end_date'] . '</th>';
                echo '<th>Descrição: ' . $curriculo['description'] . '</th>';
                echo '</tr>';
            }
            ?>
            <button class="btn btn-lg btn-primary" onclick="printPage()">Imprimir Currículo</button>
</main>

<script src="assets/js/script.js"></script>
</body>
</html>