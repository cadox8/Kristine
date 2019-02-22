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

$headerTag = $lang['SET_SIGNATURE'].' - '.forumName;
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
                <h2 class="title is-3" style="margin-bottom: -10px"><?php echo $lang['SET_SIGNATURE']; ?></h2>
                <hr style="margin-bottom: 0">

                <div class="columns">
                    <div class="column">
                        <?php
                            if (isset($msg)) {
                                echo '<div class="notification ';
                                switch ($msg) {
                                    case 1:
                                        echo 'is-success">'.$lang['S_S'];
                                        break;

                                    default:
                                        echo 'is-danger">'.$lang['S_E'];
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
                                <li><a href="security.php?username=<?php echo $username; ?>"><?php echo $lang['SET_SECURITY']; ?></a></li>
                                <li><a href="preferences.php?username=<?php echo $username; ?>"><?php echo $lang['SET_PREFERENCES']; ?></a></li>
                                <li><a href="" class="is-active"><?php echo $lang['SET_SIGNATURE']; ?></a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="column is-6">
                        <label class="label"><?php echo $lang['USER'].': '.$username.'</label>';  ?></label>
                        <label class="label"><?php Ranks::getRank($lang, $user->rank, true); ?></label><br>

                        <form class="is-form" method="POST" action="../core/change_signature.php">
                            <label class="label"><?php echo $lang['CHANGE'].' '.$lang['SET_SIGNATURE']; ?></label>
                            <div class="field">
                                <div class="control">
                                    <textarea class="textarea" name="signature"><?php if ($user->signature != '') echo $user->signature; ?></textarea>
                                </div>
                            </div>
                            <button class="button is-info" type="submit"><?php echo $lang['UPD'] ?></button>
                        </form>

                        <br>

                        <label class="label" style="margin-bottom: -20px"><?php echo $lang['PREVIEW']; ?></label>
                        <hr style="margin-bottom: 7px">
                        <?php
                            $signature = $user->signature;

                            if ($signature == '') {
                                echo 'No '.$lang['SET_SIGNATURE'];
                                return;
                            }

                            echo $signature;
                        ?>
                    </div>
                    <div class="column"></div>
                </div>
            </div>
        </div>
    </section>

    <?php include "../static/footer.php"; ?>

</body>
</html>
