function editHost(url){

    $('.js-edit-host input[type="text"], ' +
        '.js-edit-host input[type="tel"], ' +
        '.js-edit-host select, ' +
        '.js-edit-host input[type="email"], ' +
        '.js-edit-host input[type="password"], ' +
        '.js-edit-host textarea').on('change', function () {

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
}

function deleteHost(url){

    $(document).on('click', '.delete_host', function () {
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

function addHost(url){

    $(document).on('click', '#hostAdd', function(e){
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
                $('.error_emails_host').css('display','none')
                $('.error_domen_host').css('display','none')
                $('.alert-success').css('display','block')
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                let data               = XMLHttpRequest.responseText;
                let jsonResponse       = JSON.parse(data);
                let domenErrorHost     = jsonResponse.errors.domen;

                if(domenErrorHost){
                    $('.error_domen_host').css('display','block').text(domenErrorHost)
                }

            }
        });
    });
}
