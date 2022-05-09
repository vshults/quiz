$('.connectedSortable').sortable({
    containment:'.content',
    placeholder: 'sort-highlight',
    stop: handleReorderElements,
    connectWith: '.connectedSortable',
    handle: '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex: 999999
})
$('.connectedSortable .card-header').css('cursor', 'move')


$('.todo-list').sortable({
    placeholder: 'sort-highlight',
    handle: '.handle',
    forcePlaceholderSize: true,
    zIndex: 999999
})

function initSortableContainer()
{
    $(function()
    {
        $('.connectedSortable').sortable({
            containment:'.content',
            placeholder: 'sort-highlight',
            stop: handleReorderElements,
            connectWith: '.connectedSortable',
            handle: '.card-header, .nav-tabs',
            forcePlaceholderSize: true,
            zIndex: 999999
        })
        $('.connectedSortable .card-header').css('cursor', 'move')


        $('.todo-list').sortable({
            placeholder: 'sort-highlight',
            handle: '.handle',
            forcePlaceholderSize: true,
            zIndex: 999999
        })

    } );
}



function handleReorderElements()
{
    var url = '/admin/sortQuestions';
    var fieldData = $('.connectedSortable').sortable( "serialize" );
    fieldData += "&action=reorderElements";

    var posting = $.post( url, fieldData);
    posting.done( function( data)
    {
        reorderElementsResponse( data );
    });
}


function reorderElementsResponse( data )
{
    if (data.FAIL === undefined) // Everything's cool!
    {
        $("#Message").html( data.resultString + data.itemIndexString );
    }
    else
    {
        alert( "Bad Clams!" );
    }
}
