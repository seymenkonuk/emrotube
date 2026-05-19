<?php

use Seymen\PhpMvcTemplate\Config\AppConfig;
use Seymen\PhpMvcTemplate\Core\Request;

?>

<?

/** @var string $title */

?>

<?php
$brandName = AppConfig::APP_NAME;
$csrfToken = Request::getCsrfToken() ?? "";
?>

<!DOCTYPE html>
<html lang="TR">

<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content='width=device-width, initial-scale=1' />
    <meta name="theme-color" content="#F3F4F6">
    <meta name="csrf-token" content="<?= $this->escape($csrfToken) ?>">

    <title><?= $this->escape($title) ?> - <?= $this->escape($brandName) ?></title>

    <link rel="manifest" href="/manifest.json">

    <link rel="stylesheet" href="/static/css/tailwind.css">
    <link rel="stylesheet" href="/static/css/hideScrollbar.css">
    <link rel="stylesheet" href="/static/css/bootstrap-icons/bootstrap-icons.css">
    <?= $this->section('styles') ?>

</head>

<body class="bg-gray-100 flex min-h-screen">

    <?= $this->section('content') ?>

    <script src="/static/js/addCsrfToken.js"></script>
    <script src="/static/js/hamburgerMenu.js"></script>
    <script src="/static/js/replaceWithFetch.js"></script>
    <script src="/static/js/sanitizeForm.js"></script>
    <script src="/static/js/textareaAutoResize.js"></script>
    <script src="/static/js/togglePassword.js"></script>
    <script src="/static/js/swRegister.js"></script>
    <?= $this->section('scripts') ?>

</body>

</html>