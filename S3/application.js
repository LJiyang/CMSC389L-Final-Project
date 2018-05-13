function dataValidation(){
    message = "";
    message = passwordValidation(message);
    message = phoneValidation(message);
    if (message !== "") {
        alert(message);
        return false;
    } else{
        message = "Do you want to submit the form data?";
        return window.confirm(message);
    }
}

function passwordValidation(message){
    var p = document.getElementById("password").value;
    var vp = document.getElementById("verifyPassword").value;
    if (p !== vp) {
        message += "password does not verify\n";
    } else if (p === '') {
        message += "need set password\n"
    }
    return message;
}

function phoneValidation(message){
    var pFP = document.getElementById("phoneFirstPart").value;
    var pSP = document.getElementById("phoneSecondPart").value;
    var pTP = document.getElementById("phoneThirdPart").value;
    if (String(parseInt(pFP)) !== pFP
        || String(parseInt(pSP)) !== pSP
        || String(parseInt(pTP)) !== pTP
        || pFP.length !== 3
        || pSP.length !== 3
        || pTP.length !== 4) {
        message += "Invalid phone number\n";
    }
    return message;
}
