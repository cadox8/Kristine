<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="columns">
            <div class="column is-10">
                <p class="copyright">Made with
                    <a class="copyright" target="_blank" href="http://cadox8.me/Kristine">Kristine</a>.
                </p>
            </div>
            <div class="column">
                <time class="loadTime" style="color: white" id="loadTime"> Getting time...</time>
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
