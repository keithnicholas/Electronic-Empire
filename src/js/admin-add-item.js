window.onload=function(){

    function isNameNoNumber(stringVal) {
        var nameValue = stringVal.replace(/\s/g, ''); //Remove Spaces
        for (var i = 0; i < nameValue.length; i++) {
            console.log(nameValue.charAt(i))
            if (!isNaN(nameValue.charAt(i))) {
                return false;
            }
        }
        return true;
    }


    document.querySelector("#add-item-form button").addEventListener("click", function(){
        document.getElementById("add-item-form").className="submitted-blank";
    });

    document.getElementById("add-item-form").onsubmit = function (e) {
        var allForm=document.querySelectorAll("#add-item-form");

        var wrong=false;
        for(var i=0;i<allForm.length;i++){
            var aNode=allForm[i];

            if(aNode.getAttribute("name")=="item-name") {
                if(aNode.value.length < 3 || !isNameNoNumber(aNode.value)){
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                }
            }

            if(aNode.getAttribute("name")=="producer-name") {
                if(aNode.value.length < 3 || !isNameNoNumber(aNode.value)){
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                }
            }
            //free item
            if(aNode.getAttribute("name")=="price-additem-name") {
                if(aNode.value<=0){
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }
            //empty description
            if(aNode.getAttribute("name")=="description-additem") {
                if(aNode.value.length==0){
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }
        }
        if (wrong) {
            e.preventDefault();
        }
    }
}
