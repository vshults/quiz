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

function questionTitle(url) {

    $('.js-edit-question_title input[type="text"], ' +
        '.js-edit-question_title textarea').on('change', function () {

        let id = $(this).attr('data-id')
        let name = $(this).attr('data-name')
        let answer = $(this).attr('data-answer')

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

function editAnswer(url) {

    $('.js-edit-answer input[type="text"], ' +
        '.js-edit-answer textarea').on('change', function () {

        let id = $(this).attr('data-id')
        let name = $(this).attr('data-name')
        let answer = $(this).attr('data-answer')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
                name: name,
                answer: answer,
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

function editQuestionsSetting(url) {

    $('.js-edit-questions-setting input[type="text"], ' +
        '.js-edit-questions-setting select, ' +
        '.js-edit-questions-setting input[type="checkbox"], ' +
        '.js-edit-questions-setting textarea').on('change', function () {

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

function addBranch(url) {

    $(document).on('click', '.add_branch', function () {

        let id = $(this).attr('data-id')
        let hostID = $(this).attr('data-hostID')
        let selectionID = $(this).attr('data-selection-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
                hostID: hostID,
                selectionID: selectionID,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function addBranchQuestion(url) {

    $(document).on('click', '.add_branch_question', function () {

        let id = $(this).attr('data-id')
        let hostID = $(this).attr('data-hostID')
        let selectionID = $(this).attr('data-selection-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
                hostID: hostID,
                selectionID: selectionID,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function addQuestion(url) {

    $(document).on('click', '.add_question', function () {

        let hostID = $(this).attr('data-host-id')
        let selectionID = $(this).attr('data-selection-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                hostID: hostID,
                selectionID: selectionID
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function deleteQuestion(url) {

    $(document).on('click', '.delete_question', function () {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function addAnswer(url) {

    $(document).on('click', '.add_answer', function () {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function deleteAnswer(url) {

    $(document).on('click', '.delete_answer', function () {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function deleteBranch(url) {

    $(document).on('click', '.delete_branch', function () {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function deleteBranchQuestion(url) {

    $(document).on('click', '.delete_branch_question', function () {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function uploadImageQuestion(url) {


    $('.uploadImage').on('change', function (event) {

        event.preventDefault();
        var formNm = $('#image')[0];
        var formData = new FormData(formNm);
        let id = $(this).attr('data-id')
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

function uploadImageAnswer(url) {

    $('.imageAnswerUpload').on('change', function (event) {

        var formNm   = $(this)[0];
        var formData = new FormData(formNm);
        let id   = $(this).attr('data-id')
        let name = $(this).attr('data-name')
        formData.append('id', id);
        formData.append('answer', true);
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

function deleteAnswerImage(url){

    $('.deleteAnswerImage').on('click', function (e) {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}
function deleteQuestionImage(url){

    $('.deleteAnswerImage').on('click', function (e) {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

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

function editSelection(url){

    $('.js-edit-selection input[type="text"], ' +
        '.js-edit-selection').on('change', function () {

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

function addSelection(url){

    $(document).on('click', '.add_selection', function () {

        let id = $(this).attr('data-user-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function deleteSelection(url){

    $(document).on('click', '.delete_selection', function () {
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
                location.reload();

            }
        }).then(() => {

        })
    });
}

function addQuestionSelection(url){

    $(document).on('click', '.add_question_selection', function () {

        let selectionID = $(this).attr('data-selection-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                selectionID: selectionID,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function deleteQuestionSelection(url){
    $(document).on('click', '.delete_question_selection', function () {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function addAnswerSelection(url){

    $(document).on('click', '.add_answer_selection', function () {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function deleteAnswerSelection(url){

    $(document).on('click', '.delete_answer_selection', function () {

        let id = $(this).attr('data-id')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function addBranchSelection(url){

    $(document).on('click', '.add_branch_selection', function () {

        let id = $(this).attr('data-id')
        let selectionID = $(this).attr('data-selectionID')
        let type = $(this).attr('data-type')

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
                type:type,
                selectionID: selectionID,
            },
            success() {

            }
        }).then(() => {
            location.reload();

        })
    });
}

function saveSelection(url){

    $(document).on('change', '.js-react-save-select', function () {
        let dataTextarea = []
        let hostID = $(this).attr('data-host-id')
        let selectionID = $(this).find(':selected').attr('data-selection-id')
        $.ajax({
            url: url,
            type: 'post',
            data: {
                selectionID: selectionID,
                value: $(this).val(),
                hostID: hostID,
                select: 1,
            },
            success: function(){
                location.reload();
            },
        })
    });
}
