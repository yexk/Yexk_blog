/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50528
Source Host           : 127.0.0.1:3306
Source Database       : ye_blog

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2016-12-01 19:31:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ye_article
-- ----------------------------
DROP TABLE IF EXISTS `ye_article`;
CREATE TABLE `ye_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章主键ID',
  `cid` smallint(5) unsigned NOT NULL COMMENT '文章分类ID',
  `title` varchar(180) NOT NULL COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文章内容',
  `desc` varchar(255) NOT NULL COMMENT '文章描述',
  `user_id` int(10) unsigned NOT NULL COMMENT '发布作者',
  `read_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览数量',
  `like_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点赞数量',
  `thumb` varchar(255) DEFAULT NULL COMMENT '文章缩略图',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '发布时间',
  `update_time` int(10) unsigned DEFAULT NULL COMMENT '最后修改时间',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态值，0正常、1删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of ye_article
-- ----------------------------

-- ----------------------------
-- Table structure for ye_category
-- ----------------------------
DROP TABLE IF EXISTS `ye_category`;
CREATE TABLE `ye_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类主键ID',
  `name` varchar(60) NOT NULL COMMENT '分类名称',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类父级ID',
  `desc` varchar(255) DEFAULT NULL COMMENT '分类描述',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0、展示，1、删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of ye_category
-- ----------------------------

-- ----------------------------
-- Table structure for ye_user
-- ----------------------------
DROP TABLE IF EXISTS `ye_user`;
CREATE TABLE `ye_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户主键ID',
  `username` varchar(80) NOT NULL COMMENT '登陆名称',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `name` varchar(80) NOT NULL COMMENT '昵称',
  `create_time` int(10) unsigned DEFAULT NULL,
  `update_time` int(10) unsigned DEFAULT NULL,
  `is_open_api` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0,本地注册，1、微博，2、QQ',
  `login_ip` int(10) unsigned DEFAULT NULL COMMENT '存入整形的登陆ip',
  `profile_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '其他资料',
  `state` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未激活，1正常使用，2已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ye_user
-- ----------------------------
