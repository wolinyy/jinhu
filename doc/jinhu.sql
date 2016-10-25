/*
Navicat MySQL Data Transfer

Source Server         : 115.28.224.194
Source Server Version : 50552
Source Host           : 115.28.224.194:3306
Source Database       : jinhu

Target Server Type    : MYSQL
Target Server Version : 50552
File Encoding         : 65001

Date: 2016-10-25 20:45:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yy_info
-- ----------------------------
DROP TABLE IF EXISTS `yy_info`;
CREATE TABLE `yy_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `type_one_id` smallint(5) unsigned NOT NULL COMMENT '一级分类id',
  `type_two_id` smallint(5) unsigned NOT NULL COMMENT '二级分类id',
  `title` varchar(32) NOT NULL COMMENT '标题',
  `content` varchar(384) NOT NULL COMMENT '内容',
  `addr_one_id` smallint(5) unsigned NOT NULL COMMENT '一级地址 县城或各个镇',
  `addr_two_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '二级地址 村 乡',
  `addr_detail` varchar(24) NOT NULL DEFAULT '' COMMENT '地址详细说明',
  `lng` smallint(6) NOT NULL DEFAULT '0' COMMENT '坐标-经度',
  `lat` smallint(6) NOT NULL DEFAULT '0' COMMENT '坐标-纬度',
  `zoom` smallint(6) NOT NULL DEFAULT '0' COMMENT '坐标-比例',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '联系人',
  `phone` varchar(12) NOT NULL DEFAULT '' COMMENT '联系手机',
  `email` varchar(32) NOT NULL DEFAULT '' COMMENT '电子邮件',
  `qq` varchar(15) NOT NULL DEFAULT '' COMMENT 'QQ号',
  `passwd` varchar(32) NOT NULL DEFAULT '' COMMENT '管理密码',
  `show_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '默认0-全部可见 1-仅会员可见',
  `create_at` int(10) unsigned NOT NULL COMMENT '添加时间',
  `update_at` int(10) unsigned NOT NULL COMMENT '更新时间',
  `ip` varchar(15) NOT NULL,
  `limit` smallint(5) unsigned NOT NULL COMMENT '有效时长 按天算',
  `is_pro` int(11) unsigned NOT NULL COMMENT '推荐',
  `is_top` int(11) unsigned NOT NULL COMMENT '置顶',
  `top_type` tinyint(1) unsigned NOT NULL COMMENT '置顶类型',
  `look_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '信息状态 0-未审核 1-可信用户，自动通过 2-人工审核-通过 3-人工审核-失败 4-被多人举报，不可见',
  `reason` varchar(32) NOT NULL DEFAULT '' COMMENT '审核失败原因',
  `auditor_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '审核人id',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '软删除 1为删除',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `type_one_id` (`type_one_id`) USING BTREE,
  KEY `type_two_id` (`type_two_id`) USING BTREE,
  KEY `phone` (`phone`) USING BTREE,
  KEY `title` (`title`) USING BTREE,
  KEY `addr_one_id` (`addr_one_id`) USING BTREE,
  KEY `addr_two_id` (`addr_two_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类信息表: 基本信息 详细信息（属性信息） 图片 联系方式';

-- ----------------------------
-- Records of yy_info
-- ----------------------------

-- ----------------------------
-- Table structure for yy_info_attr
-- ----------------------------
DROP TABLE IF EXISTS `yy_info_attr`;
CREATE TABLE `yy_info_attr` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL COMMENT '信息属性名称',
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '消息一级分类id',
  `type2_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '消息二级分类id',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '属性类型 1-行文本 2-单选 3-多选 4-文本域 5-数值型行文本',
  `value` text NOT NULL COMMENT '属性值，类型不同 含义不同',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '排序字段',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=772 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yy_info_attr
-- ----------------------------
INSERT INTO `yy_info_attr` VALUES ('5', '身份', '51', '100', '2', '1:个人\n2:经纪人', '100');
INSERT INTO `yy_info_attr` VALUES ('6', '出租形式', '51', '100', '2', '1:整套\n2:单间\n3:床位', '101');
INSERT INTO `yy_info_attr` VALUES ('7', '房型', '51', '100', '2', '1:4室及以上\n2:3室2厅\n3:3室1厅\n4:2室2厅\n5:2室1厅\n6:1室1厅\n7:1室0厅', '102');
INSERT INTO `yy_info_attr` VALUES ('8', '租金', '51', '100', '5', '元', '103');
INSERT INTO `yy_info_attr` VALUES ('9', '房屋配置', '51', '100', '3', '1:床\n2:衣柜\n3:沙发\n4:电视\n5:冰箱\n6:洗衣机\n7:空调\n8:热水器\n9:宽带\n10:暖气', '104');
INSERT INTO `yy_info_attr` VALUES ('10', '身份', '51', '101', '2', '1:个人\n2:经纪人', '100');
INSERT INTO `yy_info_attr` VALUES ('11', '出租形式', '51', '101', '2', '1:整套\n2:单间\n3:床位', '101');
INSERT INTO `yy_info_attr` VALUES ('12', '房型', '51', '101', '2', '1:4室及以上\r\n2:3室2厅\r\n3:3室1厅\r\n4:2室2厅\r\n5:2室1厅\r\n6:1室1厅\r\n7:1室0厅', '102');
INSERT INTO `yy_info_attr` VALUES ('13', '租金', '51', '101', '5', '元', '103');
INSERT INTO `yy_info_attr` VALUES ('14', '房屋配置', '51', '101', '3', '1:床\r\n2:衣柜\r\n3:沙发\r\n4:电视\r\n5:冰箱\r\n6:洗衣机\r\n7:空调\r\n8:热水器\r\n9:宽带\r\n10:暖气', '104');
INSERT INTO `yy_info_attr` VALUES ('15', '身份', '51', '102', '2', '1:个人\r\n2:经纪人', '100');
INSERT INTO `yy_info_attr` VALUES ('16', '装修', '51', '102', '2', '1:毛坯房\n2:简单装修\n3:中等装修\n4:精装修', '101');
INSERT INTO `yy_info_attr` VALUES ('17', '房型', '51', '102', '2', '1:4室及以上\r\n2:3室2厅\r\n3:3室1厅\r\n4:2室2厅\r\n5:2室1厅\r\n6:1室1厅\r\n7:1室0厅', '102');
INSERT INTO `yy_info_attr` VALUES ('18', '价格', '51', '102', '5', '万元', '103');
INSERT INTO `yy_info_attr` VALUES ('19', '面积', '51', '102', '5', '平米', '104');
INSERT INTO `yy_info_attr` VALUES ('20', '店铺分类', '51', '103', '2', '1:餐饮美食\n2:服饰鞋包\n3:酒店宾馆\n4:超市零售\n5:空铺转让\n6:美容美发\n7:家居建材\n8:汽修美容\n9:电子通讯\n100:其它', '100');
INSERT INTO `yy_info_attr` VALUES ('21', '面积', '51', '103', '5', '平米', '101');
INSERT INTO `yy_info_attr` VALUES ('22', '面积', '51', '104', '5', '平米', '100');
INSERT INTO `yy_info_attr` VALUES ('23', '价格', '51', '104', '5', '万元', '101');
INSERT INTO `yy_info_attr` VALUES ('24', '身份', '51', '105', '2', '1:个人\n2:经纪人', '100');
INSERT INTO `yy_info_attr` VALUES ('25', '面积', '51', '105', '5', '平米', '101');
INSERT INTO `yy_info_attr` VALUES ('26', '租金', '51', '105', '5', '元/平米/天', '102');
INSERT INTO `yy_info_attr` VALUES ('27', '面积', '51', '106', '5', '平米', '100');
INSERT INTO `yy_info_attr` VALUES ('28', '价格', '51', '106', '5', '万元', '101');
INSERT INTO `yy_info_attr` VALUES ('29', '身份', '51', '107', '2', '1:个人\n2:经纪人', '100');
INSERT INTO `yy_info_attr` VALUES ('30', '面积', '51', '107', '5', '平米', '101');
INSERT INTO `yy_info_attr` VALUES ('31', '租金', '51', '107', '5', '元/平米/天', '102');
INSERT INTO `yy_info_attr` VALUES ('32', '来源', '52', '110', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('33', '价格', '52', '110', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('34', '新旧程度', '52', '110', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('35', '来源', '52', '111', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('36', '价格', '52', '111', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('37', '新旧程度', '52', '111', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('38', '电脑品牌', '52', '112', '2', '1:戴尔\n2:华硕\n3:惠普\n4:联想\n5:IBM\n6:苹果\n7:三星\n8:东芝\n9:神舟\n10:方正\n11:清华同方\n12:索尼\n13:其它', '100');
INSERT INTO `yy_info_attr` VALUES ('39', '新旧程度', '52', '112', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '101');
INSERT INTO `yy_info_attr` VALUES ('40', '价格', '52', '112', '2', '元', '102');
INSERT INTO `yy_info_attr` VALUES ('41', '来源', '52', '112', '2', '1:个人\n2:商家', '103');
INSERT INTO `yy_info_attr` VALUES ('42', '来源', '52', '113', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('43', '价格', '52', '113', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('44', '新旧程度', '52', '113', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('45', '来源', '52', '114', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('46', '价格', '52', '114', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('47', '新旧程度', '52', '114', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('48', '来源', '52', '115', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('49', '价格', '52', '115', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('50', '新旧程度', '52', '115', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('51', '来源', '52', '116', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('52', '价格', '52', '116', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('53', '新旧程度', '52', '116', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('54', '来源', '52', '117', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('55', '价格', '52', '117', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('56', '新旧程度', '52', '117', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('57', '来源', '52', '118', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('58', '价格', '52', '118', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('59', '新旧程度', '52', '118', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('60', '来源', '52', '119', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('61', '价格', '52', '119', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('62', '新旧程度', '52', '119', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('63', '来源', '52', '120', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('64', '价格', '52', '120', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('65', '新旧程度', '52', '120', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('66', '来源', '52', '121', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('67', '价格', '52', '121', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('68', '新旧程度', '52', '121', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('69', '来源', '52', '122', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('70', '价格', '52', '122', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('71', '新旧程度', '52', '122', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('72', '来源', '52', '123', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('73', '价格', '52', '123', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('74', '新旧程度', '52', '123', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('75', '来源', '52', '124', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('76', '价格', '52', '124', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('77', '新旧程度', '52', '124', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('78', '来源', '52', '125', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('79', '价格', '52', '125', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('80', '新旧程度', '52', '125', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('81', '来源', '52', '126', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('82', '价格', '52', '126', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('83', '新旧程度', '52', '126', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('84', '来源', '52', '127', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('85', '价格', '52', '127', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('86', '新旧程度', '52', '127', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('87', '来源', '52', '128', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('88', '价格', '52', '128', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('89', '新旧程度', '52', '128', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('90', '来源', '52', '129', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('91', '价格', '52', '129', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('92', '新旧程度', '52', '129', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('93', '来源', '52', '130', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('94', '价格', '52', '130', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('95', '新旧程度', '52', '130', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('96', '来源', '52', '131', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('97', '价格', '52', '131', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('98', '新旧程度', '52', '131', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('99', '来源', '52', '132', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('100', '价格', '52', '132', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('101', '新旧程度', '52', '132', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('102', '来源', '52', '133', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('103', '价格', '52', '133', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('104', '新旧程度', '52', '133', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('105', '来源', '52', '134', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('106', '价格', '52', '134', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('107', '新旧程度', '52', '134', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('108', '来源', '52', '135', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('109', '价格', '52', '135', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('110', '新旧程度', '52', '135', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('111', '轿车品牌', '53', '136', '2', '1:大众\n2:本田\n3:丰田\n4:别克\n5:奥迪\n6:奔驰\n7:宝马\n8:比亚迪\n9:现代\n10:雪佛兰\n11:奇瑞\n12:福特\n13:日产\n14:马自达\n15:金杯\n16:路虎\n100:其它', '100');
INSERT INTO `yy_info_attr` VALUES ('112', '上牌年份', '53', '136', '2', '1:2011年以前\n2:2011年\n3:2012年\n4:2013年\n5:2014年\n6:2015年', '101');
INSERT INTO `yy_info_attr` VALUES ('113', '行驶里程', '53', '136', '5', '万公里', '102');
INSERT INTO `yy_info_attr` VALUES ('114', '价格', '53', '136', '5', '万元', '103');
INSERT INTO `yy_info_attr` VALUES ('115', '新旧程度', '53', '136', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '104');
INSERT INTO `yy_info_attr` VALUES ('116', '来源', '53', '136', '2', '1:个人\n2:商家', '105');
INSERT INTO `yy_info_attr` VALUES ('117', '价格', '53', '137', '5', '万元', '103');
INSERT INTO `yy_info_attr` VALUES ('118', '新旧程度', '53', '137', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '104');
INSERT INTO `yy_info_attr` VALUES ('119', '来源', '53', '137', '2', '1:个人\n2:商家', '105');
INSERT INTO `yy_info_attr` VALUES ('120', '上牌年份', '53', '138', '2', '1:2011年以前\n2:2011年\n3:2012年\n4:2013年\n5:2014年\n6:2015年', '101');
INSERT INTO `yy_info_attr` VALUES ('121', '行驶里程', '53', '138', '5', '万公里', '102');
INSERT INTO `yy_info_attr` VALUES ('122', '价格', '53', '138', '5', '万元', '103');
INSERT INTO `yy_info_attr` VALUES ('123', '新旧程度', '53', '138', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '104');
INSERT INTO `yy_info_attr` VALUES ('124', '来源', '53', '138', '2', '1:个人\n2:商家', '105');
INSERT INTO `yy_info_attr` VALUES ('125', '价格', '53', '139', '5', '万元', '103');
INSERT INTO `yy_info_attr` VALUES ('126', '新旧程度', '53', '139', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '104');
INSERT INTO `yy_info_attr` VALUES ('127', '来源', '53', '139', '2', '1:个人\n2:商家', '105');
INSERT INTO `yy_info_attr` VALUES ('128', '价格', '53', '141', '5', '元', '103');
INSERT INTO `yy_info_attr` VALUES ('129', '新旧程度', '53', '141', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '104');
INSERT INTO `yy_info_attr` VALUES ('130', '来源', '53', '141', '2', '1:个人\n2:商家', '105');
INSERT INTO `yy_info_attr` VALUES ('131', '价格', '53', '142', '5', '元', '103');
INSERT INTO `yy_info_attr` VALUES ('132', '新旧程度', '53', '142', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '104');
INSERT INTO `yy_info_attr` VALUES ('133', '来源', '53', '142', '2', '1:个人\n2:商家', '105');
INSERT INTO `yy_info_attr` VALUES ('134', '摩托车品牌', '53', '145', '2', '1:雅马哈\n2:本田\n3:建设\n4:铃木\n5:宗申\n6:力帆\n7:豪爵\n8:新大洲\n100:其它', '100');
INSERT INTO `yy_info_attr` VALUES ('135', '价格', '53', '145', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('136', '来源', '53', '145', '2', '1:个人\n2:商家', '102');
INSERT INTO `yy_info_attr` VALUES ('137', '电动车品牌', '53', '146', '2', '1:新日\n2:立马\n3:绿源\n4:爱玛\n5:雅迪\n100:其它', '100');
INSERT INTO `yy_info_attr` VALUES ('138', '价格', '53', '146', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('139', '新旧程度', '53', '146', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('140', '来源', '53', '146', '2', '1:个人\n2:商家', '103');
INSERT INTO `yy_info_attr` VALUES ('141', '自行车品牌', '53', '147', '2', '1:永久\n2:凤凰\n3:捷安特\n100:其它', '100');
INSERT INTO `yy_info_attr` VALUES ('142', '价格', '53', '147', '5', '元', '103');
INSERT INTO `yy_info_attr` VALUES ('143', '新旧程度', '53', '147', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '104');
INSERT INTO `yy_info_attr` VALUES ('144', '来源', '53', '147', '2', '1:个人\n2:商家', '105');
INSERT INTO `yy_info_attr` VALUES ('145', '价格', '53', '148', '5', '元', '103');
INSERT INTO `yy_info_attr` VALUES ('146', '新旧程度', '53', '148', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '104');
INSERT INTO `yy_info_attr` VALUES ('147', '来源', '53', '148', '2', '1:个人\n2:商家', '105');
INSERT INTO `yy_info_attr` VALUES ('148', '性别要求', '54', '451', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('149', '月薪', '54', '451', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('150', '职位', '54', '451', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('151', '公司名称', '54', '451', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('152', '学历', '54', '451', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('153', '工作年限', '54', '451', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('154', '福利', '54', '451', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('155', '公司性质', '54', '451', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('156', '性别要求', '54', '452', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('157', '月薪', '54', '452', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('158', '职位', '54', '452', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('159', '公司名称', '54', '452', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('160', '学历', '54', '452', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('161', '工作年限', '54', '452', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('162', '福利', '54', '452', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('163', '公司性质', '54', '452', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('164', '性别要求', '54', '453', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('165', '月薪', '54', '453', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('166', '职位', '54', '453', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('167', '公司名称', '54', '453', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('168', '学历', '54', '453', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('169', '工作年限', '54', '453', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('170', '福利', '54', '453', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('171', '公司性质', '54', '453', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('172', '性别要求', '54', '454', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('173', '月薪', '54', '454', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('174', '职位', '54', '454', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('175', '公司名称', '54', '454', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('176', '学历', '54', '454', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('177', '工作年限', '54', '454', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('178', '福利', '54', '454', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('179', '公司性质', '54', '454', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('180', '性别要求', '54', '455', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('181', '月薪', '54', '455', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('182', '职位', '54', '455', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('183', '公司名称', '54', '455', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('184', '学历', '54', '455', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('185', '工作年限', '54', '455', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('186', '福利', '54', '455', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('187', '公司性质', '54', '455', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('188', '性别要求', '54', '456', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('189', '月薪', '54', '456', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('190', '职位', '54', '456', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('191', '公司名称', '54', '456', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('192', '学历', '54', '456', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('193', '工作年限', '54', '456', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('194', '福利', '54', '456', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('195', '公司性质', '54', '456', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('196', '性别要求', '54', '457', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('197', '月薪', '54', '457', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('198', '职位', '54', '457', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('199', '公司名称', '54', '457', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('200', '学历', '54', '457', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('201', '工作年限', '54', '457', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('202', '福利', '54', '457', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('203', '公司性质', '54', '457', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('204', '性别要求', '54', '458', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('205', '月薪', '54', '458', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('206', '职位', '54', '458', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('207', '公司名称', '54', '458', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('208', '学历', '54', '458', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('209', '工作年限', '54', '458', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('210', '福利', '54', '458', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('211', '公司性质', '54', '458', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('212', '性别要求', '54', '459', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('213', '月薪', '54', '459', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('214', '职位', '54', '459', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('215', '公司名称', '54', '459', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('216', '学历', '54', '459', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('217', '工作年限', '54', '459', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('218', '福利', '54', '459', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('219', '公司性质', '54', '459', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('220', '性别要求', '54', '460', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('221', '月薪', '54', '460', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('222', '职位', '54', '460', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('223', '公司名称', '54', '460', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('224', '学历', '54', '460', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('225', '工作年限', '54', '460', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('226', '福利', '54', '460', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('227', '公司性质', '54', '460', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('228', '性别要求', '54', '461', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('229', '月薪', '54', '461', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('230', '职位', '54', '461', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('231', '公司名称', '54', '461', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('232', '学历', '54', '461', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('233', '工作年限', '54', '461', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('234', '福利', '54', '461', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('235', '公司性质', '54', '461', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('236', '性别要求', '54', '462', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('237', '月薪', '54', '462', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('238', '职位', '54', '462', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('239', '公司名称', '54', '462', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('240', '学历', '54', '462', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('241', '工作年限', '54', '462', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('242', '福利', '54', '462', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('243', '公司性质', '54', '462', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('244', '性别要求', '54', '463', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('245', '月薪', '54', '463', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('246', '职位', '54', '463', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('247', '公司名称', '54', '463', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('248', '学历', '54', '463', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('249', '工作年限', '54', '463', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('250', '福利', '54', '463', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('251', '公司性质', '54', '463', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('252', '性别要求', '54', '464', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('253', '月薪', '54', '464', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('254', '职位', '54', '464', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('255', '公司名称', '54', '464', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('256', '学历', '54', '464', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('257', '工作年限', '54', '464', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('258', '福利', '54', '464', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('259', '公司性质', '54', '464', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('260', '性别要求', '54', '465', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('261', '月薪', '54', '465', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('262', '职位', '54', '465', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('263', '公司名称', '54', '465', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('264', '学历', '54', '465', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('265', '工作年限', '54', '465', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('266', '福利', '54', '465', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('267', '公司性质', '54', '465', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('268', '性别要求', '54', '466', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('269', '月薪', '54', '466', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('270', '职位', '54', '466', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('271', '公司名称', '54', '466', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('272', '学历', '54', '466', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('273', '工作年限', '54', '466', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('274', '福利', '54', '466', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('275', '公司性质', '54', '466', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('276', '性别要求', '54', '467', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('277', '月薪', '54', '467', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('278', '职位', '54', '467', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('279', '公司名称', '54', '467', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('280', '学历', '54', '467', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('281', '工作年限', '54', '467', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('282', '福利', '54', '467', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('283', '公司性质', '54', '467', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('284', '性别要求', '54', '468', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('285', '月薪', '54', '468', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('286', '职位', '54', '468', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('287', '公司名称', '54', '468', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('288', '学历', '54', '468', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('289', '工作年限', '54', '468', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('290', '福利', '54', '468', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('291', '公司性质', '54', '468', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('292', '性别要求', '54', '469', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('293', '月薪', '54', '469', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('294', '职位', '54', '469', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('295', '公司名称', '54', '469', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('296', '学历', '54', '469', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('297', '工作年限', '54', '469', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('298', '福利', '54', '469', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('299', '公司性质', '54', '469', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('300', '性别要求', '54', '470', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('301', '月薪', '54', '470', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('302', '职位', '54', '470', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('303', '公司名称', '54', '470', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('304', '学历', '54', '470', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('305', '工作年限', '54', '470', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('306', '福利', '54', '470', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('307', '公司性质', '54', '470', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('308', '性别要求', '54', '471', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('309', '月薪', '54', '471', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('310', '职位', '54', '471', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('311', '公司名称', '54', '471', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('312', '学历', '54', '471', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('313', '工作年限', '54', '471', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('314', '福利', '54', '471', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('315', '公司性质', '54', '471', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('316', '性别要求', '54', '472', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('317', '月薪', '54', '472', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('318', '职位', '54', '472', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('319', '公司名称', '54', '472', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('320', '学历', '54', '472', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('321', '工作年限', '54', '472', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('322', '福利', '54', '472', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('323', '公司性质', '54', '472', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('324', '性别要求', '54', '473', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('325', '月薪', '54', '473', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('326', '职位', '54', '473', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('327', '公司名称', '54', '473', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('328', '学历', '54', '473', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('329', '工作年限', '54', '473', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('330', '福利', '54', '473', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('331', '公司性质', '54', '473', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('332', '性别要求', '54', '474', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('333', '月薪', '54', '474', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('334', '职位', '54', '474', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('335', '公司名称', '54', '474', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('336', '学历', '54', '474', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('337', '工作年限', '54', '474', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('338', '福利', '54', '474', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('339', '公司性质', '54', '474', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('340', '性别要求', '54', '475', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('341', '月薪', '54', '475', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('342', '职位', '54', '475', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('343', '公司名称', '54', '475', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('344', '学历', '54', '475', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('345', '工作年限', '54', '475', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('346', '福利', '54', '475', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('347', '公司性质', '54', '475', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('348', '性别要求', '54', '476', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('349', '月薪', '54', '476', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('350', '职位', '54', '476', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('351', '公司名称', '54', '476', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('352', '学历', '54', '476', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('353', '工作年限', '54', '476', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('354', '福利', '54', '476', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('355', '公司性质', '54', '476', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('356', '性别要求', '54', '477', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('357', '月薪', '54', '477', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('358', '职位', '54', '477', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('359', '公司名称', '54', '477', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('360', '学历', '54', '477', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('361', '工作年限', '54', '477', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('362', '福利', '54', '477', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('363', '公司性质', '54', '477', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('364', '性别要求', '54', '478', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('365', '月薪', '54', '478', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('366', '职位', '54', '478', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('367', '公司名称', '54', '478', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('368', '学历', '54', '478', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('369', '工作年限', '54', '478', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('370', '福利', '54', '478', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('371', '公司性质', '54', '478', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('372', '性别要求', '54', '479', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('373', '月薪', '54', '479', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('374', '职位', '54', '479', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('375', '公司名称', '54', '479', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('376', '学历', '54', '479', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('377', '工作年限', '54', '479', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('378', '福利', '54', '479', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('379', '公司性质', '54', '479', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('380', '性别要求', '54', '480', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('381', '月薪', '54', '480', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('382', '职位', '54', '480', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('383', '公司名称', '54', '480', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('384', '学历', '54', '480', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('385', '工作年限', '54', '480', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('386', '福利', '54', '480', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('387', '公司性质', '54', '480', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('388', '性别要求', '54', '481', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('389', '月薪', '54', '481', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('390', '职位', '54', '481', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('391', '公司名称', '54', '481', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('392', '学历', '54', '481', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('393', '工作年限', '54', '481', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('394', '福利', '54', '481', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('395', '公司性质', '54', '481', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('396', '性别要求', '54', '482', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('397', '月薪', '54', '482', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('398', '职位', '54', '482', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('399', '公司名称', '54', '482', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('400', '学历', '54', '482', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('401', '工作年限', '54', '482', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('402', '福利', '54', '482', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('403', '公司性质', '54', '482', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('404', '性别要求', '54', '483', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('405', '月薪', '54', '483', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('406', '职位', '54', '483', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('407', '公司名称', '54', '483', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('408', '学历', '54', '483', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('409', '工作年限', '54', '483', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('410', '福利', '54', '483', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('411', '公司性质', '54', '483', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('412', '性别要求', '54', '484', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('413', '月薪', '54', '484', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('414', '职位', '54', '484', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('415', '公司名称', '54', '484', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('416', '学历', '54', '484', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('417', '工作年限', '54', '484', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('418', '福利', '54', '484', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('419', '公司性质', '54', '484', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('420', '性别要求', '54', '485', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('421', '月薪', '54', '485', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('422', '职位', '54', '485', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('423', '公司名称', '54', '485', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('424', '学历', '54', '485', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('425', '工作年限', '54', '485', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('426', '福利', '54', '485', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('427', '公司性质', '54', '485', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('428', '性别要求', '54', '486', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('429', '月薪', '54', '486', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('430', '职位', '54', '486', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('431', '公司名称', '54', '486', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('432', '学历', '54', '486', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('433', '工作年限', '54', '486', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('434', '福利', '54', '486', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('435', '公司性质', '54', '486', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('436', '性别要求', '54', '487', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('437', '月薪', '54', '487', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('438', '职位', '54', '487', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('439', '公司名称', '54', '487', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('440', '学历', '54', '487', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('441', '工作年限', '54', '487', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('442', '福利', '54', '487', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('443', '公司性质', '54', '487', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('444', '性别要求', '54', '488', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('445', '月薪', '54', '488', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('446', '职位', '54', '488', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('447', '公司名称', '54', '488', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('448', '学历', '54', '488', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('449', '工作年限', '54', '488', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('450', '福利', '54', '488', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('451', '公司性质', '54', '488', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('452', '性别要求', '54', '489', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('453', '月薪', '54', '489', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('454', '职位', '54', '489', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('455', '公司名称', '54', '489', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('456', '学历', '54', '489', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('457', '工作年限', '54', '489', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('458', '福利', '54', '489', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('459', '公司性质', '54', '489', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('460', '性别要求', '54', '490', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('461', '月薪', '54', '490', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('462', '职位', '54', '490', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('463', '公司名称', '54', '490', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('464', '学历', '54', '490', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('465', '工作年限', '54', '490', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('466', '福利', '54', '490', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('467', '公司性质', '54', '490', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('468', '性别要求', '54', '491', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('469', '月薪', '54', '491', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('470', '职位', '54', '491', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('471', '公司名称', '54', '491', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('472', '学历', '54', '491', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('473', '工作年限', '54', '491', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('474', '福利', '54', '491', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('475', '公司性质', '54', '491', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('476', '性别要求', '54', '492', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('477', '月薪', '54', '492', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('478', '职位', '54', '492', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('479', '公司名称', '54', '492', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('480', '学历', '54', '492', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('481', '工作年限', '54', '492', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('482', '福利', '54', '492', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('483', '公司性质', '54', '492', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('484', '性别要求', '54', '493', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('485', '月薪', '54', '493', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('486', '职位', '54', '493', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('487', '公司名称', '54', '493', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('488', '学历', '54', '493', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('489', '工作年限', '54', '493', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('490', '福利', '54', '493', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('491', '公司性质', '54', '493', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('492', '性别要求', '54', '494', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('493', '月薪', '54', '494', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('494', '职位', '54', '494', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('495', '公司名称', '54', '494', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('496', '学历', '54', '494', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('497', '工作年限', '54', '494', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('498', '福利', '54', '494', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('499', '公司性质', '54', '494', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('500', '性别要求', '54', '495', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('501', '月薪', '54', '495', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('502', '职位', '54', '495', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('503', '公司名称', '54', '495', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('504', '学历', '54', '495', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('505', '工作年限', '54', '495', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('506', '福利', '54', '495', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('507', '公司性质', '54', '495', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('508', '性别要求', '54', '496', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('509', '月薪', '54', '496', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('510', '职位', '54', '496', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('511', '公司名称', '54', '496', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('512', '学历', '54', '496', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('513', '工作年限', '54', '496', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('514', '福利', '54', '496', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('515', '公司性质', '54', '496', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('516', '性别要求', '54', '497', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('517', '月薪', '54', '497', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('518', '职位', '54', '497', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('519', '公司名称', '54', '497', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('520', '学历', '54', '497', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('521', '工作年限', '54', '497', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('522', '福利', '54', '497', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('523', '公司性质', '54', '497', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('524', '性别要求', '54', '498', '2', '1:男\n2:女\n3:男女不限', '100');
INSERT INTO `yy_info_attr` VALUES ('525', '月薪', '54', '498', '2', '1:面议\n2:1000以下\n3:1000~2000\n4:2000~3000\n5:3000~6000\n6:6000~8000\n7:8000~12000\n8:12000~30000\n9:30000以上', '101');
INSERT INTO `yy_info_attr` VALUES ('526', '职位', '54', '498', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('527', '公司名称', '54', '498', '1', '', '103');
INSERT INTO `yy_info_attr` VALUES ('528', '学历', '54', '498', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '104');
INSERT INTO `yy_info_attr` VALUES ('529', '工作年限', '54', '498', '5', '年', '105');
INSERT INTO `yy_info_attr` VALUES ('530', '福利', '54', '498', '3', '1:五险一金\n2:包住\n3:包吃\n4:年底双薪\n5:周末双休\n6:交通补助\n7:加班补助\n8:餐补\n9:话补\n10:房补', '106');
INSERT INTO `yy_info_attr` VALUES ('531', '公司性质', '54', '498', '2', '1:私营\n2:国有\n3:股份制\n4:外商独资办事处\n5:中外合资/合作\n6:上市公司\n7:事业单位\n8:政府机关', '107');
INSERT INTO `yy_info_attr` VALUES ('532', '日薪', '55', '499', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('533', '公司名称', '55', '499', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('534', '日薪', '55', '500', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('535', '公司名称', '55', '500', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('536', '日薪', '55', '501', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('537', '公司名称', '55', '501', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('538', '日薪', '55', '502', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('539', '公司名称', '55', '502', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('540', '日薪', '55', '503', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('541', '公司名称', '55', '503', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('542', '日薪', '55', '504', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('543', '公司名称', '55', '504', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('544', '日薪', '55', '505', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('545', '公司名称', '55', '505', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('546', '日薪', '55', '506', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('547', '公司名称', '55', '506', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('548', '日薪', '55', '507', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('549', '公司名称', '55', '507', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('550', '日薪', '55', '508', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('551', '公司名称', '55', '508', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('552', '日薪', '55', '509', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('553', '公司名称', '55', '509', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('554', '日薪', '55', '510', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('555', '公司名称', '55', '510', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('556', '日薪', '55', '511', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('557', '公司名称', '55', '511', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('558', '日薪', '55', '512', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('559', '公司名称', '55', '512', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('560', '日薪', '55', '513', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('561', '公司名称', '55', '513', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('562', '日薪', '55', '514', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('563', '公司名称', '55', '514', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('564', '日薪', '55', '515', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('565', '公司名称', '55', '515', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('566', '日薪', '55', '516', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('567', '公司名称', '55', '516', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('568', '日薪', '55', '517', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('569', '公司名称', '55', '517', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('570', '日薪', '55', '518', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('571', '公司名称', '55', '518', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('572', '日薪', '55', '519', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('573', '公司名称', '55', '519', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('574', '日薪', '55', '520', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('575', '公司名称', '55', '520', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('576', '日薪', '55', '521', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('577', '公司名称', '55', '521', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('578', '日薪', '55', '522', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('579', '公司名称', '55', '522', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('580', '日薪', '55', '523', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('581', '公司名称', '55', '523', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('582', '日薪', '55', '524', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('583', '公司名称', '55', '524', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('584', '日薪', '55', '525', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('585', '公司名称', '55', '525', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('586', '日薪', '55', '526', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('587', '公司名称', '55', '526', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('588', '日薪', '55', '527', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('589', '公司名称', '55', '527', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('590', '日薪', '55', '528', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('591', '公司名称', '55', '528', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('592', '日薪', '55', '529', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('593', '公司名称', '55', '529', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('594', '日薪', '55', '530', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('595', '公司名称', '55', '530', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('596', '日薪', '55', '531', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('597', '公司名称', '55', '531', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('598', '日薪', '55', '532', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('599', '公司名称', '55', '532', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('600', '日薪', '55', '533', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('601', '公司名称', '55', '533', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('602', '日薪', '55', '534', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('603', '公司名称', '55', '534', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('604', '日薪', '55', '535', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('605', '公司名称', '55', '535', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('606', '日薪', '55', '536', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('607', '公司名称', '55', '536', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('608', '日薪', '55', '537', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('609', '公司名称', '55', '537', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('610', '日薪', '55', '538', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('611', '公司名称', '55', '538', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('612', '日薪', '55', '539', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('613', '公司名称', '55', '539', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('614', '日薪', '55', '540', '5', '元/天', '100');
INSERT INTO `yy_info_attr` VALUES ('615', '公司名称', '55', '540', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('616', '性别', '56', '541', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('617', '学历', '56', '541', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('618', '是否应届', '56', '541', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('619', '工作年限', '56', '541', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('620', '性别', '56', '542', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('621', '学历', '56', '542', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('622', '是否应届', '56', '542', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('623', '工作年限', '56', '542', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('624', '性别', '56', '543', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('625', '学历', '56', '543', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('626', '是否应届', '56', '543', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('627', '工作年限', '56', '543', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('628', '性别', '56', '544', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('629', '学历', '56', '544', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('630', '是否应届', '56', '544', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('631', '工作年限', '56', '544', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('632', '性别', '56', '545', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('633', '学历', '56', '545', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('634', '是否应届', '56', '545', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('635', '工作年限', '56', '545', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('636', '性别', '56', '546', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('637', '学历', '56', '546', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('638', '是否应届', '56', '546', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('639', '工作年限', '56', '546', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('640', '性别', '56', '547', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('641', '学历', '56', '547', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('642', '是否应届', '56', '547', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('643', '工作年限', '56', '547', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('644', '性别', '56', '548', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('645', '学历', '56', '548', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('646', '是否应届', '56', '548', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('647', '工作年限', '56', '548', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('648', '性别', '56', '549', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('649', '学历', '56', '549', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('650', '是否应届', '56', '549', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('651', '工作年限', '56', '549', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('652', '性别', '56', '550', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('653', '学历', '56', '550', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('654', '是否应届', '56', '550', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('655', '工作年限', '56', '550', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('656', '性别', '56', '551', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('657', '学历', '56', '551', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('658', '是否应届', '56', '551', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('659', '工作年限', '56', '551', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('660', '性别', '56', '552', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('661', '学历', '56', '552', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('662', '是否应届', '56', '552', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('663', '工作年限', '56', '552', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('664', '性别', '56', '553', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('665', '学历', '56', '553', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('666', '是否应届', '56', '553', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('667', '工作年限', '56', '553', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('668', '性别', '56', '554', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('669', '学历', '56', '554', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('670', '是否应届', '56', '554', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('671', '工作年限', '56', '554', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('672', '性别', '56', '555', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('673', '学历', '56', '555', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('674', '是否应届', '56', '555', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('675', '工作年限', '56', '555', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('676', '性别', '56', '556', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('677', '学历', '56', '556', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('678', '是否应届', '56', '556', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('679', '工作年限', '56', '556', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('680', '性别', '56', '557', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('681', '学历', '56', '557', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('682', '是否应届', '56', '557', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('683', '工作年限', '56', '557', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('684', '性别', '56', '558', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('685', '学历', '56', '558', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('686', '是否应届', '56', '558', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('687', '工作年限', '56', '558', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('688', '性别', '56', '559', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('689', '学历', '56', '559', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('690', '是否应届', '56', '559', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('691', '工作年限', '56', '559', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('692', '性别', '56', '560', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('693', '学历', '56', '560', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('694', '是否应届', '56', '560', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('695', '工作年限', '56', '560', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('696', '性别', '56', '561', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('697', '学历', '56', '561', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('698', '是否应届', '56', '561', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('699', '工作年限', '56', '561', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('700', '性别', '56', '562', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('701', '学历', '56', '562', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('702', '是否应届', '56', '562', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('703', '工作年限', '56', '562', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('704', '性别', '56', '563', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('705', '学历', '56', '563', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('706', '是否应届', '56', '563', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('707', '工作年限', '56', '563', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('708', '性别', '56', '564', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('709', '学历', '56', '564', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('710', '是否应届', '56', '564', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('711', '工作年限', '56', '564', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('712', '性别', '56', '565', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('713', '学历', '56', '565', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('714', '是否应届', '56', '565', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('715', '工作年限', '56', '565', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('716', '性别', '56', '566', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('717', '学历', '56', '566', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('718', '是否应届', '56', '566', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('719', '工作年限', '56', '566', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('720', '性别', '56', '567', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('721', '学历', '56', '567', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('722', '是否应届', '56', '567', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('723', '工作年限', '56', '567', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('724', '性别', '56', '568', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('725', '学历', '56', '568', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('726', '是否应届', '56', '568', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('727', '工作年限', '56', '568', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('728', '性别', '56', '569', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('729', '学历', '56', '569', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('730', '是否应届', '56', '569', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('731', '工作年限', '56', '569', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('732', '性别', '56', '570', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('733', '学历', '56', '570', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('734', '是否应届', '56', '570', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('735', '工作年限', '56', '570', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('736', '性别', '56', '571', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('737', '学历', '56', '571', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('738', '是否应届', '56', '571', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('739', '工作年限', '56', '571', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('740', '性别', '56', '572', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('741', '学历', '56', '572', '2', '1:初中及以下\n2:高中/中专/技校\n3:大专\n4:本科\n5:硕士\n6:博士及以上', '101');
INSERT INTO `yy_info_attr` VALUES ('742', '是否应届', '56', '572', '2', '1:应届\n2:非应届', '102');
INSERT INTO `yy_info_attr` VALUES ('743', '工作年限', '56', '572', '5', '年', '103');
INSERT INTO `yy_info_attr` VALUES ('744', '性别', '70', '573', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('745', '职业', '70', '573', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('746', '性别', '70', '574', '2', '1:男\n2:女', '100');
INSERT INTO `yy_info_attr` VALUES ('747', '职业', '70', '574', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('748', '狗狗品种', '57', '193', '2', '1:泰迪\n2:萨摩耶\n3:金毛\n4:藏獒\n5:雪橇犬\n6:哈士奇\n7:拉布拉多\n8:贵宾\n100:其它', '100');
INSERT INTO `yy_info_attr` VALUES ('749', '公母', '57', '193', '2', '1:公\n2:母', '101');
INSERT INTO `yy_info_attr` VALUES ('750', '价格', '57', '193', '5', '元', '102');
INSERT INTO `yy_info_attr` VALUES ('751', '来源', '57', '193', '2', '1:个人\n2:商家', '103');
INSERT INTO `yy_info_attr` VALUES ('752', '宠物类别', '57', '194', '2', '1:猫猫\n2:水族\n3:花鸟\n100:其它', '100');
INSERT INTO `yy_info_attr` VALUES ('753', '价格', '57', '194', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('754', '拼车类型', '72', '400', '2', '1:长途车拼车\n2:上下班拼车\n3:上下学拼车\n100:其它拼车', '100');
INSERT INTO `yy_info_attr` VALUES ('755', '价格', '72', '400', '5', '元', '101');
INSERT INTO `yy_info_attr` VALUES ('756', '目的地', '72', '400', '1', '', '102');
INSERT INTO `yy_info_attr` VALUES ('757', '来源', '72', '401', '2', '1:个人\n2:商家', '100');
INSERT INTO `yy_info_attr` VALUES ('758', '价格', '72', '401', '1', '', '101');
INSERT INTO `yy_info_attr` VALUES ('759', '新旧程度', '72', '401', '2', '1:全新\n2:9成新\n3:7成新\n4:5成新', '102');
INSERT INTO `yy_info_attr` VALUES ('760', '学费', '59', '233', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('761', '学费', '59', '234', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('762', '学费', '59', '235', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('763', '学费', '59', '236', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('764', '学费', '59', '237', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('765', '学费', '59', '238', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('766', '学费', '59', '239', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('767', '学费', '59', '240', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('768', '学费', '59', '241', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('769', '学费', '59', '242', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('770', '学费', '59', '243', '5', '元', '100');
INSERT INTO `yy_info_attr` VALUES ('771', '学费', '59', '244', '5', '元', '100');

-- ----------------------------
-- Table structure for yy_info_type
-- ----------------------------
DROP TABLE IF EXISTS `yy_info_type`;
CREATE TABLE `yy_info_type` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '信息类型名',
  `pid` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '父级分类',
  `level` tinyint(3) NOT NULL DEFAULT '1' COMMENT '分类等级',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '排序字段',
  `limit_time` int(10) unsigned NOT NULL DEFAULT '1209600' COMMENT '有效期 单位秒 默认两周',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态 0 - 可见 1-禁止显示',
  `icon` varchar(24) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `uid` (`pid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=594 DEFAULT CHARSET=utf8 COMMENT='分类信息类型表 两级 两级下根据属性再分';

-- ----------------------------
-- Records of yy_info_type
-- ----------------------------
INSERT INTO `yy_info_type` VALUES ('1', '分类信息', '0', '0', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('51', '房屋租售', '1', '1', '1', '1209600', '0', 'icon_fang.gif');
INSERT INTO `yy_info_type` VALUES ('52', '二手转让', '1', '1', '2', '1209600', '0', 'icon_ershou.gif');
INSERT INTO `yy_info_type` VALUES ('53', '车辆买卖', '1', '1', '3', '1209600', '0', 'icon_che.gif');
INSERT INTO `yy_info_type` VALUES ('54', '全职招聘', '1', '1', '4', '1209600', '0', 'icon_zhaopin.gif');
INSERT INTO `yy_info_type` VALUES ('55', '兼职招聘', '1', '1', '5', '1209600', '0', 'icon_jzzhaopin.gif');
INSERT INTO `yy_info_type` VALUES ('56', '求职简历', '1', '1', '6', '1209600', '0', 'icon_jianli.gif');
INSERT INTO `yy_info_type` VALUES ('57', '宠物', '1', '1', '7', '1209600', '0', 'icon_pet.gif');
INSERT INTO `yy_info_type` VALUES ('58', '生活服务', '1', '1', '8', '1209600', '0', 'icon_life.gif');
INSERT INTO `yy_info_type` VALUES ('59', '教育培训', '1', '1', '9', '1209600', '0', 'icon_edu.gif');
INSERT INTO `yy_info_type` VALUES ('60', '商务服务', '1', '1', '10', '1209600', '0', 'icon_business.gif');
INSERT INTO `yy_info_type` VALUES ('61', '医疗健康', '1', '1', '11', '1209600', '2', '');
INSERT INTO `yy_info_type` VALUES ('62', '餐饮美食', '1', '1', '12', '1209600', '0', 'icon_canyin.gif');
INSERT INTO `yy_info_type` VALUES ('63', '休闲娱乐', '1', '1', '13', '1209600', '0', 'xxtb.png');
INSERT INTO `yy_info_type` VALUES ('64', '票务卡券', '1', '1', '14', '1209600', '0', 'piaowutubiao.png');
INSERT INTO `yy_info_type` VALUES ('65', '招商加盟', '1', '1', '15', '1209600', '0', 'jmtb.png');
INSERT INTO `yy_info_type` VALUES ('66', '旅游酒店', '1', '1', '16', '1209600', '0', 'lvyoutubiao.png');
INSERT INTO `yy_info_type` VALUES ('67', '寻人寻物', '1', '1', '17', '1209600', '0', 'xrtb.png');
INSERT INTO `yy_info_type` VALUES ('68', '丽人', '1', '1', '18', '1209600', '0', 'icon_liren.gif');
INSERT INTO `yy_info_type` VALUES ('69', '农林牧副渔', '1', '1', '19', '1209600', '0', 'icon_nong.gif');
INSERT INTO `yy_info_type` VALUES ('70', '交友征婚', '1', '1', '20', '1209600', '0', 'icon_love.gif');
INSERT INTO `yy_info_type` VALUES ('71', '批发采购', '1', '1', '0', '1209600', '0', 'hdtb.png');
INSERT INTO `yy_info_type` VALUES ('72', '汽车服务', '1', '1', '0', '1209600', '0', 'qctb.png');
INSERT INTO `yy_info_type` VALUES ('73', '装修建材', '1', '1', '0', '1209600', '0', 'zhuangxiutubiao.png');
INSERT INTO `yy_info_type` VALUES ('74', '婚庆摄影', '1', '1', '0', '1209600', '0', 'hqtb.png');
INSERT INTO `yy_info_type` VALUES ('100', '房屋出租', '51', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('101', '日租/短租', '51', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('102', '二手房出售', '51', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('103', '店铺转让/出租', '51', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('104', '商铺出售', '51', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('105', '写字楼出租', '51', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('106', '写字楼出售', '51', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('107', '厂房/仓库/土地', '51', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('108', '求租/求购', '51', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('109', '其他房产信息', '51', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('110', '手机及配件', '52', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('111', '手机号码', '52', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('112', '电脑转让', '52', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('113', '数码产品转让', '52', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('114', '家具/办公家具', '52', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('115', '家用电器', '52', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('116', '日常用品', '52', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('117', '办公经营设备', '52', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('118', '收藏品/工艺品', '52', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('119', '服装/配饰/鞋包', '52', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('120', '母婴/玩具', '52', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('121', '运动/图书/乐器', '52', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('122', '门票卡券', '52', '2', '13', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('123', '工业设备', '52', '2', '14', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('124', '校园二手', '52', '2', '15', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('125', '设备租赁', '52', '2', '16', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('126', '闲置礼品', '52', '2', '17', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('127', '物品回收', '52', '2', '18', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('128', 'QQ号码出售', '52', '2', '19', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('129', '游戏账号/装备', '52', '2', '20', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('130', '游戏点卡', '52', '2', '21', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('131', '佛教用品', '52', '2', '22', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('132', '户外用品', '52', '2', '23', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('133', '健身器材', '52', '2', '24', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('134', '物品交换', '52', '2', '25', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('135', '其他物品', '52', '2', '26', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('136', '二手轿车', '53', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('137', '货车/工程车', '53', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('138', '面包车/客车', '53', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('139', '拖拉机/收割机', '53', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('140', '拼车/顺风车', '53', '2', '5', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('141', '新车优惠/4S店', '53', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('142', '汽车用品/配件', '53', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('143', '汽修保养', '53', '2', '8', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('144', '车辆收购服务', '53', '2', '9', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('145', '摩托车/燃气车', '53', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('146', '电动车', '53', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('147', '自行车', '53', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('148', '本地下线车', '53', '2', '13', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('149', '其他车辆信息', '53', '2', '14', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('193', '狗狗', '57', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('194', '猫猫/其他宠物', '57', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('195', '宠物免费赠送', '57', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('196', '宠物用品/食品', '57', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('197', '宠物服务/配种', '57', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('198', '宠物服务', '57', '2', '6', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('199', '宠物寄养', '57', '2', '7', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('200', '秀我宠物', '57', '2', '8', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('201', '宠物医院', '57', '2', '9', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('202', '猫猫/花鸟鱼虫', '57', '2', '10', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('203', '搬家服务', '58', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('204', '保姆/月嫂', '58', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('205', '保洁/清洗', '58', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('206', '管道疏通', '58', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('207', '外卖/送水', '58', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('208', '鲜花/盆景', '58', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('209', '租车服务', '58', '2', '7', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('210', '房屋装修', '58', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('211', '家居维修', '58', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('212', '家电维修', '58', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('213', '电脑维修', '58', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('214', '开锁/修锁', '58', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('215', '婚庆/化妆', '58', '2', '13', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('216', '摄影摄像', '58', '2', '14', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('217', '钟点工', '58', '2', '15', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('218', '洗衣店', '58', '2', '16', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('219', '白事服务', '58', '2', '17', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('220', '休闲娱乐', '58', '2', '18', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('221', '酒店/宾馆', '58', '2', '19', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('222', '驾校服务', '58', '2', '20', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('223', '陪驾/代驾', '58', '2', '21', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('224', '本地名站', '58', '2', '22', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('225', '美容纤体', '58', '2', '23', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('226', '建材装饰', '58', '2', '24', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('227', '旅游度假', '58', '2', '25', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('228', '生鲜配送', '58', '2', '26', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('229', '蛋糕配送', '58', '2', '27', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('230', '鲜奶配送', '58', '2', '28', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('231', '跑腿服务', '58', '2', '29', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('232', '其它生活服务', '58', '2', '30', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('233', '职业培训', '59', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('234', '外语培训', '59', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('235', '学历教育', '59', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('236', '家教', '59', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('237', 'IT培训', '59', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('238', '留学签证', '59', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('239', '高等教育', '59', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('240', '文体培训', '59', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('241', '婴幼儿教育', '59', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('242', '中小学教育', '59', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('243', '公务员培训', '59', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('244', '其他培训', '59', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('245', '投资理财', '60', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('246', '机票/签证', '60', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('247', '招商加盟', '60', '2', '3', '1209600', '1', '');
INSERT INTO `yy_info_type` VALUES ('248', '担保/贷款', '60', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('249', '公司注册', '60', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('250', '会计/审计', '60', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('251', '网站建设', '60', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('252', '快递/物流', '60', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('253', '庆典/演出', '60', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('254', '印刷/喷绘', '60', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('255', '设计策划', '60', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('256', '律师服务', '60', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('257', '翻译/速记', '60', '2', '13', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('258', '礼品定制', '60', '2', '14', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('259', '其它商务服务', '60', '2', '15', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('260', '男科', '61', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('261', '妇科', '61', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('262', '儿科', '61', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('263', '内科', '61', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('264', '外科', '61', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('265', '骨科', '61', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('266', '眼科', '61', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('267', '早泄', '61', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('268', '阳痿', '61', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('269', '体检', '61', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('270', '皮肤科', '61', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('271', '泌尿科', '61', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('272', '性病科', '61', '2', '13', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('273', '五官科', '61', '2', '14', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('274', '肛肠科', '61', '2', '15', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('275', '风湿科', '61', '2', '16', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('276', '肿瘤科', '61', '2', '17', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('277', '健康资讯', '61', '2', '18', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('278', '不孕不育', '61', '2', '19', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('279', '整形美容', '61', '2', '20', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('280', '口腔护理', '61', '2', '21', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('281', '中医保健', '61', '2', '22', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('282', '社区医院', '61', '2', '23', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('283', '精神心理科', '61', '2', '24', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('284', '中餐厅', '62', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('285', '洋餐厅', '62', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('286', '外卖', '62', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('287', '家常菜', '62', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('288', '蛋糕甜点', '62', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('289', '自助餐', '62', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('290', '清真餐厅', '62', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('291', '预定蛋糕', '62', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('302', '电影票', '64', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('303', '优惠券', '64', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('304', '演出票', '64', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('305', '购物卡', '64', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('306', '消费券', '64', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('307', '健身卡', '64', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('308', '体育赛事', '64', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('309', '景点门票', '64', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('310', '特价打折机票', '64', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('311', '展览/会展门票', '64', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('312', '少儿剧场门票', '64', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('313', '舞蹈芭蕾门票', '64', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('314', '话剧/歌剧/戏曲门票', '64', '2', '13', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('315', '其他票务', '64', '2', '14', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('316', '餐饮加盟', '65', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('317', '服装加盟', '65', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('318', '箱包加盟', '65', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('319', '美容保健', '65', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('320', '礼品饰品', '65', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('321', '家居环保', '65', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('322', '家政加盟', '65', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('323', '干洗加盟', '65', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('324', '物流加盟', '65', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('325', '网络服务', '65', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('326', '家装建材', '65', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('327', '机械工业', '65', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('328', '婴幼加盟', '65', '2', '13', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('329', '特色加盟', '65', '2', '14', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('330', '汽车服务加盟', '65', '2', '15', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('331', '农业加盟', '65', '2', '16', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('332', '旅行社票务加盟', '65', '2', '17', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('333', '干洗店', '65', '2', '18', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('334', '网络教育', '65', '2', '19', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('335', '酒店加盟', '65', '2', '20', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('336', '周边游', '66', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('337', '农家乐', '66', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('338', '采摘', '66', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('339', '度假村', '66', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('340', '国内游', '66', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('341', '出境游', '66', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('342', '旅行社', '66', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('343', '酒店预定', '66', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('344', '寻人', '67', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('345', '寻物', '67', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('346', '寻宠物', '67', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('347', '美体瘦身', '68', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('348', '丰胸', '68', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('349', 'SPA', '68', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('350', '舞蹈瑜伽', '68', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('351', '美发护发', '68', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('352', '美甲', '68', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('353', '纹身', '68', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('354', '其他丽人信息', '68', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('355', '粮油作物种苗', '69', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('356', '园林花卉', '69', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('357', '畜禽养殖', '69', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('358', '农作物', '69', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('359', '饲料/兽药', '69', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('360', '农药/肥料', '69', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('361', '农产品加工/代理', '69', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('362', '水产', '69', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('363', '农机具/设备', '69', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('364', '其他农林牧副渔', '69', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('378', '食品批发', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('379', '纺织/布料', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('380', '服饰鞋帽', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('381', '商超设备', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('382', '安防设备', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('383', '化妆品', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('384', '母婴玩具', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('385', '运动用品', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('386', '手机数码', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('387', '箱包/饰品', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('388', '礼品批发', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('389', '电工电料', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('390', '电子元器', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('391', '仪表仪器', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('392', '灯具照明', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('393', '原材料', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('394', '机械加工', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('395', '包装批发', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('396', '化学品', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('397', '图书批发', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('398', '音像批发', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('399', '卡券批发', '71', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('400', '拼车/顺风车', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('401', '汽修保养', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('402', '车辆收购服务', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('403', '驾校服务', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('404', '陪驾/代驾', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('405', '租车服务', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('406', '过户/验车', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('407', '4S店', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('408', '汽车美容装饰', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('409', '改装/防护', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('410', '汽车服务大全', '72', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('411', '家庭装修', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('412', '办公室装修', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('413', '店面装修', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('414', '局部装修', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('415', '别墅装修', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('416', '房屋改造', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('417', '二手房翻新', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('418', '装修设计', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('419', '商业装修', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('420', '地坪', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('421', '卫浴', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('422', '洁具', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('423', '窗帘布艺', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('424', '五金', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('425', '灯饰', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('426', '门窗', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('427', '水电', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('428', '墙面地板', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('429', '吊顶建材', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('430', '橱柜', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('431', '楼梯', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('432', '暖气地暖', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('433', '住宅家具', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('434', '商务办公家具', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('435', '智能家居系统', '73', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('436', '婚车租用', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('437', '婚宴酒店', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('438', '婚礼策划', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('439', '主持司仪', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('440', '婚庆用品', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('441', '跟拍/摄录', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('442', '婚纱/礼服', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('443', '彩妆造型', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('444', '灯光音响', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('445', '花卉植株', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('446', '花车装饰', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('447', '演艺助兴', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('448', '婚纱照拍摄', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('449', '伴娘/伴郎租用', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('450', '婚庆其他', '74', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('451', '超市/百货/零售', '54', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('452', '客服', '54', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('453', '销售/市场/业务员', '54', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('454', '行政/后勤', '54', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('455', '淘宝职位', '54', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('456', '司机/驾驶员', '54', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('457', '家政/安保', '54', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('458', '餐饮/酒店', '54', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('459', '贸易/运输/物流', '54', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('460', '工人/技工', '54', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('461', '财务/审计/税务', '54', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('462', '毕业生/实习生/培训生', '54', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('463', '美术/设计/创意', '54', '2', '13', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('464', '保健按摩', '54', '2', '14', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('465', '人才招聘会', '54', '2', '15', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('466', 'KTV', '54', '2', '16', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('467', '其他招聘', '54', '2', '17', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('468', '人力资源', '54', '2', '18', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('469', '房产中介经纪/开发', '54', '2', '19', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('470', '生产/制造', '54', '2', '20', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('471', '旅游', '54', '2', '21', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('472', '美容/美发', '54', '2', '22', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('473', '保健按摩', '54', '2', '23', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('474', '运动健身', '54', '2', '24', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('475', '保险', '54', '2', '25', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('476', '金融/投资/证券', '54', '2', '26', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('477', '广告/会展', '54', '2', '27', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('478', '媒体/影视/表演', '54', '2', '28', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('479', '编辑/出版/印刷', '54', '2', '29', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('480', '市场/公关/媒介', '54', '2', '30', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('481', '计算机/网络/通信', '54', '2', '31', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('482', '电气/能源/动力', '54', '2', '32', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('483', '机械/仪器仪表', '54', '2', '33', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('484', '翻译', '54', '2', '34', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('485', '法律', '54', '2', '35', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('486', '教育/培训', '54', '2', '36', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('487', '咨询/顾问', '54', '2', '37', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('488', '学术/科研', '54', '2', '38', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('489', '医院/医疗/护理', '54', '2', '39', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('490', '医药/生物工程', '54', '2', '40', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('491', '环保', '54', '2', '41', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('492', '农/林/牧/渔', '54', '2', '42', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('493', '建筑/装修', '54', '2', '43', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('494', '物业管理', '54', '2', '44', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('495', '汽车销售与服务', '54', '2', '45', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('496', '酒吧', '54', '2', '46', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('497', '夜场', '54', '2', '47', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('498', '夜总会招聘', '54', '2', '48', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('499', '传单派发', '55', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('500', '家教', '55', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('501', '服务员', '55', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('502', '模特/礼仪', '55', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('503', '网站设计/建设', '55', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('504', '会计/财务', '55', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('505', '夜场', '55', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('506', '学生兼职', '55', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('507', '促销/导购', '55', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('508', '钟点工', '55', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('509', '生活配送', '55', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('510', '护工', '55', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('511', '催乳师', '55', '2', '13', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('512', '问卷调查', '55', '2', '14', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('513', '活动策划', '55', '2', '15', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('514', '网络营销', '55', '2', '16', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('515', '游戏代练', '55', '2', '17', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('516', 'SEO优化', '55', '2', '18', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('517', '软件开发/编程', '55', '2', '19', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('518', '网络布线/维修', '55', '2', '20', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('519', '美工/平面设计', '55', '2', '21', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('520', 'CAD制图/装修设计', '55', '2', '22', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('521', '图片处理', '55', '2', '23', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('522', '手绘/漫画', '55', '2', '24', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('523', '视频剪辑/制作', '55', '2', '25', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('524', '技工', '55', '2', '26', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('525', '艺术老师', '55', '2', '27', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('526', '健身教练', '55', '2', '28', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('527', '汽车陪练', '55', '2', '29', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('528', '汽车代驾', '55', '2', '30', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('529', '导游', '55', '2', '31', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('530', '写作', '55', '2', '32', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('531', '翻译', '55', '2', '33', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('532', '律师/法务', '55', '2', '34', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('533', '摄影/摄像', '55', '2', '35', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('534', '化妆师', '55', '2', '36', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('535', '司仪/驻唱/演出', '55', '2', '37', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('536', '志愿者', '55', '2', '38', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('537', '夜总会', '55', '2', '39', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('538', 'KTV', '55', '2', '40', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('539', '酒吧', '55', '2', '41', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('540', '其他兼职', '55', '2', '42', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('541', '销售', '56', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('542', '客服', '56', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('543', '人事/行政/后勤', '56', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('544', '酒店/餐饮/旅游', '56', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('545', '美容/美发/保健/健身', '56', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('546', '计算机/网络/通信', '56', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('547', '建筑/房产/装修/物业', '56', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('548', '普工/技工/生产', '56', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('549', '司机', '56', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('550', '家政保洁/安保', '56', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('551', '影视/娱乐/KTV', '56', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('552', '编辑/出版/印刷', '56', '2', '12', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('553', '教育培训', '56', '2', '13', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('554', '财务/审计/统计', '56', '2', '14', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('555', '农/林/牧/渔业', '56', '2', '15', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('556', '市场营销/公关媒介', '56', '2', '16', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('557', '汽车制造/服务', '56', '2', '17', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('558', '零售/促销', '56', '2', '18', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('559', '广告/设计/咨询', '56', '2', '19', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('560', '金融/银行/证券/投资', '56', '2', '20', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('561', '保险', '56', '2', '21', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('562', '贸易/采购/商务', '56', '2', '22', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('563', '仓储/物流', '56', '2', '23', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('564', '法律', '56', '2', '24', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('565', '医疗/制药/生物', '56', '2', '25', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('566', '电子/电气/仪器仪表', '56', '2', '26', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('567', '质控/安防', '56', '2', '27', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('568', '高级管理', '56', '2', '28', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('569', '服装/纺织/食品', '56', '2', '29', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('570', '环境科学/环保', '56', '2', '30', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('571', '翻译', '56', '2', '31', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('572', '其他职位', '56', '2', '32', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('573', '找女友/找男友', '70', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('574', '征婚', '70', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('575', '结伴活动', '70', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('576', '技能交换', '70', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('577', '婚介服务', '70', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('578', '同乡会', '70', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('579', '相约活动', '70', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('580', '公益活动/志愿者', '70', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('581', '真人照片秀', '70', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('582', '运动健身', '63', '2', '1', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('583', '夜店酒吧', '63', '2', '2', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('584', '足疗按摩', '63', '2', '3', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('585', 'KTV/电影院', '63', '2', '4', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('586', '户外运动', '63', '2', '5', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('587', '洗浴/温泉', '63', '2', '6', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('588', '咖啡厅/茶馆', '63', '2', '7', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('589', '网吧', '63', '2', '8', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('590', '桌游/智力', '63', '2', '9', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('591', '电玩城', '63', '2', '10', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('592', '台球厅', '63', '2', '11', '1209600', '0', '');
INSERT INTO `yy_info_type` VALUES ('593', 'DIY手工坊', '63', '2', '12', '1209600', '0', '');

-- ----------------------------
-- Table structure for yy_infoAttrs
-- ----------------------------
DROP TABLE IF EXISTS `yy_infoAttrs`;
CREATE TABLE `yy_infoAttrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info_id` int(10) unsigned NOT NULL COMMENT '分类信息id',
  `attr_id` int(10) unsigned NOT NULL COMMENT '属性id',
  `attr_value_float` decimal(10,2) unsigned NOT NULL COMMENT '属性值-引用',
  `attr_value_text` varchar(256) NOT NULL DEFAULT '' COMMENT '属性值-文本',
  PRIMARY KEY (`id`),
  KEY `info_id` (`info_id`) USING BTREE,
  KEY `attr_id` (`attr_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类信息图片关系表';

-- ----------------------------
-- Records of yy_infoAttrs
-- ----------------------------

-- ----------------------------
-- Table structure for yy_infoBrowse
-- ----------------------------
DROP TABLE IF EXISTS `yy_infoBrowse`;
CREATE TABLE `yy_infoBrowse` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info_id` int(10) unsigned NOT NULL COMMENT '分类信息id',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id 0表示未登录',
  `session_id` varchar(32) NOT NULL DEFAULT '' COMMENT 'session id',
  `ip` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览ip',
  `create_at` int(10) unsigned NOT NULL COMMENT '浏览时间',
  `agent_type` tinyint(3) unsigned DEFAULT '2' COMMENT '代理类型 1-mobile/2-browser/3-robot',
  `system_type` tinyint(3) unsigned DEFAULT '0' COMMENT '系统类型 0-pc/1-apple/2-android/3-other mobile',
  `platform` varchar(24) NOT NULL DEFAULT '' COMMENT '平台',
  `user_agent` varchar(128) NOT NULL DEFAULT '' COMMENT '用户代理',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `info_id` (`info_id`) USING BTREE,
  KEY `ip` (`ip`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类信息浏览表 该表可以记在nosql中';

-- ----------------------------
-- Records of yy_infoBrowse
-- ----------------------------

-- ----------------------------
-- Table structure for yy_infoImgs
-- ----------------------------
DROP TABLE IF EXISTS `yy_infoImgs`;
CREATE TABLE `yy_infoImgs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `info_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类信息id',
  `path` varchar(64) NOT NULL DEFAULT '',
  `porder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `creaat_at` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `info_id` (`info_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类信息图片关系表';

-- ----------------------------
-- Records of yy_infoImgs
-- ----------------------------

-- ----------------------------
-- Table structure for yy_infoReport
-- ----------------------------
DROP TABLE IF EXISTS `yy_infoReport`;
CREATE TABLE `yy_infoReport` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `info_id` int(10) unsigned NOT NULL COMMENT '分类信息id',
  `content` varchar(64) NOT NULL COMMENT '举报内容',
  `uid` int(10) unsigned NOT NULL COMMENT '举报用户id',
  `create_at` int(10) unsigned NOT NULL COMMENT '举报时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '信息状态 0-人工审核-恶意举报,无效 1-默认举报状态 2-人工审核-举报有效',
  `auditor_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '审核人id',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `info_id` (`info_id`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分类信息举报表';

-- ----------------------------
-- Records of yy_infoReport
-- ----------------------------

-- ----------------------------
-- Table structure for yy_region_jh
-- ----------------------------
DROP TABLE IF EXISTS `yy_region_jh`;
CREATE TABLE `yy_region_jh` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `pid` smallint(10) unsigned NOT NULL DEFAULT '0' COMMENT '区域父级id',
  `name` varchar(24) NOT NULL DEFAULT '' COMMENT '地区名',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '地区等级',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `rpid` (`pid`) USING BTREE,
  KEY `level` (`type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1804 DEFAULT CHARSET=utf8 COMMENT='行政区域';

-- ----------------------------
-- Records of yy_region_jh
-- ----------------------------
INSERT INTO `yy_region_jh` VALUES ('1', '0', '金湖县', '0', '0');
INSERT INTO `yy_region_jh` VALUES ('101', '1', '黎城镇（主城区）', '1', '100');
INSERT INTO `yy_region_jh` VALUES ('102', '1', '金南镇', '1', '101');
INSERT INTO `yy_region_jh` VALUES ('103', '1', '闵桥镇', '1', '102');
INSERT INTO `yy_region_jh` VALUES ('104', '1', '塔集镇', '1', '103');
INSERT INTO `yy_region_jh` VALUES ('105', '1', '银集镇', '1', '104');
INSERT INTO `yy_region_jh` VALUES ('106', '1', '涂沟镇', '1', '105');
INSERT INTO `yy_region_jh` VALUES ('107', '1', '前锋镇', '1', '106');
INSERT INTO `yy_region_jh` VALUES ('108', '1', '吕良镇', '1', '107');
INSERT INTO `yy_region_jh` VALUES ('109', '1', '陈桥镇', '1', '108');
INSERT INTO `yy_region_jh` VALUES ('110', '1', '金北镇', '1', '109');
INSERT INTO `yy_region_jh` VALUES ('111', '1', '戴楼镇', '1', '110');
INSERT INTO `yy_region_jh` VALUES ('112', '1', '宝应湖农场', '1', '111');
INSERT INTO `yy_region_jh` VALUES ('113', '1', '复兴圩农场', '1', '112');
INSERT INTO `yy_region_jh` VALUES ('501', '101', '闸东', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('502', '101', '劳动桥', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('503', '101', '宋坝桥', '2', '3');
INSERT INTO `yy_region_jh` VALUES ('504', '101', '城中', '2', '4');
INSERT INTO `yy_region_jh` VALUES ('505', '101', '西苑', '2', '5');
INSERT INTO `yy_region_jh` VALUES ('506', '101', '平安路', '2', '6');
INSERT INTO `yy_region_jh` VALUES ('507', '101', '衡阳路区', '2', '7');
INSERT INTO `yy_region_jh` VALUES ('508', '101', '新城', '2', '8');
INSERT INTO `yy_region_jh` VALUES ('509', '101', '郑岗', '2', '9');
INSERT INTO `yy_region_jh` VALUES ('510', '101', '黎城', '2', '10');
INSERT INTO `yy_region_jh` VALUES ('511', '101', '徐梁', '2', '11');
INSERT INTO `yy_region_jh` VALUES ('512', '101', '工农', '2', '12');
INSERT INTO `yy_region_jh` VALUES ('513', '101', '任庄', '2', '13');
INSERT INTO `yy_region_jh` VALUES ('514', '101', '顺河', '2', '14');
INSERT INTO `yy_region_jh` VALUES ('515', '101', '上湾', '2', '15');
INSERT INTO `yy_region_jh` VALUES ('516', '101', '大兴', '2', '16');
INSERT INTO `yy_region_jh` VALUES ('517', '101', '九里', '2', '17');
INSERT INTO `yy_region_jh` VALUES ('518', '101', '黎东', '2', '18');
INSERT INTO `yy_region_jh` VALUES ('601', '102', '金南', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('602', '102', '金沟', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('603', '102', '卞塘', '2', '3');
INSERT INTO `yy_region_jh` VALUES ('604', '102', '福寿', '2', '4');
INSERT INTO `yy_region_jh` VALUES ('605', '102', '三车村', '2', '200');
INSERT INTO `yy_region_jh` VALUES ('606', '102', '抬饭村', '2', '201');
INSERT INTO `yy_region_jh` VALUES ('607', '102', '宋墩村', '2', '202');
INSERT INTO `yy_region_jh` VALUES ('608', '102', '时墩村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('609', '102', '五里村', '2', '205');
INSERT INTO `yy_region_jh` VALUES ('610', '102', '吴桥村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('611', '102', '王庄村', '2', '207');
INSERT INTO `yy_region_jh` VALUES ('612', '102', '南宫村', '2', '208');
INSERT INTO `yy_region_jh` VALUES ('613', '102', '新坝村', '2', '209');
INSERT INTO `yy_region_jh` VALUES ('614', '102', '南桥村', '2', '210');
INSERT INTO `yy_region_jh` VALUES ('615', '102', '新杨村', '2', '211');
INSERT INTO `yy_region_jh` VALUES ('616', '102', '华家坝村', '2', '212');
INSERT INTO `yy_region_jh` VALUES ('617', '102', '缸庙村', '2', '213');
INSERT INTO `yy_region_jh` VALUES ('618', '102', '连湖村', '2', '214');
INSERT INTO `yy_region_jh` VALUES ('619', '102', '南望村', '2', '215');
INSERT INTO `yy_region_jh` VALUES ('701', '103', '古镇', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('702', '103', '庙沟', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('703', '103', '闵桥', '2', '3');
INSERT INTO `yy_region_jh` VALUES ('704', '103', '双庙村', '2', '201');
INSERT INTO `yy_region_jh` VALUES ('705', '103', '药王村', '2', '202');
INSERT INTO `yy_region_jh` VALUES ('706', '103', '太平村', '2', '203');
INSERT INTO `yy_region_jh` VALUES ('707', '103', '甫坝村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('708', '103', '施尖村', '2', '205');
INSERT INTO `yy_region_jh` VALUES ('709', '103', '金桥村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('710', '103', '小桥村', '2', '207');
INSERT INTO `yy_region_jh` VALUES ('711', '103', '横桥村', '2', '208');
INSERT INTO `yy_region_jh` VALUES ('801', '104', '宝塔', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('802', '104', '夹沟', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('803', '104', '东方红', '2', '3');
INSERT INTO `yy_region_jh` VALUES ('804', '104', '陆河村', '2', '200');
INSERT INTO `yy_region_jh` VALUES ('805', '104', '高桥村', '2', '202');
INSERT INTO `yy_region_jh` VALUES ('806', '104', '联合村', '2', '203');
INSERT INTO `yy_region_jh` VALUES ('807', '104', '新华村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('808', '104', '岔河村', '2', '205');
INSERT INTO `yy_region_jh` VALUES ('809', '104', '安乐村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('810', '104', '三柳村', '2', '207');
INSERT INTO `yy_region_jh` VALUES ('811', '104', '双桥村', '2', '208');
INSERT INTO `yy_region_jh` VALUES ('812', '104', '金平村', '2', '209');
INSERT INTO `yy_region_jh` VALUES ('813', '104', '龚河村', '2', '210');
INSERT INTO `yy_region_jh` VALUES ('901', '105', '银集', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('902', '105', '淮建', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('903', '105', '红湖', '2', '3');
INSERT INTO `yy_region_jh` VALUES ('904', '105', '劳动村', '2', '201');
INSERT INTO `yy_region_jh` VALUES ('905', '105', '复连村', '2', '202');
INSERT INTO `yy_region_jh` VALUES ('906', '105', '团结村', '2', '203');
INSERT INTO `yy_region_jh` VALUES ('907', '105', '天堂村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('908', '105', '何营村', '2', '205');
INSERT INTO `yy_region_jh` VALUES ('909', '105', '新胜村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('910', '105', '刘坝村', '2', '207');
INSERT INTO `yy_region_jh` VALUES ('911', '105', '永祥村', '2', '208');
INSERT INTO `yy_region_jh` VALUES ('912', '105', '高沈村', '2', '209');
INSERT INTO `yy_region_jh` VALUES ('913', '105', '利生村', '2', '210');
INSERT INTO `yy_region_jh` VALUES ('1001', '106', '通衢', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('1002', '106', '港中', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('1003', '106', '涂沟', '2', '3');
INSERT INTO `yy_region_jh` VALUES ('1004', '106', '秦庄村', '2', '200');
INSERT INTO `yy_region_jh` VALUES ('1005', '106', '五星村', '2', '201');
INSERT INTO `yy_region_jh` VALUES ('1006', '106', '唐港村', '2', '202');
INSERT INTO `yy_region_jh` VALUES ('1007', '106', '于沟村', '2', '203');
INSERT INTO `yy_region_jh` VALUES ('1008', '106', '新淮村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('1009', '106', '高邮湖村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('1010', '106', '湖滨村', '2', '207');
INSERT INTO `yy_region_jh` VALUES ('1011', '106', '东湖村', '2', '208');
INSERT INTO `yy_region_jh` VALUES ('1012', '106', '三河村', '2', '209');
INSERT INTO `yy_region_jh` VALUES ('1101', '107', '淮武村', '2', '200');
INSERT INTO `yy_region_jh` VALUES ('1102', '107', '淮胜村', '2', '201');
INSERT INTO `yy_region_jh` VALUES ('1103', '107', '淮村村', '2', '202');
INSERT INTO `yy_region_jh` VALUES ('1104', '107', '同心村', '2', '203');
INSERT INTO `yy_region_jh` VALUES ('1105', '107', '合意村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('1106', '107', '民生村', '2', '205');
INSERT INTO `yy_region_jh` VALUES ('1107', '107', '中兴村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('1108', '107', '阮桥村', '2', '207');
INSERT INTO `yy_region_jh` VALUES ('1109', '107', '郑圩村', '2', '208');
INSERT INTO `yy_region_jh` VALUES ('1110', '107', '东滩村', '2', '209');
INSERT INTO `yy_region_jh` VALUES ('1111', '107', '前锋村', '2', '210');
INSERT INTO `yy_region_jh` VALUES ('1112', '107', '白马湖村', '2', '211');
INSERT INTO `yy_region_jh` VALUES ('1201', '108', '泰山', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('1202', '108', '大庄', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('1203', '108', '赤水村', '2', '201');
INSERT INTO `yy_region_jh` VALUES ('1204', '108', '幸福村', '2', '202');
INSERT INTO `yy_region_jh` VALUES ('1205', '108', '陈庄村', '2', '203');
INSERT INTO `yy_region_jh` VALUES ('1206', '108', '金淮村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('1207', '108', '孙集村', '2', '205');
INSERT INTO `yy_region_jh` VALUES ('1208', '108', '花园村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('1209', '108', '付圩村', '2', '207');
INSERT INTO `yy_region_jh` VALUES ('1210', '108', '沿湖村', '2', '208');
INSERT INTO `yy_region_jh` VALUES ('1211', '108', '三圆村', '2', '209');
INSERT INTO `yy_region_jh` VALUES ('1212', '108', '军舍村', '2', '210');
INSERT INTO `yy_region_jh` VALUES ('1301', '109', '新宁', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('1302', '109', '兴隆', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('1303', '109', '新港', '2', '3');
INSERT INTO `yy_region_jh` VALUES ('1304', '109', '军王村', '2', '200');
INSERT INTO `yy_region_jh` VALUES ('1305', '109', '南宁村', '2', '201');
INSERT INTO `yy_region_jh` VALUES ('1306', '109', '新桥村', '2', '203');
INSERT INTO `yy_region_jh` VALUES ('1307', '109', '邬桥村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('1308', '109', '万坝村', '2', '205');
INSERT INTO `yy_region_jh` VALUES ('1309', '109', '振兴村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('1310', '109', '丰乐村', '2', '207');
INSERT INTO `yy_region_jh` VALUES ('1311', '109', '前进村', '2', '208');
INSERT INTO `yy_region_jh` VALUES ('1312', '109', '新丰村', '2', '209');
INSERT INTO `yy_region_jh` VALUES ('1313', '109', '张坝村', '2', '210');
INSERT INTO `yy_region_jh` VALUES ('1401', '110', '金港', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('1402', '110', '新街', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('1403', '110', '刘庄村', '2', '200');
INSERT INTO `yy_region_jh` VALUES ('1404', '110', '应集村', '2', '201');
INSERT INTO `yy_region_jh` VALUES ('1405', '110', '马港村', '2', '202');
INSERT INTO `yy_region_jh` VALUES ('1406', '110', '张方村', '2', '203');
INSERT INTO `yy_region_jh` VALUES ('1407', '110', '陈渡村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('1408', '110', '董河村', '2', '205');
INSERT INTO `yy_region_jh` VALUES ('1409', '110', '万庄村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('1410', '110', '洪圩村', '2', '208');
INSERT INTO `yy_region_jh` VALUES ('1501', '111', '金西', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('1502', '111', '永丰', '2', '2');
INSERT INTO `yy_region_jh` VALUES ('1503', '111', '官路', '2', '3');
INSERT INTO `yy_region_jh` VALUES ('1504', '111', '戴楼', '2', '4');
INSERT INTO `yy_region_jh` VALUES ('1505', '111', '牌楼', '2', '5');
INSERT INTO `yy_region_jh` VALUES ('1506', '111', '衡阳村', '2', '202');
INSERT INTO `yy_region_jh` VALUES ('1507', '111', '新塘村', '2', '203');
INSERT INTO `yy_region_jh` VALUES ('1508', '111', '小集村', '2', '204');
INSERT INTO `yy_region_jh` VALUES ('1509', '111', '官塘村', '2', '205');
INSERT INTO `yy_region_jh` VALUES ('1510', '111', '红岭村', '2', '206');
INSERT INTO `yy_region_jh` VALUES ('1511', '111', '楼庄村', '2', '207');
INSERT INTO `yy_region_jh` VALUES ('1601', '112', '宝应湖农场', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('1701', '113', '复兴圩农场', '2', '1');
INSERT INTO `yy_region_jh` VALUES ('1704', '0', '不限', '2', '0');

-- ----------------------------
-- Table structure for yy_user
-- ----------------------------
DROP TABLE IF EXISTS `yy_user`;
CREATE TABLE `yy_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(24) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0-普通用户 10-分类信息管理员 100-超级管理员',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '手机号登录',
  `email` varchar(32) NOT NULL DEFAULT '' COMMENT '邮箱登录',
  `passwd` char(32) NOT NULL COMMENT '32位密码',
  `salt` varchar(32) NOT NULL DEFAULT '' COMMENT '密码加盐，与激活位',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '账户状态 0-注册未激活 1-激活可用 2-被举报账户受限 3-黑名单账户',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 1-是/0-否',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加人',
  `create_at` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_at` int(10) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `phone` (`phone`),
  KEY `emial` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yy_user
-- ----------------------------

-- ----------------------------
-- View structure for yy_info_attr_view
-- ----------------------------
DROP VIEW IF EXISTS `yy_info_attr_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `yy_info_attr_view` AS select `a`.`id` AS `id`,`a`.`name` AS `name`,`a`.`type_id` AS `type_id`,`a`.`type2_id` AS `type2_id`,`a`.`type` AS `type`,`a`.`value` AS `value`,`a`.`order` AS `order`,`c1`.`name` AS `c1_name`,`c2`.`name` AS `c2_name` from ((`yy_info_attr` `a` join `yy_info_type` `c1` on((`a`.`type_id` = `c1`.`id`))) join `yy_info_type` `c2` on((`a`.`type2_id` = `c2`.`id`))) ;

-- ----------------------------
-- View structure for yy_info_type_view
-- ----------------------------
DROP VIEW IF EXISTS `yy_info_type_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `yy_info_type_view` AS select `a`.`id` AS `id`,`a`.`name` AS `name`,`a`.`pid` AS `pid`,`a`.`level` AS `level`,`a`.`order` AS `order`,`a`.`limit_time` AS `limit_time`,`b`.`name` AS `pname`,`a`.`status` AS `status`,`b`.`status` AS `pstatus`,`b`.`icon` AS `icon` from (`yy_info_type` `a` join `yy_info_type` `b` on((`a`.`pid` = `b`.`id`))) where ((`a`.`status` = 0) and (`b`.`status` = 0)) ;

-- ----------------------------
-- View structure for yy_info_view
-- ----------------------------
DROP VIEW IF EXISTS `yy_info_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `yy_info_view` AS select `info`.`id` AS `id`,`info`.`uid` AS `uid`,`info`.`type_one_id` AS `type_one_id`,`info`.`type_two_id` AS `type_two_id`,`info`.`title` AS `title`,`info`.`content` AS `content`,`info`.`addr_one_id` AS `addr_one_id`,`info`.`addr_two_id` AS `addr_two_id`,`info`.`addr_detail` AS `addr_detail`,`info`.`lng` AS `lng`,`info`.`lat` AS `lat`,`info`.`zoom` AS `zoom`,`info`.`name` AS `name`,`info`.`phone` AS `phone`,`info`.`email` AS `email`,`info`.`qq` AS `qq`,`info`.`passwd` AS `passwd`,`info`.`show_type` AS `show_type`,`info`.`create_at` AS `create_at`,`info`.`update_at` AS `update_at`,`info`.`ip` AS `ip`,`info`.`limit` AS `limit`,`info`.`is_pro` AS `is_pro`,`info`.`is_top` AS `is_top`,`info`.`top_type` AS `top_type`,`info`.`look_num` AS `look_num`,`info`.`status` AS `status`,`info`.`auditor_id` AS `auditor_id`,`info`.`is_delete` AS `is_delete`,`t1`.`name` AS `t1_name`,`t2`.`name` AS `t2_name`,`r1`.`name` AS `r1_name`,`r2`.`name` AS `r2_name` from ((((`yy_info` `info` join `yy_info_type` `t1` on((`t1`.`id` = `info`.`type_one_id`))) join `yy_info_type` `t2` on((`info`.`type_two_id` = `t2`.`id`))) join `yy_region_jh` `r1` on((`r1`.`id` = `info`.`addr_one_id`))) join `yy_region_jh` `r2` on((`info`.`addr_two_id` = `r2`.`id`))) ;

-- ----------------------------
-- View structure for yy_infoAttrs_view
-- ----------------------------
DROP VIEW IF EXISTS `yy_infoAttrs_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `yy_infoAttrs_view` AS select `yy_infoAttrs`.`id` AS `id`,`yy_infoAttrs`.`info_id` AS `info_id`,`yy_infoAttrs`.`attr_id` AS `attr_id`,`yy_infoAttrs`.`attr_value_float` AS `attr_value_float`,`yy_infoAttrs`.`attr_value_text` AS `attr_value_text`,`yy_info_attr`.`name` AS `name`,`yy_info_attr`.`type` AS `type`,`yy_info_attr`.`value` AS `value`,`yy_info_attr`.`order` AS `order` from (`yy_infoAttrs` join `yy_info_attr` on((`yy_infoAttrs`.`attr_id` = `yy_info_attr`.`id`))) ;

-- ----------------------------
-- View structure for yy_region_jh_view
-- ----------------------------
DROP VIEW IF EXISTS `yy_region_jh_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `yy_region_jh_view` AS select `a`.`id` AS `id`,`a`.`pid` AS `pid`,`a`.`name` AS `name`,`a`.`type` AS `type`,`a`.`order` AS `order`,`b`.`name` AS `pname` from (`yy_region_jh` `a` join `yy_region_jh` `b` on((`a`.`pid` = `b`.`id`))) ;

-- ----------------------------
-- View structure for yy_user_view
-- ----------------------------
DROP VIEW IF EXISTS `yy_user_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `yy_user_view` AS select `yy_user`.`id` AS `id`,`yy_user`.`name` AS `name`,`yy_user`.`role_id` AS `role_id`,`yy_user`.`phone` AS `phone`,`yy_user`.`email` AS `email`,`yy_user`.`status` AS `status`,`yy_user`.`create_at` AS `create_at` from `yy_user` ;
