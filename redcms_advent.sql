-- phpMyAdmin SQL Dump
-- version 3.0.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 29. November 2008 um 14:59
-- Server Version: 5.0.67
-- PHP-Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `redcms_advent`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `box`
--

DROP TABLE IF EXISTS `box`;
CREATE TABLE IF NOT EXISTS `box` (
  `id` int(11) NOT NULL auto_increment,
  `page_id` int(11) NOT NULL,
  `template` varchar(255) default NULL,
  `title` varchar(255) NOT NULL,
  `teaser` text NOT NULL,
  `body` text NOT NULL,
  `sorted` int(11) default '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `access` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `box`
--

INSERT INTO `box` (`id`, `page_id`, `template`, `title`, `teaser`, `body`, `sorted`, `created`, `modified`, `published`, `access`) VALUES
(1, 1, NULL, 'Erste Box', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vestibulum luctus auctor nulla. Duis ac eros quis lacus viverra auctor. Phasellus semper tempus dui. Sed accumsan tempus neque. Duis convallis massa non tellus. In euismod facilisis nulla. Nullam at nulla non risus facilisis aliquet. Nam sem. Suspendisse et justo at ipsum rutrum tempus. Fusce pellentesque. Nulla blandit ornare ipsum. Vivamus vel massa. Integer non magna. Suspendisse feugiat posuere neque. Ut volutpat ultrices lacus. Vivamus sed augue. Cras non risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>', '<p>In justo elit, varius et, iaculis a, eleifend vestibulum, erat. Praesent condimentum rutrum mi. Pellentesque id nisi. Donec id ligula. Vestibulum turpis lorem, pellentesque a, varius eget, auctor et, metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque ac massa. Suspendisse ac orci. Aenean nec metus. Cras urna sapien, porta id, ultrices nec, semper quis, nulla. Integer accumsan neque sit amet purus. Aenean sodales tellus molestie enim. Etiam consequat sollicitudin metus. Phasellus ante ligula, iaculis mattis, varius id, lobortis ac, odio. Duis magna.</p>', 0, '2008-11-10 00:00:00', '2008-11-15 11:13:16', 1, 0),
(2, 1, NULL, 'Zweite Box', '<p>In justo elit, varius et, iaculis a, eleifend vestibulum, erat. Praesent condimentum rutrum mi. Pellentesque id nisi. Donec id ligula. Vestibulum turpis lorem, pellentesque a, varius eget, auctor et, metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque ac massa. Suspendisse ac orci. Aenean nec metus. Cras urna sapien, porta id, ultrices nec, semper quis, nulla. Integer accumsan neque sit amet purus. Aenean sodales tellus molestie enim. Etiam consequat sollicitudin metus. Phasellus ante ligula, iaculis mattis, varius id, lobortis ac, odio. Duis magna.</p>', '<p>Nulla facilisi. Pellentesque eu est. Suspendisse molestie diam et justo. Quisque aliquet, erat eget lacinia malesuada, urna enim convallis urna, id condimentum quam leo id velit. In imperdiet molestie purus. Phasellus aliquam, quam eget accumsan ullamcorper, libero lectus pharetra ligula, vitae ornare erat massa id libero. Fusce et orci non nisi sagittis ullamcorper. Donec sed arcu in metus consequat imperdiet. Nulla ullamcorper lacus at nisl. Nullam purus orci, accumsan et, sagittis non, porttitor eget, risus. Donec gravida eros vel elit adipiscing euismod. Aliquam ultrices ipsum et libero. Aliquam eu ante ut felis vestibulum tempor.</p>', 1, '2008-11-01 00:00:00', '2008-11-15 11:13:16', 1, 0),
(3, 1, NULL, 'dritte Box', '<p>Nulla facilisi. Pellentesque eu est. Suspendisse molestie diam et justo. Quisque aliquet, erat eget lacinia malesuada, urna enim convallis urna, id condimentum quam leo id velit. In imperdiet molestie purus. Phasellus aliquam, quam eget accumsan ullamcorper, libero lectus pharetra ligula, vitae ornare erat massa id libero. Fusce et orci non nisi sagittis ullamcorper. Donec sed arcu in metus consequat imperdiet. Nulla ullamcorper lacus at nisl. Nullam purus orci, accumsan et, sagittis non, porttitor eget, risus. Donec gravida eros vel elit adipiscing euismod. Aliquam ultrices ipsum et libero. Aliquam eu ante ut felis vestibulum tempor.</p>', '<p>Maecenas vitae ipsum feugiat nisl luctus eleifend. Vivamus augue purus, molestie sed, vehicula nec, bibendum at, elit. In velit sapien, aliquam non, pulvinar eu, imperdiet eu, nunc. Curabitur congue ornare odio. Aliquam placerat imperdiet mi. Duis rhoncus leo a nulla. Duis velit mi, vestibulum nec, tristique vitae, posuere vel, nisi. Vivamus mi. Mauris dapibus risus eu lorem. Sed sagittis, dolor sed egestas pellentesque, mi orci lacinia sapien, vitae hendrerit mi diam ultrices turpis. Sed dui. Suspendisse diam tellus, bibendum vel, posuere sed, venenatis ac, ligula. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec accumsan lacus in massa. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris eleifend aliquet est. Quisque sagittis magna id ipsum.</p>', 2, '2008-10-02 00:00:00', '2008-11-15 11:13:16', 1, 0),
(4, 1, NULL, 'vierte Box', '<p>Maecenas vitae ipsum feugiat nisl luctus eleifend. Vivamus augue purus, molestie sed, vehicula nec, bibendum at, elit. In velit sapien, aliquam non, pulvinar eu, imperdiet eu, nunc. Curabitur congue ornare odio. Aliquam placerat imperdiet mi. Duis rhoncus leo a nulla. Duis velit mi, vestibulum nec, tristique vitae, posuere vel, nisi. Vivamus mi. Mauris dapibus risus eu lorem. Sed sagittis, dolor sed egestas pellentesque, mi orci lacinia sapien, vitae hendrerit mi diam ultrices turpis. Sed dui. Suspendisse diam tellus, bibendum vel, posuere sed, venenatis ac, ligula. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec accumsan lacus in massa. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris eleifend aliquet est. Quisque sagittis magna id ipsum.</p>', '<p>Maecenas lacinia, nisi at aliquam tincidunt, elit leo viverra lacus, tempus consectetuer risus lorem at lacus. Vestibulum semper. Cras bibendum, lacus at tincidunt gravida, velit augue fermentum erat, nec adipiscing sem augue id justo. Aliquam velit. Phasellus magna est, condimentum non, laoreet eu, sodales non, velit. Maecenas scelerisque sapien non tellus. Aliquam erat volutpat. Nunc quam ante, faucibus sit amet, dictum quis, iaculis sed, tortor. Maecenas id justo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus mattis, tortor vitae placerat placerat, nibh turpis pretium felis, molestie mattis justo ante eget ante. Pellentesque eget odio vitae dui luctus porttitor. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet quam. Nunc interdum, enim eu rhoncus adipiscing, arcu tortor semper odio, nec pellentesque velit neque in lectus. Cras ut justo ac orci dapibus feugiat. Nullam dictum euismod velit.</p>', 3, '2008-10-19 00:00:00', '2008-11-15 11:13:16', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `access` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `page_id`, `name`, `title`, `created`, `modified`, `published`, `access`) VALUES
(1, 0, 1, 'Startseite', 'Hier geht es zur Startseite', '2008-11-12 15:29:09', '2008-11-12 15:29:09', 1, 0),
(2, 1, 2, 'meine Testseite', 'Hier bitte nicht klicken', '2008-11-12 16:20:12', '2008-11-15 09:32:40', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL auto_increment,
  `template` varchar(255) NOT NULL,
  `author` varchar(255) default NULL,
  `title` varchar(255) NOT NULL,
  `teaser` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `access` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `page`
--

INSERT INTO `page` (`id`, `template`, `author`, `title`, `teaser`, `created`, `modified`, `published`, `access`) VALUES
(1, 'page.tpl.html', 'Enrico Reinsdorf', 'Startseite', '<p>Willkommen auf der Startseite!</p>', '2008-11-09 11:10:20', '2008-11-29 12:59:53', 1, 0),
(2, 'page.tpl.html', 'Enrico Reinsdorf', 'Test', 'Ein kleiner Test.', '2008-11-13 21:22:05', '2008-11-15 12:08:31', 0, 0),
(3, 'page.tpl.html', 'Enrico Reinsdorf', '', '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>', '2008-11-29 12:42:37', '2008-11-29 12:42:37', 1, 0);
