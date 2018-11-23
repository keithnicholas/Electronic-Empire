window.onload=function(){
    document.querySelector("#checkout").addEventListener("click", function(){
        window.location = "pay-page.php";
    });

    $("button").click(function(){
        $(this).parent('div').parent('div').parent('div').remove();
    });
}
