
window.onload = function () {

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

            if (aNode.getAttribute("name") == "firstName") { //Check length of ID
                if (aNode.value.length < 3|| !isNameNoNumber(aNode.value)) {
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                }
            }
            if (aNode.getAttribute("name") == "lastName") { //Check length of ID
                if (aNode.value.length < 3||!isNameNoNumber(aNode.value)) {
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                }
            }
            if (aNode.getAttribute("name") == "username") { //check name
                if (aNode.value.length < 3) {
                    var parentNode = aNode.parentElement;
                    var labelNode = document.createElement("label");
                    labelNode.classList.add = "text-error"
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                    var msg = "username must be atleast 4 characters"
                    labelNode.innerHTML = msg;
                    parentNode.append(labelNode)
                    
                }
            }
            if (aNode.getAttribute("name") == "password") { //check PAssword
                if (aNode.value.length < 1) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }
            if (aNode.getAttribute("name") == "email") { //check validity of email
                alert("Email is not valid");
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



