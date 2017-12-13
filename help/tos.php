<?php
require "../data/init.php";
require "../lang/lang.php";

$fol = false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require "../static/head.php"; ?>
</head>

<body>

    <?php require "../static/header.php"; ?>

    <section class="section">
        <div class="container">
            <h3 class="title">Terms of Service</h3>

            <div class="columns">
                <div class="column is-3">
                    <aside class="menu">
                        <p class="menu-label">Help</p>
                        <ul class="menu-list">
                            <li><a href="" class="is-active">Terms Of Service</a></li>
                            <li><a>Help</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="column">
                    <center><figure class="image is-128x128">
                      <img src="https://raw.githubusercontent.com/cadox8/Kristine/master/img/kristine.jpg">
                    </figure></center>
                    <strong>Privacy</strong><br>
                    At certain points in the <?php echo '<strong>'.forumName.'</strong>'; ?> website navigation, you may be asked to share your email address or other personal identifying information with us. As provided in these Terms and Conditions, such information will never be distributed to a third party and it will never be publicly visible without your express written consent.<br>
                    Your email address will only be used to send you the <?php echo '<strong>'.forumName.'</strong>'; ?> newsletter and/or to alert you to any information that you have specifically requested you be notified about.<br><br>
                    <strong>Use of the Site</strong><br>
                    The <?php echo '<strong>'.forumName.'</strong>'; ?> website hosts a public forum, which is equipped with commenting facilities. While we invite you to share your opinions and questions in this way, they must not be used to distribute spam messages, post commercial advertisements, or spread links to malicious or dangerous websites. We do retain the right to moderate any comment or written content submitted to the <?php echo '<strong>'.forumName.'</strong>'; ?> website and to remove any content we deem to have violated our policies.<br><br>
                    <strong>Disclaimer</strong><br>
                    All of the content contained on the <?php echo '<strong>'.forumName.'</strong>'; ?> is edited, checked, and verified for accuracy as much as it is possible to do so. However, we cannot guarantee either its accuracy or the safety of any external links it might contain. MySite.com, as well as its owners, affiliates, and contributing authors can therefore not be held responsible for any problems or damage that occurs as a result of making use of material contained on our site.<br><br>
                    <strong>Copyright</strong><br>
                    Any and all of the content presented on the <?php echo '<strong>'.forumName.'</strong>'; ?> website is, unless explicitly stated otherwise, subject to a copyright held by MySite.com. It is permissible to link to content from this site as long as the original source is clearly stated, but the wholesale reproduction or partial modification of content is not permitted. Exceptions are granted only if you receive prior written consent from <?php echo '<strong>'.forumName.'</strong>'; ?>.<br><br>
                    <strong>Contacts</strong><br>
                    Should you have any further questions, concerns, or queries about these Terms and Conditions, or if you encounter difficulties while navigating and using the site, please contact info@mysite.com.<br>
                </div>
            </div>
        </div>
    </section>

    <?php require "../static/footer.php"; ?>
</body>
</html>
