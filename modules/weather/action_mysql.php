<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2023 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_MODULES')) {
    exit('Stop!!!');
}

$sql_drop_module = [];

$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . '_city;';
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $lang . '_' . $module_data . ';';

$sql_create_module = $sql_drop_module;

// # 1. Bảng thành phố
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_city (
    id int(11) unsigned NOT NULL AUTO_INCREMENT,
    name_city varchar(255) NOT NULL DEFAULT '' COMMENT 'Tên thành phố',
    zipcode varchar(255) NOT NULL DEFAULT '' COMMENT 'Mã bưu chính',
    nation_name varchar(255) NOT NULL DEFAULT '' COMMENT 'Quốc gia',
    add_time int(11) NOT NULL DEFAULT '0' COMMENT 'Thời gian thêm',
    update_time int(11) NOT NULL DEFAULT '0' COMMENT 'Thời gian cập nhật',
    weight smallint(4) NOT NULL DEFAULT '0' COMMENT 'Thứ tự',
    PRIMARY KEY (id)
) ENGINE=InnoDB";

// # 2. Bảng dữ liệu thành phố cho 63 tỉnh thành
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_city (id, name_city, zipcode, nation_name, add_time, update_time, weight) VALUES
    (1, 'Hà Nội', '100000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 1),
    (2, 'Hà Giang', '310000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 2),
    (3, 'Cao Bằng', '260000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 3),
    (4, 'Bắc Kạn', '230000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 4),
    (5, 'Tuyên Quang', '250000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 5),
    (6, 'Lào Cai', '330000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 6),
    (7, 'Điện Biên', '380000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 7),
    (8, 'Lai Châu', '390000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 8),
    (9, 'Sơn La', '360000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 9),
    (10, 'Yên Bái', '320000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 10),
    (11, 'Hòa Bình', '350000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 11),
    (12, 'Thái Nguyên', '250000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 12),
    (13, 'Lạng Sơn', '170000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 13),
    (14, 'Quảng Ninh', '200000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 14),
    (15, 'Bắc Giang', '260000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 15),
    (16, 'Phú Thọ', '340000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 16),
    (17, 'Vĩnh Phúc', '290000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 17),
    (18, 'Bắc Ninh', '210000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 18),
    (19, 'Hải Dương', '320000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 19),
    (20, 'Hải Phòng', '180000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 20),
    (21, 'Hưng Yên', '330000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 21),
    (22, 'Thái Bình', '410000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 22),
    (23, 'Hà Nam', '410000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 23),
    (24, 'Nam Định', '420000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 24),
    (25, 'Ninh Bình', '430000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 25),
    (26, 'Thanh Hóa', '440000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 26),
    (27, 'Nghệ An', '460000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 27),
    (28, 'Hà Tĩnh', '480000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 28),
    (29, 'Quảng Bình', '510000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 29),
    (30, 'Quảng Trị', '520000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 30),
    (31, 'Thừa Thiên Huế', '530000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 31),
    (32, 'Đà Nẵng', '550000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 32),
    (33, 'Quảng Nam', '560000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 33),
    (34, 'Quảng Ngãi', '570000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 34),
    (35, 'Bình Định', '590000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 35),
    (36, 'Phú Yên', '620000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 36),
    (37, 'Khánh Hòa', '650000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 37),
    (38, 'Ninh Thuận', '660000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 38),
    (39, 'Bình Thuận', '800000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 39),
    (40, 'Kon Tum', '580000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 40),
    (41, 'Gia Lai', '600000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 41),
    (42, 'Đắk Lắk', '630000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 42),
    (43, 'Đắk Nông', '640000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 43),
    (44, 'Lâm Đồng', '670000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 44),
    (45, 'Bình Phước', '830000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 45),
    (46, 'Tây Ninh', '860000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 46),
    (47, 'Bình Dương', '820000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 47),
    (48, 'Đồng Nai', '810000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 48),
    (49, 'Bà Rịa - Vũng Tàu', '790000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 49),
    (50, 'TP Hồ Chí Minh', '700000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 50),
    (51, 'Long An', '850000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 51),
    (52, 'Tiền Giang', '860000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 52),
    (53, 'Bến Tre', '930000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 53),
    (54, 'Trà Vinh', '940000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 54),
    (55, 'Vĩnh Long', '890000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 55),
    (56, 'Đồng Tháp', '870000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 56),
    (57, 'An Giang', '900000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 57),
    (58, 'Kiên Giang', '920000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 58),
    (59, 'Cần Thơ', '940000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 59),
    (60, 'Hậu Giang', '950000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 60),
    (61, 'Sóc Trăng', '950000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 61),
    (62, 'Bạc Liêu', '960000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 62),
    (63, 'Cà Mau', '970000', 'Việt Nam', " . NV_CURRENTTIME . ", 0, 63)";
