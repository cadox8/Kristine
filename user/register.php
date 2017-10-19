<?php
require "../data/init.php";
require "../lang/lang.php";

$fol = false;

$msg = 0;
if (isset($_GET['msg'])) $msg = $_GET['msg'];

if (isset($_POST['user']) && isset($_POST['pass1']) && isset($_POST['email'])) {
    echo $_POST['user'];
    echo $_POST['email'];
    echo $_POST['pass1'];
}

$headerTag = $lang['SIGN_UP'].' - '.forumName;
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
                        <form class="is-form" method="POST" action="../core/new_user.php">
                            <h2 class="title"><?php echo $lang['PLEASE'].', '.$lang['SIGN_UP'] ?></h2>

                            <?php
                                if(isset($msg)) {
                                    if ($msg == -1) {
                                        echo '<div class="notification is-success">'.$lang['SUCCESS'].'</div>';
                                    } elseif ($msg == 0) {
                                            echo '<div class="notification is-info">Please, fill all fields.</div>';
                                        } else {
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
                                    }
                            ?>

                            <div class="field">
                                <label class="label">Username</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="name" placeholder="e.g. jonh01">
                                    <span class="icon is-small is-left"><i class="fa fa-user"></i></span>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="email" name="email" placeholder="e.g. kristine@kristine.com">
                                    <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field">
                                        <label class="label">Password</label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="password" name="pass1" placeholder="*********">
                                            <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Repeat Password</label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="password" name="pass2" placeholder="*********">
                                            <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">I'm </label>
                                <div class="control">
                                    <label class="radio">
                                        <input type="radio" name="gender">
                                        Male
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender">
                                        Female
                                    </label>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Language</label>
                                <div class="control has-icons-left">
                                    <div class="select is-primary">
                                        <select name="lang">
                                            <option value="en_EN" selected>English</option>
                                            <option value="es_ES">Español</option>
                                        </select>
                                        <span class="icon is-small is-left"><i class="fa fa-language"></i></span>
                                    </div>
                                </div>
                            </div>


                            <label class="label"><small>Clicking on Register, you will accept the <a href="../help/tos.php" target="_blank">terms and conditions</a>.</small></label>

                            <br>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary" type="submit">Register</button>
                                </div>
                                <label class="label"><?php echo $lang['QUEST_START'].$lang['NOT_NEW_USER'].$lang['QUEST_END'].' <a href="login.php">'.$lang['JOIN_SITE'].'</a>'; ?>.</label>
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
