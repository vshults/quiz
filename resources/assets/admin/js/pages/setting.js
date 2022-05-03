function editSetting(url){

    $('.js-edit-setting input[type="text"], ' +
        '.js-edit-setting input[type="tel"], ' +
        '.js-edit-setting input[type="email"], ' +
        '.js-edit-setting input[type="password"], ' +
        '.js-edit-setting textarea').on('change', function () {

        let id = $(this).attr('data-id')
        let name = $(this).attr('data-name')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
                name: name,
                value: $(this).val(),
            } ,
            success() {


            }
        }).then(() => {
            $(this).addClass('is-valid')

            function getJson() {
                try {
                    return JSON.parse($('#json-input').val());
                } catch (ex) {
                    alert('Неверный формат json');
                }
            }

            var editor = new JsonEditor('#json-display', getJson());
            editor.load(getJson());



            setTimeout(() => {
                $(this).removeClass('is-valid')
            }, 500);

        })

    });
}

function getJson() {
    return JSON.parse($('#json-input').val());
}

var editor = new JsonEditor('#json-display', getJson());
editor.load(getJson());
