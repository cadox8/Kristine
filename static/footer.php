<!-- Footer -->
<footer class="footer dark">
    <div class="container">
        <div class="columns">
            <div class="column is-10">
                <p class="copyright">Made with
                    <a class="copyright" target="_blank" href="http://bulma.io">Bulma</a>.
                </p>
            </div>
            <div class="column">
                <?php
                    $tosLoc = "help/";
                    if (!$fol) $tosLoc = "../help/";
                    echo '<a class="copyright" target="_blank" href="'.$tosLoc.'tos.php">Help</a>.';
                ?>
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<?php
    $jsFolder = "js/";
    if (!$fol) $jsFolder = "../js/";
    echo '<script type="text/javascript" src="'.$jsFolder.'bulma.js"></script>';
?>
