$(document).ready(function() {  
 
    $("#name").on({
        keyup: function(){
            $(this).val($(this).val().toUpperCase());
        }
    })

    $(".select_money").on({
        click: function(){
            $('#money1').val($(this).val().replace(/,/g, ''));
            $('#money2').val($(this).val().replace(/,/g, ''));
        }
    })
    
})
