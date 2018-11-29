$(document).ready(function(){

    $hasRunOnce = false;
    $processSuccess= false;
    
    $(".update-quantity-form").on("submit",function(event){
        event.preventDefault()
        $valuechange =$(this).closest('form').find('.item-quantity').val()
        $form = $(this)

        if($valuechange != "" && ($valuechange > 0 && $valuechange<1000)){
            $.ajax({
                url: $form.attr('action'),
                method:"POST",
                cache: false,
                data: $form.serialize(),
                success:function(fromPHP){
                    $.alert({
                        animation:'top',
                        closeAnimation: 'bottom',
                        useBootstrap: false,
                        title: 'Product Quantity Change',
                        content: 'Quantity has been changed to '+$valuechange,
                        onClose: function(){
                            location.reload();
                        }
                    });
                    
                },
                error: function(e){

                    console.log('error ajax for quantity');
                },
                always: function(ak){
                    
                }
                
            });   
        }
        else{
            $.alert({
                useBootstrap: false,
                animationBounce: 1.5,
                animation:'top',
                closeAnimation:'bottom',
                title: 'Invalid Quantity',
                onClose: function(){
                    location.reload();
                },
                content: 'You are entering invalid quantity. Quantity must be between 1-1000 and cannot be negative or empty'
            });
            
        }

    });

});