-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2016-09-08 18:23:51
-- 服务器版本： 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp_toto`
--

-- --------------------------------------------------------

--
-- 表的结构 `ye_user`
--

CREATE TABLE `ye_user` (
  `id` int(8) UNSIGNED NOT NULL COMMENT '用户表的主键ID',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `email` varchar(255) NOT NULL COMMENT '用户邮箱',
  `password` varchar(32) NOT NULL,
  `reg_time` int(10) UNSIGNED NOT NULL COMMENT '注册时间',
  `login_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录时间',
  `login_ip` varchar(255) DEFAULT '127.0.0.1' COMMENT '登录ip',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '伪删除状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ye_user`
--

INSERT INTO `ye_user` (`id`, `username`, `email`, `password`, `reg_time`, `login_time`, `login_ip`, `status`) VALUES
(1, 'yexk', 'yexk123@yexk.cn', '21232f297a57a5a743894a0e4a801fc3', 1473306535, 1473306535, '127.0.0.1', 1),
(2, 'admin', 'admin@yexk.cn', '21232f297a57a5a743894a0e4a801fc3', 1473313721, 1473313721, '127.0.0.1', 1),
(3, 'test', 'test@yexk.cn', '21232f297a57a5a743894a0e4a801fc3', 1473313960, 1473313960, '127.0.0.1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ye_user`
--
ALTER TABLE `ye_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ye_user`
--
ALTER TABLE `ye_user`
  MODIFY `id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户表的主键ID', AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
