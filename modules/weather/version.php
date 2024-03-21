<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE')) {
    exit('Stop!!!');
}

$module_version = [
    'name' => 'Dự báo thời tiết', // Tieu de module
    'modfuncs' => 'main', // Khai báo bao nhiêu fun hỗ trợ block ở ngoài sitef
    'change_alias' => 'main', // Các fun hỗ trợ đổi alias
    'submenu' => 'main', // Các fun hỗ trợ tạo menu con
    'is_sysmod' => 0,  // 1:0 => Co phai la module he thong hay khong
    'virtual' => 0, // 1:0 => Co cho phep ao hao module hay khong
    'version' => '4.6.00',
    'date' => 'Monday, February 19, 2024 21:00:00 PM GMT+07:00', // Ngay phat hanh phien ban
    'author' => 'Nguyễn Thế Huy (nguyenthehuy977943@gmail.com)',
    'note' => 'Module Dụ báo thời tiết', // Ghi chu
    'uploads_dir' => [  
        $module_upload
    ]
];
