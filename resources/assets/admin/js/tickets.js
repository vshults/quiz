  $(function () {

    $('.checkbox-toggle').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {

            $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
            $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {

            $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
            $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
    })

    $('.mailbox-star').click(function (e) {
    e.preventDefault()

    var $this = $(this).find('a > i')
    var fa    = $this.hasClass('fa')

    if (fa) {
    $this.toggleClass('fa-star')
    $this.toggleClass('fa-star-o')
}
})
})
