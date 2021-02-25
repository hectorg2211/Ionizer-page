/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-02-05 17:29:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ionizer_entries`
-- ----------------------------
DROP TABLE IF EXISTS `ionizer_entries`;
CREATE TABLE `ionizer_entries` (
  `ionizer_id` mediumint(10) NOT NULL,
  `line` text,
  `building` char(1) DEFAULT NULL,
  `status` text,
  `remark` text,
  PRIMARY KEY (`ionizer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ionizer_entries
-- ----------------------------
INSERT INTO `ionizer_entries` VALUES ('1', 'L01', 'a', 'working', '');
INSERT INTO `ionizer_entries` VALUES ('2', 'L01', 'a', 'working', '');
INSERT INTO `ionizer_entries` VALUES ('4', 'L01', 'a', 'working', '');
INSERT INTO `ionizer_entries` VALUES ('5', 'L01', 'a', 'working', '');
INSERT INTO `ionizer_entries` VALUES ('9', 'L01', 'a', 'working', '');
INSERT INTO `ionizer_entries` VALUES ('456', 'L01', 'a', 'working', '');
INSERT INTO `ionizer_entries` VALUES ('5555', 'L01', 'a', 'working', '');
INSERT INTO `ionizer_entries` VALUES ('99999', 'L41', 'a', 'working', 'oolouioiouio');
INSERT INTO `ionizer_entries` VALUES ('123456', 'L04', 'c', 'damaged', 'It works');
INSERT INTO `ionizer_entries` VALUES ('321321', 'L01', 'a', 'working', '');
INSERT INTO `ionizer_entries` VALUES ('999999', 'L01', 'a', 'working', 'Si jalo');
INSERT INTO `ionizer_entries` VALUES ('8388607', 'L01', 'a', 'working', '');
