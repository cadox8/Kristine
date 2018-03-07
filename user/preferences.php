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

$headerTag = $lang['SET_PREFERENCES'].' - '.forumName;
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
                <h2 class="title is-3" style="margin-bottom: -10px"><?php echo $lang['SET_PREFERENCES']; ?></h2>
                <hr style="margin-bottom: 0">

                <div class="columns">
                    <div class="column">
                        <?php
                            if (isset($msg)) {
                                echo '<div class="notification ';
                                switch ($msg) {
                                    case 1:
                                        echo 'is-success">'.$lang['CONTACT'].' '.$lang['UPD'];
                                        break;
                                    case 2:
                                        echo 'is-success">Profile Picture updated';
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
                                <li><a href="security.php?username=<?php echo $username; ?>"><?php echo $lang['SET_SECURITY']; ?></a></li>
                                <li><a href="" class="is-active"><?php echo $lang['SET_PREFERENCES']; ?></a></li>
                                <li><a href="signature.php?username=<?php echo $username; ?>"><?php echo $lang['SET_SIGNATURE']; ?></a></li>
                            </ul>
                        </aside>
                    </div>
                    <div class="column is-6">
                        <form class="is-form" method="POST" action="../core/change_lang.php">
                            <label class="label">Language</label>
                            <div class="field has-addons">
                                <div class="control has-icons-left">
                                    <div class="select is-primary">
                                        <select name="lang">
                                            <option value="en_EN" <?php if ($selectedLang == "en_EN") echo 'selected'; ?>>English</option>
                                            <option value="es_ES" <?php if ($selectedLang == "es_ES") echo 'selected'; ?>>Español</option>
                                        </select>
                                        <span class="icon is-small is-left"><i class="fa fa-language"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="control">
                                <button class="button is-info" type="submit"><?php echo $lang['UPD'] ?></button>
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
