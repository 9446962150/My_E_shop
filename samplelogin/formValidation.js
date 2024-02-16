function validateForm() {
    var name = document.forms["registrationForm"]["full"].value;
    var username = document.forms["registrationForm"]["User"].value;
    var email = document.forms["registrationForm"]["Email"].value;
    var password = document.forms["registrationForm"]["Pass"].value;
    var country = document.forms["registrationForm"]["Country"].value;
    var city = document.forms["registrationForm"]["City"].value;
    var contact = document.forms["registrationForm"]["Contact"].value;
    var address = document.forms["registrationForm"]["Address"].value;

    // Regular expressions for email and phone number validation
    var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    var phoneRegex = /^\d{10}$/;

    // Regular expression for username validation (alphanumeric, underscores, and at least 4 characters)
    var usernameRegex = /^[A-Za-z0-9_]{4,}$/;

    // Regular expression for password validation (at least 6 characters)
    var passwordRegex = /.{6,}/;

    // Regular expression for full name validation (letters only and at least 2 characters)
    var nameRegex = /^[A-Za-z ]{4,}$/;


    if (!name.match(nameRegex)) {
        alert("Invalid full name.");
        return false;
    }

    if (!email.match(emailRegex)) {
        alert("Invalid email address. Please enter a valid email.");
        return false;
    }

    if (!contact.match(phoneRegex)) {
        alert("Invalid phone number. Please enter a 10-digit number.");
        return false;
    }

    if (!username.match(usernameRegex)) {
        alert("Invalid username. Please use at least 4 characters, alphanumeric and underscores.");
        return false;
    }

    if (!password.match(passwordRegex)) {
        alert("Invalid password. Please use at least 6 characters.");
        return false;
    }

    return true;
}
