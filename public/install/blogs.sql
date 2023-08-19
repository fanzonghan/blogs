SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for xf_admin
-- ----------------------------
DROP TABLE IF EXISTS `xf_admin`;
CREATE TABLE `xf_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '关联用户id',
  `nickname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '昵称',
  `acatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '头像',
  `account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '账号',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '密码',
  `phone` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '手机号码',
  `add_ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '添加ip',
  `last_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后一次登录时间',
  `last_ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后一次登录ip',
  `is_del` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否注销',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of xf_admin
-- ----------------------------
INSERT INTO `xf_admin` VALUES (1, 1, '管理员', '', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '18888888888', '', 0, '', 0, 0, 0);

-- ----------------------------
-- Table structure for xf_article
-- ----------------------------
DROP TABLE IF EXISTS `xf_article`;
CREATE TABLE `xf_article`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '标题',
  `alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '简介',
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '缩略图',
  `category_id` int(11) NULL DEFAULT NULL COMMENT '分类',
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT '作者',
  `description` int(11) NULL DEFAULT NULL COMMENT '详情',
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '标签',
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '状态 -1删除  0审核中 1正常 ',
  `browse_num` int(10) NOT NULL DEFAULT 0 COMMENT '浏览量',
  `like_num` int(10) NOT NULL DEFAULT 0 COMMENT '点赞量',
  `add_time` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(10) NOT NULL DEFAULT 0 COMMENT '更新时间',
  `is_del` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除',
  `sl` tinyint(1) NOT NULL DEFAULT 0 COMMENT '收录',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for xf_article_description
-- ----------------------------
DROP TABLE IF EXISTS `xf_article_description`;
CREATE TABLE `xf_article_description`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '详情',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for xf_blogroll
-- ----------------------------
DROP TABLE IF EXISTS `xf_blogroll`;
CREATE TABLE `xf_blogroll`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '名字',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '链接',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态0隐藏 1显示',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for xf_category
-- ----------------------------
DROP TABLE IF EXISTS `xf_category`;
CREATE TABLE `xf_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '父类id',
  `name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '分类名',
  `sort` int(10) NOT NULL DEFAULT 0 COMMENT '排序',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of xf_category
-- ----------------------------
INSERT INTO `xf_category` VALUES (1, 0, '技术分享', 0, 1, 1689013235, 1690910618);
INSERT INTO `xf_category` VALUES (2, 1, 'JAVA', 0, 1, 1689013235, 1690910584);
INSERT INTO `xf_category` VALUES (3, 1, 'PHP', 0, 1, 1689602559, 1690910576);
INSERT INTO `xf_category` VALUES (4, 1, 'HTML', 0, 1, 1690910589, 1690910589);
INSERT INTO `xf_category` VALUES (5, 1, '其他', 0, 1, 1690910636, 1690910636);
INSERT INTO `xf_category` VALUES (6, 0, '软件分享', 0, 1, 1689013235, 1689013235);

-- ----------------------------
-- Table structure for xf_feedback
-- ----------------------------
DROP TABLE IF EXISTS `xf_feedback`;
CREATE TABLE `xf_feedback`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL DEFAULT 0 COMMENT '关联文章',
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '访客名',
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '联系方式',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '内容',
  `reply` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '回复内容',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态 0正常 1屏蔽',
  `ip` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ip地址',
  `add_time` int(10) NOT NULL DEFAULT 0 COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for xf_system_config
-- ----------------------------
DROP TABLE IF EXISTS `xf_system_config`;
CREATE TABLE `xf_system_config`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '变量名',
  `group` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '分组',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '变量值',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '备注',
  `add_time` int(11) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of xf_system_config
-- ----------------------------
INSERT INTO `xf_system_config` VALUES (1, 'title', 'system', '小范的技术博客', '网站标题', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (2, 'keywords', 'system', '', NULL, NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (3, 'description', 'system', '', NULL, NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (4, 'copyright', 'system', '', NULL, NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (5, 'system_url', 'system', '', '网站域名', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (6, 'status', 'system', '1', '网站开关', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (7, 'banner1', 'banner', 'http://kodo.xiaofan.ink/bz/bz0002.jpg', '轮播图一', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (8, 'token', 'baidu', '', '百度收录密钥', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (9, 'accessKey', 'qiniu', '', '七牛云accessKey', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (10, 'secretKey', 'qiniu', '', '七牛云secretKey', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (11, 'bucket', 'qiniu', '', '七牛云桶', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (12, 'yzurl', 'qiniu', '', '七牛云域名', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (13, 'banner2', 'banner', 'http://kodo.xiaofan.ink/bz/bz0001.png', '轮播图二', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (14, 'storage_type', 'system', 'qiniu', '文件上传方式', NULL, 1689013235);
INSERT INTO `xf_system_config` VALUES (15, 'name', 'music', '吹梦到西洲 (伴奏)', '音乐名', 1691228339, 1691228339);
INSERT INTO `xf_system_config` VALUES (16, 'img', 'music', 'https://i.biliimg.com/bfs/im/8195f7dfc409f6c27aab68d195422771ee785b6c.png', '音乐封面', 1691228339, 1691228339);
INSERT INTO `xf_system_config` VALUES (17, 'url', 'music', 'https://m704.music.126.net/20230807155825/a0f4d60638b6349e7e880ae271d4e14b/jdymusic/obj/wo3DlMOGwrbDjj7DisKw/14096538968/e648/8803/0939/376165ad34124171f403187733cac10f.mp3', '音乐播放地址', 1691228339, 1691228339);

-- ----------------------------
-- Table structure for xf_system_log
-- ----------------------------
DROP TABLE IF EXISTS `xf_system_log`;
CREATE TABLE `xf_system_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT '行为',
  `type` tinyint(1) NOT NULL COMMENT '类型 0用户 1管理员',
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '请求数据',
  `ip` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ip地址',
  `location` varchar(255) DEFAULT NULL COMMENT '归属地',
  `add_time` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for xf_tag
-- ----------------------------
DROP TABLE IF EXISTS `xf_tag`;
CREATE TABLE `xf_tag`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '标签名',
  `is_del` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否删除 0正常 1删除',
  `add_time` int(10) NOT NULL DEFAULT 0 COMMENT '时间戳',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of xf_tag
-- ----------------------------
INSERT INTO `xf_tag` VALUES (1, 'PHP', 0, 0);
INSERT INTO `xf_tag` VALUES (2, 'Java', 0, 0);
INSERT INTO `xf_tag` VALUES (3, 'HTML', 0, 0);
INSERT INTO `xf_tag` VALUES (4, '其他', 0, 0);
INSERT INTO `xf_tag` VALUES (5, '记账', 0, 0);
INSERT INTO `xf_tag` VALUES (6, 'vue', 0, 0);
INSERT INTO `xf_tag` VALUES (7, 'uni-app', 0, 0);

-- ----------------------------
-- Table structure for xf_user
-- ----------------------------
DROP TABLE IF EXISTS `xf_user`;
CREATE TABLE `xf_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '昵称',
  `acatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '头像',
  `account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '账号',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '密码',
  `phone` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '手机号码',
  `add_ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '添加ip',
  `last_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后一次登录时间',
  `last_ip` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后一次登录ip',
  `is_del` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否注销',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of xf_user
-- ----------------------------
INSERT INTO `xf_user` VALUES (1, '小范', '', 'xiaofan', '123456', '18888888888', '', 0, '', 0, 1689013235, 1689013235);

SET FOREIGN_KEY_CHECKS = 1;
