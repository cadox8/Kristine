<?php
require "../data/init.php";

$fol = false;

if (isset($_POST['name']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email'])){
    $username = mysqli_real_escape_string($mysql, stripslashes($_POST['name']));
    $email = mysqli_real_escape_string($mysql, stripslashes($_POST['email']));
    $selectedLang = $_POST['lang'];

    $msg = '<div class="notification is-success">'.$lang['SUCCESS'].'</div>';

    //All Queries
    $checkUserQuery = $mysql->query("SELECT * FROM `users` WHERE `name`= '$username'");
    $checkEmailQuery = $mysql->query("SELECT * FROM `users` WHERE `email`= '$email'");
    //

    if (!hash_equals($_POST['pass1'], $_POST['pass2'])) {
        $msg = 1;
    } else {
        $password = base64_encode(mysqli_real_escape_string($mysql, stripslashes($_POST['pass1'])));
        if ($checkUserQuery->num_rows >= 1) {
            $msg = 2;
        } else {
            if ($checkEmailQuery->num_rows >= 1) {
                $msg = 3;
            } else {
                $result = $mysql->query("INSERT INTO `users` (`name`, `email`, `pass`, `lang`) VALUES ('$username', '$email', '$password', '$selectedLang')");
                if(!$result) $msg = 4;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../static/head.php"; ?>
</head>

    <body>

    <?php include "../static/header.php"; ?>

    <!-- Page -->
    <section class="section">
        <div class="container">
            <div class="container">
                <div class="columns">
                    <div class="column is-4">
                        <p></p>
                    </div>
                    <div class="column is-5">
                        <form class="is-form" method="POST" action="">
                            <h2 class="title">Please Register</h2>

                            <?php
                                if(isset($msg) && $msg != 0) {
                                    echo '<div class="notification is-danger">';
                                    switch ($msg) {
                                        case 1:
                                            echo $lang['PASSWORD'].$lang['NM'];
                                            break;
                                        case 2:
                                            echo $lang['USERNAME'].$lang['AE'];
                                            break;
                                        case 3:
                                            echo $lang['EMAIL'].$lang['AE'];
                                            break;
                                        default:
                                            echo $lang['UR_ERROR'];
                                            break;
                                    }
                                    echo '</div>';
                                }
                            ?>

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

                            <label class="label">Language</label>
                            <div class="field">
                                <div class="control">
                                    <div class="select">
                                        <select name="lang">
                                            <option value="en_EN">English</option>
                                            <option value="es_ES">Español</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <label class="label"><small>Clicking on Register, you will accept the <a href="tos.php" target="_blank">terms and conditions</a>.</small></label>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary" type="submit">Register</button>
                                </div>
                                <div class="control">
                                    <a class="button is-info" href="login.php">Login</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="column">
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "../static/footer.php"; ?>
</body>

</html>