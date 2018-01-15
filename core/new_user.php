<?php
require "../data/init.php";

if (isset($_POST['name']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email'])){
    $username = mysqli_real_escape_string($mysql, stripslashes($_POST['name']));
    $email = mysqli_real_escape_string($mysql, stripslashes($_POST['email']));
    $selectedLang = $_POST['lang'];

    if ($selectedLang == '' || $selectedLang == null) $selectedLang = 'en_EN';

    //All Queries
    $checkUserQuery = $mysql->query("SELECT * FROM `users` WHERE `name`= '$username'");
    $checkEmailQuery = $mysql->query("SELECT * FROM `users` WHERE `email`= '$email'");
    //

    if ($username == '' || $email == '' || $_POST['pass1'] == '') {
        header('Location: ../user/register.php');
    } else {
        if (!hash_equals($_POST['pass1'], $_POST['pass2'])) {
            header('Location: ../user/register.php?msg=1');
        } else {
            $password = base64_encode(mysqli_real_escape_string($mysql, stripslashes($_POST['pass1'])));
            if ($checkUserQuery->num_rows >= 1) {
                header('Location: ../user/register.php?msg=2');
            } else {
                if ($checkEmailQuery->num_rows >= 1) {
                    header('Location: ../user/register.php?msg=3');
                } else {
                    $hash = md5(rand(0,1000));
                    $result = $mysql->query("INSERT INTO `users` (`name`, `email`, `pass`, `lang`, `hash`) VALUES ('$username', '$email', '$password', '$selectedLang', '$hash')");
                    header('Location: ../user/register.php?msg=-1');

                    $subject = 'Activate your account - Kristine';

                    $message = 'Thanks for signing up!
                    Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

                    ------------------------
                    Username: '.$username.'
                    ------------------------

                    Please click this link to activate your account:
                    http://www.'.forumName.forumDomain.'/verify.php?email='.$email.'&hash='.$hash.'
                    ';

                    if(!mail($email, $subject, $message)) {

                    }

                    if (!$result) header('Location: ../user/register.php?msg=4');
                }
            }
        }
    }
}
