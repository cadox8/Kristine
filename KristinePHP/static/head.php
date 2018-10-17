<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="theme-color" content="#B21EC9">

<!-- Stuff -->
<meta property="og:title" content=<?php echo forumName; ?>>
<meta property="og:description" content="Simple forum made with bulmaCSS">
<meta name="author" content="cadox8">
<meta name="twitter:card" content="summary">

<!-- CSS & Favicon -->
<?php
    $kristineCSS = "css/kristine.css";
    $imgFolder = 'img/';
    if (!$fol) {
        $kristineCSS = "../css/kristine.css";
        $imgFolder = '../img/';
    }
    echo '<link rel="icon" type="image/x-icon" href="'.$imgFolder.'favicon.ico"/>';
    echo '<link href="'.$kristineCSS.'" rel="stylesheet">';
?>

<!-- Fonts -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

<title><?php echo $headerTag; ?></title>
