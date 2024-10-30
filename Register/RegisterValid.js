function validateForm() {
    document.getElementById("email").addEventListener("input", function() {
        document.getElementById("email-span").innerText = ""; 
    });
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const conpassword = document.getElementById("conpassword").value;
    const namespan = document.getElementById("name-span");
    const emailspan = document.getElementById("email-span");
    const passwordspan = document.getElementById("password-span");
    const conpasswordspan = document.getElementById("conpassword-span");

    let isValid = true;

  
    if (name === ""  ) {
        namespan.innerHTML="Please enter your name properly.";
        isValid = false;
    }else{
        namespan.innerHTML="";
    }


   
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
        passwordspan.innerHTML="";
    }

   if (conpassword === "") {
        conpasswordspan.innerHTML="Please Confirm password";
        isValid = false;
   }else if (conpassword !== password) {
        conpasswordspan.innerHTML="Passwords do not match.";
        isValid = false;

    } else if (conpassword.length < 6) {
        conpasswordspan.innerHTML="Please enter a password with at least 6 characters.";
        isValid = false;
    }else{
        conpasswordspan.innerHTML="";
    }
    

    return isValid;
}
