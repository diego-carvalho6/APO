<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Currículos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
    $.ajax({
        url: 'http://localhost/curriculum/assets/php/listCurriculum.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.length > 0) {
                var html = '';
                $.each(response, function(index, curriculo) {
                    html += '<div class="card mb-3">';
                    html += '<div class="card-body">';
                    html += '<h5 class="card-title">Currículo ID: ' + curriculo.id + '</h5>';
                    html += '<p class="card-text">Nome: ' + curriculo.name + '</p>';
                    html += '<p class="card-text">Idade: ' + curriculo.age + '</p>';
                    html += '<p class="card-text">Data de Nascimento: ' + curriculo.birthday + '</p>';
                    html += '<h6 class="card-subtitle mb-2 text-muted">Experiências Profissionais:</h6>';
                    if (curriculo.experiences.length > 0) {
                        html += '<ul class="list-group">';
                        $.each(curriculo.experiences, function(i, experience) {
                            html += '<li class="list-group-item">';
                            html += '<strong>Cargo:</strong> ' + experience.position + '<br>';
                            html += '<strong>Empresa:</strong> ' + experience.company + '<br>';
                            html += '<strong>Período:</strong> ' + experience.start_date + ' - ' + experience.end_date + '<br>';
                            html += '<strong>Descrição:</strong> ' + experience.description;
                            html += '</li>';
                        });
                        html += '</ul>';
                    } else {
                        html += '<p class="card-text">Nenhuma experiência cadastrada.</p>';
                    }
                    html += '</div>';
                    html += '</div>';
                });
                $('#curriculos-container').html(html);
            } else {
                $('#curriculos-container').html('<div class="alert alert-warning" role="alert">Nenhum currículo encontrado.</div>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro ao buscar currículos:', error);
            $('#curriculos-container').html('<div class="alert alert-danger" role="alert">Erro ao carregar currículos.</div>');
        }});});</script>
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
                    <a class="nav-link" href="">Vizualizador de Currículos<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./user.php">Encontrar Currículo</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container mt-5">
        <h1>Lista de Currículos</h1>
        <div id="curriculos-container">
        </div>
    </main>
</body>
</html>