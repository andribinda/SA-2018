function formhash(form, password) {
    // Erstelle ein neues Feld für das gehashte Passwort.
    var p = document.createElement("input");

    // Füge es dem Formular hinzu.
    document.getElementById("loginForm").appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);


    // Sorge dafür, dass kein Text-Passwort geschickt wird.
    password.value = "";

    // Reiche das Formular ein.
    form.submit();
}

function regformhash(form, email, homebasePlz, password, password2) {
     // Überprüfe, ob jedes Feld einen Wert hat
    if (email.value == ''         ||
          homebasePlz.value == ''     ||
          password.value == ''  ||
          password2.value == '') {

        alert('Bitte alle Felder ausfüllen');
        return false;
    }


    // Überprüfe, dass Passwort lang genug ist (min 6 Zeichen)
    // Die Überprüfung wird unten noch einmal wiederholt, aber so kann man dem
    // Benutzer mehr Anleitung geben
    if (password.value.length < 6) {
        alert('Das Passwort sollte mindestens 6 Zeichen lang sein');
        form.password.focus();
        return false;
    }

    // Mindestens eine Ziffer, ein Kleinbuchstabe und ein Großbuchstabe
    // Mindestens sechs Zeichen

    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if (!re.test(password.value)) {
        alert('Das Passwort soll Gross- und Kleinbuchstaben, sowie eine Zahl enthalten');
        form.password.focus();
        return false;
    }

    // Überprüfe die Passwörter und bestätige, dass sie gleich sind
    if (password.value != password2.value) {
        alert('Die Passwörter stimmen nicht überein');
        form.password.focus();
        return false;
    }

    // Erstelle ein neues Feld für das gehashte Passwort.
    var pReg = document.createElement("input");

    // Füge es dem Formular hinzu.
    document.getElementById("regForm").appendChild(pReg);
    pReg.name = "pReg";
    pReg.id = "pReg"
    pReg.type = "hidden";
    pReg.value = hex_sha512(password.value);

    // Sorge dafür, dass kein Text-Passwort geschickt wird.
    password.value = "";
    password2.value = "";

    // Reiche das Formular ein.
    form.submit();
    return true;
}

function updatePassword(form, password, passwordConf) {

    if (  password.value == ''  ||
          passwordConf.value == '') {
        alert('Bitte beide Felder ausfüllen');
        return false;
    }

    if (password.value.length < 6) {
        alert('Das Passwort sollte mindestens 6 Zeichen lang sein');
        form.password.focus();
        return false;
    }

    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if (!re.test(password.value)) {
        alert('Das Passwort soll Gross- und Kleinbuchstaben, sowie eine Zahl enthalten');
        form.password.focus();
        return false;
    }

    if (password.value != passwordConf.value) {
        alert('Die Passwörter stimmen nicht überein');
        form.password.focus();
        return false;
    }

    var pPW = document.createElement("input");

    document.getElementById("formUpdatePassword").appendChild(pPW);
    pPW.name = "pPW";
    pPW.id = "pPW"
    pPW.type = "hidden";
    pPW.value = hex_sha512(password.value);

    password.value = "";
    passwordConf.value = "";

    var user_id = document.createElement("input");
    document.getElementById("formUpdatePassword").appendChild(user_id);
    user_id.name = "user_id";
    user_id.type = "hidden";
    user_id.value = document.getElementById('pID').innerText;
    console.log($(form).serialize());
    $.post("../includes/userSettings.php", $(form).serialize(), function(data){});
    return true;
}

function updateEmail(form, emailUser) {

    var re = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (!re.test(emailUser.value)) {
        alert('Keine gültige Email-Adresse');
        form.emailUser.focus();
        return false;
    }

    var user_id = document.createElement("input");
    document.getElementById("formUpdateEmail").appendChild(user_id);
    user_id.name = "user_id";
    user_id.type = "hidden";
    user_id.value = document.getElementById('pID').innerText;

    $.post("../includes/userSettings.php", $(form).serialize(), function(data){
    });
    return true;
}
