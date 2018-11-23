
window.onload = function () {
    function validateEmail(email) {
        var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regex.test(String(email).toLowerCase());
    }
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
    // Attach event listener to all event that comes from 'required', called when field is empty
    document.querySelector("#mainForm button").addEventListener("click", function () {
        document.getElementById("mainForm").className = "submitted-blank";
    });


    var nodesEvent = document.querySelectorAll('#mainForm input'); // Adding Event listener to remove red lines 
    document.getElementById("mainForm").onsubmit = function (e) {
        var allForm = document.querySelectorAll('#mainForm input')



        var wrong = false;
        for (var i = 0; i < allForm.length; i++) {

            var aNode = allForm[i]

            if (aNode.getAttribute("name") == "idFieldRegister") { //Check length of ID
                if (aNode.value.length > 15) {
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                }
            }
            if (aNode.getAttribute("name") == "nameFieldRegister") { //check name
                if (aNode.value.length < 3 || !isNameNoNumber(aNode.value) ) {
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                }
            }
            if (aNode.getAttribute("name") == "passwordFieldRegister") { //check PAssword
                if (aNode.value.length > 20 || aNode.value.length < 4) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }
            if (aNode.getAttribute("name") == "emailFieldRegister") { //check validity of email

                if (aNode.value.length > 50 || !validateEmail(aNode.value)) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }

            }

            if (wrong) {

                e.preventDefault();
            }
        }
    }
    

}



