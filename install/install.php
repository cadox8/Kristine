<?php
require "../data/init.php";
require "../lang/lang.php";
$fol = false;

if (installed) header("Location: index.php");

$error = 0;

if (isset($_POST['host']) && isset($_POST['name']) && isset($_POST['user']) && isset($_POST['pass'])) {
    $host = $_POST['host'];
    $name = $_POST['name'];
    $user = $_POST['user'];
    $pass = $_POST['$pass'];

    $connect = mysqli_connect($host, $user, $pass, $name);

    if (mysqli_connect_error()) {
        $error = 1;
    } else {
        $error = 2;
        DBHOST = $host;
        DBUSER = $user;
        DBPASS = $pass;
        DBNAME = $name;
    }
}

$headerTag = $lang['NEW_POST'].' - '.forumName;
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
                <h2 class="title is-3" style="margin-bottom: -10px"><?php echo $lang['NEW_POST']; ?></h2>
                <hr style="margin-bottom: 0">

                <div class="columns">
                    <div class="column is-2"></div>
                    <div class="column is-8">
                        <?php
                            if(isset($error)) {
                                switch ($error) {
                                    case 1:
                                        echo '<div class="notification is-danger">Could not connect to MySQL server</div>';
                                        break;
                                    case 2:
                                        echo '<div class="notification is-success">Done :D</div>';
                                        break;
                                }
                            }
                        ?>
                        <br>
                        <form class="is-form" method="POST" action="install.php">
                            <div class="field">
                                <label class="label">DB Host</label>
                                <div class="control">
                                    <input class="input" type="text" value="localhost" placeholder="localhost" name="host"></input>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">DB Name</label>
                                <div class="control">
                                    <input class="input" type="text" value="kristine" placeholder="kristine" name="name"></input>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">DB User</label>
                                <div class="control">
                                    <input class="input" type="text" value="root" placeholder="root" name="user"></input>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">DB Password</label>
                                <div class="control">
                                    <input class="input" type="password" placeholder="********" name="pass"></input>
                                </div>
                            </div>

                            <button class="button is-info" type="submit">Conect</button>
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
