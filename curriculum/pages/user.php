<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca de Currículo</title>
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
                    <a class="nav-link" href="./user-form.php">Gerador de Currículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Vizualizador de Currículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./user.php">Encontrar Currículo <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container mt-5">

        <div class="search-bar mb-3 d-flex">
            <input type="text" id="search-text" class="form-control" placeholder="Pesquisar...">
            <button id="search-button" class="btn btn-primary">
                <img src="../assets/icons/search.svg" alt="Search Icon" width="20" height="20">
            </button>

        </div>

        <div class="container mt-5 d-flex margin" style="margin: 1rem 0;">
            <h1>Currículo:</h1>
            <button style="margin: 0 30px;" id="print-button" class="btn btn-primary" >Imprimir Currículo</button>
        </div>

        <div id="curricullum-container"></div>
    </main>
</body>
</html>