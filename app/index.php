<?php

require_once dirname(__DIR__) . "/config/bootstrap.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://dev.1c-bitrix.ru/bitrix/js/ui/buttons/src/css/ui.buttons.css">
    <link rel="stylesheet" href="https://dev.1c-bitrix.ru/bitrix/js/ui/progressbar/ui.progressbar.min.css?16655106043702">
    <link rel="stylesheet" href="https://dev.1c-bitrix.ru/bitrix/js/ui/forms/ui.forms.min.css">
    <link rel="stylesheet" href="https://dev.1c-bitrix.ru/bitrix/js/ui/alerts/src/ui.alert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=$_ENV['WORK_DIRECTORY']?>/app/dist/content.bundle.css">
    <script src="//api.bitrix24.com/api/v1/"></script>
    <title>Стартовая страница</title>
</head>
<body>


<div>
    <div id="app"></div>
</div>

<script>
    const AUTH_OBJECT = <?=(new \Sw24\Bitrix24Auth\Bitrix24Client())->getAuthObject();?>;
    const PLACEMENT_OPTIONS = <?=$_REQUEST['PLACEMENT_OPTIONS'] ?? '{}';?>;

    const domainName = 'skyweb24.ru'

    const linkTag = document.createElement('link')
    linkTag.rel = 'stylesheet'
    linkTag.href = `https://${domainName}/bitrix/js/ui/icon-set/main/style.min.css`
    document.head.appendChild(linkTag)
</script>
<script src="<?=$_ENV['WORK_DIRECTORY']?>/app/dist/content.bundle.js"></script>

</body>
</html>
