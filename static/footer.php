<!-- Footer -->
<footer>
    <div class="container">
        <div class="column is-12">
            <p class="copyright text-muted small">Copyright &copy; Kristine 2017.
                <span class="icon is-small"><i style="color: #090909" class="fa fa-code"></i></span> with
                <span class="icon is-small"><i style="color: purple" class="fa fa-heart"></i></span> by
                <a class="copyright text-muted small" style="color:yellow;" target="_blank" href="http://cadox8.me">Cadox8</a>.
            </p>
            <time class="loadInfo" style="color: white" id="loadTime"> Getting time...</time>
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