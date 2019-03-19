<?php
require "../data/init.php";
require "../lang/lang.php";

$fol = false;

$msg = -2;
if (isset($_GET['msg'])) $msg = $_GET['msg'];

$headerTag = getMessage('menu', 'sign_up').' - '.forumName;
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
                            <h2 class="title"><?php echo getMessage('misc', 'please').', '.getMessage('menu', 'sign_up') ?></h2>

                            <?php
                                if(isset($msg)) {
                                    switch ($msg) {
                                        case -1:
                                            echo '<div class="notification is-success">'.getMessage('success', 'registration').'</div>';
                                            break;
                                        case 0:
                                            echo '<div class="notification is-info">'.getMessage('error', 'all_fields').'</div>';
                                            break;
                                        case 1:
                                            echo getMessage('error', 'pass_not_match');
                                            break;
                                        case 2:
                                            echo getMessage('error', 'user_exists');
                                            break;
                                        case 3:
                                            echo getMessage('error', 'email');
                                            break;
                                        default:
                                            break;
                                    }
                                }
                            ?>

                            <div class="field">
                                <label class="label"><?php echo getMessage('user', 'username'); ?></label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="name" placeholder="e.g. jonh01">
                                    <span class="icon is-small is-left"><i class="fa fa-user"></i></span>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label"><?php echo getMessage('user', 'email'); ?></label>
                                <div class="control has-icons-left">
                                    <input class="input" type="email" name="email" placeholder="e.g. kristine@kristine.com">
                                    <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                                </div>
                            </div>

                            <div class="field is-horizontal">
                                <div class="field-body">
                                    <div class="field">
                                        <label class="label"><?php echo getMessage('user', 'password'); ?></label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="password" name="pass1" placeholder="*********">
                                            <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label"><?php echo getMessage('user', 'password'); ?></label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="password" name="pass2" placeholder="*********">
                                            <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label"><?php echo getMessage('user', 'gender'); ?> </label>
                                <div class="control">
                                    <label class="radio">
                                        <input type="radio" name="gender"><?php echo getMessage('user', 'male'); ?>
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender"><?php echo getMessage('user', 'female'); ?>
                                    </label>
                                </div>
                            </div>
<!--
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
                            </div> -->


                            <label class="label"><small><?php echo getMessage('misc', 'tos') ?></small></label>

                            <br>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary" type="submit"><?php echo getMessage('menu', 'sign_up'); ?></button>
                                </div>
                                <label class="label"><?php echo getMessage('user', 'have_account').' <a href="login.php">'.getMessage('user', 'go_log_in').'</a>'; ?>.</label>
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
