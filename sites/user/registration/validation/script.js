const validationBoxContainer = document.createElement("div");
validationBoxContainer.className = "validationBoxContainer";

const emailField = document.getElementById("registrationEmail");
const codeField = document.getElementById("registrationCode");
const passwordField = document.getElementById("registrationPassword");
const passwordFieldRepeat = document.getElementById("registrationPasswordRepeat");

let passwordValid = false;
let emailValid = false;
let codeValid = false;

const validatePassword = () => {
    let result = true;
    let iconPath;
    let icon;
    const password = document.getElementById("registrationPassword").value;
    const passwordRepeat = document.getElementById("registrationPasswordRepeat").value;

    // check length
    result = password.length >= 8 ? result : false;
    iconPath = password.length >= 8 ? "validation/check.svg" : "validation/cross.svg" ;
    icon = document.getElementById("pwLengthIcon");
    if (icon) icon.setAttribute("src", iconPath);

    // check for Numbers
    const numberPattern = /[0-9]+/;
    result = numberPattern.test(password) ? result: false;
    iconPath = numberPattern.test(password) ? "validation/check.svg" : "validation/cross.svg" ;
    icon = document.getElementById("pwNumberIcon");
    if (icon) icon.setAttribute("src", iconPath);

    // check for capitalized Letter
    const capitalizedLetterPattern = /[A-ZÄÜÖ]+/;
    result = capitalizedLetterPattern.test(password) ? result: false;
    iconPath = capitalizedLetterPattern.test(password) ? "validation/check.svg" : "validation/cross.svg" ;
    icon = document.getElementById("pwCapitalizedIcon");
    if (icon) icon.setAttribute("src", iconPath);

    // check for special character
    const specialCharacterPattern = /[^a-zA-ZÄÜÖ0-9]+/;
    result = specialCharacterPattern.test(password) ? result: false;
    iconPath = specialCharacterPattern.test(password) ? "validation/check.svg" : "validation/cross.svg" ;
    icon = document.getElementById("pwSpecialCharacterIcon");
    if (icon) icon.setAttribute("src", iconPath);

    const areEqual = password !== "" && passwordRepeat !== "" && password === passwordRepeat;
    result = areEqual ?  result: false;
    iconPath = areEqual ? "validation/check.svg" : "validation/cross.svg" ;
    icon = document.getElementById("pwIdentical");
    if (icon) icon.setAttribute("src", iconPath);

    passwordValid = result;
    checkIfInputValid();
}

const validateEmail = () => {
    const email = document.getElementById("registrationEmail").value;

    // check for special character
    const emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    const result = emailPattern.test(email);
    const iconPath = result ? "validation/check.svg" : "validation/cross.svg" ;
    const icon = document.getElementById("emailAtIcon");
    if (icon) icon.setAttribute("src", iconPath);

    emailValid = result;
    checkIfInputValid();
}

const validateCode = () => {
    const code = document.getElementById("registrationCode").value;

    // check for special character
    const codePattern = /^[a-z0-9]{5}-[a-z0-9]{5}-[a-z0-9]{5}$/i;
    const result = codePattern.test(code);
    const iconPath = result ? "validation/check.svg" : "validation/cross.svg" ;
    const icon = document.getElementById("codeFormatIcon");
    if (icon) icon.setAttribute("src", iconPath);

    codeValid = result;
    checkIfInputValid();
}

const showValidationBox = (box) => {
    switch (box) {
        case "password":
            passwordFieldRepeat.parentNode.appendChild(validationBoxContainer);
            $.get("validation/passwordValidationBox.html", function (data) {
                $(".validationBoxContainer").html(data);
                validatePassword();
            });
            break;
        case "email":
            emailField.parentNode.appendChild(validationBoxContainer);
            $.get("validation/emailValidationBox.html", function (data) {
                $(".validationBoxContainer").html(data);
                validateEmail();
            });
            break;
        case "code":
            codeField.parentNode.appendChild(validationBoxContainer);
            $.get("validation/codeValidationBox.html", function (data) {
                $(".validationBoxContainer").html(data);
                validateCode();
            });
            break;
    }
}

const hideValidationBox = (box) => {
    switch (box) {
        case "password":
            passwordFieldRepeat.parentNode.removeChild(validationBoxContainer);
            break;
        case "email":
            emailField.parentNode.removeChild(validationBoxContainer);
            break;
        case "code":
            codeField.parentNode.removeChild(validationBoxContainer);
            break;
    }
}

const checkIfInputValid = () => {
    if (passwordValid && emailValid && codeValid) {
        document.getElementById("registerButton").disabled = false;
    }
}

// add event listeners
passwordField.oninput = validatePassword;
passwordField.onfocus = () => showValidationBox("password");
passwordField.onblur = () => hideValidationBox("password");
passwordFieldRepeat.oninput = validatePassword;
passwordFieldRepeat.onfocus = () => showValidationBox("password");
passwordFieldRepeat.onblur = () => hideValidationBox("password");

emailField.oninput = validateEmail;
emailField.onfocus = () => showValidationBox("email");
emailField.onblur = () => hideValidationBox("email");

codeField.oninput = validateCode;
codeField.onfocus = () => showValidationBox("code");
codeField.onblur = () => hideValidationBox("code");

