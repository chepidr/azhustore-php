$(document).ready(function(){

    $('.cart__quantity').change(function(){
        var quantity=$(this).val();
        var id=$(this).attr('rel');
        var type=$(this).attr('rel1');
        var size=$(this).attr('rel2');

        $.ajax({
            url: 'ajax_quantity.php',
            data:{
                'id':id,
                'quantity':quantity,
                'type':type,
                'size':size
            },
            success: function(data){
                var result = $.parseJSON(data);
                $('#item-total-'+id+'-'+type+size).text(result.cost+' Тг');
                $('.cart__total').text('В итоге: '+result.total+' Тг');
            }
        });
    });

    $('.cart__delete').click(function(){
        var id=$(this).attr('rel');
        var type=$(this).attr('rel1');
        var size=$(this).attr('rel2');
        $.ajax({
            url: 'ajax_delete.php',
            data:{
                'id':id,
                'type':type,
                'size':size
            },
            success: function(data){
                window.location.reload();
            }
        });
    });

    $('.cart__button').click(function(){
        $('.modal').css('display', 'block');
    });

    $('.close').click(function(){
        $('.modal').css('display', 'none');
    });
    
    $(window).click(function(e) {
        
        if($(e.target).hasClass('modal')){
            $('.modal').css('display', 'none');
        }

    });
});