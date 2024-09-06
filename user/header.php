<?php if (isset($_GET['lang']) && $_GET['lang'] == "ar") { ?>
  <html dir="rtl" lang="<?php echo $_GET['lang']; ?>">
<?php } elseif (!isset($_GET['lang'])) { ?>
  <html lang="en">
<?php } ?>

<head>
  <title><?php gettitle() ?></title>
  <meta charset="utf-8">
  <meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1">
  <?php
  $css_lang = isset($_GET['lang']) && $_GET['lang'] == "ar" ? "homertl.css" : "home.css";
  ?>
  <link rel="icon" type="image/x-icon" href="layout/imags/Peaky Zone.png">
  <link rel="stylesheet" href="layout/css/<?php echo $css_lang ?>">
  <link rel="stylesheet" href="layout/css/all.min.css">
  <link rel="stylesheet" href="layout/css/bootstrap.min.css">

</head>

<body>