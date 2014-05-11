SET @iMaxOrder = (SELECT `menu_order` + 1 FROM `sys_options_cats` ORDER BY `menu_order` DESC LIMIT 1);
INSERT INTO `sys_options_cats` (`name`, `menu_order`) VALUES ('Multiadmin access', @iMaxOrder);
SET @iCategId = (SELECT LAST_INSERT_ID());

INSERT INTO `sys_permalinks` VALUES (NULL, 'modules/?r=multiadmin/', 'm/multiadmin/', 'ma_permalinks');



ALTER TABLE  `sys_menu_admin` ADD  `access` VARCHAR( 255 ) NOT NULL DEFAULT  '1';


UPDATE  `sys_menu_admin` SET  `access` = 1;

INSERT INTO `sys_menu_admin` (`id`, `parent_id`, `name`, `title`, `url`, `description`, `icon`, `icon_large`, `check`, `order`, `access`) VALUES (NULL, '0', 'Multiadmin access', '_admin_access', '{siteAdminUrl}admin_access.php', 'Add and change admin access levels', 'admin_access.png', 'admin_access_l.png', '', '0', 1);
