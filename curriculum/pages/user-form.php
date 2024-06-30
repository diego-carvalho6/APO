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
    <form id="curriculo-form" method="POST" action="assets/php/insertCurriculum.php">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="age" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="data-nascimento">Data de Nascimento:</label>
            <input type="date" id="data-nascimento" name="data_nascimento" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="idade">Idade:</label>
            <input type="text" id="idade" name="idade" class="form-control" readonly>
        </div>
        <div id="experiencias">
            <h4>Experiências Profissionais</h4>
            <button type="button" id="add-experiencia" class="btn btn-primary mb-3">+</button>
        </div>
        <button type="submit" class="btn btn-success">Gerar Currículo</button>
    </form>
</main>

<script src="assets/js/script.js"></script>
</body>
</html>