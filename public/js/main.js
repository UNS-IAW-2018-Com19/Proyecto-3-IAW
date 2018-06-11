
/**
 * Carga del modal para login
*/

$(function(){
    $('#elegantModalForm').modal({backdrop: 'static', keyboard: false, show:true})  
})


$(document).on("click", ".btninfo", function () {
    $("#flip"+this.id).toggleClass('hover');
});
