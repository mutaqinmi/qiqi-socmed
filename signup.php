<?php
$db = mysqli_connect("localhost", "root", "", "user_example");

function register($data){
    global $db;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data["password"]);

    $checkduplicate = mysqli_query($db, "SELECT username FROM user_data WHERE username = '$username'");
    if(mysqli_fetch_assoc($checkduplicate)){
        echo "
            <script>
            alert('Username isn't available!')
            </script>
        ";
        return false;
    };

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($db, "INSERT INTO user_data VALUES('', '$username', '$password')");
    return mysqli_affected_rows($db);
}

if(isset($_POST["signup"])){
    if(register($_POST) > 0){
        echo "
            <script>
            confirm('Sign Up successfull!')
            </script>
        ";
        header("location: signin.php");
    } else {
        echo mysqli_error($db);
    };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to QiQi - Indonesian 1st Social Media!">
    <title>Sign Up | QiQi - Indonesian 1st Social Media</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="wrapper">
        <div class="window">
            <h1>Sign Up</h1>
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
                <button type="submit" name="signup" id="signup">Sign Up</button>
                <button id="login">Have an account?</button>
            </form>
        </div>
    </div>

    <script>
        const showpw = document.getElementById("show");
        const login = document.getElementById("login");
        showpw.addEventListener("click", function(){
            const showpw = document.getElementById("show");
            const pw = document.getElementById("password");
            if(showpw.checked){
                pw.type = "text";
            } else {
                pw.type = "password";
            };
        });
        login.addEventListener("click", function(){
            location.href = "signin.php";
        });
    </script>
</body>
</html>