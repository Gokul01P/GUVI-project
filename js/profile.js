document.addEventListener('DOMContentLoaded', function() {
    var userDataJSON = localStorage.getItem('userEmail');
    
    var userData = JSON.parse(userDataJSON);
    
    if (userData) {
        document.getElementById('fname').innerText = 'First Name: ' + userData.fname;
        document.getElementById('lname').innerText = 'Last Name: ' + userData.lname;
        document.getElementById('email').innerText = 'Email: ' + userData.email;
        document.getElementById('contact').innerText = 'Phone Number: ' + userData.contact;
    } else {
        console.error("No user data found in local storage.");
    }
});
