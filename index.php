<?php session_start(); ?>

<?php include "functions/scss.php"; ?>
<?php include "router.php"; ?>
<?php include "functions/functions.php"; ?>
<?php include "functions/db.php"; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="<?= $conf_description ?>">
    <meta name="keywords" content="<?= $conf_keywords ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?= $conf_title ?></title>
    <link rel="stylesheet" href="<?= asset("assets/css/style.css"); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
</head>

<body>

    <div id="notification_sandbox">
        <?php printNotification(); ?>
    </div>

    <?php include("modules/navbar.php"); ?>

    <div id="page-wrapper">
        <?php include $page ?>
    </div>

    <?php include("js.php"); ?>
</body>

</html>