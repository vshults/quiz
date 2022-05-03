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

        $.ajax({
            url: url,
            type: 'post',
            data: {
                id: id,
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
