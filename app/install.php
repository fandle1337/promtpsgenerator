<?php

use App\Helper\HelperFileVersion;

require_once dirname(__DIR__) . "/config/bootstrap.php";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://dev.1c-bitrix.ru/bitrix/js/ui/buttons/src/css/ui.buttons.css">
    <link rel="stylesheet" href="https://dev.1c-bitrix.ru/bitrix/js/ui/forms/ui.forms.min.css">
    <title>Установка приложения</title>
    <link rel="stylesheet" href="<?= HelperFileVersion::get('/app/dist/install.bundle.css') ?>">
</head>
<body>

<div id="app"></div>

<script>
    const AUTH_OBJECT = <?=(new \Sw24\Bitrix24Auth\Bitrix24Client())->getAuthObject();?>;
</script>
<script src="//api.bitrix24.com/api/v1/"></script>
<script src="<?= HelperFileVersion::get('/app/dist/install.bundle.js') ?>"></script>
</body>
</html>