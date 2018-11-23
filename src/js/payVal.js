window.onload=function(){
    function isNameNoNumber(stringVal) {
        var nameValue = stringVal.replace(/\s/g, ''); //Remove Spaces
        for (var i = 0; i < nameValue.length; i++) {
            if (!isNaN(nameValue.charAt(i))) {
                return false;
            }
        }
        return true;
    }

    function isValidPostCode(str){
        if(str.length!=6)
            return false;
        for(var i=0; i < str.length;i++){
            if((i%2==0 && str.charAt(i)<'A'||str.charAt(i)>'Z')
            ||(i%2==1 && isNaN(str.charAt(i))))
                return false;
        }
        return true;
    }

    function isValidED(mm,yy){
        var today=new Date();
        var month=today.getMonth()+2;
        var year=today.getFullYear();
        return(yy>year || (yy==year&&mm>month));
    }

    document.querySelector("#mainForm button").addEventListener("click", function () {
        document.getElementById("mainForm").className = "submitted-blank";
    });

    document.getElementById("mainForm").onsubmit=function(e){
        var allForm=document.querySelectorAll('#mainForm input');
        var wrong=false;
        for(var i=0;i<allForm.length;i++){
            var aNode=allForm[i];

            if (aNode.getAttribute("name") == "nameFieldPay") { //check name
                if (aNode.value.length < 3 || !isNameNoNumber(aNode.value) ) {
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                }
            }//end if

            if (aNode.getAttribute("name") == "addressFieldPay") { //check Address
                if (aNode.value.length < 4) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }//end if

            if (aNode.getAttribute("name") == "cityFieldPay") { //check City
                if (aNode.value.length <= 4) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }//end if

            if (aNode.getAttribute("name") == "provinceFieldPay") { //check State
                if (aNode.value.length<=1) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }//end if

            if (aNode.getAttribute("name") == "post-code") { //check post code
                if (!isValidPostCode(aNode.value)) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }//end if

            if (aNode.getAttribute("name") == "card-holder") { //check card-holder
                if (aNode.value.length < 3 || !isNameNoNumber(aNode.value) ) {
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                }
            }//end if

            if (aNode.getAttribute("name") == "card-num") { //check card-num
                if (aNode.value.length!=20 || isNaN(aNode.value)) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }//end if

            var entered_month;
            var entered_year;
            if (aNode.getAttribute("name") == "ed-month") { //check ed-mm
                entered_month=aNode.value;
                if(isNaN(entered_month)||entered_month<0&&entered_month>12){
                    wrong=true;
                    aNode.classList.add("form-invalid");
                }
            }//end if

            if (aNode.getAttribute("name") == "ed-yr") { //check ed-yy
                entered_year=aNode.value;
                if(isNaN(entered_month)||entered_month<18&&entered_month>22||isValidED(entered_month,entered_year)){
                    wrong=true;
                    aNode.classList.add("form-invalid");
                }
            }//end if
            if(wrong){
                e.preventDefault();
            }
            else {
                console.log("valided");
            }
        }
    }
}
