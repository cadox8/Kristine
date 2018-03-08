<?php
require "../data/init.php";
require "../lang/lang.php";

$fol = false;

$msg = -2;
if (isset($_GET['msg'])) $msg = $_GET['msg'];

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
                                    switch ($msg) {
                                        case -1:
                                            echo '<div class="notification is-success">'.$lang['SUCCESS'].'</div>';
                                            break;
                                        case 0:
                                            echo '<div class="notification is-info">'.$lang['ALL_FIELDS'].'</div>';
                                            break;
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
                                            break;
                                    }
                                }
                            ?>

                            <div class="field">
                                <label class="label"><?php echo $lang['USERNAME'] ?></label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="name" placeholder="e.g. jonh01">
                                    <span class="icon is-small is-left"><i class="fa fa-user"></i></span>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label"><?php echo $lang['EMAIL'] ?></label>
                                <div class="control has-icons-left">
                                    <input class="input" type="email" name="email" placeholder="e.g. kristine@kristine.com">
                                    <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field">
                                        <label class="label"><?php echo $lang['PASSWORD'] ?></label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="password" name="pass1" placeholder="*********">
                                            <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label"><?php echo $lang['REPEAT'].' '.$lang['PASSWORD'] ?></label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="password" name="pass2" placeholder="*********">
                                            <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label"><?php echo $lang['IM'] ?> </label>
                                <div class="control">
                                    <label class="radio">
                                        <input type="radio" name="gender"><?php echo $lang['MALE'] ?>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender"><?php echo $lang['FEMALE'] ?>
                                    </label>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label"><?php echo $lang['LANGUAGE'] ?></label>
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


                            <label class="label"><small><?php echo $lang['REG_INFO'] ?></small></label>

                            <br>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary" type="submit"><?php echo $lang['SIGN_UP'] ?></button>
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
