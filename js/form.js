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
    console.log(pReg);
    form.submit();
    return true;
}
