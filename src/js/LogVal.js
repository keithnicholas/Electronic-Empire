
window.onload = function () {

    // Attach event listener to all event that comes from 'required', called when field is empty
    document.querySelector("#mainForm button").addEventListener("click", function(){
        document.getElementById("mainForm").className="submitted-blank";
    });


    var nodesEvent = document.querySelectorAll('#mainForm input'); // Adding Event listener to remove red lines
    document.getElementById("mainForm").onsubmit = function (e) {
        var allForm = document.querySelectorAll('#mainForm input[type="text"]')

        var wrong = false;
        for (var i = 0; i < allForm.length; i++) {

            var aNode = allForm[i]

            if (aNode.getAttribute("name") == "nameField") { //Check length of ID
                if (aNode.value.length > 15) {
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                }
            }

            if (aNode.getAttribute("name") == "passwordField") { //check PAssword
                if ( aNode.value.length > 20 || aNode.value.length < 4) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }
            }

            if (wrong) {

                e.preventDefault();
            }
        }
    }
    document.querySelector("#sign-up").addEventListener("click", function(){
        window.location = "register-screen.html";
    });


}
