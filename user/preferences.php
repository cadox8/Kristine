<?php
require "../data/init.php";
require '../utils/ranks.php';
require "../lang/lang.php";
$fol = false;

if (isset($_GET['username']) && isset($_SESSION['name'])) {
    $username = $_GET['username'];
    $tried = $_SESSION['name'];

    $adminQuery = $mysql->query("SELECT * FROM `users` WHERE `name` = '$tried'");

    $selectedLang = $adminQuery->fetch_object()->lang;

    if ($username != $tried) {
        if ($adminQuery->fetch_object()->rank != 5) {
            header("Location: ../index.php");
        }
    }
} else {
    header("Location: ../index.php");
}

if (isset($_GET['msg'])) $msg = $_GET['msg'];

$usersQuery = $mysql->query("SELECT * FROM `users` WHERE `name` = '$username'");
$user = $usersQuery->fetch_object();

$headerTag = getMessage('settings', 'account_preferences').' - '.forumName;
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
                <h2 class="title is-3" style="margin-bottom: -10px"><?php echo getMessage('settings', 'account_preferences'); ?></h2>
                <hr style="margin-bottom: 0">

                <div class="columns">
                    <div class="column">
                        <?php
                            if (isset($msg)) {
                                echo '<div class="notification ';
                                switch ($msg) {
                                    case 1:
                                        echo 'is-success">'.getMessage('settings', 'account_preferences').' '.$lang['UPD'];
                                        break;

                                    default:
                                        echo 'is-danger">'.getMessage('error', 'unknown').'';
                                        break;
                                }
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-3">
                        <aside class="menu">
                            <p class="menu-label"><?php echo getMessage('settings', 'user_settings'); ?></p>
                            <ul class="menu-list">
                                <li><a href="account.php?username=<?php echo $username; ?>"><?php echo getMessage('settings', 'account_details'); ?></a></li>
                                <li><a href="security.php?username=<?php echo $username; ?>"><?php echo getMessage('settings', 'account_security'); ?></a></li>
                                <li><a href="" class="is-active"><?php echo getMessage('settings', 'account_preferences'); ?></a></li>
                                <li><a href="signature.php?username=<?php echo $username; ?>"><?php echo getMessage('settings', 'account_signature'); ?></a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="column is-6">
                      
                    </div>
                    <div class="column"></div>
                </div>
            </div>
        </div>
    </section>

    <?php include "../static/footer.php"; ?>

</body>
</html>
