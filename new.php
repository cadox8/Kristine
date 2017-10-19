<?php
require "data/init.php";
require 'utils/ranks.php';
require "lang/lang.php";

if (isset($_GET['forumID']) && isset($_SESSION['name'])) {
    $forumID = $_GET['forumID'];
    $tried = $_SESSION['name'];
} else {
    header("Location: index.php");
}

$headerTag = $lang['MENU_HOME'].' - '.forumName;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "static/head.php"; ?>
</head>

<body>

    <?php include "static/header.php"; ?>


    <!-- Page -->
    <section class="section">
        <div class="container">
            <div class="container">
                <h2 class="title is-3" style="margin-bottom: -10px"><?php echo $lang['SET_AC']; ?></h2>
                <hr style="margin-bottom: 0">

                <div class="columns">
                    <div class="column is-2"></div>
                    <div class="column is-8">
                        <br>
                        <form class="is-form" method="POST" action="">
                            <div class="field">
                                <div class="control">
                                    <textarea class="textarea" name="post" placeholder="Write Something" rows="8"></textarea>
                                </div>
                            </div>
                            <button class="button is-info" type="submit">Create</button>
                        </form>
                    </div>
                    <div class="column"></div>
                </div>
            </div>
        </div>
    </section>

    <?php include "static/footer.php"; ?>

</body>
</html>
