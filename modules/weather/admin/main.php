<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    exit('Stop!!!');
}

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$page_title = $nv_Lang->getModule('main_admin');
$error = [];
$data = [
    'name_city' => '',
    'zipcode' => '',
    'nation_name' => '',
];

$data['id'] = $nv_Request->get_int('id', 'post,get', 0);

if ($nv_Request->isset_request('submit', 'post,get')) {
    $data['name_city'] = $nv_Request->get_title('name_city', 'post', '');
    $data['zipcode'] = $nv_Request->get_title('zipcode', 'post', '');
    $data['nation_name'] = $nv_Request->get_title('nation_name', 'post', '');
    $data['weight'] = $db->query('SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_city')->fetchColumn();
    $data['weight'] = intval($data['weight']) + 1;

    if (empty($data['name_city'])) {
        $error[] = $nv_Lang->getModule('error_required_name_city');
    }

    if (empty($data['zipcode'])) {
        $error[] = $nv_Lang->getModule('error_required_zipcode');
    }

    if (empty($data['nation_name'])) {
        $error[] = $nv_Lang->getModule('error_required_nation_name');
    }

    if (empty($error)) {
        try {
            if ($data['id'] > 0) {
                $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_city SET name_city = :name_city, zipcode = :zipcode, nation_name = :nation_name, update_time = :update_time  WHERE id = ' . $data['id']);
                $stmt->bindValue(':update_time', NV_CURRENTTIME);
            } else {
                $stmt = $db->prepare('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_city (name_city, zipcode, nation_name, add_time, weight) VALUES (:name_city, :zipcode, :nation_name, :add_time, :weight)');
                $stmt->bindValue(':add_time', NV_CURRENTTIME);
                $stmt->bindParam(':weight', $data['weight'], PDO::PARAM_INT);
            }
            $stmt->bindParam(':name_city', $data['name_city'], PDO::PARAM_STR);
            $stmt->bindParam(':zipcode', $data['zipcode'], PDO::PARAM_STR);
            $stmt->bindParam(':nation_name', $data['nation_name'], PDO::PARAM_STR);
            $stmt->execute();
            if ($data['id'] > 0) {
                nv_insert_logs(NV_LANG_DATA, $module_name, 'Edit_city', 'ID: ' . $data['id'], $admin_info['userid']);
            } else {
                nv_insert_logs(NV_LANG_DATA, $module_name, 'Add_city', ' ', $admin_info['userid']);
            }
            $nv_Cache->delMod($module_name);
            nv_redirect_location($base_url);
        } catch (PDOException $e) {
            trigger_error($e->getMessage());
            $error[] = $nv_Lang->getModule('errorsave');
        }
    }
}

// xóa
if ($nv_Request->isset_request('action', 'post,get')) {
    if ($data['id'] > 0) {
        if ($nv_Request->get_title('checksess', 'post,get', '') === md5($data['id'] . NV_CHECK_SESSION)) {
            $sql = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_city WHERE id = ' . $data['id'];
            $sth = $db->prepare($sql);
            $sth->execute();
            nv_insert_logs(NV_LANG_DATA, $module_name, 'Delete_city', 'ID: ' . $data['id'], $admin_info['userid']);
            $nv_Cache->delMod($module_name);
            nv_redirect_location($base_url);
        }
    }
}

if ($nv_Request->isset_request('change_weight', 'post,get')) {
    $id = $nv_Request->get_int('id', 'post,get', 0);
    $newWeight = $nv_Request->get_int('new_weight', 'post,get', 0);
    if ($id > 0 && $newWeight > 0) {
        $sql = "SELECT id, weight FROM " . NV_PREFIXLANG . "_" . $module_data . "_city WHERE id != :id ORDER BY weight ASC";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $weight = 0;
        $items = $stmt->fetchAll();

        foreach ($items as $row) {
            $weight++;
            if ($weight == $newWeight) {
                $weight++;
            }

            $updateSql = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_city SET weight = :weight WHERE id = :id";
            $updateStmt = $db->prepare($updateSql);
            $updateStmt->bindParam(':weight', $weight, PDO::PARAM_INT);
            $updateStmt->bindParam(':id', $row['id'], PDO::PARAM_INT);
            $updateStmt->execute();
        }


        $sql = "UPDATE " . NV_PREFIXLANG . "_" . $module_data . "_city SET weight = :new_weight WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':new_weight', $newWeight, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

if ($data['id'] > 0) {
    $data = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_city WHERE id = ' . $data['id'])->fetch();
    if (empty($data)) {
        nv_redirect_location($base_url);
    }
}

$perpage = 5;
$page = $nv_Request->get_int('page', 'get', 1);
$db->sqlreset()
    ->select('COUNT(*)')
    ->from(NV_PREFIXLANG . '_' . $module_data . '_city');
$total = $db->query($db->sql())->fetchColumn();

$db->select('*')
    ->from(NV_PREFIXLANG . '_' . $module_data . '_city')
    ->order('weight ASC')
    ->limit($perpage)
    ->offset(($page - 1) * $perpage);
$sth = $db->query($db->sql());
$city = [];
while ($row = $sth->fetch()) {
    $city[] = $row;
}

if ($page > 1 && empty($city)) {
    nv_redirect_location($base_url);
}

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', \NukeViet\Core\Language::$lang_module);
$xtpl->assign('GLANG', \NukeViet\Core\Language::$lang_global);

if (!empty($city)) {
    $i = ($page - 1) * $perpage;
    foreach ($city as $row) {
        for ($j = 1; $j <= $total; $j++) {
            $xtpl->assign('WEIGHT', $j);
            $xtpl->assign('WEIGHT_SELECTED', $j == $row['weight'] ? 'selected="selected"' : '');
            $xtpl->parse('main.loop.weight');
        }
        $row['url_edit'] = $base_url . '&id=' . $row['id'];
        $row['url_delete'] = $base_url . '&action=delete&id=' . $row['id'] . '&checksess=' . md5($row['id'] . NV_CHECK_SESSION);
        $xtpl->assign('ROW', $row);
        $xtpl->parse('main.loop');
    }

    $generate_page = nv_generate_page($base_url, $total, $perpage, $page);
    if (!empty($generate_page)) {
        $xtpl->assign('GENERATE_PAGE', $generate_page);
        $xtpl->parse('main.generate_page');
    }
}

if (!empty($error)) {
    $xtpl->assign('ERROR', implode('<br />', $error));
    $xtpl->parse('main.error');
}

$xtpl->assign('DATA', $data);

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
