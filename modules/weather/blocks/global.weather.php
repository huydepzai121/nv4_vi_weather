<?php

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!nv_function_exists('nv_block_weather')) {

    function nv_block_weather_config($module, $data_block)
    {
        global $db, $nv_Lang;

        // Kết nối đến cơ sở dữ liệu
        $db->sqlreset()
            ->select('id, name_city')
            ->from(NV_PREFIXLANG . '_weather_city');

        $result = $db->query($db->sql());

        // Kiểm tra kết quả truy vấn
        if ($result->rowCount() > 0) {
            // Tạo select box
            $html = '<div class="form-group">';
            $html .= '<label class="control-label col-sm-6" for="city_name">' . $nv_Lang->getModule('name_city') . ':</label>';
            $html .= '<div class="col-sm-18"><select class="form-control" name="config_cityname">';

            while ($row = $result->fetch()) {
                $selected = ($data_block['cityname'] == $row['id']) ? 'selected' : '';
                $html .= '<option value="' . $row['name_city'] . '" ' . $selected . '>' . $row['name_city'] . '</option>';
            }

            $html .= '</select></div>';
            $html .= '</div>';

            return $html;
        }
    }

    /**
     * nv_menu_theme_clock_digital_submit()
     *
     * @param string $module
     * @return array
     */
    function nv_block_weather_submit($module)
    {
        global $nv_Request;
        $return = [];
        $return['error'] = [];
        $return['config']['cityname'] = $nv_Request->get_title('config_cityname', 'post,get', '');
        return $return;
    }

    function nv_block_weather($block_config)
    {
        global $site_mods, $module_info, $module_name, $global_config, $module_data;

        $apiKey = "c06e18684099c1114a22ac4e14f91004";
        if (!empty($block_config['cityname'])) {
            $cityName = $block_config['cityname'];
            $cityName = change_alias($cityName);
            $cityName = str_replace('-', ' ', $cityName);

            $units = "metric";
            $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($cityName) . "&units=" . $units . "&appid=" . $apiKey;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            $response = curl_exec($ch);
            curl_close($ch);

            $weather_data = json_decode($response, true);

            if (!empty($weather_data) && $weather_data['cod'] == 200) {
                $xtpl = new XTemplate('global.weather.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_name);
                $xtpl->assign('TEMP', round($weather_data['main']['temp']));
                $xtpl->assign('DESCRIPTION', ucfirst($weather_data['weather'][0]['description']));
                $xtpl->assign('CITY', $weather_data['name']);
                $xtpl->assign('ICON', 'http://openweathermap.org/img/w/' . $weather_data['weather'][0]['icon'] . '.png');

                $xtpl->parse('main');
                return $xtpl->text('main');
            }
        }
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_block_weather($block_config);
}