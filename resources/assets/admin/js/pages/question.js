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
