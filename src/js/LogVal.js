
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

            if (aNode.getAttribute("name") == "name") { //Check length of ID
                if (aNode.value.length > 15 ||aNode.value.length <1) {
                    wrong = true;
                    allForm[i].classList.add("form-invalid");
                    var parentNode = aNode.parentElement;
                    var labelNode = document.createElement("label");
                    labelNode.classList.add = "text-error"
                    var msg = "username must be atleast 4 characters"
                    labelNode.innerHTML = msg;
                    parentNode.append(labelNode)
                }else{
                    allForm[i].classList.remove("form-invalid");
                }
            }

            if (aNode.getAttribute("name") == "password") { //check PAssword
                if ( aNode.value.length < 1) {
                    wrong = true;
                    aNode.classList.add("form-invalid");
                }else{
                    aNode.classList.remove("form-invalid");
                }
            }

            if (wrong) {

                e.preventDefault();
            }
        }
    }
    document.querySelector("#sign-up").addEventListener("click", function(){
        window.location = "register-screen.php";
    })
    /*document.querySelector("#sign-in").addEventListener("click", function(){
        window.location = "main-page.php";
    });*/

}
