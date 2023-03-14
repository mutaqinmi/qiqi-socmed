<?php
$db = mysqli_connect("localhost", "root", "", "user_example");

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($db, "SELECT * FROM user_data WHERE username = '$username'");
    if(mysqli_num_rows($result) === 1){
        $pw = mysqli_fetch_assoc($result);
        if(password_verify($password, $pw["password"])){
            header("location: index.php");
            exit;
        };
    };

    $error = true;
    if(isset($error)){
        echo "
            <script>
            alert('Wrong username or password!')
            </script>
        ";
    }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to QiQi - Indonesian 1st Social Media!">
    <title>Sign In | QiQi - Indonesian 1st Social Media</title>
    <link rel="stylesheet" href="signin.css">
</head>
<body>
    <div class="wrapper">
        <div class="window">
            <h1>Sign In</h1>
            <form method="post">
                <div class="username">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="password">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                    <div style="display: flex; align-items: center;" class="showpassword">
                        <input type="checkbox" name="show" id="show">
                        <label style="font-size: 10pt; margin-left: 5px;" for="show">Show Password</label>
                    </div>
                </div>
                <button type="submit" name="login" id="login">Sign In</button>
                <button id="signup">Do not have an account?</button>
            </form>
        </div>
    </div>

    <script>
        const showpw = document.getElementById("show");
        const signup = document.getElementById("signup");
        showpw.addEventListener("click", function(){
            const showpw = document.getElementById("show");
            const pw = document.getElementById("password");
            if(showpw.checked){
                pw.type = "text";
            } else {
                pw.type = "password";
            };
        });
        signup.addEventListener("click", function(){
            location.href = "signup.php";
        });
    </script>
</body>
</html>