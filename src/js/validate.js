//check passwords

function isBlank(inputField) {
  if (inputField.value == "") {
    return true;
  }
  return false;
}

function makeRed(inputDiv) {
  //inputDiv.classList.addClass('form-required');
  inputDiv.style.borderColor = "red";
  inputDiv.value = "required";

}

function makeClean(inputDiv) {
  inputDiv.style.borderColor = "#FFFFFF";
}

window.onload = function () {
  var mainForm = document.getElementById("mainForm");
  var requiredInputs = document.querySelectorAll("input[required]");

  mainForm.onsubmit = function (e) {
    var requiredInputs = document.querySelectorAll(".required");
    var err = false;

    for (var i = 0; i < requiredInputs.length; i++) {
      if (isBlank(requiredInputs[i])) {
        err = true;
        makeRed(requiredInputs[i]);

      }
      else {
        makeClean(requiredInputs[i]);
      }
    }
    if (err == true) {
      e.preventDefault();
    }
    /*else
    {
      console.log('checking match');
      checkPasswordMatch(e);
    }*/
  }
}
