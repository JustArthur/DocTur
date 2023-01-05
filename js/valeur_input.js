const identifiant = document.querySelector("form #identifiant"),
email = document.querySelector("form #mail"),
counter_id = document.querySelector("form .chiffre_id"),
counter_mail = document.querySelector("form .chiffre_mail"),
maxLength_id = identifiant.getAttribute("maxlength"),
maxLength_email = email.getAttribute("maxlength");

identifiant.onkeyup = () => {
    counter_id.innerText = maxLength_id - identifiant.value.length;  
}
email.onkeyup = () => {
    counter_mail.innerText = maxLength_email - email.value.length;  
}
