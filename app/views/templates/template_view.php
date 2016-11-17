<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Науковий рейтинг викладача</title>
    <link rel="shortcut icon" href="/app/views/img/favicon.ico" type="image/x-icon" />
    <!--[if lte IE 8]><script src="/app/views/js/libs/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="/app/views/css/normalize.css">
    <link rel="stylesheet" href="/app/views/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/app/views/css/style.css" type="text/css" />
    <noscript><link rel="stylesheet" href="/app/views/css/noscript.css" /></noscript>
    <!--[if lte IE 8]><link rel="stylesheet" href="/app/views/css/ie8.css" /><![endif]-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="/app/views/js/include_js.js"></script>
</head>

<body>

    <?php
        if($_SERVER['REQUEST_URI'] == '/') {
            include ROOT_DIR.'/app/views/templates/'.$content_view;
            include ROOT_DIR.'/app/views/templates/footer.php';
    }   ?>

    <div id="wrapper">

        <!-- Nav -->
        <?php if($_SERVER['REQUEST_URI'] != '/') include ROOT_DIR.'/app/views/templates/header.php'; ?>

        <!-- Main -->
        <div id="main">

            <?php if($_SERVER['REQUEST_URI'] != '/') include ROOT_DIR.'/app/views/templates/'.$content_view; ?>

        </div>

        <!-- Footer -->
        <?php include ROOT_DIR.'/app/views/templates/footer.php'; ?>

    </div>

    <!--[if lte IE 8]><script src="/app/views/js/libs/ie/respond.min.js"></script><![endif]-->
</body>
</html>