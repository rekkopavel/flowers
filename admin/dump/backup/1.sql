-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ����� ��������: ��� 17 2009 �., 23:39
-- ������ �������: 5.0.45
-- ������ PHP: 5.2.4
-- 
-- ��: `dostavka`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `smi_subphoto`
-- 

CREATE TABLE `smi_subphoto` (
  `id` int(8) NOT NULL auto_increment,
  `pid` int(8) NOT NULL default '0',
  `sid` int(8) NOT NULL,
  `num` int(5) NOT NULL default '0',
  `comment` text NOT NULL,
  `alt` varchar(255) NOT NULL default '',
  `type` varchar(20) NOT NULL default '',
  `last` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=cp1251 AUTO_INCREMENT=85 ;

-- 
-- ���� ������ ������� `smi_subphoto`
-- 

INSERT INTO `smi_subphoto` VALUES (63, 234, 0, 5, '��.������� �������, ���.\\"������\\" ���.8-910-308-55-57', '', 'image/jpeg', 0);
INSERT INTO `smi_subphoto` VALUES (69, 234, 0, 6, '��.����������, ���.����� ��.���������, ������ �������,���.8-910-308-55-62 ', '', 'image/jpeg', 0);
INSERT INTO `smi_subphoto` VALUES (78, 234, 60, 1, '3333333', '', 'image/jpeg', 0);
INSERT INTO `smi_subphoto` VALUES (83, 234, 59, 1, '1111111', '1', 'image/jpeg', 0);
INSERT INTO `smi_subphoto` VALUES (81, 234, 60, 1, '11111', '', 'image/jpeg', 0);
        