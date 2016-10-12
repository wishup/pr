-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2016 at 07:16 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Superadmin', '1', 1475777707);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/admin/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/default/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/default/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/menu/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/menu/create', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/menu/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/menu/update', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/menu/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/permission/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/permission/create', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/permission/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/permission/update', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/permission/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/role/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/role/assign', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/role/create', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/role/delete', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/role/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/role/remove', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/role/update', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/role/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/route/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/route/assign', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/route/create', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/route/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/route/remove', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/rule/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/rule/create', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/rule/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/rule/update', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/rule/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/activate', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/delete', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/login', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/logout', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/signup', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/admin/user/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/assignment/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/assignment/assign', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/assignment/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/assignment/revoke', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/assignment/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/base/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/contact-form/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/contact-form/create', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/contact-form/delete', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/contact-form/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/contact-form/update', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/contact-form/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/debug/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/debug/default/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/debug/default/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/debug/default/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/discount/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/discount/create', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/discount/delete', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/discount/getmodel', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/discount/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/discount/update', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/discount/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/email-groups/*', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/email-groups/create', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/email-groups/delete', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/email-groups/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/email-groups/update', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/email-groups/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/emails/*', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emails/create', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emails/delete', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emails/index', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emails/update', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emails/view', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emailtemplates/*', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emailtemplates/create', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emailtemplates/delete', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emailtemplates/index', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emailtemplates/preview', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emailtemplates/restore', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emailtemplates/update', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/emailtemplates/view', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq-categories/*', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq-categories/create', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq-categories/delete', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq-categories/index', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq-categories/update', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq-categories/view', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq/*', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq/create', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq/delete', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq/index', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq/update', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/faq/view', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/favoriteurls/*', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/favoriteurls/add', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/favoriteurls/remove', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/gii/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/gii/default/*', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/gii/default/action', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/gii/default/diff', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/gii/default/index', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/gii/default/preview', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/gii/default/view', 2, NULL, NULL, NULL, 1475777690, 1475777690),
('/glossary/*', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/glossary/create', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/glossary/delete', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/glossary/index', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/glossary/update', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/glossary/view', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/help/*', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/help/create', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/help/delete', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/help/index', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/help/update', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/help/view', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/layouts/activesection', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/activewidget', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/create', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/delete', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/delwidget', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/extandinfo', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/index', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/reorder', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/layouts/savewidget', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/savewidgetarea', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/update', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/view', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/layouts/widgetinfo', 2, NULL, NULL, NULL, 1475777691, 1475777691),
('/live-edit-texts/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/live-edit-texts/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/live-edit-texts/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/live-edit-texts/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/live-edit-texts/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/live-edit-texts/updatefield', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/live-edit-texts/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailing/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailing/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailing/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailing/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailing/preview', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailing/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailing/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailingtemplates/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailingtemplates/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailingtemplates/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailingtemplates/gettemplate', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailingtemplates/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailingtemplates/preview', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailingtemplates/sendtest', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailingtemplates/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/mailingtemplates/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/media/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/media/delfile', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/media/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/media/tinymce', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/media/uploadfile', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/createitem', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/deleteitem', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/moveitem', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/nodes', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/renameitem', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menu/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menuitems/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menuitems/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menuitems/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menuitems/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menuitems/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/menuitems/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/messaging/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/messaging/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/messaging/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/messaging/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/messaging/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/messaging/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/pages/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/pages/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/pages/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/pages/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/pages/restore', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/pages/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/pages/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/permission/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/permission/assign', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/permission/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/permission/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/permission/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/permission/remove', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/permission/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/permission/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources-categories/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources-categories/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources-categories/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources-categories/delthumb', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources-categories/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources-categories/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources-categories/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources/delfile', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources/delthumb', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/resources/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/role/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/role/assign', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/role/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/role/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/role/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/role/remove', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/role/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/role/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-parameters/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-parameters/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-parameters/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-parameters/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-parameters/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-parameters/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-settings/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-settings/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-settings/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-settings/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-settings/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/seo-settings/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/settings/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/settings/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/settings/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/settings/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/settings/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/settings/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopcategories/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopcategories/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopcategories/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopcategories/delimg', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopcategories/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopcategories/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopcategories/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproducts/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproducts/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproducts/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproducts/delimg', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproducts/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproducts/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproducts/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproductsattributes/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproductsattributes/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproductsattributes/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproductsattributes/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproductsattributes/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/shopproductsattributes/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/site/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/site/error', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/site/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/site/login', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/site/logout', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/site/statistics', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/sliders/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/sliders/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/sliders/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/sliders/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/sliders/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/sliders/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/slides/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/slides/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/slides/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/slides/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/slides/reorder', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/slides/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/slides/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/subscribers/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/subscribers/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/subscribers/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/subscribers/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/subscribers/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/subscribers/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/unsubscribe-reasons/*', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/unsubscribe-reasons/create', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/unsubscribe-reasons/delete', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/unsubscribe-reasons/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/unsubscribe-reasons/update', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/unsubscribe-reasons/view', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/unsubscribe/*', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/unsubscribe/create', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/unsubscribe/delete', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/unsubscribe/index', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/unsubscribe/update', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/unsubscribe/view', 2, NULL, NULL, NULL, 1475777692, 1475777692),
('/user/*', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/user/create', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/user/delete', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/user/index', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/user/profile', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/user/update', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/user/view', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/users/*', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/users/create', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/users/delete', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/users/index', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/users/update', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/users/view', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/widget/*', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/widget/delete', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/widget/deleteattachment', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/widget/index', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/widget/save', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/widgetsareas/*', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/widgetsareas/create', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('/widgetsareas/delete', 2, NULL, NULL, NULL, 1475777693, 1475777693),
('Superadmin', 1, NULL, NULL, NULL, 1475777683, 1475777683);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Superadmin', '/*');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `limit` int(11) DEFAULT NULL,
  `limit_per_user` int(11) DEFAULT NULL,
  `only_model` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `only_model_id` int(11) DEFAULT NULL,
  `usage` int(6) NOT NULL DEFAULT '0',
  `per_type` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emaillayouts`
--

CREATE TABLE `emaillayouts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `from_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `from_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `to_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `to_email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `attachments` text COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `send_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE `emailtemplates` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `from_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `from_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `plaintext` text COLLATE utf8_unicode_ci NOT NULL,
  `shortcodes` text COLLATE utf8_unicode_ci NOT NULL,
  `layout_id` int(11) DEFAULT NULL,
  `status` smallint(2) NOT NULL DEFAULT '1',
  `slug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `signature_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates_revisions`
--

CREATE TABLE `emailtemplates_revisions` (
  `id` int(11) NOT NULL,
  `emailtemplate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `plaintext` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `action` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_groups`
--

CREATE TABLE `email_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `unsubscribe` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `exclude_from_search` int(1) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite_urls`
--

CREATE TABLE `favorite_urls` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `description`) VALUES
(1, 'Workspace', '');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_item`
--

CREATE TABLE `gallery_item` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery_item`
--

INSERT INTO `gallery_item` (`id`, `gallery_id`, `name`, `description`, `image`) VALUES
(1, 1, 'workspace 1', '', 'd7e8d9e55e77fe9cac9e4e1801c5a943img48.jpg'),
(2, 1, 'workspace 2', '', '3db35122ddc846fcd372c6517dd38565img49.jpg'),
(3, 1, 'workspace 3', '', '9d29be2a36487759d50ac1a578a068d0img50.jpg'),
(4, 1, 'workspace 4', '', 'b758e221c0b0554eb6053efc088a9086img49.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `glossary`
--

CREATE TABLE `glossary` (
  `id` int(11) NOT NULL,
  `word` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `exclude_from_search` int(1) NOT NULL,
  `acronim` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id`, `content`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE `layouts` (
  `id` int(11) NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homepage` int(1) DEFAULT NULL,
  `layout_file` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `layouts`
--

INSERT INTO `layouts` (`id`, `url`, `parent_id`, `title`, `homepage`, `layout_file`) VALUES
(1, '', 0, 'Main', 1, 'wide_content'),
(2, 'site', 0, 'Inner pages', 0, 'main');

-- --------------------------------------------------------

--
-- Table structure for table `layouts_settings`
--

CREATE TABLE `layouts_settings` (
  `id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  `key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `layouts_settings`
--

INSERT INTO `layouts_settings` (`id`, `layout_id`, `key`, `value`) VALUES
(1, 1, 'section_top_active', '1'),
(2, 1, 'section_bottom_active', '1'),
(3, 1, 'section_center_active', '1'),
(4, 1, 'section_left_active', '0'),
(5, 1, 'section_right_active', '0'),
(6, 2, 'section_top_active', '1'),
(7, 2, 'section_left_active', '0'),
(8, 2, 'section_right_active', '0'),
(9, 2, 'section_bottom_active', '1'),
(10, 2, 'section_center_active', '1');

-- --------------------------------------------------------

--
-- Table structure for table `layouts_widgets_areas`
--

CREATE TABLE `layouts_widgets_areas` (
  `id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  `section` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `widget_area_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_edit`
--

CREATE TABLE `live_edit` (
  `id` int(11) NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `model` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `field` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `encoded` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `index` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `live_edit`
--

INSERT INTO `live_edit` (`id`, `token`, `date`, `model`, `model_id`, `field`, `encoded`, `index`) VALUES
(1, '7a4a3a20247e056af88e2980765e90c0', '2016-10-09 21:55:19', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(2, 'dbaeb93dbd0e97d282ef1b9172c16a98', '2016-10-09 21:55:19', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(3, '05d18d79e34fb061f72a4c0205dd465d', '2016-10-09 21:55:20', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(4, '231f723af64676bf0a0ff20f40b2126a', '2016-10-09 21:55:20', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(5, 'a04ea57aa45c47a2a9ff0cb319c8d764', '2016-10-09 21:56:25', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(6, '5d0e49230f2868e12fd11230c63110ca', '2016-10-09 21:56:27', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(7, '5c521eeb40ea21de0a40a2c4df021c80', '2016-10-09 21:56:27', '\\common\\models\\Pages', 4, 'content', '', ''),
(8, '89c2c23b1bbf41410877abde4c12c6db', '2016-10-09 21:56:28', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(9, '5e205cc2025e4203b9b643de71deb9d2', '2016-10-09 21:56:28', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(12, 'da6373eeb9bb9c5dc6ed29fbd06f4c9d', '2016-10-09 21:57:22', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(13, '5237585c525bd4820692e41def6ef1a2', '2016-10-09 21:57:22', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(16, '9a7b0f4a56e6b5b5dd96a159c9068869', '2016-10-09 21:57:33', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(17, '9a14da4e72bed5d0ed16a758c6b99872', '2016-10-09 21:57:33', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(18, '600098c29c7fc47e8f2bee33e3c802ed', '2016-10-09 21:57:40', '\\common\\models\\Pages', 4, 'header', '', ''),
(19, '49ac4ce4317dab2dbeb48ab7a695bc3f', '2016-10-09 21:57:40', '\\common\\models\\Pages', 4, 'content', '', ''),
(20, 'a2f206290d57360cc5993eecf69ed37d', '2016-10-09 21:57:41', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(21, 'a60244a7cfbff2ccce51c962b5bcae59', '2016-10-09 21:57:41', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(22, 'ee5324ec5a7058a8b20f171181d22007', '2016-10-09 21:58:49', '\\common\\models\\Pages', 4, 'header', '', ''),
(23, 'a2e44dd362436ebe4024c5b958911580', '2016-10-09 21:58:49', '\\common\\models\\Pages', 4, 'content', '', ''),
(24, 'ffd2985dcd1225479a05eecab7c31500', '2016-10-09 21:58:49', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(25, 'd2ded443ce6cb94a4ece5f007ec2b658', '2016-10-09 21:58:49', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(26, 'd040b374a09be6b81f47f062013665bc', '2016-10-09 22:01:13', '\\common\\models\\Pages', 4, 'header', '', ''),
(27, '2b76701ce29df43515429bf7c255e5ac', '2016-10-09 22:01:13', '\\common\\models\\Pages', 4, 'content', '', ''),
(28, '8e922d328ca4bfecfd316bdd80a03f3b', '2016-10-09 22:01:13', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(29, 'b77c4d62df518cda83db97765b882bce', '2016-10-09 22:01:14', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(32, '91e11d97775c5061ec7931d032b4b7f1', '2016-10-09 22:01:36', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(33, '76c66104155c8b5d819df1a16cd48d4b', '2016-10-09 22:01:36', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(36, 'fec2bcd21bcd8b332e9cc320dc0ad5cf', '2016-10-09 22:01:56', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(37, '1cc9eb3d903f3daf94f799d72e6e4810', '2016-10-09 22:01:56', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(38, '644c9effe689ced97270184252745822', '2016-10-09 22:02:09', '\\common\\models\\Pages', 4, 'header', '', ''),
(39, '40a61c06b55a746e882f2091abdeacba', '2016-10-09 22:02:09', '\\common\\models\\Pages', 4, 'content', '', ''),
(40, 'bc71501495ae8f83274fccee434d68c3', '2016-10-09 22:02:10', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content'),
(41, '973a4aaea8a18e2dd4e063c3b4d77ffe', '2016-10-09 22:02:10', '\\common\\models\\WidgetsInLayouts', 4, 'params', 'serialize', 'content');

-- --------------------------------------------------------

--
-- Table structure for table `live_edit_texts`
--

CREATE TABLE `live_edit_texts` (
  `id` int(11) NOT NULL,
  `key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `live_edit_texts`
--

INSERT INTO `live_edit_texts` (`id`, `key`, `content`) VALUES
(1, '852211e9632b3a1a80b578a3ecefda49', 'Sorry... The page you are looking for has moved.'),
(2, '871deafbe1178454c235bb13c332876d', 'Please use the links below or contact customer support for additional assistance.'),
(3, '9793563e698d6f460f06b8c67ddbe419', 'You will be automatically redirected to the homepage in a few seconds.'),
(4, '5afb26a926c1b9f5b596dbb4ccc23675', 'Host login'),
(5, 'fe6aca0c7a866d3f7e726aa6fc4ac4db', 'Bible Bee Host Account'),
(6, '72d4c6306e9c276d1d9bd226e0b24e07', 'I have an Account'),
(7, '8a8a68bd067a98c8aca623fd7f059cd1', 'We will never post anything without your permission.'),
(8, 'e59c786b44348c5a8e0535985baeff4c', 'I need an account'),
(9, 'adb2f5c83797658dd712a6bc38ab5dd5', 'Welcome!'),
(10, 'e56512440c0b896fef7a0a75d5c5fb8e', 'We are thrilled to help you explore Bible Bee!'),
(11, '83f77804d33a4a72a1ec7890df973c12', 'Exercitation ullamco laboris nisi ut aliquip ex commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
(12, '83b5fd0e05825170c129d5bbf43208a9', 'Informatives'),
(13, '32d654338ecfc8ca0a0196b3ec16ed37', 'Contacts'),
(14, '8af935657967a93ca61e59d589806b0e', 'Connaugt Road Central Suite 18B, 148 New Yankee'),
(15, '1917735a5394662b28668dca7ba33a61', '+1 (555) 333 22 11'),
(16, '27acdbc56cdba4b1ec5d9482bff52f5e', 'Connaugt Road Central Suite 18B, 148<br>New Yankee'),
(17, '9b3b8d9f280b04643ac4e0e02645b3c1', '- All rights Reserved');

-- --------------------------------------------------------

--
-- Table structure for table `mailing`
--

CREATE TABLE `mailing` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `start_at` datetime DEFAULT NULL,
  `last_at` datetime DEFAULT NULL,
  `frequency` int(11) DEFAULT NULL,
  `email_count` int(11) DEFAULT NULL,
  `final_notification` int(1) DEFAULT NULL,
  `paused` int(1) DEFAULT NULL,
  `finished` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mailing_templates`
--

CREATE TABLE `mailing_templates` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mailing_users`
--

CREATE TABLE `mailing_users` (
  `id` int(11) NOT NULL,
  `mailing_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sent` int(1) DEFAULT NULL,
  `sent_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `attachment` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`) VALUES
(1, 'Main menu'),
(2, 'Footer menu');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `other_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `parent_id`, `menu_id`, `name`, `url`, `order`, `other_url`) VALUES
(1, 0, 1, 'Home', 'other', 99999, '/'),
(2, 0, 1, 'Das Unternehmen', 'other', 99999, '/site/view/1'),
(5, 0, 2, 'Homepage', 'other', 99999, '/'),
(6, 0, 2, 'About', 'other', 99999, '/'),
(7, 0, 1, 'Handel', 'other', 99999, 'site/view/2'),
(8, 0, 1, 'Netzwerk', 'other', 99999, 'site/view/3'),
(9, 0, 1, 'Service', 'other', 99999, 'site/view/4'),
(10, 0, 1, 'Informatives', 'other', 99999, '/site/view/5'),
(11, 0, 1, 'Shop', 'other', 99999, 'http://shop.hanse-lite.de/'),
(12, 0, 1, 'Blog', 'other', 99999, '/blog'),
(13, 10, 1, 'Garantie', 'other', 0, '/site/view/6'),
(14, 10, 1, 'AGB', 'other', 1, '/site/view/7'),
(15, 10, 1, 'Versand', 'other', 2, '/site/view/8'),
(16, 10, 1, 'Widerrufsbelehrung', 'other', 3, '/site/view/9'),
(17, 10, 1, 'Lieferfähigkeit', 'other', 4, '/site/view/10'),
(18, 10, 1, 'Produkte von hoher Qualität', 'other', 5, '/site/view/11');

-- --------------------------------------------------------

--
-- Table structure for table `menu_routes`
--

CREATE TABLE `menu_routes` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url_template` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messaging`
--

CREATE TABLE `messaging` (
  `id` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `start_at` date DEFAULT NULL,
  `finish_at` date DEFAULT NULL,
  `can_close` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1475777575),
('m130524_201442_init', 1475777584),
('m140506_102106_rbac_init', 1475777578),
('m151124_141059_create_tables', 1475777593),
('m151214_120755_emails_table_create', 1475777593),
('m151215_141704_emailtemplates_table_create', 1475777594),
('m160111_122005_add_latitude_longitutde_to_users_hosts', 1475777595),
('m160112_140450_user_info_backend', 1475777595),
('m160112_145243_alter_date_of_birth_column', 1475777595),
('m160113_083314_create_email_layouts_table', 1475777596),
('m160113_083515_alter_emailtemplates_table', 1475777596),
('m160113_083746_alter_users_table', 1475777597),
('m160113_140840_create_social_auth_table', 1475777597),
('m160120_132438_subscribers_table', 1475777597),
('m160120_133634_faq_categories_table', 1475777597),
('m160120_134621_settings_table', 1475777598),
('m160120_140130_add_acronim_to_glossary', 1475777598),
('m160120_140400_add_category_id_to_faq', 1475777599),
('m160121_140412_create_menu_routes_table', 1475777599),
('m160125_081403_add_favicon_to_settings', 1475777599),
('m160127_101345_add_tags_field_to_user_info_table', 1475777599),
('m160127_114751_add_avatar_field_to_user_info_table', 1475777599),
('m160127_133512_create_emailtemplates_revisions_table', 1475777600),
('m160202_133828_alter_users_hosts_table', 1475777600),
('m160203_142138_create_media_table', 1475777601),
('m160205_074652_add_title_field_to_layouts', 1475777601),
('m160205_101225_create_widgets_in_layouts_table', 1475777601),
('m160209_071900_add_active_field_to_layout_widgets', 1475777601),
('m160209_115448_add_type_to_widgets_in_layouts', 1475777601),
('m160211_064259_add_parent_id_to_layout_widgets', 1475777602),
('m160211_073434_add_parent_widget_id_to_layout_widgets', 1475777602),
('m160211_082115_status_to_glossary', 1475777603),
('m160215_094448_add_homepage_field_to_layouts', 1475777603),
('m160215_123218_google_analytics_field_in_settings', 1475777603),
('m160216_071747_create_options_table', 1475777603),
('m160216_075253_create_mailing_tables', 1475777604),
('m160216_121033_create_users_tokens_table', 1475777604),
('m160222_073421_create_mailing_templates_table', 1475777605),
('m160223_123525_delete_html_pages', 1475777606),
('m160229_112408_new_table_sliders', 1475777607),
('m160229_131517_create_live_edit_table', 1475777607),
('m160302_092128_alter_layouts_table', 1475777607),
('m160302_144348_alter_subscribers_table', 1475777608),
('m160307_083643_alter_user_check_table', 1475777608),
('m160307_105923_user_tokens_foreign_key_change', 1475777608),
('m160309_124957_messaging_tables_create', 1475777609),
('m160310_145101_order_to_slides', 1475777609),
('m160311_091526_add_link_to_slides', 1475777609),
('m160314_122051_alter_user_info_table', 1475777610),
('m160318_144526_remove_use_custom_fields', 1475777610),
('m160322_131858_create_live_edit_texts_table', 1475777610),
('m160325_120847_add_table_hear_about', 1475777610),
('m160325_125444_change_hear_about_column', 1475777611),
('m160328_123229_create_families_and_contestants', 1475777612),
('m160330_065839_create_orders_and_order_items', 1475777612),
('m160330_153703_add_agegroup_to_childs', 1475777612),
('m160330_165925_add_descroptionto_order_item', 1475777613),
('m160331_125210_add_dynamic_user_id_to_order_table', 1475777613),
('m160401_133906_add_journal_field_into_child', 1475777613),
('m160406_113802_add_spouse_to_family', 1475777614),
('m160406_113848_add_cell_phone_to_usersinfo', 1475777615),
('m160407_122801_add_status_to_children', 1475777615),
('m160408_092628_add_orderid_to_chilren_and_delete_status', 1475777617),
('m160413_135842_add_created_at_to_contestants_and_order', 1475777618),
('m160414_113956_add_customer_service_status_to_hosts', 1475777618),
('m160418_101244_add_customer_service_status_to_users', 1475777618),
('m160418_101251_add_customer_service_status_to_families', 1475777618),
('m160419_081613_add_all_csstatuses_to_users', 1475777619),
('m160420_080415_add_status_to_email_templates', 1475777619),
('m160421_121924_create_notes', 1475777620),
('m160421_125358_create_family_host_table', 1475777620),
('m160422_074412_remove_title_from_users_notes', 1475777621),
('m160422_083204_add_slug_to_emailtemplate', 1475777621),
('m160425_161807_create_discount_table', 1475777621),
('m160426_140626_add_discount_code_to_order', 1475777621),
('m160428_095639_add_usage_discount_code', 1475777622),
('m160429_080155_add_per_type_to_discount_code', 1475777622),
('m160502_104307_create_subscription', 1475777622),
('m160502_144446_order_alter_family_id', 1475777622),
('m160505_115802_remove_cascade_from_contestant_order_id', 1475777623),
('m160505_120437_add_status_to_contestants', 1475777623),
('m160506_151236_delete_fkey_contestant_to_order', 1475777623),
('m160512_090532_add_notification_emails_to_settings', 1475777624),
('m160513_144836_add_email_template_descrpition', 1475777624),
('m160516_103916_create_users_emails_table', 1475777624),
('m160517_072435_add_type_to_user_history', 1475777626),
('m160519_085331_add_date_field_in_options', 1475777626),
('m160520_094824_make_dynid_unique_in_users_families', 1475777626),
('m160523_124802_add_help_table', 1475777626),
('m160524_104932_create_resources_tables', 1475777627),
('m160525_101648_create_contestants_winners_table', 1475777627),
('m160525_121402_add_year_to_seasons', 1475777627),
('m160526_135218_add_migr_table_field_to_users', 1475777628),
('m160531_090810_add_signature_to_user_table', 1475777628),
('m160531_095934_add_signature_id_to_emailtemplates_table', 1475777628),
('m160531_130744_add_image_field_to_resources_categories', 1475777628),
('m160531_144746_create_email_groups_table', 1475777629),
('m160601_081128_alter_resources_table', 1475777629),
('m160601_131307_add_group_id_to_emailtemplates', 1475777629),
('m160601_135634_create_unsubscribe_table', 1475777629),
('m160602_124225_create_unsubscribe_reasons_table', 1475777629),
('m160602_125034_add_reason_id_to_unsubscribe_table', 1475777629),
('m160606_112927_add_date_field_in_family_host_table', 1475777630),
('m160610_103638_create_contact_form_table', 1475777630),
('m160614_125057_create_family_host_history_table', 1475777630),
('m160615_074245_add_fields_to_subscribers', 1475777631),
('m160617_124947_remove_unnecessary_tables', 1475777635),
('m160923_100444_create_shop_tables', 1475777635),
('m160929_124011_add_slug_to_prod_attr', 1475777635),
('m161010_084635_create_gallery_tables', 1476211724),
('m161010_140211_create_posts_table', 1476211724);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `model` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `key` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `header` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `exclude_from_search` int(1) NOT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `header`, `content`, `exclude_from_search`, `status`, `password`) VALUES
(1, 'Das Unternehmen', 'Das Unternehmen', '<p><strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&nbsp;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&nbsp;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&nbsp;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', 0, 'published', ''),
(2, 'Handel', 'Handel', '', 0, 'published', ''),
(3, 'Netzwerk', 'Netzwerk', '', 0, 'published', ''),
(4, 'Service', 'Service', '', 0, 'published', ''),
(5, 'Informatives', 'Informatives', '', 0, 'published', ''),
(6, 'Garantie', 'Garantie', '', 0, 'published', ''),
(7, 'AGB', 'AGB', '', 0, 'published', ''),
(8, 'Versand', 'Versand', '', 0, 'published', ''),
(9, 'Widerrufsbelehrung', 'Widerrufsbelehrung', '', 0, 'published', ''),
(10, 'Lieferfähigkeit', 'Lieferfähigkeit', '', 0, 'published', ''),
(11, 'Produkte von hoher Qualität', 'Produkte von hoher Qualität', '', 0, 'published', '');

-- --------------------------------------------------------

--
-- Table structure for table `pages_revisions`
--

CREATE TABLE `pages_revisions` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `action` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages_revisions`
--

INSERT INTO `pages_revisions` (`id`, `page_id`, `user_id`, `content`, `date`, `action`) VALUES
(1, 1, 1, '<p><strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2016-10-09 20:58:43', 'Created'),
(2, 1, 1, '<p><strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2016-10-09 21:11:54', 'Changed'),
(3, 1, 1, '<p><strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>&nbsp;</p>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&nbsp;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&nbsp;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).&nbsp;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2016-10-09 21:12:59', 'Changed');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_content` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recent_urls`
--

CREATE TABLE `recent_urls` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recent_urls`
--

INSERT INTO `recent_urls` (`id`, `user_id`, `title`, `url`) VALUES
(101, 1, 'Create Page', '/backend/pages/create'),
(102, 1, 'Update Page:  Lieferfähigkeit', '/backend/pages/update/10'),
(103, 1, 'Update Menu Item:  Lieferfähigkeit', '/backend/menuitems/update/17'),
(104, 1, 'Main menu', '/backend/menu/view/1'),
(105, 1, 'Pages', '/backend/pages/index'),
(106, 1, 'Create Page', '/backend/pages/create'),
(107, 1, 'Update Page:  Produkte von hoher Qualität', '/backend/pages/update/11'),
(108, 1, 'Update Menu Item:  Produkte von hoher Qualität', '/backend/menuitems/update/18'),
(109, 1, 'Main menu', '/backend/menu/view/1'),
(110, 1, 'Layouts', '/backend/layouts/index'),
(111, 1, 'Update Layout ', '/backend/layouts/update/1'),
(112, 1, 'Galleries', '/backend/gallery/index'),
(113, 1, 'Create Gallery', '/backend/gallery/create'),
(114, 1, 'Workspace', '/backend/gallery/view/1'),
(115, 1, 'Galleries', '/backend/gallery/index'),
(116, 1, 'Gallery Items', '/backend/galleryitems/index/1'),
(117, 1, 'Create Gallery Item', '/backend/galleryitems/create/1'),
(118, 1, 'workspace 1', '/backend/galleryitems/view/1'),
(119, 1, 'Gallery Items', '/backend/galleryitems/index/1'),
(120, 1, 'Create Gallery Item', '/backend/galleryitems/create/1'),
(121, 1, 'workspace 2', '/backend/galleryitems/view/2'),
(122, 1, 'Gallery Items', '/backend/galleryitems/index/1'),
(123, 1, 'Create Gallery Item', '/backend/galleryitems/create/1'),
(124, 1, 'workspace 3', '/backend/galleryitems/view/3'),
(125, 1, 'Layouts', '/backend/layouts/index'),
(126, 1, 'Update Layout ', '/backend/layouts/update/1'),
(127, 1, 'Galleries', '/backend/gallery/index'),
(128, 1, 'Gallery Items', '/backend/galleryitems/index/1'),
(129, 1, 'Create Gallery Item', '/backend/galleryitems/create/1'),
(130, 1, 'workspace 4', '/backend/galleryitems/view/4');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `age_group` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `overlay_text` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `button_type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources_categories`
--

CREATE TABLE `resources_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_parameters`
--

CREATE TABLE `seo_parameters` (
  `id` int(11) NOT NULL,
  `url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seo_parameters`
--

INSERT INTO `seo_parameters` (`id`, `url`, `title`, `meta_description`, `meta_keywords`) VALUES
(1, '', 'Hanse Lite', 'Hanse Lite', 'Hanse Lite');

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` int(11) NOT NULL,
  `default_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `rewrite_url` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `facebook_api_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_api_secret_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_copyrights` text COLLATE utf8_unicode_ci,
  `favicon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_analytics` text COLLATE utf8_unicode_ci,
  `notification_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notification_email_bcc` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `facebook_api_key`, `facebook_api_secret_key`, `facebook_link`, `twitter_link`, `footer_copyrights`, `favicon`, `google_analytics`, `notification_email`, `notification_email_bcc`) VALUES
(1, '', '', '', '', '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

CREATE TABLE `shop_products` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` float DEFAULT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_attributes`
--

CREATE TABLE `shop_products_attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_products_attr_vals`
--

CREATE TABLE `shop_products_attr_vals` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_prod_cat`
--

CREATE TABLE `shop_prod_cat` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`) VALUES
(1, 'Homepage slider');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `slider_id` int(11) NOT NULL,
  `slide` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `slider_id`, `slide`, `order`, `link`) VALUES
(1, 1, 'img04.jpg', 999, '/'),
(2, 1, 'img01.jpg', 999, '');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `info` text COLLATE utf8_unicode_ci,
  `first_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unsubscribe`
--

CREATE TABLE `unsubscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `reason_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unsubscribe_reasons`
--

CREATE TABLE `unsubscribe_reasons` (
  `id` int(11) NOT NULL,
  `reason` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 's6rUpV91mW8WLRdMJVprl3_PMcGzBgqZ', '$2y$13$WYyyPUYSuotBJReo9FBovuLyOTAA860JMzjb22nG4df0lTBNgqW9m', '', 'admin@admin.com', 10, 1450275212, 1450275212);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_tokens`
--

CREATE TABLE `users_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info_backend`
--

CREATE TABLE `user_info_backend` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `signature` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_info_backend`
--

INSERT INTO `user_info_backend` (`id`, `user_id`, `first_name`, `last_name`, `last_login`, `signature`) VALUES
(1, 1, '', '', '2016-10-06 20:14:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE `widgets` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `title`, `slug`, `description`) VALUES
(1, 'Header', 'header', ''),
(2, 'Footer', 'footer', ''),
(3, 'Banner', 'banner', ''),
(4, 'Text block', 'textblock', ''),
(5, 'Banner with text', 'banner_with_text', ''),
(6, 'Newsletter', 'newsletter', ''),
(7, 'Social Networks Share', 'social', ''),
(8, 'Main content', 'maincontent', ''),
(9, 'Slider', 'slider', ''),
(10, 'Contact form', 'contact', ''),
(11, 'Workspace', 'workspace', ''),
(12, 'Communication centre messages', 'adminmessages', '');

-- --------------------------------------------------------

--
-- Table structure for table `widgets_areas`
--

CREATE TABLE `widgets_areas` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `widgets_in_areas`
--

CREATE TABLE `widgets_in_areas` (
  `id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `widgets_in_layouts`
--

CREATE TABLE `widgets_in_layouts` (
  `id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `params` text COLLATE utf8_unicode_ci NOT NULL,
  `order` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) DEFAULT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `parent_widget_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `widgets_in_layouts`
--

INSERT INTO `widgets_in_layouts` (`id`, `widget_id`, `layout_id`, `position`, `title`, `params`, `order`, `active`, `type`, `parent_id`, `parent_widget_id`) VALUES
(1, 1, 1, 'top', 'Header', 'a:0:{}', '1', 1, 'widget', 0, 0),
(2, 9, 1, 'top', 'Slider', 'a:1:{s:11:"slider_name";s:1:"1";}', '2', 1, 'widget', 0, 0),
(3, 2, 1, 'bottom', 'Footer', 'a:0:{}', '1', 1, 'widget', 0, 0),
(4, 4, 1, 'center', 'Homepage text', 'a:1:{s:7:"content";s:697:"<h2>WHO WE ARE?</h2>\r\n<p>Morbi in erat malesuada, sollicitudin massa at, tristique nisl. Maecenas id eros scelerisque, vulputate tortor quis, efficitur arcu sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Umco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <strong>Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem.</strong></p>\r\n<p>Fusce mattis nunc lacus, vulputate facilisis dui efficitur ut. Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem. Morbi in erat malesuada, sollicitudin massa at,</p>";}', '1', 1, 'widget', 0, 0),
(5, 1, 2, 'top', 'Header', 'a:0:{}', '1', 1, 'widget', 0, 0),
(6, 8, 2, 'center', 'Main content', 'a:0:{}', '1', 1, 'widget', 0, 0),
(7, 2, 2, 'bottom', 'Footer', 'a:0:{}', '1', 1, 'widget', 0, 0),
(8, 11, 1, 'center', 'Our Workspace', 'a:1:{s:10:"gallery_id";s:1:"1";}', '2', 1, 'widget', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emaillayouts`
--
ALTER TABLE `emaillayouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailtemplates_revisions`
--
ALTER TABLE `emailtemplates_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emailtemplates_revisions_user_id` (`user_id`),
  ADD KEY `fk_emailtemplates_revisions_emailtemplate_id` (`emailtemplate_id`);

--
-- Indexes for table `email_groups`
--
ALTER TABLE `email_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_faq_category_id` (`category_id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite_urls`
--
ALTER TABLE `favorite_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_item`
--
ALTER TABLE `gallery_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gallery_item_gallery_id` (`gallery_id`);

--
-- Indexes for table `glossary`
--
ALTER TABLE `glossary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layouts`
--
ALTER TABLE `layouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layouts_settings`
--
ALTER TABLE `layouts_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_layouts_settings_layout_id` (`layout_id`);

--
-- Indexes for table `layouts_widgets_areas`
--
ALTER TABLE `layouts_widgets_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_layouts_widgets_areas_layout_id` (`layout_id`),
  ADD KEY `fk_layouts_widgets_areas_widget_area_id` (`widget_area_id`);

--
-- Indexes for table `live_edit`
--
ALTER TABLE `live_edit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_edit_texts`
--
ALTER TABLE `live_edit_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailing`
--
ALTER TABLE `mailing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailing_templates`
--
ALTER TABLE `mailing_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailing_users`
--
ALTER TABLE `mailing_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mailing_users_user_id` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_items_menu_id` (`menu_id`);

--
-- Indexes for table `menu_routes`
--
ALTER TABLE `menu_routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messaging`
--
ALTER TABLE `messaging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_revisions`
--
ALTER TABLE `pages_revisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pages_revisions_page_id` (`page_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recent_urls`
--
ALTER TABLE `recent_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_resources_category_id` (`category_id`);

--
-- Indexes for table `resources_categories`
--
ALTER TABLE `resources_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_parameters`
--
ALTER TABLE `seo_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_products`
--
ALTER TABLE `shop_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_products_attributes`
--
ALTER TABLE `shop_products_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_products_attr_vals`
--
ALTER TABLE `shop_products_attr_vals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_prod_cat`
--
ALTER TABLE `shop_prod_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_slides_slider_id` (`slider_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unsubscribe`
--
ALTER TABLE `unsubscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unsubscribe_reasons`
--
ALTER TABLE `unsubscribe_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_tokens`
--
ALTER TABLE `users_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_tokens_user_id` (`user_id`);

--
-- Indexes for table `user_info_backend`
--
ALTER TABLE `user_info_backend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_info_backend_user_id` (`user_id`);

--
-- Indexes for table `widgets`
--
ALTER TABLE `widgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widgets_areas`
--
ALTER TABLE `widgets_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widgets_in_areas`
--
ALTER TABLE `widgets_in_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_widgets_in_areas_widget_id` (`widget_id`),
  ADD KEY `fk_widgets_in_areas_area_id` (`area_id`);

--
-- Indexes for table `widgets_in_layouts`
--
ALTER TABLE `widgets_in_layouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_widgets_in_layouts_layout_id` (`layout_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emaillayouts`
--
ALTER TABLE `emaillayouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emailtemplates_revisions`
--
ALTER TABLE `emailtemplates_revisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_groups`
--
ALTER TABLE `email_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favorite_urls`
--
ALTER TABLE `favorite_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gallery_item`
--
ALTER TABLE `gallery_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `glossary`
--
ALTER TABLE `glossary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `layouts`
--
ALTER TABLE `layouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `layouts_settings`
--
ALTER TABLE `layouts_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `layouts_widgets_areas`
--
ALTER TABLE `layouts_widgets_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `live_edit`
--
ALTER TABLE `live_edit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `live_edit_texts`
--
ALTER TABLE `live_edit_texts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `mailing`
--
ALTER TABLE `mailing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mailing_templates`
--
ALTER TABLE `mailing_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mailing_users`
--
ALTER TABLE `mailing_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `menu_routes`
--
ALTER TABLE `menu_routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messaging`
--
ALTER TABLE `messaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pages_revisions`
--
ALTER TABLE `pages_revisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recent_urls`
--
ALTER TABLE `recent_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resources_categories`
--
ALTER TABLE `resources_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seo_parameters`
--
ALTER TABLE `seo_parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_products`
--
ALTER TABLE `shop_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_products_attributes`
--
ALTER TABLE `shop_products_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_products_attr_vals`
--
ALTER TABLE `shop_products_attr_vals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_prod_cat`
--
ALTER TABLE `shop_prod_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unsubscribe`
--
ALTER TABLE `unsubscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unsubscribe_reasons`
--
ALTER TABLE `unsubscribe_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_tokens`
--
ALTER TABLE `users_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_info_backend`
--
ALTER TABLE `user_info_backend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `widgets`
--
ALTER TABLE `widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `widgets_areas`
--
ALTER TABLE `widgets_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `widgets_in_areas`
--
ALTER TABLE `widgets_in_areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `widgets_in_layouts`
--
ALTER TABLE `widgets_in_layouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emailtemplates_revisions`
--
ALTER TABLE `emailtemplates_revisions`
  ADD CONSTRAINT `fk_emailtemplates_revisions_emailtemplate_id` FOREIGN KEY (`emailtemplate_id`) REFERENCES `emailtemplates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_emailtemplates_revisions_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `fk_faq_category_id` FOREIGN KEY (`category_id`) REFERENCES `faq_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery_item`
--
ALTER TABLE `gallery_item`
  ADD CONSTRAINT `fk_gallery_item_gallery_id` FOREIGN KEY (`gallery_id`) REFERENCES `gallery` (`id`);

--
-- Constraints for table `layouts_settings`
--
ALTER TABLE `layouts_settings`
  ADD CONSTRAINT `fk_layouts_settings_layout_id` FOREIGN KEY (`layout_id`) REFERENCES `layouts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `layouts_widgets_areas`
--
ALTER TABLE `layouts_widgets_areas`
  ADD CONSTRAINT `fk_layouts_widgets_areas_layout_id` FOREIGN KEY (`layout_id`) REFERENCES `layouts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_layouts_widgets_areas_widget_area_id` FOREIGN KEY (`widget_area_id`) REFERENCES `widgets_areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mailing_users`
--
ALTER TABLE `mailing_users`
  ADD CONSTRAINT `fk_mailing_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `fk_menu_items_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pages_revisions`
--
ALTER TABLE `pages_revisions`
  ADD CONSTRAINT `fk_pages_revisions_page_id` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `fk_resources_category_id` FOREIGN KEY (`category_id`) REFERENCES `resources_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slides`
--
ALTER TABLE `slides`
  ADD CONSTRAINT `fk_slides_slider_id` FOREIGN KEY (`slider_id`) REFERENCES `sliders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_tokens`
--
ALTER TABLE `users_tokens`
  ADD CONSTRAINT `fk_users_tokens_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_info_backend`
--
ALTER TABLE `user_info_backend`
  ADD CONSTRAINT `fk_user_info_backend_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `widgets_in_areas`
--
ALTER TABLE `widgets_in_areas`
  ADD CONSTRAINT `fk_widgets_in_areas_area_id` FOREIGN KEY (`area_id`) REFERENCES `widgets_areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_widgets_in_areas_widget_id` FOREIGN KEY (`widget_id`) REFERENCES `widgets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `widgets_in_layouts`
--
ALTER TABLE `widgets_in_layouts`
  ADD CONSTRAINT `fk_widgets_in_layouts_layout_id` FOREIGN KEY (`layout_id`) REFERENCES `layouts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
