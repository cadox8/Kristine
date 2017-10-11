<!-- Navigation -->
<nav class="navbar is-transparent" id="top">
    <div class="navbar-brand">
        <p class="navbar-item is-hidden-mobile"></p>
        <a class="navbar-item" href=""> ProjectX</a>
        <div class="navbar-burger burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div id="navMenu" class="navbar-menu">
        <div class="navbar-end">
            <a class="navbar-item is-active" href="index.php">Home</a>

            <?php if (!isset($_SESSION['name'])) {
                echo '<div class="navbar-item has-dropdown is-hoverable"><a class="navbar-link">Login/Register</a><div class="navbar-dropdown"><a class="navbar-item" href="login.php">Login</a><a class="navbar-item" href="register.php">Register</a><hr class="navbar-divider"><div class="navbar-item">Version ' .$version.'</div></div></div>';
            } else {
                echo '<div class="navbar-item has-dropdown is-hoverable"><a class="navbar-link">Hi '.$_SESSION['name'];
                echo '</a><div class="navbar-dropdown"><a class="navbar-item">Profile</a><a class="navbar-item" href="logout.php">Logout</a><hr class="navbar-divider"><div class="navbar-item">Version ' .$version.'</div></div></div>';
            }
            ?>
            <p class="navbar-item is-hidden-mobile"></p>
        </div>
    </div>
</nav>