<?php
require "data/start.php";

if (isset($_POST['name']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email'])){
    $username = mysqli_real_escape_string($mysql, stripslashes($_POST['name']));
    $email = mysqli_real_escape_string($mysql, stripslashes($_POST['email']));

    $msg = '<div class="notification is-success">User Created Successfully.</div>';
    if (!hash_equals($_POST['pass1'], $_POST['pass2'])) $msg = '<div class="notification is-danger">Password does not match</div>';

    $password = base64_encode(mysqli_real_escape_string($mysql, stripslashes($_POST['pass1'])));

    $query = "INSERT INTO `users` (`name`, `email`, `pass`) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($mysql, $query);

    if(!$result) $msg = '<div class="notification is-danger">User Registration Failed.</div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.php"; ?>
</head>

    <body>

    <?php include "header.php"; ?>

    <!-- Page -->
    <section class="section">
        <div class="container">
            <div class="container">
                <div class="columns">
                    <div class="column is-5">
                        <form class="is-form" method="POST" action="">
                            <h2 class="title">Please Register</h2>

                            <?php if(isset($msg)) echo $msg; ?>

                            <div class="field">
                                <label class="label">Username</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="name" placeholder="Username">
                                    <span class="icon is-small is-left"><i class="fa fa-user"></i></span>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="email" name="email" placeholder="Email">
                                    <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                                </div>
                            </div>

                            <label class="label">Password</label>
                            <div class="field is-horizontal">
                                <div class="control has-icons-left">
                                    <input class="input" type="password" name="pass1" placeholder="*********">
                                    <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                </div>

                                <div class="control has-icons-left">
                                    <input class="input" type="password" name="pass2" placeholder="*********">
                                    <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                </div>
                            </div>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary" type="submit">Register</button>
                                </div>
                                <div class="control">
                                    <a class="button is-info" href="login.php">Login</a>
                                </div>
                            </div>
                            <label class="label">Clicking on Register, you will accept the <a href="tos.php" target="_blank">terms and conditions</a>.</label>
                        </form>
                    </div>

                    <div class="column">
                        <p>ToDo: Info</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "footer.html"; ?>
</body>

</html>