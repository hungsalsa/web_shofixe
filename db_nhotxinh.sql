/*
Navicat MySQL Data Transfer

Source Server         : DATA
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_nhotxinh

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-09-13 12:26:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('admin', '1', '1534871718');
INSERT INTO `auth_assignment` VALUES ('author', '2', '1534871718');
INSERT INTO `auth_assignment` VALUES ('author', '6', '1534902702');

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('admin', '1', null, null, null, '1534871407', '1534871407');
INSERT INTO `auth_item` VALUES ('author', '1', null, null, null, '1534871406', '1534871406');
INSERT INTO `auth_item` VALUES ('quantri/categories/create', '2', 'quantri/categories/create', null, null, '1534870799', '1534870799');
INSERT INTO `auth_item` VALUES ('quantri/categories/delete', '2', 'quantri/categories/delete', null, null, '1534870799', '1534870799');
INSERT INTO `auth_item` VALUES ('quantri/categories/index', '2', 'quantri/categories/index', null, null, '1534870799', '1534870799');
INSERT INTO `auth_item` VALUES ('quantri/categories/update', '2', 'quantri/categories/update', null, null, '1534870799', '1534870799');
INSERT INTO `auth_item` VALUES ('quantri/categories/view', '2', 'quantri/categories/view', null, null, '1534870799', '1534870799');
INSERT INTO `auth_item` VALUES ('updateOwnPost', '2', 'Update own post', 'isAuthor', null, '1534912775', '1534912775');

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('admin', 'author');
INSERT INTO `auth_item_child` VALUES ('admin', 'quantri/categories/delete');
INSERT INTO `auth_item_child` VALUES ('admin', 'quantri/categories/update');
INSERT INTO `auth_item_child` VALUES ('author', 'quantri/categories/create');
INSERT INTO `auth_item_child` VALUES ('author', 'quantri/categories/index');
INSERT INTO `auth_item_child` VALUES ('author', 'quantri/categories/view');
INSERT INTO `auth_item_child` VALUES ('author', 'updateOwnPost');
INSERT INTO `auth_item_child` VALUES ('updateOwnPost', 'quantri/categories/update');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('isAuthor', 0x4F3A33353A22636F6D6D6F6E5C6D6F64756C65735C617574685C726261635C417574686F7252756C65223A333A7B733A343A226E616D65223B733A383A226973417574686F72223B733A393A22637265617465644174223B693A313533343931323737353B733A393A22757064617465644174223B693A313533343931323737353B7D, '1534912775', '1534912775');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1534855940');
INSERT INTO `migration` VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', '1534855940');

-- ----------------------------
-- Table structure for tbl_backend_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_backend_user`;
CREATE TABLE `tbl_backend_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `fullName` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authkey` char(50) NOT NULL,
  `created_et` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `user_add` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_backend_user
-- ----------------------------
INSERT INTO `tbl_backend_user` VALUES ('1', 'hung', 'hung ld', '12345', '123456a', '0', '0', '0');

-- ----------------------------
-- Table structure for tbl_ban
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ban`;
CREATE TABLE `tbl_ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_tua` int(11) NOT NULL,
  `birthday` date DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `relationship` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `price_sales` varchar(255) DEFAULT NULL,
  `loinhuan` int(11) NOT NULL,
  `gianet` int(11) NOT NULL COMMENT 'Chuyển thành lãi của người đós',
  `giaban` int(11) NOT NULL,
  `datcoc` int(11) DEFAULT NULL,
  `thanhtoan` int(11) NOT NULL,
  `ngayphaitt` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `note` text,
  `created_at` int(11) NOT NULL,
  `users_add` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_ban
-- ----------------------------
INSERT INTO `tbl_ban` VALUES ('1', 'Nguyễn Hoàng Nam', '5', '2018-08-01', '1', 'vo chong con cai', '0987803022', 'nam@gmail.com', 'nhung', '69000000', '6000000', '75000000', '40000', '74960000', '2018-08-30', '1', '<p><img src=\"http://local.xuan.vn/uploads/1.jpg\" alt=\"\" width=\"120\" height=\"160\" /></p>', '1534353339', '1');
INSERT INTO `tbl_ban` VALUES ('2', 'Nguyễn Hoàng Nam', '1', '1970-01-01', '1', 'vo chong con cai', '0987803022', 'nam@gmail.com', 'nhung', '1000000', '5000000', '6000000', '40000', '5960000', '1970-01-01', '1', '<p><img src=\"http://local.xuan.vn/uploads/1.jpg\" alt=\"\" width=\"722\" height=\"960\" /></p>', '1534401420', '1');
INSERT INTO `tbl_ban` VALUES ('3', 'Lê Minh Lâm', '4', '1970-01-01', '1', 'ko có', '0987231564', 'lam@gmail.com', 'Thắng', '10000000', '10000000', '20000000', '5000000', '15000000', '1970-01-01', '1', '<p>Kh&aacute;ch sẽ chuyển khoản</p>', '1534395464', '1');
INSERT INTO `tbl_ban` VALUES ('4', 'Hoàng Tùng Lâm', '2', '2018-08-01', '1', '', '', '', 'Minh', '2000000', '5000000', '7000000', '3000000', '4000000', '1970-01-01', '1', '<p><img src=\"http://local.xuan.vn/uploads/2.jpg?1534221123519\" alt=\"2\" /></p>', '1534228537', '1');
INSERT INTO `tbl_ban` VALUES ('5', 'Minh BOONG', '2', '1970-01-01', '1', '00000000000000000', '011545544', '', 'Hồng', '2300000', '3700000', '6000000', '4000000', '2000000', '1970-01-01', '1', '', '1534396610', '1');
INSERT INTO `tbl_ban` VALUES ('6', 'sssssssssssfdsf', '5', '1970-01-01', '1', 'fdssdf', '0987803022', '', 'fdssf', '56465', '443535', '500000', '35343', '464657', '1970-01-01', '1', '', '1534395759', '1');
INSERT INTO `tbl_ban` VALUES ('7', 'Nông Đức Mạnh', '1', '2018-08-01', '1', 'Vợ cháu', '0987803022', 'sada@ghj.vn', 'Hoa', '2000000', '10000000', '12000000', '10000000', '2000000', '2018-08-31', '1', '<p>aaaaaaaaaaaaaa</p>', '1534225959', '1');
INSERT INTO `tbl_ban` VALUES ('8', 'Hoàng Minh Ngân', '3', '2018-08-16', '1', 'Vợ bố con -', '01245676645', 'hak@gmail.com', 'Minh Lâm', '3600000', '900000', '4500000', '2000000', '2500000', '2018-08-16', '1', '<p>asd sdsdsdsdsdsdsdsdsdsddasdadada đấ dsad ad ada asda d&acirc; a</p>', '1534394880', '1');
INSERT INTO `tbl_ban` VALUES ('9', 'Minh Đức', '1', '2018-08-16', '1', 'CHƯƠNG TRÌNH TRI ÂN KHÁCH HÀNG 2018 ', '031455454', 'ertd@dfg.vn', 'ddddd', '10000000', '4000000', '14000000', '10000000', '4000000', '2018-08-30', '1', '<p><img src=\"https://mototech.com.vn/app/webroot/js/kcfinder/upload/images/tin-khuyen-mai/phu-tung-xe-may-tri-khach-hang-2018.jpg\" alt=\"bảo dưỡng xe m&aacute;y gi&aacute; rẻ\" /></p>\r\n<p>Mototech tr&acirc;n trong cảm ơn sự tin y&ecirc;u dịch vụ v&agrave; sự ủng hộ của Qu&yacute; Kh&aacute;ch h&agrave;ng trong thời gian qua.&nbsp;</p>\r\n<p>Ch&uacute;ng t&ocirc;i h&acirc;n hạnh gửi tới Qu&yacute; Kh&aacute;ch h&agrave;ng chương tr&igrave;nh khuyến mại tri &acirc;n 2018:</p>\r\n<ul>\r\n<li>Tặng 1 mũ bảo hiểm ti&ecirc;u chuẩn cho những h&oacute;a đơn tr&ecirc;n 1 triệu.</li>\r\n<li>Tặng 1 năm bảo hiểm xe m&aacute;y BIDV cho h&oacute;a đơn tr&ecirc;n 300k</li>\r\n<li>MIỄN PH&Iacute; rửa xe cho tất cả c&aacute;c xe đến với Mototech.</li>\r\n<li>MIỄN PH&Iacute; những bước bảo tr&igrave; cơ bản: Bơm lốp, tăng x&iacute;ch, chỉnh phanh cho tất cả c&aacute;c xe đến với Mototech.</li>\r\n</ul>\r\n<p>--------------------------------------------------</p>\r\n<p>Tham khảo th&ecirc;m g&oacute;i bảo dưỡng xe ga ti&ecirc;u chuẩn Click&nbsp;<a href=\"https://mototech.com.vn/p/goi-bao-duong-xe-ga-tieu-chuan\">V&agrave;o đ&acirc;y</a></p>\r\n<p>Tham khảo th&ecirc;m g&oacute;i bảo dưỡng xe ga cơ bản Click&nbsp;<a href=\"https://mototech.com.vn/p/bao-duong-xe-ga-co-ban\">V&agrave;o đ&acirc;y</a></p>\r\n<p>Tham khảo th&ecirc;m g&oacute;i bảo dưỡng xe số Cơ bản Click&nbsp;<a href=\"https://mototech.com.vn/p/bao-duong-co-ban-cho-xe-may\">V&agrave;o đ&acirc;y</a></p>\r\n<p>----------------------------------------------------</p>\r\n<p>Chương tr&igrave;nh diễn ra trong 13 ng&agrave;y tại 4 cơ sở của Mototech từ ng&agrave;y 30/07 đến ng&agrave;y 12/08.</p>\r\n<p>HỆ THỐNG CỬA H&Agrave;NG SỬA XE CHUY&Ecirc;N NGHIỆP MOTOTECH&nbsp;</p>\r\n<p>CS1 :135 Kim Ngưu - Hai B&agrave; Trưng, SĐT: 024.66847601<br />CS2: 64 Trung Văn - Nam Từ Li&ecirc;m, SĐT: 024.66847602<br />CS3: 212 Định C&ocirc;ng Thượng - Ho&agrave;ng Mai, SĐT: 024.66847603<br />CS4 : Số 11 - Ng&otilde; 381 Nguyễn Khang, SĐT: 024.38823879</p>\r\n<p>----------------------------------------------------</p>\r\n<p>Hỗ trợ online:<br />Website: mototech.com.vn<br />Fanpage:&nbsp;<a class=\"_58cn\" href=\"https://www.facebook.com/hashtag/suachuaxemaymototech?source=feed_text\">#suachuaxemaymototech</a><br />Cứu hộ xe m&aacute;y: 0982.618.518<br />Điện thoại: 024.66847600 - Hotline: 0985.557.937</p>', '1534396028', '1');

-- ----------------------------
-- Table structure for tbl_categories
-- ----------------------------
DROP TABLE IF EXISTS `tbl_categories`;
CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cateName` varchar(255) NOT NULL,
  `groupId` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `link` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `descriptions` mediumtext,
  `status` tinyint(4) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `userAdd` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_categories
-- ----------------------------
INSERT INTO `tbl_categories` VALUES ('1', 'About Mototech', '3', '0', '', '', null, 'Bảo dưỡng xe máy Honda', 'Bảo dưỡng xe máy Honda', 'Bảo dưỡng xe máy Honda\r\nBảo dưỡng xe máy Honda\r\nBảo dưỡng xe máy Honda\r\nBảo dưỡng xe máy Honda', '1', '0', '1534528520', '1');
INSERT INTO `tbl_categories` VALUES ('2', 'PA Mototec', '2', '0', 'Bảo dưỡng xe máy Yamaha', 'Bảo dưỡng xe máy Yamaha', null, 'Bảo dưỡng xe máy Yamaha', 'Bảo dưỡng xe máy Yamaha', 'Bảo dưỡng xe máy Yamaha\r\n', '1', '1534520276', '1534528503', '1');
INSERT INTO `tbl_categories` VALUES ('3', 'Tin Mototech', '3', '0', '', '', null, '', '', '', '1', '1534563855', '1534563855', '1');
INSERT INTO `tbl_categories` VALUES ('4', 'Chọn phụ tùng xe máy', '3', '3', '', '', null, 'Chọn phụ tùng xe máy', 'Chọn phụ tùng xe máy', 'Chọn phụ tùng xe máy Chọn phụ tùng xe máy', '1', '1534564138', '1534564138', '1');
INSERT INTO `tbl_categories` VALUES ('5', 'Bảo dưỡng xe máy', '3', '3', '', '', null, '', '', '', '1', '1534565223', '1534567376', '1');
INSERT INTO `tbl_categories` VALUES ('6', 'Sửa xe máy', '4', null, '', '', null, '', '', '', '0', '1534613785', '1534614156', '2');

-- ----------------------------
-- Table structure for tbl_group
-- ----------------------------
DROP TABLE IF EXISTS `tbl_group`;
CREATE TABLE `tbl_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupsName` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_group
-- ----------------------------
INSERT INTO `tbl_group` VALUES ('1', '--Danh mục root--', '1', '1534493498', '1534526144');
INSERT INTO `tbl_group` VALUES ('2', 'PA Mototech', '1', '1534493647', '1534520920');
INSERT INTO `tbl_group` VALUES ('3', 'Kỹ thuật', '1', '1534526438', '1534528965');

-- ----------------------------
-- Table structure for tbl_manufactures
-- ----------------------------
DROP TABLE IF EXISTS `tbl_manufactures`;
CREATE TABLE `tbl_manufactures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `slug` varchar(255) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `order` mediumint(9) DEFAULT NULL,
  `content` text CHARACTER SET latin1,
  `description` text CHARACTER SET latin1 NOT NULL,
  `keyword` text CHARACTER SET latin1,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_manufactures
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_models
-- ----------------------------
DROP TABLE IF EXISTS `tbl_models`;
CREATE TABLE `tbl_models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `order` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_models
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_news
-- ----------------------------
DROP TABLE IF EXISTS `tbl_news`;
CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `htmltitle` varchar(255) DEFAULT NULL,
  `htmlkeyword` varchar(255) DEFAULT NULL,
  `htmldescriptions` mediumtext,
  `content` mediumtext NOT NULL,
  `hot` int(11) NOT NULL DEFAULT '0',
  `view` int(11) DEFAULT '0',
  `tag` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `user_add` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_news
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_product
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `keyword` text CHARACTER SET latin1,
  `description` text CHARACTER SET latin1 NOT NULL,
  `short_introduction` text CHARACTER SET latin1,
  `content` text CHARACTER SET latin1 NOT NULL,
  `price` mediumint(9) DEFAULT NULL,
  `start_sale` date DEFAULT NULL,
  `end_sale` date DEFAULT NULL,
  `price_sales` mediumint(9) DEFAULT NULL,
  `order` mediumint(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `salse` tinyint(4) DEFAULT NULL,
  `hot` tinyint(4) DEFAULT NULL,
  `best_seller` tinyint(4) DEFAULT NULL,
  `new` tinyint(4) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL COMMENT 'Hãng sản xuất ra sản phẩm',
  `guarantee` int(11) DEFAULT NULL,
  `models_id` varchar(255) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Loại xe sử dụng sản phẩm',
  `views` int(11) DEFAULT NULL,
  `code` varchar(255) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Mã sản phẩm nếu có',
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `images_list` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `product_category_id` int(11) NOT NULL,
  `related_articles` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_product
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_product_category
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_category`;
CREATE TABLE `tbl_product_category` (
  `idCate` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cateName` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `keyword` mediumtext,
  `description` mediumtext,
  `content` mediumtext,
  `short_introduction` mediumtext,
  `home_page` tinyint(4) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `product_parent_id` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`idCate`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_product_category
-- ----------------------------
INSERT INTO `tbl_product_category` VALUES ('1', 'Dầu máy Castroll', 'Dầu máy Castroll', 'D?u Castroll', 'Dầu máy Castroll', 'Dầu máy CastrollDầu máy CastrollDầu máy Castroll', 'Dầu máy CastrollDầu máy CastrollDầu máy Castroll', 'Dầu máy CastrollDầu máy Castroll', '1', '', '1', '0', '0', '1536759923', '1536759923', '1');
INSERT INTO `tbl_product_category` VALUES ('2', 'Dầu máy Motul', 'Dầu máy Motul', 'D?u Castroll', 'D?u CastrollD?u Castroll', 'D?u CastrollD?u CastrollD?u CastrollD?u CastrollD?u Castroll', 'D?u Castroll', 'D?u CastrollD?u CastrollD?u Castroll', '1', '', '1', '0', '0', '1536759957', '1536759957', '1');
INSERT INTO `tbl_product_category` VALUES ('3', 'Dầu máy Liqui', 'Dầu máy Liqui', 'D?u Castroll', 'D?u CastrollD?u Castroll', 'D?u CastrollD?u CastrollD?u CastrollD?u CastrollD?u Castroll', 'D?u Castroll', 'D?u CastrollD?u CastrollD?u Castroll', '1', '', '1', '1', null, '1536759993', '1536766972', '1');
INSERT INTO `tbl_product_category` VALUES ('4', 'Dầu máy xe ga', 'Dầu máy xe ga', 'Dầu máy xe ga', 'Dầu máy xe ga', 'Dầu máy xe ga', 'Dầu máy xe gaDầu máy xe ga', 'Dầu máy xe gaDầu máy xe gaDầu máy xe ga', null, '', '2', '1', '1', '1536767104', '1536767137', '1');

-- ----------------------------
-- Table structure for tbl_product_properties
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_properties`;
CREATE TABLE `tbl_product_properties` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `product_id` int(4) DEFAULT NULL,
  `property_id` int(4) DEFAULT NULL,
  `value` text CHARACTER SET latin1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_product_properties
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_properties
-- ----------------------------
DROP TABLE IF EXISTS `tbl_properties`;
CREATE TABLE `tbl_properties` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `property_category_id` int(4) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_properties
-- ----------------------------
INSERT INTO `tbl_properties` VALUES ('1', 'Chiều rộng', '1', '0');
INSERT INTO `tbl_properties` VALUES ('2', 'chiều dài', '1', '0');
INSERT INTO `tbl_properties` VALUES ('3', '45x45cm', '1', '0');
INSERT INTO `tbl_properties` VALUES ('4', '45cm', '1', '0');

-- ----------------------------
-- Table structure for tbl_property_categories
-- ----------------------------
DROP TABLE IF EXISTS `tbl_property_categories`;
CREATE TABLE `tbl_property_categories` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_property_categories
-- ----------------------------
INSERT INTO `tbl_property_categories` VALUES ('1', 'Kích thước');
INSERT INTO `tbl_property_categories` VALUES ('2', 'Trọng lượng');
INSERT INTO `tbl_property_categories` VALUES ('3', 'Năm sản xuất');
INSERT INTO `tbl_property_categories` VALUES ('5', 'Xuất xứ');
INSERT INTO `tbl_property_categories` VALUES ('6', 'Thể tích');

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `fullname` (`fullname`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `fullname` (`fullname`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'Lê Văn Hưng', 'pkHWEe0Vj6vdZ18rfE898DlmKH90kz1G', '$2y$13$Q0KAj/8jWk.XxWhuH805HuYokziPqdWpytSLCJlJbfwcFv3aAD1n.', null, 'admin@gmail.com', '10', '1534845575', '1534845575');
INSERT INTO `user` VALUES ('2', 'test', 'Nguyễn Hoàng Nam', 'zR_HrHmKVHWDBGIYAw4M9DtnRBfgmeiZ', '$2y$13$jreKTu8LjA4X7/BjYw.4J.eG8n6N3/h0eazHxwIJeHIpCyhiq5j7y', null, 'a@gmail.com', '10', '1534872565', '1534872565');
INSERT INTO `user` VALUES ('3', 'author', 'Hoang lan', 'eiNMb3jini7e5Tc9NKetK0_BFijUvNWU', '$2y$13$l7b3wb40MR8UVKMPkijV5.jKOzbFJF.noH8llorC0nPn8p7fYAqnq', null, 'author@gmail.com', '10', '1534902214', '1534902214');
INSERT INTO `user` VALUES ('6', 'author2', 'Hoang lan', 'AbHWnrMh4bLO06a19jETwbBw8qfE2lTG', '$2y$13$g7HaPx3af5G2dnMMFa1DbeBmzUPYlgD7Ai8cUM0rfub.PyYdYBBW.', null, 'auth2or@gmail.com', '10', '1534902702', '1534902702');
