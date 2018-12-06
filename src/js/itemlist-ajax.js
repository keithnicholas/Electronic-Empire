$(document).ready(function () {
    //TODO: Confirmation Box is a bit buggy
    $('.form-addcart-itemlist').on('click', function (e) {
        //alert('am i  runnning')
        e.preventDefault();
        var url = 'include/process-addcart.php'
        $form = $(this)
        $.confirm({
            useBootstrap: false,
            title: 'Confirmation',
            content: 'Please confirm that you are adding this item',
            buttons: {
                confirm: function () {
 
                    $.ajax({
                        animation:'top',
                        closeAnimation: 'bottom',
                        method: "POST",
                        url: url,
                        data: $form.serialize(),
                        success: function (fromPHP) {
                            phpMessage = fromPHP;
                            
                        },
                        error: function (a) {

                        },
                        always: function (ak) {

                        }
                    });
                    $.alert({
                        useBootstrap: false,
                        title: "Item has been added",
                        content: ''
                    });
                },
                cancel: function () {
                    $.alert({
                        useBootstrap: false,
                        animationBounce: 1.5,
                        animation:'top',
                        closeAnimation:'bottom',
                        title: "",
                        content: 'Adding item canceled!'
                    });
                },
            }
        });
        
    });
})