$(document).ready(function() {
    const $birthDateInput = $('#data-nascimento');
    const $age = $('#idade');
    const $addExperienceButton = $('#add-experiencia');
    const $experiences = $('#experiencias');

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
        const $div = $('<div>', { class: 'form-group' });
        const $label = $('<label>', { for: 'experiencia', text: 'Experiência:' });
        const $input = $('<input>', { type: 'text', name: 'experiencia[]', class: 'form-control' });

        $div.append($label, $input);
        $experiences.append($div);
    });
});

function printPage() {
    window.print();
}