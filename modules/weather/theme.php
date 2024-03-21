<?php

if (!defined('NV_IS_MOD_WEATHER')) {
    exit('Stop!!!');
}

function nv_weather_main() {
    global $nv_Lang, $module_info, $module_name, $module_file, $global_config;
    $xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
    $xtpl->assign('GLANG', \NukeViet\Core\Language::$lang_global);
    $xtpl->assign('PAGE_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name);

    $xtpl->parse('main');
    return $xtpl->text('main');
}