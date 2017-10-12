<script type="text/javascript"> var beforeload = (new Date()).getTime(); </script>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="icon" type="image/x-icon" href="img/favicon.ico"/>
<!--<meta name="theme-color" content="#B21EC9">-->


<!-- CSS -->
<?php
    $bulmaCSS = "css/bulma.css";
    $kristineCSS = "css/kristine.css";
    $langFolder = 'lang/lang.php';
    if (!$fol) {
        $bulmaCSS = "../css/bulma.css";
        $kristineCSS = "../css/kristine.css";
        $langFolder = '../lang/lang.php';
    }
    echo '<link href="'.$kristineCSS.'" rel="stylesheet">';
    echo '<link href="'.$bulmaCSS.'" rel="stylesheet">';

    require $langFolder;
?>


<!-- Fonts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

<title><?php echo forumName; ?></title>