<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="admin/assets/css/authforms.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: center;">
            <div class="img_div">
                <img class="logo" src="images/logo.png" alt="Logo">
            </div>
        </div>
        <h2>User Registration</h2>
        <form action="/" method="post" id="reg_form">
            <div class="form-group">
                <label for="first_name">First Name <span style="color:red;">*</span></label>
                <input type="text" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name <span style="color:red;">*</span></label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address">
            </div>

            <div class="form-group">
                <label for="email">Email <span style="color:red;">*</span></label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password <span style="color:red;">*</span></label>
                <input type="password" id="password" name="password1" required>
                <p id="password-error" style="color:red; font-weight:bold;font-size: 12px;text-align: justify;"></p>
            </div>

            <div class="form-group">
                <label for="re-password">Confirm Password <span style="color:red;">*</span></label>
                <input type="password" id="re-password" name="password2" required>
            </div>

            <button type="submit">Register</button>
            <p style="text-align: center;">Already have an account? <a href="/online_bookstore?page=Login">Login</a></p>
        </form>
    </div>

    <script>
    //-------------------------------------------------------------------------------
    document.addEventListener('DOMContentLoaded', function(){
    //-------------------------------------------------------------------------------
    //when submitting the form
        const form = document.getElementById('reg_form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(form);

            let pass_valid = validatePassword();
            if(!pass_valid){
                return;
            }

            try{
                fetch('admin/Ajax.php?ajax=register', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if(response.ok){
                        return response.json();
                    }else{
                        alert("Something went wrong...");
                        console.error('Error occured.');
                    }
                })
                .then((data) => {
                    if(data.status == "success"){
                        alert("Registration successful.");
                        window.location.href = '/online_bookstore?page=Login';
                    }else{
                        alert(data.msg);
                    }
                })
                .catch(error => {
                    alert("Something went wrong...");
                    console.error('Error:', error);
                });
            }catch(error){
                alert("Something went wrong...");
                console.error('Error:', error);
            }
            
        });
    //-------------------------------------------------------------------------------
    //vlidate password
        function validatePassword() {
            const passwordInput = document.getElementById("password");
            const passwordError = document.getElementById("password-error");
            const password = passwordInput.value;

            // Regular expression to validate the password
            const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (passwordRegex.test(password)) {
                passwordError.textContent = "";
                return true;
            } else {
                passwordError.textContent = "Password must have at least 8 characters, one capital letter, one lowercase letter, one special character, and one number.";
                return false;
            }
        }
    //-------------------------------------------------------------------------------
    });
    //-------------------------------------------------------------------------------
    </script>

</body>
</html>
