function validateForm() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const emailspan = document.getElementById("email-span");
    const passwordspan = document.getElementById("password-span");
    let isValid = true;

   
    if (email === "" || !email.includes("@")) {
        emailspan.innerHTML="Please enter a valid email address.";
        isValid = false;
    }else{
        emailspan.innerHTML="";
    }


    if (password === "" || password.length < 6) {
        passwordspan.innerHTML="Please enter a password with at least 6 characters.";
        isValid = false;
    }else{
         emailspan.innerHTML="";
    }


    return isValid;
}
