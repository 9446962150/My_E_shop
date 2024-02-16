function validateForm() {
    var name = document.forms["checkoutForm"]["name"].value;
    var country = document.forms["checkoutForm"]["Country"].value;
    var city = document.forms["checkoutForm"]["City"].value;
    var contact = document.forms["checkoutForm"]["Contact"].value;
    var address = document.forms["checkoutForm"]["Address"].value;

    // Regular expressions for email and phone number validation
    var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    var phoneRegex = /^\d{10}$/;
    
    // Regular expression for name validation (letters only and at least 2 characters)
    var nameRegex = /^[A-Za-z ]+$/;

    if (name === "") {
        alert("Name must be filled out");
        return false;
    } else if (!name.match(nameRegex)) {
        alert("Invalid name");
        return false;
    }

    if (country === "") {
        alert("Country must be filled out");
        return false;
    }

    if (city === "") {
        alert("City must be filled out");
        return false;
    }

    if (contact === "") {
        alert("Contact must be filled out");
        return false;
    } else if (!contact.match(phoneRegex)) {
        alert("Invalid phone number. Please enter a 10-digit number.");
        return false;
    }

    if (address === "") {
        alert("Address must be filled out");
        return false;
    }

    return true;
}
