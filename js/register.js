$(document).ready(function() {
    $('#registerForm').submit(function(e) {
        e.preventDefault();

        var formData = {
            fname: $("#fname").val(),
            lname: $("#lname").val(),
            email: $("#email").val(),
            age: $("#age").val(),
            dob: $("#dob").val(),
            password: $("#password").val(),
            cpassword: $("#cpassword").val(),
            contact: $("#contact").val()
        };
        
        console.log(formData);

        $.ajax({
            type: 'POST',
            url: './php/register.php',
            data: formData,
            success: function(response) {
                alert(response);
                window.location.href="login.html"
                // Handle success response here
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
                // Handle error response here
            }
        });
    });
});
