import bsCustomFileInput from 'bs-custom-file-input'

$("#avatar").change(function() { readURL(this); });
$('#cloneImgInput').click(function () { cloneImgInput(this); });

$(document).ready(function () {
    bsCustomFileInput.init();
})

function readURL(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function(e) { $('#blah').attr('src', e.target.result); }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function cloneImgInput() {
    var element         = $('.origin-field'),
        cloneElement    = element.clone();

    if (cloneElement === undefined)
        return false;

    let elementId       = element.find('input').attr('id') + Math.floor((Math.random() * 9999999) + 1),
        elementLabel    = element.find('.text-hide-label').text();

    cloneElement.removeClass('origin-field');
    cloneElement.find('input + label').html(elementLabel);

    cloneElement.find('input').attr('id', elementId).val('');
    cloneElement.find('label').attr('for', elementId);

    element.parent().append(cloneElement);
    bsCustomFileInput.init();
}
