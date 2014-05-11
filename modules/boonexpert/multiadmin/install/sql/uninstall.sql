
INSERT INTO `sys_options_cats` (`name`, `menu_order`) VALUES ('Multiadmin access', @iMaxOrder);

DELETE FROM `sys_options_cats` WHERE `name` = 'Multiadmin access';

DELETE FROM `sys_permalinks` WHERE  `standard`='modules/?r=multiadmin/';

ALTER TABLE  `sys_menu_admin` DROP  `access`;
DELETE FROM `sys_menu_admin` WHERE `name` = 'Multiadmin access';