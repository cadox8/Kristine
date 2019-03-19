<!-- Data -->
<script type="text/javascript">
  var c = document.cookie;
  document.cookie = 'size=' + Math.max(screen.width, screen.height) + ';';
</script>

<!-- Info -->
<section class="hero is-paddingless" style="margin-top: -13px">
    <div class="hero-body is-paddingless"><br>
        <div class="container">
            <h1 class="title is-3">
                <div class="columns">
                    <div class="column is-2"><?php echo '<a class="is-head left">'.forumName.'</a>' ?></div>
                    <div class="column is-9 is-hidden-mobile"></div>
                    <div class="column is-1 is-hidden-mobile"><a href="https://twitter.com/<?php echo forumTwitter; ?>" target="_blank"><span class="icon is-large right"><i class="fab fa-twitter"></i></span></a></div>
                </div>
            </h1>
        </div>
    </div>
</section>

<!-- Navigation -->
<nav class="navbar is-dark is-transparent" id="top">
    <div class="navbar-brand">
        <p class="navbar-item is-hidden-mobile"></p>
        <p class="navbar-item"></p>
        <?php
            $def = "";
            if (!$fol) $def = "../";
            echo '<a class="navbar-item is-active" href="'.$def.'index.php">'.getMessage('menu', 'home').'</a>';
            if (isset($_SESSION['name'])) {
                $username = $_SESSION['name'];
                if ($mysql->query("SELECT `rank` FROM `users` WHERE `name`='$username'")->fetch_object()->rank == 5) {
                    echo '<a class="navbar-item" href="'.$def.'admin/admin.php">'.getMessage('menu', 'admin').'</a>';
                }
            }
        ?>
        <div class="navbar-burger burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="navMenu" class="navbar-menu">
        <div class="navbar-start">

        </div>
        <div class="navbar-end">
            <?php
            $userFolder = "user/";
            if (!$fol) $userFolder = "../user/";

            if (!isset($_SESSION['name'])) {
                echo '<div class="navbar-item has-dropdown is-hoverable"><a class="navbar-link">'.getMessage('menu', 'log_in').' / '.getMessage('menu', 'sign_up').'</a><div class="navbar-dropdown"><a class="navbar-item" href="'.$userFolder.'login.php">'.getMessage('menu', 'log_in').'</a><a class="navbar-item" href="'.$userFolder.'register.php">'.getMessage('menu', 'sign_up').'</a><hr class="navbar-divider"><div class="navbar-item">Version '.version.'</div></div></div>';
            } else {
                echo '<a class="navbar-item" href="'.$def.'profile.php?userName='.$_SESSION['name'].'"><span class="icon is-medium"><i class="far fa-user"></i></span> '.$_SESSION['name'].'</a>';
                echo '<a class="navbar-item" href="'.$userFolder.'logout.php"><span class="icon is-medium"><i class="fas fa-sign-out-alt"></i></span></a>';
            }
            ?>
            <p class="navbar-item is-hidden-mobile"></p>
            <p class="navbar-item is-hidden-mobile"></p>
        </div>
    </div>
</nav>
