<?php

if (!defined('NV_IS_MOD_WEATHER')) {
    exit('Stop!!!');
}

$page_url = $base_url;

$contents = nv_weather_main();

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
