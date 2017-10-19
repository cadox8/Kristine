<?php
require "../data/init.php";
require "../lang/lang.php";
$fol = false;

if (isset($_GET['msg'])) $msg = $_GET['msg'];
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
                        <form class="is-form" method="POST" action="../core/sign_in.php">
                            <h2 class="title"><?php echo $lang['PLEASE'].', '.$lang['LOG_IN'] ?></h2>

                            <?php
                                if(isset($msg)) {
                                    switch ($msg) {
                                        case 1:
                                            echo '<div class="notification is-danger">There is an error. Please, try again in some minutes.</div>';
                                            break;
                                        case 2:
                                            echo '<div class="notification is-danger">Wrong username or password</div>';
                                            break;
                                    }
                                }
                            ?>

                            <div class="field">
                                <label class="label"><?php echo $lang['USERNAME']; ?></label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="name" placeholder="e.g. jonh01">
                                    <span class="icon is-small is-left"><i class="fa fa-user"></i></span>
                                </div>
                            </div>

                            <label class="label"><?php echo $lang['PASSWORD']; ?></label>
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" type="password" name="pass" placeholder="*********">
                                    <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                                </div>
                            </div>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary" type="submit"><?php echo $lang['LOG_IN']; ?></button>
                                </div>
                                <label class="label"><?php echo $lang['QUEST_START'].$lang['NEW_USER'].$lang['QUEST_END'].' <a href="register.php">'.$lang['NEW_ACCOUNT'].'</a>'; ?>.</label>
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
