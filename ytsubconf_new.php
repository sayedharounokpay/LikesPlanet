<?php

include('config.php');
foreach ($_GET as $key => $value) {
    $protect[$key] = filter($value);
}

if (!isset($data->login)) {
    echo '<script>document.location="ytsub.php";</script>';
    exit;
}

require 'youtube_sub_app.php';

$site_id = $protect['sid'];
$site_user = $protect['user'];
$ytsub = $protect['ytsub'];

if (empty($site_id) || empty($ytsub)) {
    $_SESSION['err_message'] = '<font size="4" color="red">Not Subscribed!</font>';
    echo '<script>document.location="ytsub.php";</script>';
}

$youbuteSub->setToken();
$youbuteSub->setHitNum($data);
$siteRes = $youbuteSub->checkSubState($data, $site_id, $site_user);
if (intval($siteRes['rownum']) < 1) {
    $_SESSION['err_message'] = '<font size="4" color="red">You have been subscribed.</font>';
    echo '<script>document.location="ytsub.php";</script>';
    exit();
} else {
    $res = $youbuteSub->isVaildTokenOrNot();
    if ($res !== true) {
        $_SESSION['err_message'] = '<font size="4" color="red">' . $res . '</font>';
        echo '<script>document.location="ytsub.php";</script>';
        exit();
    }

    $subRes = $youbuteSub->subscribChannel($ytsub);
    if ($subRes !== true) {
        $_SESSION['err_message'] = '<font size="4" color="red">Not Subscribed! ' . $subRes . '</font>';
        echo '<script>document.location="ytsub.php";</script>';
        exit();
    } else {
        $youbuteSub->addSubData($siteRes['res'], $data);
        $_SESSION['err_message'] = '<font size="4" color="green">Ok. Points Added.</font>';
        echo '<script>document.location="ytsub.php";</script>';
    }
}
?>