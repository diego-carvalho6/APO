$(document).ready(function() {
    const $dataNascimento = $('#data-nascimento');
    const $idade = $('#idade');
    const $addExperiencia = $('#add-experiencia');
    const $experiencias = $('#experiencias');

    $dataNascimento.on('change', function() {
        const hoje = new Date();
        const nascimento = new Date($dataNascimento.val());
        let idadeCalculada = hoje.getFullYear() - nascimento.getFullYear();
        const mes = hoje.getMonth() - nascimento.getMonth();
        if (mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())) {
            idadeCalculada--;
        }
        $idade.val(idadeCalculada);
    });

    $addExperiencia.on('click', function() {
        const $div = $('<div>', { class: 'form-group' });
        const $label = $('<label>', { for: 'experiencia', text: 'Experiência:' });
        const $input = $('<input>', { type: 'text', name: 'experiencia[]', class: 'form-control' });

        $div.append($label, $input);
        $experiencias.append($div);
    });
});