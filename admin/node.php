<?php
require "../data/init.php";
require '../utils/ranks.php';
require "../lang/lang.php";
$fol = false;

if (!isset($_SESSION['name']) || !isset($_GET['node']) || !isset($_GET['type'])) header("Location: ../index.php");
$node = $_GET['node'];
$type= $_GET['type'];
$username = $_SESSION['name'];

$result = $mysql->query("SELECT * FROM `users` WHERE `name` = '$username'");
$user = $result->fetch_object();

if ($user->rank != 5) {
    header("Location: ../user/security.php?username=$username&msg=0");
}

$headerTag = getMessage('admin', 'edit_node').' - '.forumName;
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
            <h2 class="title is-3" style="margin-bottom: -10px"><?php echo substr(getMessage('admin', 'node'), 0, -1).': '.$node; ?></h2>
            <hr style="margin-bottom: 0"><br>
        </div>

        <div class="columns">
            <div class="column is-2"></div>
            <div class="column is-8">
                <form class="is-form" method="POST" action="../core/update_node_name.php?type=<?php echo $type.'&old_node='.$node; ?>">
                    <div class="field">
                      <label class="label"><?php echo getMessage('misc', 'name'); ?></label>
                      <div class="control">
                        <input class="input" name="node" type="text" placeholder="Write the new name" value="<?php echo $node; ?>">
                      </div>
                      <p class="help">This will be the display name</p>
                    </div>
                <button class="button is-info" type="submit"><?php echo getMessage('misc', 'update') ?></button>
                </form>
            </div>
        </div>
    </section>

    <?php include "../static/footer.php"; ?>

</body>
</html>
