$(document).ready(function() {
    const $birthDateInput = $('#birthday');
    const $age = $('#age');
    const $addExperienceButton = $('#add-experience');
    const $addCurricullumButton = $('#add-curriculum');
    const $printButton = $('#print-button');
    const $experiences = $('#experiences');
    const $curriculumForm = $('#curriculum-form');
    const $curriculumContainer = $('#curricullum-container');
    const $search = $('#search-button');

    const $searchInput = $('#search-text');
    const $submitFormButton = $('#submit-form');

    $birthDateInput.on('change', function() {
        const today = new Date();
        const birthday = new Date($birthDateInput.val());
        let resultDate = today.getFullYear() - birthday.getFullYear();
        const month = today.getMonth() - birthday.getMonth();
        if (month < 0 || (month === 0 && today.getDate() < birthday.getDate())) {
            resultDate--;
        }
        $age.val(resultDate);
    });

    $addExperienceButton.on('click', function() {
        const $div = $('<div>', { class: 'experiencia form-group mb-3 border rounded p-3' }); // Adicionando a classe 'experiencia'

        const $labelPosition = $('<label>', { for: 'position', text: 'Cargo:' });
        const $inputPosition = $('<input>', { type: 'text', name: 'position', class: 'form-control position', required: true });

        const $labelCompany = $('<label>', { for: 'company', text: 'Empresa:' });
        const $inputCompany = $('<input>', { type: 'text', name: 'company', class: 'form-control company', required: true });

        const $labelDescription = $('<label>', { for: 'description', text: 'Descrição:' });
        const $inputDescription = $('<textarea>', { name: 'description', class: 'form-control description', required: true });

        const $labelStartDate = $('<label>', { for: 'startDate', text: 'Data de Início:' });
        const $inputStartDate = $('<input>', { type: 'date', name: 'startDate', class: 'form-control startDate', required: true });

        const $labelEndDate = $('<label>', { for: 'endDate', text: 'Data de Término:' });
        const $inputEndDate = $('<input>', { type: 'date', name: 'endDate', class: 'form-control endDate', required: true });

        const $removeButton = $('<button>', { type: 'button', class: 'btn btn-danger btn-sm ml-2 remove-experience', text: 'Remover' });

        $removeButton.on('click', function() {
            $div.remove();
        });

        $div.append(
            $labelPosition, $inputPosition,
            $labelCompany, $inputCompany,
            $labelDescription, $inputDescription,
            $labelStartDate, $inputStartDate,
            $labelEndDate, $inputEndDate,
            $removeButton
        );

        $experiences.append($div);
    });
    
    $printButton.on('click', function() {
        window.print();
    });

    
    $search.on('click', function() {
        var data = [];

        if ($searchInput.val() === '' || $searchInput.val() == null) {
            $curriculumContainer.html('<div class="alert alert-warning" role="alert">Nenhum currículo encontrado.</div>');
            return;
        }

        $.ajax({
            url: 'http://localhost/curriculum/assets/php/listCurriculum.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                data = response.filter(function(x) {
                    return x?.id == $searchInput.val() || 
                           x?.name?.includes($searchInput.val()) || 
                           x?.birthday == $searchInput.val() || 
                           (Array.isArray(x.experiences) && x.experiences.some(function(y) {
                            return y?.position?.includes($searchInput.val()) || 
                                   y?.company?.includes($searchInput.val()) || 
                                   y?.start_date?.includes($searchInput.val()) || 
                                   y?.end_date?.includes($searchInput.val());
                        }));
                });

                if (data.length === 0) {
                    $curriculumContainer.html('<div class="alert alert-warning" role="alert">Nenhum currículo encontrado.</div>');
                } else {
                    var html = '';
                    $.each(data, function(index, curriculo) {
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
                    $curriculumContainer.html(html);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro ao buscar currículos:', error);
                $curriculumContainer.html('<div class="alert alert-danger" role="alert">Erro ao carregar currículos.</div>');
            }
        });
    });


    $curriculumForm.on('submit', function(event) {
        event.preventDefault();

        const formData = $(this).serializeArray();
        const experiences = [];

        const curriculumData = {};
        $.each(formData, function() {
            if (curriculumData[this.name]) {
                if (!Array.isArray(curriculumData[this.name])) {
                    curriculumData[this.name] = [curriculumData[this.name]];
                }
                curriculumData[this.name].push(this.value || '');
            } else {
                curriculumData[this.name] = this.value || '';
            }
        });

        $('.experiencia').each(function() {
            const $inputs = $(this).find('.form-control');
            const experience = {};

            $inputs.each(function() {
                experience[this.name] = $(this).val();
            });

            experiences.push(experience);
        });


        curriculumData['experiences'] = experiences;

        console.log(curriculumData)

        $.ajax({
            url: "http://localhost/curriculum/assets/php/insertCurriculum.php",
            method: 'POST',
            data: JSON.stringify(curriculumData),
            contentType: 'application/json',
            success: function(response) {
                $('#result-form').html('<div class="alert alert-success">Currículo gerado com sucesso!</div>');

                $('#print-name').text(curriculumData.name);
                $('#print-birthday').text(curriculumData.birthday);
                $('#print-age').text(curriculumData.age);

                $('#print-experiences').empty();
                $.each(curriculumData.experiences, function(index, experience) {
                    $('#print-experiences').append(`<li><strong>Cargo:</strong> ${experience.position}, <strong>Empresa:</strong> ${experience.company}, <strong>Início:</strong> ${experience.startDate}, <strong>Término:</strong> ${experience.endDate}, <strong>Descrição:</strong> ${experience.description}</li>`);
                });

                $('#print-section').show();
            },
            error: function(xhr, status, error) {
                $('#result-form').html('<div class="alert alert-danger">Erro ao gerar currículo. ' + xhr.responseText + '</div>');

            }
        });
    });
});
