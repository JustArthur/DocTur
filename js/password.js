const passInput = document.querySelector("#password");
const percentBar = document.querySelector(".password-pourcent span");
const passLabel = document.querySelector(".password-label");


passInput.addEventListener("input", handlePassInput);

function handlePassInput(e) {

    var mdp = ['1','12','123','1234','12345','123456','1234567','12345678', '123456789', '1234567890',
                'qwerty', 'Qwerty', 'password', 'qwerty123', 'Qwerty123', 'abc123', 'password1', 'qwertyuiop',
                '123321', 'password123', 'azerty', 'Azerty', 'qwerty123', 'mot de passe', 'ilove', 'ilovey', 'iloveyo', 'iloveyou', '1q2w3e'];
    
    if(mdp.indexOf(passInput.value) === -1) {
        if(passInput.value.length === 0) {
            passLabel.innerHTML = "";
            addClass();
        } else if (passInput.value.length <= 6) {
            passLabel.innerHTML = "Faible";
            addClass("weak");
        } else if (passInput.value.length <= 12) {
            passLabel.innerHTML = "Peut mieux faire";
            addClass("average");
        } else if(passInput.value.length < 16) {
            passLabel.innerHTML = "Fort";
            addClass("strong");
        } else {
            passLabel.innerHTML = "Très fort";
            addClass("very-strong");
        }
    } else {
        passLabel.innerHTML = "Très faible";
        addClass("very-weak");
    }
}

function addClass(className) {
    
    percentBar.classList.remove("very-weak"); //5
    percentBar.classList.remove("weak"); //30
    percentBar.classList.remove("average"); //60
    percentBar.classList.remove("strong"); //80
    percentBar.classList.remove("very-strong"); //100

    if(className) {
        percentBar.classList.add(className);
    }
}

var valid = false;

function toggle() {
    if(valid) {
        passInput.setAttribute("type", "password")
        valid = false;
    } else {
        passInput.setAttribute("type", "text")
        valid = true;
    }
}