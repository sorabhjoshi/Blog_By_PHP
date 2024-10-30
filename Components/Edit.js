function validate() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const city = document.getElementById("city").value;
    const state = document.getElementById("State").value;
    const country = document.getElementById("Country").value;
    const pincode = document.getElementById("pincode").value;

    const namespan = document.getElementById("name-span");
    const emailspan = document.getElementById("email-span");
    const phonespan = document.getElementById("phone-span");
    const cityspan = document.getElementById("city-span");
    const statespan = document.getElementById("state-span");
    const countryspan = document.getElementById("country-span");
    const pincodespan = document.getElementById("pincode-span");

    let isValid = true;

    if (name === "") {
        namespan.innerHTML = "Please enter your name.";
        isValid = false;
    } else {
        namespan.innerHTML = "";
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailRegex.test(email)) {
        emailspan.innerHTML = "Please enter a valid email address.";
        isValid = false;
    } else {
        emailspan.innerHTML = "";
    }

    const phoneRegex = /^\d{10}$/;
    if (phone === "" || !phoneRegex.test(phone)) {
        phonespan.innerHTML = "Please enter a valid 10-digit phone number.";
        isValid = false;
    } else {
        phonespan.innerHTML = "";
    }

    if (city === "") {
        cityspan.innerHTML = "Please enter your city.";
        isValid = false;
    } else {
        cityspan.innerHTML = "";
    }

    if (state === "") {
        statespan.innerHTML = "Please enter your state.";
        isValid = false;
    } else {
        statespan.innerHTML = "";
    }

    if (country === "") {
        countryspan.innerHTML = "Please enter your country.";
        isValid = false;
    } else {
        countryspan.innerHTML = "";
    }

    const pincodeRegex = /^\d{6}$/;
    if (pincode === "" || !pincodeRegex.test(pincode)) {
        pincodespan.innerHTML = "Please enter a valid 6-digit pincode.";
        isValid = false;
    } else {
        pincodespan.innerHTML = "";
    }

    return isValid;
}