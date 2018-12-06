$(document).ready(function(){
    var hasTextExist = false;
    $(".button-remove-each-comment").on('click',function(e){

        var commentId = $(e.target).parent().find('#comment_id').val(); //get parent of the clicked comment and find the comment id
        $.ajax({
            url: "admin-comment-process.php",
            method:"POST",
            cache: false,
            data: {
                comment_id: commentId
            },
            success:function(fromPhp){
                
                $.alert({
                    useBootstrap: false,
                    animationBounce: 1.5,
                    animation:'top',
                    closeAnimation:'bottom',
                    title: 'Comment Deletion',
                    content: "Comment id: "+commentId+" has been deleted",
                    onClose:function(){
                        location.reload()
                    }
                })
                
            },
            error: function(e){
                console.log('ajax remove error '+e)
            }
        });


    })
    
    $(".button-edit-each-comment").on('click',function(e){
        if(!hasTextExist){
            var commentId = $(e.target).parent().find('#comment_id').val(); //get parent of the clicked comment and find the comment id
            var $targetAdd=$(e.target).parent().find(".user-comment")
            $targetAdd.hide() //hide previous comment
            var $nodeToAdd = $("<textarea id=\"new-comment\" rows=\"4\" cols=\"45\"></textarea>").show(500);
            $targetAdd.html($nodeToAdd) //replace it with textarea
            $targetAdd.fadeToggle()
            $(e.target).parent().find('.button-edit-each-comment').attr('value','Submit') //change the text value of the button to submit
            $(e.target).parent().find('.button-edit-each-comment').attr('id','dynamic-edit') //give it an ID
            $(".button-edit-each-comment").hide() //remove the rest of the buttons
            $(".button-remove-each-comment").hide()
            $(e.target).parent().find('.button-edit-each-comment').attr("style", "");
            hasTextExist = true
            //add form to easen ajax
        }
        else{
            var commentId = $(e.target).parent().find('#comment_id').val(); //get commentID
            var $newMsg = $(e.target).parent().find('textarea').val() //get textarea value
            
            ajaxEdit(e,commentId,$newMsg)
        }

    })
    function ajaxEdit(e,commentId,$newMsg){
        $.ajax({
            url: "admin-comment-process.php",
            method:"POST",
            cache: false,
            data: {
                comment_id: commentId,
                edit: 'ok',
                new_msg: $newMsg
            },
            success:function(fromPhp){

                $.alert({
                    useBootstrap: false,
                    animationBounce: 1.5,
                    animation:'top',
                    closeAnimation:'bottom',
                    title: 'Edit Comment',
                    content: "Comment id: "+commentId+" has been updated with "+$newMsg,
                    onClose:function(){
                        location.reload()
                    }
                })
                
            },
            error: function(e){
                console.log('ajax remove error '+e)
            }
        });
    }

})