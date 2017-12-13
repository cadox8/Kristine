<!-- Footer -->
<footer class="footer dark">
    <div class="container">
        <div class="columns">
            <div class="column is-10">
                <p class="copyright">Made with
                    <a class="copyright" target="_blank" href="http://cadox8.me/Kristine">Kristine</a>.
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php
    $jsFolder = "js/";
    if (!$fol) $jsFolder = "../js/";
    echo '<script type="text/javascript" src="'.$jsFolder.'bulma.js"></script>';
?>
