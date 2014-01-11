var passWords = document.getElementsByClassName('password');
var errorMsg;


function sync()
{
    var n1 = document.getElementsByName('mail')[0];
    var n2 = document.getElementsByName('username')[0];
    n2.value = n1.value;
}

function checkLengthPassword() {

    for (var i = 0, max = passWords.length; i < max; i++) {
        if (passWords[i].value.length < 6) {
            errorMsg = 'Het wachtwoord moet minstens 6 tekens lang zijn.';
            return false;
        }
    }
    return true;
}

function checkLengthUsername() {
    if (document.getElementById('minLength').value.length < 4) {
        errorMsg = 'De gebruikersnaam moet minstens 4 tekens lang zijn.';
        return false;
    } else {
        return true;
    }
}

function validatePasswords() {
    if (passWords[0].value === passWords[1].value) {
        return true;
    } else {
        errorMsg = 'Het herhaalde wachtwoord is niet gelijk aan het initiele wachtwoord.';
        return false;
    }
}

function passwordsEmpty() {
    if (passWords[0].value.length === 0) {
        if (passWords[1].value.length === 0) {
            return true;
        }
    }
    return false;
}

function validateAccountData() {
    $userNameLengthCheck = checkLengthUsername();

    if ($userNameLengthCheck === false) {
        showError(errorMsg);
        return;
    }

    if (passwordsEmpty() === false) {
        $passwordEqualCheck = validatePasswords();
        if ($passwordEqualCheck === false) {
            showError(errorMsg);
            return;
        } else {
            $passwordLengthCheck = checkLengthPassword();

            if ($passwordLengthCheck === false) {
                showError(errorMsg);
                return;
            }
        }
    }
    return true;
}

function allFieldsEntered() {
    if (passwordsEmpty() === false && checkLengthUsername() === true) {
        return true;
    } else {
        showError('Niet alle gegevens zijn ingevuld!');
        return false;
    }
}

function validatePassesOnly() {
    if (passwordsEmpty() === false) {
        $passwordEqualCheck = validatePasswords();
        if ($passwordEqualCheck === false) {
            showError(errorMsg);
            return;
        } else {
            $passwordLengthCheck = checkLengthPassword();

            if ($passwordLengthCheck === false) {
                showError(errorMsg);
                return;
            }
        }
    } else {
        showError("Het nieuwe wachtwoord is leeg!");
        return;
    }
    return true;
}