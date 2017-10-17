<?php
require "../data/init.php";
$fol = false;

if (isset($_GET['msg'])) $msg = $_GET['msg'];

$name = $_SESSION['name'];
$usersQuery = $mysql->query("SELECT * FROM `users` WHERE `name` = '$name'");
$user = $usersQuery->fetch_object();
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
                <h2 class="title is-3" style="margin-bottom: -3px"><?php echo $lang['PROF_SETTINGS']; ?></h2><hr>
                <div class="columns">
                    <div class="column">
                        <?php
                            if (isset($msg) && $msg == 1) {
                                echo '<div class="notification is-success">';
                                echo 'Email updated';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-6">
                        <form class="is-form" method="POST" action="../core/update_mail.php">
                            <label class="label">New Email</label>
                            <div class="field has-addons">
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="email" placeholder="e.g. kristine@kristine.com">
                                    <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                                </div>
                                <div class="control">
                                    <button class="button is-info" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="column">asd</div>
                </div>
            </div>
        </div>
    </section>

    <?php include "../static/footer.php"; ?>

</body>
</html>
