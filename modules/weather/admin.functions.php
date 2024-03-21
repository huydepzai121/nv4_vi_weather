<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN')) {
    exit('Stop!!!');
}

define('NV_IS_FILE_ADMIN', true);

// Quy định những file nào được phép xử lý
$allow_func = [
    'main',
];

// Tất cả quản trị của site
global $array_user_id_users;
$_sql = 'SELECT tb1.userid, tb1.first_name, tb1.last_name, tb1.username, tb1.email FROM ' . NV_USERS_GLOBALTABLE . ' tb1 INNER JOIN ' . $db_config['prefix'] . '_authors tb2 ON tb1.userid = tb2.admin_id WHERE tb1.userid IN (SELECT `admin_id` FROM ' . NV_AUTHORS_GLOBALTABLE . ' ORDER BY lev ASC) AND tb1.active = 1 AND tb2.is_suspend = 0';
$array_user_id_users = $nv_Cache->db($_sql, 'userid', 'users');
