<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="admin/assets/css/authforms.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div style="display: flex; justify-content: center;">
                <div class="img_div">
                    <img class="logo" src="images/logo.png" alt="Logo">
                </div>
            </div>
            <h2>User Login</h2>
            <form action="/" method="post" id="log_form">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">Login</button>
                <p style="text-align: center;">Don't have an account? <a href="/online_bookstore?page=Register">Register</a></p>
                <p style="text-align: center; margin-top: -10px;">Need to browse our site? <a href="/online_bookstore?page=Home">Click here</a></p>
            </form>
        </div>
    </div>

    <script>
    //-------------------------------------------------------------------------------
    document.addEventListener('DOMContentLoaded', function(){
    //-------------------------------------------------------------------------------
    //when submitting the form
        const form = document.getElementById('log_form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(form);

            try{
                fetch('admin/Ajax.php?ajax=login', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Ajax-Request': 'true' // to identify AJAX requests
                    }
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
                        window.location.href = '/online_bookstore?page=Dashboard';
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
    });
    //-------------------------------------------------------------------------------
    </script>
</body>
</html>
