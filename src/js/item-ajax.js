

$(document).ready(function(){
  
  window.setInterval(ajaxRun,1700)
  var ajaxHasRun =false;
  var oldMsg;

  $('#ur-comment-form').on('submit',function(e){ //listener for post comment
    var preventUpload = false;
    
    if($("#ur-comment-textarea").val()==""){
      preventUpload = true
    }
    var form = $(this)
    var url = $(this).attr('action')
    var commentTxt = $("#ur-comment-textarea").val()
    //alert(url)
    if(!preventUpload){

      $.ajax({
        url: url,
        type:"POST",
        data: form.serialize(),
        success:function(data){
         
        }
        
      });
      
    }
    e.preventDefault()
  });
  //add listener for button add to cart for item-page
  $('#btn-item-page-addcart').on('click',function(e){
    //alert('am i  runnning')
    var secretusername =  $('#secretusername').val()
    var secretpid = $('#secretpid').val()
    var url = 'include/process-addcart.php'
    var teste= 'hey pid'+$("#secretpid").val()+". hey username: "+$('#secretusername').val();
    e.preventDefault();
    $.confirm({
      useBootstrap: false,
      title: 'Confirmation',
      content: 'Please confirm that you are adding this item',
      buttons: {
          confirm: function () {
            var phpMessage;
            $.ajax({
              method: "POST",
              url: url,
              data:{
                addcartpid: secretpid,
                username: secretusername
              },
              success: function(fromPHP){
                phpMessage = fromPHP;
                
              },
              error: function(a){

              },
              always:function(ak){
         
              }
            });
            $.alert({
              useBootstrap: false,
              title:"Item has been added",
              content: ''
          });
          },
          cancel: function () {
            $.alert({
              useBootstrap: false,
              title:"",
              content: 'Adding item canceled!'
          });
          },
      }
  });
    
  });

  function ajaxRun() { //ajax GET Comment
    
    $pidhidden = $('#secretpid').val();
    var result = $.get("comment-api.php?pid="+$pidhidden); //from input hidden to get pid
    result.done(function (msg) {
      
      if(ajaxHasRun){
        
        if(JSON.stringify (oldMsg)!=JSON.stringify(msg) ){
          $('#comments-itempage').html("")

          oldMsg = msg
          var data =msg;
          for (var i = 0; i < data.length; i++) {
            
            var sub = data[i];
            /*var row = $('<div class=comment-template><span>'
              + sub.username + '</span><span class="user-id">' + sub.comment_info +
              '</span></div>');*/
            var row = $('<div class=comment-template><span class=\"comment-entries\">'+sub.comment_date+'<br></span><span class=\"comment-entries\">'
              + sub.username + '</span><span class="user-id">' + sub.comment_info +
              '</span></div>');              
            $('#comments-itempage').append(row);
            
          }
          $(".user-id").css("background-color","#fbf9f3")
        }
      }

      if(!ajaxHasRun){
        var data =msg;
          for (var i = 0; i < data.length; i++) {
            
            var sub = data[i];
            /*var row = $('<div class=comment-template><span>'
              + sub.username + '</span><span class="user-id">' + sub.comment_info +
              '</span></div>');*/
              var row = $('<div class=comment-template><span class=\"comment-entries\">'+sub.comment_date+'<br></span><span class=\"comment-entries\">'
              + sub.username + '</span><span class="user-id">' + sub.comment_info +
              '</span></div>');           
            $('#comments-itempage').append(row);
            
          }
          $(".user-id").css("background-color","#fbf9f3")

        ajaxHasRun = true;
        oldMsg = msg;
      }
    });
    result.fail(function (jqXHR) { console.log("Error: " + jqXHR.status); });
    result.always(function () { console.log("done"); }  );

  
  
  }
})
