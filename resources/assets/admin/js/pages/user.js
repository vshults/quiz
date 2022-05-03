function addUser(url){

    $(document).on('click', '#userAdd', function(e){
        e.preventDefault(); // чтобы небыло принудительной отправки формы

        var form = $('#addForm')[0];
        var formData = new FormData(form);
        $.ajax({
            url : url,
            type : 'POST',
            data : formData,
            processData: false,
            contentType: false,

            success : function(data) {
                $('.error_email').css('display','none')
                $('.error_password').css('display','none')
                $('.alert-success').css('display','block')
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                let data= XMLHttpRequest.responseText;
                let jsonResponse  = JSON.parse(data);
                let emailError    = jsonResponse.errors.email;
                let passwordError = jsonResponse.errors.password;
                if(emailError){
                    $('.error_email').css('display','block').text(emailError)
                }
                if(passwordError){
                    $('.error_password').css('display','block').text(passwordError)
                }

            }
        });
    });
}

function editUser(url){

    $('.js-edit-user input[type="text"], ' +
        '.js-edit-user input[type="email"], ' +
        '.js-edit-user input[type="password"], ' +
        '.js-edit-user select, ' +
        '.js-edit-user textarea').on('change', function () {

        let id = $(this).attr('data-id')
        let name = $(this).attr('data-name')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
                name: name,
                value: $(this).val(),
            },
            success() {


            }
        }).then(() => {
            $(this).addClass('is-valid')

            setTimeout(() => {
                $(this).removeClass('is-valid')
            }, 500);

        })

    });

    $(document).on('change', '.select_user', function () {
        let id = $(this).attr('data-id')
        let name = $(this).attr('data-name')
        let value = $(this).find(':selected').attr('data-selection-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
                name: name,
                value: $(this).val(),
            },
            success() {


            }
        }).then(() => {
            $(this).addClass('is-valid')

            setTimeout(() => {
                $(this).removeClass('is-valid')
            }, 500);

        })
    });
}

function deleteUser(url){

    $(document).on('click', '.delete_user', function () {
        let dataTextarea = []
        let id = $(this).attr('data-id')
        let parent = $(this).closest(".foo")
        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {
                parent.remove()

            }
        }).then(() => {

        })
    });
}

function uploadImageUser(url) {

    $('.uploadImageUser').on('change', function (event) {

        var formNm   = $(this)[0];
        var formData = new FormData(formNm);
        let id   = $(this).attr('data-id')
        let name = $(this).attr('data-name')
        formData.append('id', id);
        formData.append('name', name);
        // отправляем данные
        $.ajax({
            url: url,
            type: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                location.reload();
            },
        });
    });
}
