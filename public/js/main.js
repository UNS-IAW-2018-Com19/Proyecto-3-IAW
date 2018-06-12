
/**
 * Carga del modal para login
*/

$(function(){
    $('#elegantModalForm').modal({backdrop: 'static', keyboard: false, show:true})  
})


$(document).on("click", ".btninfo", function () {
    $("#flip"+this.id).toggleClass('hover');
});


$('select').change(function() {
    
    var value = $(this).val();
 
    $(this).siblings('select').children('option').each(function() {
        if ( $(this).val() === value ) {
            $(this).attr('disabled', true).siblings().removeAttr('disabled');   
        }
    });
    
});



