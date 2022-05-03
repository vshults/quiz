/**
 * Configure the elements in the SortableElements div to be sortable with jQuery
 * @returns void
 */
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

/**
 * Posts an array of element Id's to the PHP controller via AJAX
 * @returns void
 */

/**
 * Handles the AJAX response. For most applications, you only have to handle any returned error messages,
 * but for this example, we're returning information about the sort operation for display.
 * @param {JSON} data
 * @returns void
 */
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
