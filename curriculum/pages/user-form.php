<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de Currículos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <script src="../assets/js/script.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Gerador de Currículos <span class="sr-only">(current)</span></a>
                  
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./users.php">Vizualizador de Currículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./user.php">Encontrar Currículo</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container mt-5">
        <form id="curriculum-form" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="data-nascimento">Data de Nascimento:</label>
                <input type="date" id="birthday" name="birthday" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="text" id="age" name="age" class="form-control" readonly>
            </div>
            <div id="experiences">
                <h4>Experiências Profissionais</h4>
                <button type="button" id="add-experience" class="btn btn-primary mb-3">+</button>
            </div>
            <button id="submit-form" class="btn btn-success">Gerar Currículo</button>
        </form>

        <div class="container mt-5" id="result-form">
        </div>

        <div id="print-section" style="display: none;">
            <h3>Dados do Currículo</h3>
            <p><strong>Nome:</strong> <span id="print-name"></span></p>
            <p><strong>Data de Nascimento:</strong> <span id="print-birthday"></span></p>
            <p><strong>Idade:</strong> <span id="print-age"></span></p>
            <h4>Experiências Profissionais</h4>
            <ul id="print-experiences"></ul>
            <button id="print-button" class="btn btn-primary">Imprimir Currículo</button>
        </div>
    </main>

</body>
</html>