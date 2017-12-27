<?php
require "../data/init.php";
require '../utils/ranks.php';
require "../lang/lang.php";
$fol = false;

if (!isset($_SESSION['name']) && !isset($_GET['node'])) header("Location: ../index.php");
$node = $_GET['node'];


$headerTag = $lang['SET_AC'].' - '.forumName;
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
            <h2 class="title is-3" style="margin-bottom: -10px"><?php echo $node; ?></h2>
            <hr style="margin-bottom: 0"><br>
        </div>
    </section>

    <?php include "../static/footer.php"; ?>

</body>
</html>
