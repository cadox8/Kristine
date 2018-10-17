<?php
require "data/init.php";
require "lang/lang.php";

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    $email = mysql_escape_string($_GET['email']);
    $hash = mysql_escape_string($_GET['hash']);

    $search = $mysql->query("SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'");
    $match  = mysql_num_rows($search);

    if($match > 0){
        $mysql->query("UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'"));
        $msg = 1;
    }else{
        $msg = 2;
    }

}else{
    $msg = 3;
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
                        <?php
                            if(isset($msg)) {
                                switch ($msg) {
                                    case 1:
                                        echo '<div class="notification is-success">Your account has been verificated.</div>';
                                        break;
                                    case 2:
                                        echo '<div class="notification is-danger">The url is either invalid or you already have verificated your account.</div>';
                                        break;
                                    case 3:
                                        echo '<div class="notification is-danger">Invalid approach, please use the link that has been send to your email.</div>';
                                        break;
                                }
                            }
                        ?>
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
