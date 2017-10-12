<!-- Info -->
<section class="hero is-paddingless" style="margin-top: -13px">
    <div class="hero-body is-paddingless"><br>
        <div class="container">
            <h1 class="title is-3">
                <?php echo '<p class="is-head left">'.forumName.'</p><a><span class="icon is-large right"><i class="fa fa-twitter black"></i></span></a>'; ?>
            </h1>
        </div>
    </div>
</section>

<!-- Navigation -->
<nav class="navbar is-dark is-transparent" id="top">
    <div class="navbar-brand">
        <p class="navbar-item is-hidden-mobile"></p>
        <p class="navbar-item"></p>
        <a class="navbar-item is-active" href="../index.php">Home</a>
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
            if (!$fol) {
                $userFolder = "../user/";
            }

            if (!isset($_SESSION['name'])) {
                echo '<div class="navbar-item has-dropdown is-hoverable"><a class="navbar-link">Login/Register</a><div class="navbar-dropdown"><a class="navbar-item" href="'.$userFolder.'login.php">Log In</a><a class="navbar-item" href="'.$userFolder.'register.php">Sign up</a><hr class="navbar-divider"><div class="navbar-item">Version '.version.'</div></div></div>';
            } else {
                echo '<a class="navbar-item" href=""><span class="icon is-medium"><i class="fa fa-user-o"></i></span> '.$_SESSION['name'].'</a>';
                echo '<a class="navbar-item" href="'.$userFolder.'logout.php"><span class="icon is-medium"><i class="fa fa-sign-out"></i></span></a>';
            }
            ?>
            <p class="navbar-item is-hidden-mobile"></p>
            <p class="navbar-item is-hidden-mobile"></p>
        </div>
    </div>
</nav>