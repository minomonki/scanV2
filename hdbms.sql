/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50139
Source Host           : localhost:3306
Source Database       : hdbms

Target Server Type    : MYSQL
Target Server Version : 50139
File Encoding         : 65001

Date: 2012-07-18 23:16:46
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tb_ipd`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd`;
CREATE TABLE `tb_ipd` (
  `an` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hn` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `indate` date NOT NULL,
  `outdate` date NOT NULL,
  `pages` int(4) NOT NULL,
  `datescan` date NOT NULL,
  PRIMARY KEY (`an`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ipd_doctype`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_doctype`;
CREATE TABLE `tb_ipd_doctype` (
  `DocID` int(5) NOT NULL,
  `DocTypeName` varchar(255) NOT NULL,
  `DocType` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`DocID`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_doctype
-- ----------------------------
INSERT INTO `tb_ipd_doctype` VALUES ('1', 'ใบ Clinical Summary', 'CLI');
INSERT INTO `tb_ipd_doctype` VALUES ('2', 'ใบ Discharge  Summary', 'DIS');
INSERT INTO `tb_ipd_doctype` VALUES ('3', 'ใบตอบกลับ Refer หรือใบบันทึกข้อความ', 'REF');
INSERT INTO `tb_ipd_doctype` VALUES ('4', 'ใบยินยอมทำการรักษา', 'INF');
INSERT INTO `tb_ipd_doctype` VALUES ('5', 'ใบตรวจร่างกายแพทย์', 'HIS');
INSERT INTO `tb_ipd_doctype` VALUES ('6', 'ใบ Doctor  Order', 'ORD');
INSERT INTO `tb_ipd_doctype` VALUES ('7', 'ใบสหวิชาชีพ', 'SAH');
INSERT INTO `tb_ipd_doctype` VALUES ('8', 'ใบดมยา', 'ANE');
INSERT INTO `tb_ipd_doctype` VALUES ('9', 'ใบผ่าตัด', 'OPE');
INSERT INTO `tb_ipd_doctype` VALUES ('10', 'ใบ Labour  record / pathograme', 'LBR');
INSERT INTO `tb_ipd_doctype` VALUES ('11', 'ใบ lab', 'LAB');
INSERT INTO `tb_ipd_doctype` VALUES ('12', 'ใบรายงานการให้เลือด', 'BLO');
INSERT INTO `tb_ipd_doctype` VALUES ('13', 'ใบตรวจ EKG', 'EKG');
INSERT INTO `tb_ipd_doctype` VALUES ('14', 'ใบบันทึกทางการฟื้นฟูสภาพ เช่น ฝังเข็ม นวดบำบัด', 'PHY');
INSERT INTO `tb_ipd_doctype` VALUES ('28', 'Nurse Note[ลับ]', 'NURS');
INSERT INTO `tb_ipd_doctype` VALUES ('29', 'ใบ Clinical Summary[ลับ]', 'CLIS');
INSERT INTO `tb_ipd_doctype` VALUES ('15', 'ใบแจ้งการให้ยา', 'MED');
INSERT INTO `tb_ipd_doctype` VALUES ('16', 'ใบประเมินสมรรถนะของพยาบาล', 'COM');
INSERT INTO `tb_ipd_doctype` VALUES ('27', 'DM chart [ลับ]', 'DMCS');
INSERT INTO `tb_ipd_doctype` VALUES ('17', 'ปัญหาทางการพยาบาล', 'PRO');
INSERT INTO `tb_ipd_doctype` VALUES ('18', 'Nurse  Note', 'NUR');
INSERT INTO `tb_ipd_doctype` VALUES ('19', 'ฟอร์มปรอท', 'TEM');
INSERT INTO `tb_ipd_doctype` VALUES ('20', 'ใบ Observe  BP   ,  I/O   ,  N/S', 'OBS');
INSERT INTO `tb_ipd_doctype` VALUES ('21', 'DM  chart', 'DMC');
INSERT INTO `tb_ipd_doctype` VALUES ('22', 'วางแผนการจำหน่าย', 'DPN');
INSERT INTO `tb_ipd_doctype` VALUES ('23', 'ใบอื่น ๆ ที่เกี่ยวกับพยาบาล', 'OTH');
INSERT INTO `tb_ipd_doctype` VALUES ('26', '___', 'TES');
INSERT INTO `tb_ipd_doctype` VALUES ('24', 'ใบ คร.', 'FIN');
INSERT INTO `tb_ipd_doctype` VALUES ('25', 'ใบตรวจสอบสิทธิ', 'INS');
INSERT INTO `tb_ipd_doctype` VALUES ('0', 'เอกสารรวม', '0');
INSERT INTO `tb_ipd_doctype` VALUES ('999', 'Documents confidential', 'SRE');
INSERT INTO `tb_ipd_doctype` VALUES ('30', 'ใบ Discharge Summary[ลับ]', 'DISS');
INSERT INTO `tb_ipd_doctype` VALUES ('31', 'ใบ Doctor Order[ลับ]', 'ORDS');
INSERT INTO `tb_ipd_doctype` VALUES ('32', 'ใบ lab[ลับ]', 'LABS');
INSERT INTO `tb_ipd_doctype` VALUES ('33', 'ใบ Labour record / pathograme[ลับ]', 'LBRS');
INSERT INTO `tb_ipd_doctype` VALUES ('34', 'ใบ Observe BP , I/O , N/S[ลับ]', 'OBSS');
INSERT INTO `tb_ipd_doctype` VALUES ('35', 'ใบ คร.[ลับ]', 'FINS');
INSERT INTO `tb_ipd_doctype` VALUES ('36', 'ใบแจ้งการให้ยา[ลับ]', 'MEDS');
INSERT INTO `tb_ipd_doctype` VALUES ('37', 'ใบดมยา[ลับ]', 'ANES');
INSERT INTO `tb_ipd_doctype` VALUES ('38', 'ใบตรวจ EKG[ลับ]', 'EKGS');
INSERT INTO `tb_ipd_doctype` VALUES ('39', 'ใบตรวจร่างกายแพทย์[ลับ]', 'HISS');
INSERT INTO `tb_ipd_doctype` VALUES ('40', 'ใบตรวจสอบสิทธิ[ลับ]', 'INSS');
INSERT INTO `tb_ipd_doctype` VALUES ('41', 'ใบตอบกลับ Refer หรือใบบันทึกข้อความ[ลับ]', 'REFS');
INSERT INTO `tb_ipd_doctype` VALUES ('42', 'ใบบันทึกทางการฟื้นฟูสภาพ เช่น ฝังเข็ม นวดบำบัด[ลับ]', 'PHYS');
INSERT INTO `tb_ipd_doctype` VALUES ('43', 'ใบประเมินสมรรถนะของพยาบาล[ลับ]', 'COMS');
INSERT INTO `tb_ipd_doctype` VALUES ('44', 'ใบผ่าตัด[ลับ]', 'OPES');
INSERT INTO `tb_ipd_doctype` VALUES ('45', 'ใบยินยอมทำการรักษา[ลับ]', 'INFS');
INSERT INTO `tb_ipd_doctype` VALUES ('46', 'ใบรายงานการให้เลือด[ลับ]', 'BLOS');
INSERT INTO `tb_ipd_doctype` VALUES ('47', 'ใบสหวิชาชีพ[ลับ]', 'SAHS');
INSERT INTO `tb_ipd_doctype` VALUES ('48', 'ใบอื่น ๆ ที่เกี่ยวกับพยาบาล[ลับ]', 'OTHS');
INSERT INTO `tb_ipd_doctype` VALUES ('49', 'ปัญหาทางการพยาบาล[ลับ]', 'PROS');
INSERT INTO `tb_ipd_doctype` VALUES ('50', 'ฟอร์มปรอท[ลับ]', 'TEMS');
INSERT INTO `tb_ipd_doctype` VALUES ('51', 'วางแผนการจำหน่าย[ลับ]', 'DPNS');

-- ----------------------------
-- Table structure for `tb_ipd_doctype_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_doctype_detail`;
CREATE TABLE `tb_ipd_doctype_detail` (
  `an` varchar(50) NOT NULL,
  `doctype` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pages` int(4) DEFAULT NULL,
  `imagescan` longblob NOT NULL,
  PRIMARY KEY (`an`,`doctype`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_doctype_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ipd_doc_pass`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_doc_pass`;
CREATE TABLE `tb_ipd_doc_pass` (
  `password` varchar(5) NOT NULL,
  `userdocpass` varchar(20) NOT NULL,
  `foruser` varchar(50) DEFAULT NULL,
  `lastupdate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`password`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_doc_pass
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ipd_doc_secret`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_doc_secret`;
CREATE TABLE `tb_ipd_doc_secret` (
  `an` varchar(50) NOT NULL,
  `byuser` varchar(30) NOT NULL,
  `byupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`an`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_doc_secret
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ipd_doc_setup`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_doc_setup`;
CREATE TABLE `tb_ipd_doc_setup` (
  `an` varchar(50) NOT NULL,
  `password` varchar(5) NOT NULL,
  `startdate` date NOT NULL,
  `expired` date DEFAULT NULL,
  `foruser` varchar(30) NOT NULL,
  `byuser` varchar(30) NOT NULL,
  `byupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`an`,`password`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_doc_setup
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ipd_logfile`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_logfile`;
CREATE TABLE `tb_ipd_logfile` (
  `logno` bigint(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `logtype` varchar(1) NOT NULL,
  `ldate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipaddr` varchar(30) NOT NULL,
  PRIMARY KEY (`logno`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_logfile
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ipd_logfile_bak`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_logfile_bak`;
CREATE TABLE `tb_ipd_logfile_bak` (
  `logno` bigint(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `logtype` varchar(1) NOT NULL,
  `ldate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipaddr` varchar(30) NOT NULL,
  PRIMARY KEY (`logno`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_logfile_bak
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ipd_logfile_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_logfile_detail`;
CREATE TABLE `tb_ipd_logfile_detail` (
  `logno` bigint(20) NOT NULL,
  `items` int(11) NOT NULL,
  `pcode` varchar(2) NOT NULL,
  `an` varchar(255) DEFAULT NULL,
  `doctype` varchar(255) DEFAULT NULL,
  `ldate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `descr` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`logno`,`items`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_logfile_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ipd_logfile_detail_bak`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_logfile_detail_bak`;
CREATE TABLE `tb_ipd_logfile_detail_bak` (
  `logno` bigint(20) NOT NULL,
  `items` int(11) NOT NULL,
  `pcode` varchar(2) NOT NULL,
  `an` varchar(255) DEFAULT NULL,
  `doctype` varchar(255) DEFAULT NULL,
  `ldate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `descr` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`logno`,`items`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_logfile_detail_bak
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_ipd_login`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_login`;
CREATE TABLE `tb_ipd_login` (
  `userID` int(5) NOT NULL,
  `Fname` varchar(40) NOT NULL,
  `Lname` varchar(60) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(25) NOT NULL,
  `typeID` varchar(10) NOT NULL,
  `usergroup` varchar(20) NOT NULL,
  `createdate` datetime NOT NULL,
  `lastLogin` datetime NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_ipd_login
-- ----------------------------
INSERT INTO `tb_ipd_login` VALUES ('3', 'สมชาย', 'ลบได้', 'delete', '1234', '', '3', '2012-04-18 18:46:20', '2012-06-12 10:49:59');
INSERT INTO `tb_ipd_login` VALUES ('999', 'admin', 'ipd', 'admin', 'super', '', '99', '0000-00-00 00:00:00', '2012-07-18 19:53:51');
INSERT INTO `tb_ipd_login` VALUES ('1', 'สยาม', 'รักกัน', 'read', '1234', '', '1', '2011-11-28 12:18:51', '2012-03-26 16:36:27');
INSERT INTO `tb_ipd_login` VALUES ('2', 'พิมพรรณ', 'สายใจ', 'print', '1234', '', '2', '2011-11-28 12:19:44', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `tb_ipd_type`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_type`;
CREATE TABLE `tb_ipd_type` (
  `TypeID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(10) NOT NULL,
  PRIMARY KEY (`TypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_ipd_type
-- ----------------------------
INSERT INTO `tb_ipd_type` VALUES ('1', 'A');
INSERT INTO `tb_ipd_type` VALUES ('2', 'B');
INSERT INTO `tb_ipd_type` VALUES ('3', 'C');
INSERT INTO `tb_ipd_type` VALUES ('4', 'D');

-- ----------------------------
-- Table structure for `tb_ipd_usergroup`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_usergroup`;
CREATE TABLE `tb_ipd_usergroup` (
  `groupID` int(5) NOT NULL,
  `groupname` varchar(255) NOT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_ipd_usergroup
-- ----------------------------
INSERT INTO `tb_ipd_usergroup` VALUES ('1', 'UReadOnly');
INSERT INTO `tb_ipd_usergroup` VALUES ('2', 'Uprint');
INSERT INTO `tb_ipd_usergroup` VALUES ('99', 'Admin');
INSERT INTO `tb_ipd_usergroup` VALUES ('3', 'Udelete');
INSERT INTO `tb_ipd_usergroup` VALUES ('4', 'test');

-- ----------------------------
-- Table structure for `tb_ipd_usergroup_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tb_ipd_usergroup_detail`;
CREATE TABLE `tb_ipd_usergroup_detail` (
  `groupID` int(5) NOT NULL,
  `manage_doc` int(11) NOT NULL,
  `manage_user` int(11) NOT NULL,
  `del_list` int(11) NOT NULL,
  `doc0` int(11) NOT NULL DEFAULT '0',
  `doc1` int(5) NOT NULL DEFAULT '0',
  `doc2` int(11) NOT NULL DEFAULT '0',
  `doc3` int(11) NOT NULL DEFAULT '0',
  `doc4` int(11) NOT NULL DEFAULT '0',
  `doc5` int(11) NOT NULL DEFAULT '0',
  `doc6` int(11) NOT NULL DEFAULT '0',
  `doc7` int(11) NOT NULL DEFAULT '0',
  `doc8` int(11) NOT NULL DEFAULT '0',
  `doc9` int(11) NOT NULL DEFAULT '0',
  `doc10` int(11) NOT NULL DEFAULT '0',
  `doc11` int(11) NOT NULL DEFAULT '0',
  `doc12` int(11) NOT NULL DEFAULT '0',
  `doc13` int(11) NOT NULL DEFAULT '0',
  `doc14` int(11) NOT NULL DEFAULT '0',
  `doc15` int(11) NOT NULL DEFAULT '0',
  `doc16` int(11) NOT NULL DEFAULT '0',
  `doc17` int(11) NOT NULL DEFAULT '0',
  `doc18` int(11) NOT NULL DEFAULT '0',
  `doc19` int(11) NOT NULL DEFAULT '0',
  `doc20` int(11) NOT NULL DEFAULT '0',
  `doc21` int(11) NOT NULL DEFAULT '0',
  `doc22` int(11) NOT NULL DEFAULT '0',
  `doc23` int(11) NOT NULL DEFAULT '0',
  `doc24` int(11) NOT NULL DEFAULT '0',
  `doc25` int(11) NOT NULL DEFAULT '0',
  `doc999` int(11) NOT NULL DEFAULT '0',
  `doc26` int(11) NOT NULL DEFAULT '0',
  `doc27` int(11) NOT NULL DEFAULT '0',
  `doc28` int(11) NOT NULL DEFAULT '0',
  `doc29` int(11) NOT NULL DEFAULT '0',
  `doc30` int(11) NOT NULL DEFAULT '0',
  `doc31` int(11) NOT NULL DEFAULT '0',
  `doc32` int(11) NOT NULL DEFAULT '0',
  `doc33` int(11) NOT NULL DEFAULT '0',
  `doc34` int(11) NOT NULL DEFAULT '0',
  `doc35` int(11) NOT NULL DEFAULT '0',
  `doc36` int(11) NOT NULL DEFAULT '0',
  `doc37` int(11) NOT NULL DEFAULT '0',
  `doc38` int(11) NOT NULL DEFAULT '0',
  `doc39` int(11) NOT NULL DEFAULT '0',
  `doc40` int(11) NOT NULL DEFAULT '0',
  `doc41` int(11) NOT NULL DEFAULT '0',
  `doc42` int(11) NOT NULL DEFAULT '0',
  `doc43` int(11) NOT NULL DEFAULT '0',
  `doc44` int(11) NOT NULL DEFAULT '0',
  `doc45` int(11) NOT NULL DEFAULT '0',
  `doc46` int(11) NOT NULL DEFAULT '0',
  `doc47` int(11) NOT NULL DEFAULT '0',
  `doc48` int(11) NOT NULL DEFAULT '0',
  `doc49` int(11) NOT NULL DEFAULT '0',
  `doc50` int(11) NOT NULL DEFAULT '0',
  `doc51` int(11) NOT NULL DEFAULT '0',
  `view_log` int(11) NOT NULL,
  `set_docpass` int(11) DEFAULT NULL,
  `set_docsecret` int(11) DEFAULT NULL,
  `view_ansum` int(11) DEFAULT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tb_ipd_usergroup_detail
-- ----------------------------
INSERT INTO `tb_ipd_usergroup_detail` VALUES ('2', '0', '0', '0', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', null);
INSERT INTO `tb_ipd_usergroup_detail` VALUES ('99', '1', '1', '0', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '1', '1', '1', null);
INSERT INTO `tb_ipd_usergroup_detail` VALUES ('1', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', null);
INSERT INTO `tb_ipd_usergroup_detail` VALUES ('3', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0');
INSERT INTO `tb_ipd_usergroup_detail` VALUES ('4', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', null, null, null);

-- ----------------------------
-- Table structure for `tb_opd`
-- ----------------------------
DROP TABLE IF EXISTS `tb_opd`;
CREATE TABLE `tb_opd` (
  `vn` varchar(13) NOT NULL,
  `dater` date NOT NULL,
  `hn` varchar(9) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `doctype_id` int(5) NOT NULL,
  `datescan` date NOT NULL,
  PRIMARY KEY (`vn`,`hn`,`doctype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_opd
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_opd_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tb_opd_detail`;
CREATE TABLE `tb_opd_detail` (
  `vn` varchar(13) NOT NULL,
  `hn` varchar(9) NOT NULL,
  `doctype_id` int(5) NOT NULL,
  `pages` int(4) DEFAULT NULL,
  `imagescan` longblob NOT NULL,
  PRIMARY KEY (`vn`,`hn`,`doctype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_opd_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_opd_doctype`
-- ----------------------------
DROP TABLE IF EXISTS `tb_opd_doctype`;
CREATE TABLE `tb_opd_doctype` (
  `doctype_id` int(5) NOT NULL,
  `DocTypeName` varchar(255) NOT NULL,
  `DocType` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`doctype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_opd_doctype
-- ----------------------------
INSERT INTO `tb_opd_doctype` VALUES ('31', 'เอกสาร31', '31');
INSERT INTO `tb_opd_doctype` VALUES ('29', 'เอกสาร29', '29');
INSERT INTO `tb_opd_doctype` VALUES ('30', 'เอกสาร30', '30');
INSERT INTO `tb_opd_doctype` VALUES ('27', 'เอกสาร27', '27');
INSERT INTO `tb_opd_doctype` VALUES ('28', 'เอกสาร28', '28');
INSERT INTO `tb_opd_doctype` VALUES ('26', 'เอกสาร26', '26');
INSERT INTO `tb_opd_doctype` VALUES ('25', 'เอกสาร25', '25');
INSERT INTO `tb_opd_doctype` VALUES ('24', 'เอกสาร24', '24');
INSERT INTO `tb_opd_doctype` VALUES ('23', 'เอกสาร23', '23');
INSERT INTO `tb_opd_doctype` VALUES ('19', 'Labพิเศษ', '19');
INSERT INTO `tb_opd_doctype` VALUES ('18', 'แพทย์แผนไทย', '18');
INSERT INTO `tb_opd_doctype` VALUES ('17', 'กายภาพบำบัด', '17');
INSERT INTO `tb_opd_doctype` VALUES ('16', 'ชันสูตร', '16');
INSERT INTO `tb_opd_doctype` VALUES ('15', 'อื่น ๆ', '15');
INSERT INTO `tb_opd_doctype` VALUES ('14', 'วางแผนครอบครัว', '14');
INSERT INTO `tb_opd_doctype` VALUES ('0', 'เอกสารรวม', '0');
INSERT INTO `tb_opd_doctype` VALUES ('13', 'อนามัยเด็กดี', '13');
INSERT INTO `tb_opd_doctype` VALUES ('12', 'อนามัยมารดา', '12');
INSERT INTO `tb_opd_doctype` VALUES ('11', 'ทันตกรรม', '11');
INSERT INTO `tb_opd_doctype` VALUES ('10', 'รังสีวิทยา', '10');
INSERT INTO `tb_opd_doctype` VALUES ('4', 'นรีเวชกรรม', '04');
INSERT INTO `tb_opd_doctype` VALUES ('5', 'กุมารเวชกรรม', '05');
INSERT INTO `tb_opd_doctype` VALUES ('6', 'โสต ศอ นาสิก', '06');
INSERT INTO `tb_opd_doctype` VALUES ('7', 'จักษุ', '07');
INSERT INTO `tb_opd_doctype` VALUES ('8', 'ศัลยกรรมกระดูก', '08');
INSERT INTO `tb_opd_doctype` VALUES ('9', 'จิตเวช', '09');
INSERT INTO `tb_opd_doctype` VALUES ('3', 'สูติกรรม', '03');
INSERT INTO `tb_opd_doctype` VALUES ('2', 'ศัลยกรรม', '02');
INSERT INTO `tb_opd_doctype` VALUES ('1', 'อายุรกรรม', '01');
INSERT INTO `tb_opd_doctype` VALUES ('21', 'เอกสาร21', '21');
INSERT INTO `tb_opd_doctype` VALUES ('999', 'เอกสารลับ', 'SRE');
INSERT INTO `tb_opd_doctype` VALUES ('22', 'เอกสาร22', '22');
INSERT INTO `tb_opd_doctype` VALUES ('20', 'เอกสาร20', '20');
INSERT INTO `tb_opd_doctype` VALUES ('32', 'เอกสาร32', '32');
INSERT INTO `tb_opd_doctype` VALUES ('33', 'เอกสาร33', '33');
INSERT INTO `tb_opd_doctype` VALUES ('34', 'เอกสาร34', '34');
INSERT INTO `tb_opd_doctype` VALUES ('35', 'เอกสาร35', '35');
INSERT INTO `tb_opd_doctype` VALUES ('36', 'เอกสาร36', '36');
INSERT INTO `tb_opd_doctype` VALUES ('37', 'เอกสาร37', '37');
INSERT INTO `tb_opd_doctype` VALUES ('38', 'เอกสาร38', '38');
INSERT INTO `tb_opd_doctype` VALUES ('39', 'เอกสาร39', '39');
INSERT INTO `tb_opd_doctype` VALUES ('40', 'เอกสาร40', '40');
INSERT INTO `tb_opd_doctype` VALUES ('41', 'เอกสาร41', '41');
INSERT INTO `tb_opd_doctype` VALUES ('42', 'เอกสาร42', '42');
INSERT INTO `tb_opd_doctype` VALUES ('43', 'เอกสาร43', '43');
INSERT INTO `tb_opd_doctype` VALUES ('44', 'เอกสาร44', '44');
INSERT INTO `tb_opd_doctype` VALUES ('45', 'เอกสาร45', '45');
INSERT INTO `tb_opd_doctype` VALUES ('46', 'เอกสาร46', '46');
INSERT INTO `tb_opd_doctype` VALUES ('47', 'เอกสาร47', '47');
INSERT INTO `tb_opd_doctype` VALUES ('48', 'เอกสาร48', '48');
INSERT INTO `tb_opd_doctype` VALUES ('49', 'เอกสาร49', '49');
INSERT INTO `tb_opd_doctype` VALUES ('50', 'บัตรบันทึกผู้ป่วยอุบัติเหตุ', 'ACC');
INSERT INTO `tb_opd_doctype` VALUES ('51', 'แบบบันทึกการตรวจแผนกผู้ป่วยนอก(F7)', 'SEN');
INSERT INTO `tb_opd_doctype` VALUES ('52', 'ใบ EKG ผู้ป่วยนอก', 'EKG');
INSERT INTO `tb_opd_doctype` VALUES ('53', 'ใบ Refer', 'REF');
INSERT INTO `tb_opd_doctype` VALUES ('54', 'ใบรับรองแพทย์ ผู้ป่วยนอก', 'DCE');
INSERT INTO `tb_opd_doctype` VALUES ('55', 'เวชระเบียนผู้ป่วยนอก คลินิก', 'CDM');
INSERT INTO `tb_opd_doctype` VALUES ('56', 'เอกสาร56', '56');
INSERT INTO `tb_opd_doctype` VALUES ('57', 'เอกสาร57', '57');
INSERT INTO `tb_opd_doctype` VALUES ('58', 'เอกสาร58', '58');
INSERT INTO `tb_opd_doctype` VALUES ('59', 'เอกสาร59', '59');
INSERT INTO `tb_opd_doctype` VALUES ('60', 'เอกสาร60', '60');
INSERT INTO `tb_opd_doctype` VALUES ('61', 'เอกสาร61', '61');
INSERT INTO `tb_opd_doctype` VALUES ('62', 'เอกสาร62', '62');
INSERT INTO `tb_opd_doctype` VALUES ('63', 'เอกสาร63', '63');
INSERT INTO `tb_opd_doctype` VALUES ('64', 'เอกสาร64', '64');
INSERT INTO `tb_opd_doctype` VALUES ('65', 'เอกสาร65', '65');
INSERT INTO `tb_opd_doctype` VALUES ('66', 'เอกสาร66', '66');
INSERT INTO `tb_opd_doctype` VALUES ('67', 'เอกสาร67', '67');
INSERT INTO `tb_opd_doctype` VALUES ('68', 'เอกสาร68', '68');
INSERT INTO `tb_opd_doctype` VALUES ('69', 'เอกสาร69', '69');
INSERT INTO `tb_opd_doctype` VALUES ('70', 'เอกสาร70', '70');
INSERT INTO `tb_opd_doctype` VALUES ('71', 'เอกสาร71', '71');
INSERT INTO `tb_opd_doctype` VALUES ('72', 'เอกสาร72', '72');
INSERT INTO `tb_opd_doctype` VALUES ('73', 'เอกสาร73', '73');
INSERT INTO `tb_opd_doctype` VALUES ('74', 'เอกสาร74', '74');
INSERT INTO `tb_opd_doctype` VALUES ('75', 'เอกสาร75', '75');
INSERT INTO `tb_opd_doctype` VALUES ('76', 'เอกสาร76', '76');
INSERT INTO `tb_opd_doctype` VALUES ('77', 'เอกสาร77', '77');
INSERT INTO `tb_opd_doctype` VALUES ('78', 'เอกสาร78', '78');
INSERT INTO `tb_opd_doctype` VALUES ('79', 'เอกสาร79', '79');
INSERT INTO `tb_opd_doctype` VALUES ('80', 'เอกสาร80', '80');
INSERT INTO `tb_opd_doctype` VALUES ('81', 'เอกสาร81', '81');
INSERT INTO `tb_opd_doctype` VALUES ('82', 'เอกสาร82', '82');
INSERT INTO `tb_opd_doctype` VALUES ('83', 'เอกสาร83', '83');
INSERT INTO `tb_opd_doctype` VALUES ('84', 'เอกสาร84', '84');
INSERT INTO `tb_opd_doctype` VALUES ('85', 'เอกสาร85', '85');
INSERT INTO `tb_opd_doctype` VALUES ('86', 'เอกสาร86', '86');
INSERT INTO `tb_opd_doctype` VALUES ('87', 'เอกสาร87', '87');
INSERT INTO `tb_opd_doctype` VALUES ('88', 'เอกสาร88', '88');
INSERT INTO `tb_opd_doctype` VALUES ('89', 'เอกสาร89', '89');
INSERT INTO `tb_opd_doctype` VALUES ('90', 'เอกสาร90', '90');
INSERT INTO `tb_opd_doctype` VALUES ('91', 'เอกสาร91', '91');
INSERT INTO `tb_opd_doctype` VALUES ('92', 'เอกสาร92', '92');
INSERT INTO `tb_opd_doctype` VALUES ('93', 'เอกสาร93', '93');
INSERT INTO `tb_opd_doctype` VALUES ('94', 'เอกสาร94', '94');
INSERT INTO `tb_opd_doctype` VALUES ('95', 'เอกสาร95', '95');
INSERT INTO `tb_opd_doctype` VALUES ('96', 'คลินิกARV', '96');
INSERT INTO `tb_opd_doctype` VALUES ('97', 'รับนม', '97');
INSERT INTO `tb_opd_doctype` VALUES ('98', 'ห้องผ่าตัด', '98');
INSERT INTO `tb_opd_doctype` VALUES ('99', 'ไม่ทราบแผนก', '99');

-- ----------------------------
-- Table structure for `tb_opd_group`
-- ----------------------------
DROP TABLE IF EXISTS `tb_opd_group`;
CREATE TABLE `tb_opd_group` (
  `groupID` int(5) NOT NULL,
  `groupname` varchar(255) NOT NULL,
  PRIMARY KEY (`groupID`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_opd_group
-- ----------------------------
INSERT INTO `tb_opd_group` VALUES ('99', 'administrator');
INSERT INTO `tb_opd_group` VALUES ('1', 'Userread');
INSERT INTO `tb_opd_group` VALUES ('2', 'UserPrint');
INSERT INTO `tb_opd_group` VALUES ('3', 'SuperUser');

-- ----------------------------
-- Table structure for `tb_opd_group_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tb_opd_group_detail`;
CREATE TABLE `tb_opd_group_detail` (
  `groupID` int(11) NOT NULL,
  `manage_doc` int(11) NOT NULL,
  `manage_user` int(11) NOT NULL,
  `del_list` int(11) NOT NULL,
  `doc0` int(5) NOT NULL DEFAULT '0',
  `doc999` int(5) NOT NULL DEFAULT '0',
  `doc1` int(11) NOT NULL DEFAULT '0',
  `doc2` int(11) NOT NULL DEFAULT '0',
  `doc3` int(11) NOT NULL DEFAULT '0',
  `doc4` int(11) NOT NULL DEFAULT '0',
  `doc5` int(11) NOT NULL DEFAULT '0',
  `doc6` int(11) NOT NULL DEFAULT '0',
  `doc7` int(11) NOT NULL DEFAULT '0',
  `doc8` int(11) NOT NULL DEFAULT '0',
  `doc9` int(11) NOT NULL DEFAULT '0',
  `doc10` int(11) NOT NULL DEFAULT '0',
  `doc11` int(11) NOT NULL DEFAULT '0',
  `doc12` int(11) NOT NULL DEFAULT '0',
  `doc13` int(11) NOT NULL DEFAULT '0',
  `doc14` int(11) NOT NULL DEFAULT '0',
  `doc15` int(11) NOT NULL DEFAULT '0',
  `doc16` int(11) NOT NULL DEFAULT '0',
  `doc17` int(11) NOT NULL DEFAULT '0',
  `doc18` int(11) NOT NULL DEFAULT '0',
  `doc19` int(11) NOT NULL DEFAULT '0',
  `doc20` int(11) NOT NULL DEFAULT '0',
  `doc21` int(11) NOT NULL DEFAULT '0',
  `doc22` int(11) NOT NULL DEFAULT '0',
  `doc23` int(11) NOT NULL DEFAULT '0',
  `doc24` int(11) NOT NULL DEFAULT '0',
  `doc25` int(11) NOT NULL DEFAULT '0',
  `doc26` int(11) NOT NULL DEFAULT '0',
  `doc27` int(11) NOT NULL DEFAULT '0',
  `doc28` int(11) NOT NULL DEFAULT '0',
  `doc29` int(11) NOT NULL DEFAULT '0',
  `doc30` int(11) NOT NULL DEFAULT '0',
  `doc31` int(11) NOT NULL DEFAULT '0',
  `doc32` int(11) NOT NULL DEFAULT '0',
  `doc33` int(11) NOT NULL DEFAULT '0',
  `doc34` int(11) NOT NULL DEFAULT '0',
  `doc35` int(11) NOT NULL DEFAULT '0',
  `doc36` int(11) NOT NULL DEFAULT '0',
  `doc37` int(11) NOT NULL DEFAULT '0',
  `doc38` int(11) NOT NULL DEFAULT '0',
  `doc39` int(11) NOT NULL DEFAULT '0',
  `doc40` int(11) NOT NULL DEFAULT '0',
  `doc41` int(11) NOT NULL DEFAULT '0',
  `doc42` int(11) NOT NULL DEFAULT '0',
  `doc43` int(11) NOT NULL DEFAULT '0',
  `doc44` int(11) NOT NULL DEFAULT '0',
  `doc45` int(11) NOT NULL DEFAULT '0',
  `doc46` int(11) NOT NULL DEFAULT '0',
  `doc47` int(11) NOT NULL DEFAULT '0',
  `doc48` int(11) NOT NULL DEFAULT '0',
  `doc49` int(11) NOT NULL DEFAULT '0',
  `doc50` int(11) NOT NULL DEFAULT '0',
  `doc51` int(11) NOT NULL DEFAULT '0',
  `doc52` int(11) NOT NULL DEFAULT '0',
  `doc53` int(11) NOT NULL DEFAULT '0',
  `doc54` int(11) NOT NULL DEFAULT '0',
  `doc55` int(11) NOT NULL DEFAULT '0',
  `doc56` int(11) NOT NULL DEFAULT '0',
  `doc57` int(11) NOT NULL DEFAULT '0',
  `doc58` int(11) NOT NULL DEFAULT '0',
  `doc59` int(11) NOT NULL DEFAULT '0',
  `doc60` int(11) NOT NULL DEFAULT '0',
  `doc61` int(11) NOT NULL DEFAULT '0',
  `doc62` int(11) NOT NULL DEFAULT '0',
  `doc63` int(11) NOT NULL DEFAULT '0',
  `doc64` int(11) NOT NULL DEFAULT '0',
  `doc65` int(11) NOT NULL DEFAULT '0',
  `doc66` int(11) NOT NULL DEFAULT '0',
  `doc67` int(11) NOT NULL DEFAULT '0',
  `doc68` int(11) NOT NULL DEFAULT '0',
  `doc69` int(11) NOT NULL DEFAULT '0',
  `doc70` int(11) NOT NULL DEFAULT '0',
  `doc71` int(11) NOT NULL DEFAULT '0',
  `doc72` int(11) NOT NULL DEFAULT '0',
  `doc73` int(11) NOT NULL DEFAULT '0',
  `doc74` int(11) NOT NULL DEFAULT '0',
  `doc75` int(11) NOT NULL DEFAULT '0',
  `doc76` int(11) NOT NULL DEFAULT '0',
  `doc77` int(11) NOT NULL DEFAULT '0',
  `doc78` int(11) NOT NULL DEFAULT '0',
  `doc79` int(11) NOT NULL DEFAULT '0',
  `doc80` int(11) NOT NULL DEFAULT '0',
  `doc81` int(11) NOT NULL DEFAULT '0',
  `doc82` int(11) NOT NULL DEFAULT '0',
  `doc83` int(11) NOT NULL DEFAULT '0',
  `doc84` int(11) NOT NULL DEFAULT '0',
  `doc85` int(11) NOT NULL DEFAULT '0',
  `doc86` int(11) NOT NULL DEFAULT '0',
  `doc87` int(11) NOT NULL DEFAULT '0',
  `doc88` int(11) NOT NULL DEFAULT '0',
  `doc89` int(11) NOT NULL DEFAULT '0',
  `doc90` int(11) NOT NULL DEFAULT '0',
  `doc91` int(11) NOT NULL DEFAULT '0',
  `doc92` int(11) NOT NULL DEFAULT '0',
  `doc93` int(11) NOT NULL DEFAULT '0',
  `doc94` int(11) NOT NULL DEFAULT '0',
  `doc95` int(11) NOT NULL DEFAULT '0',
  `doc96` int(11) NOT NULL DEFAULT '0',
  `doc97` int(11) NOT NULL DEFAULT '0',
  `doc98` int(11) NOT NULL DEFAULT '0',
  `doc99` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupID`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tb_opd_group_detail
-- ----------------------------
INSERT INTO `tb_opd_group_detail` VALUES ('99', '1', '1', '0', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3');
INSERT INTO `tb_opd_group_detail` VALUES ('1', '0', '0', '0', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `tb_opd_group_detail` VALUES ('2', '0', '0', '0', '3', '0', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3', '3');
INSERT INTO `tb_opd_group_detail` VALUES ('3', '0', '0', '1', '1', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for `tb_opd_login`
-- ----------------------------
DROP TABLE IF EXISTS `tb_opd_login`;
CREATE TABLE `tb_opd_login` (
  `userID` int(5) NOT NULL,
  `Fname` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Lname` varchar(60) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(25) NOT NULL,
  `typeID` varchar(10) NOT NULL,
  `usergroup` varchar(20) NOT NULL,
  `createdate` datetime NOT NULL,
  `lastLogin` datetime NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_opd_login
-- ----------------------------
INSERT INTO `tb_opd_login` VALUES ('3', 'สมหมาย', 'ลบแหลก', 'delete', '1234', '', '3 ', '2012-04-18 18:51:45', '0000-00-00 00:00:00');
INSERT INTO `tb_opd_login` VALUES ('999', '', '', 'admin', 'super', '4', '99', '0000-00-00 00:00:00', '2011-09-02 00:02:19');
INSERT INTO `tb_opd_login` VALUES ('1', 'สมชาย', 'ใจดี', 'read', '1234', '', '1 ', '2012-04-18 18:48:02', '0000-00-00 00:00:00');
INSERT INTO `tb_opd_login` VALUES ('2', 'สมหญิง', 'พิมพ์ได้', 'print', '1234', '', '2 ', '2012-04-18 18:50:54', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `tb_opd_type`
-- ----------------------------
DROP TABLE IF EXISTS `tb_opd_type`;
CREATE TABLE `tb_opd_type` (
  `TypeID` int(11) NOT NULL AUTO_INCREMENT,
  `Type` varchar(10) NOT NULL,
  PRIMARY KEY (`TypeID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_opd_type
-- ----------------------------
INSERT INTO `tb_opd_type` VALUES ('1', 'A');
INSERT INTO `tb_opd_type` VALUES ('2', 'B');
INSERT INTO `tb_opd_type` VALUES ('3', 'C');
INSERT INTO `tb_opd_type` VALUES ('4', 'D');
