<?php
session_start();

    include_once("./connection.php");
    include_once("./functions.php");

    $user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $user_name = $_POST['UsernameLogin'];
        $password = $_POST['PasswordLogin'];

        //Check if user has written anything
        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            //read from database
            $query = "select * from users where user_name = '$user_name' limit 1";

            $result = mysqli_query($con, $query);

            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['password'] === $password)
                    {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: index.php");
                        die;
                    }
                }
            }
            echo "Wrong username or Password";
        }else
        {
            echo "Wrong username or Password";
        }
    }

?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Login / Sign up</title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="http://localhost/login/src/MainCSS.CSS">
</head>
<body>
    <div class="container">
        <form class="form" id="login">
            <h1 class="form__title">Login</h1>
            <div class="form__input-group">
                <input type="text" name="UsernameLogin" class="form__input" autofocus placeholder="Username">
            </div>
            <div class="form__input-group">
                <input type="password" name="PasswordLogin" class="form__input" autofocus placeholder="Password">
            </div>
            <button class="form__button" type="submit">Continue</button>
            <p class="form__text">
                <a href="http://localhost/login/signup.php">Don't have an account? Create account</a>
            </p>
        </form>
    </div>
</body>