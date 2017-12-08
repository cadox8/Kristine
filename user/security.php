<?php
require "../data/init.php";
require '../utils/ranks.php';
require "../lang/lang.php";
$fol = false;

if (isset($_GET['username']) && isset($_SESSION['name'])) {
    $username = $_GET['username'];
    $tried = $_SESSION['name'];

    $adminQuery = $mysql->query("SELECT * FROM `users` WHERE `name` = '$tried'");

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

$headerTag = $lang['SET_SECURITY'].' - '.forumName;
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
                <h2 class="title is-3" style="margin-bottom: -10px"><?php echo $lang['SET_AC']; ?></h2>
                <hr style="margin-bottom: 0">

                <div class="columns">
                    <div class="column">
                        <?php
                            if (isset($msg)) {
                                echo '<div class="notification ';
                                switch ($msg) {
                                    case 1:
                                        echo 'is-success">Password Changed';
                                        break;

                                    default:
                                        echo 'is-danger">'.$lang['UR_ERROR'].'';
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
                            <p class="menu-label"><?php echo $lang['PROF_SETTINGS']; ?></p>
                            <ul class="menu-list">
                                <li><a href="account.php?username=<?php echo $username; ?>"><?php echo $lang['SET_AC']; ?></a></li>
                                <li><a href="" class="is-active"><?php echo $lang['SET_SECURITY']; ?></a></li>
                                <li><a><?php echo $lang['SET_PREFERENCES']; ?></a></li>
                                <li><a href="signature.php?username=<?php echo $username; ?>"><?php echo $lang['SET_SIGNATURE']; ?></a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="column is-6">
                        <label class="label"><?php echo $lang['USER'].': '.$username.'</label>';  ?>
                        <label class="label"><?php Ranks::getRank($lang, $user->rank, true); ?></label><br>

                        <form class="is-form" method="POST" action="../core/change_pass.php">
                            <label class="label"><?php echo $lang['NEW'].' '.$lang['PASSWORD']; ?></label>
                            <div class="field has-addons">
                                <div class="control has-icons-left is-expanded">
                                    <input class="input" type="password" name="pass" placeholder="*********">
                                    <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                </div>
                                <div class="control">
                                    <button class="button is-info" type="submit">Update</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="column"></div>
                </div>
            </div>
        </div>
    </section>

    <?php include "../static/footer.php"; ?>

</body>
</html>
