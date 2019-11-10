/*
 Navicat Premium Data Transfer

 Source Server         : localhost7
 Source Server Type    : MySQL
 Source Server Version : 50638
 Source Host           : localhost:3306
 Source Schema         : social_media

 Target Server Type    : MySQL
 Target Server Version : 50638
 File Encoding         : 65001

 Date: 05/11/2019 23:59:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for follows
-- ----------------------------
DROP TABLE IF EXISTS `follows`;
CREATE TABLE `follows` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `is_following` int(10) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of follows
-- ----------------------------
BEGIN;
INSERT INTO `follows` VALUES (1, 3, 4, '2019-11-03 17:38:43');
INSERT INTO `follows` VALUES (2, 4, 3, '2019-11-03 17:38:57');
INSERT INTO `follows` VALUES (3, 2, 3, '2019-11-04 15:21:59');
INSERT INTO `follows` VALUES (4, 3, 7, '2019-11-05 23:30:02');
INSERT INTO `follows` VALUES (6, 7, 3, '2019-11-05 11:45:47');
COMMIT;

-- ----------------------------
-- Table structure for genres
-- ----------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_genre` varchar(200) DEFAULT NULL,
  `desc_genre` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of genres
-- ----------------------------
BEGIN;
INSERT INTO `genres` VALUES (1, 'jazz', '');
INSERT INTO `genres` VALUES (2, 'Pop Music', NULL);
INSERT INTO `genres` VALUES (3, 'Hip Hop', NULL);
INSERT INTO `genres` VALUES (4, 'Rock', NULL);
INSERT INTO `genres` VALUES (5, 'Blues', NULL);
INSERT INTO `genres` VALUES (6, 'Disco', NULL);
INSERT INTO `genres` VALUES (7, 'Reggae', NULL);
INSERT INTO `genres` VALUES (8, 'Dance', NULL);
COMMIT;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `post` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------
BEGIN;
INSERT INTO `posts` VALUES (1, 3, 'hey there i use this sosmed', '2019-11-03 17:38:08');
INSERT INTO `posts` VALUES (2, 4, 'hayy gaess', '2019-11-03 17:38:25');
INSERT INTO `posts` VALUES (3, 4, 'i love https://stackoverflow.com/questions/1960461/convert-plain-text-urls-into-html-hyperlinks-in-php  this is some text, avec url= https://i.imgur.com/LKkoTxy.jpg http://www.google.com/image.gif and this ', '2019-11-03 18:06:44');
INSERT INTO `posts` VALUES (4, 3, 'test', '2019-11-03 07:31:03');
INSERT INTO `posts` VALUES (5, 3, 'heloo everybody', '2019-11-03 07:32:15');
INSERT INTO `posts` VALUES (6, 3, 'this just test', '2019-11-03 07:33:07');
INSERT INTO `posts` VALUES (7, 3, 'i like this https://i.imgur.com/pqggrK0.jpg from https://imgur.com/', '2019-11-04 05:39:59');
INSERT INTO `posts` VALUES (8, 3, 'i like this cat bro https://i.imgur.com/pqggrK0.jpg from https://imgur.com/', '2019-11-04 05:55:43');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `genres_id` int(10) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `address` text,
  `mobile` varchar(20) DEFAULT NULL,
  `bio` text,
  `photo` varchar(100) DEFAULT 'default.png',
  `register_since` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (2, 'zikox', 'admin@gmail.com', '6dad25f6ef20f4ce0c6d1ce47596081f93b38320', 'zikox', 1, 'M', NULL, NULL, NULL, NULL, NULL, 'default.png', '2019-11-02 02:04:20', NULL);
INSERT INTO `users` VALUES (3, 'andyptra', 'merbabudev@gmail.com', '6dad25f6ef20f4ce0c6d1ce47596081f93b38320', 'Andy saputra', 3, 'M', NULL, NULL, NULL, NULL, NULL, '92b07f638d0875672395cdae7f3cca0e.png', '2019-11-02 02:06:22', '2019-11-05 23:53:50');
INSERT INTO `users` VALUES (4, 'boy', 'team.worldofwonders@gmail.com', '6dad25f6ef20f4ce0c6d1ce47596081f93b38320', 'boy alexander', 1, 'M', NULL, NULL, NULL, NULL, NULL, 'https://i.imgur.com/LKkoTxy.jpg', '2019-11-02 02:07:59', NULL);
INSERT INTO `users` VALUES (5, 'elo', 'penjual@gmail.com', '6dad25f6ef20f4ce0c6d1ce47596081f93b38320', 'elo alexander', 1, 'M', NULL, NULL, NULL, NULL, NULL, 'https://i.imgur.com/LKkoTxy.jpg', '2019-11-02 02:09:35', '2019-11-03 18:29:31');
INSERT INTO `users` VALUES (6, 'abu', 'team.woqrldofwonders@gmail.com', '6dad25f6ef20f4ce0c6d1ce47596081f93b38320', 'abu alexander', 1, 'M', NULL, NULL, NULL, NULL, NULL, 'default.png', '2019-11-02 02:10:27', NULL);
INSERT INTO `users` VALUES (7, 'farhan', 'andygrdap@gmail.com', '6dad25f6ef20f4ce0c6d1ce47596081f93b38320', 'farhan', 3, 'M', NULL, NULL, NULL, NULL, NULL, '92b07f638d0875672395cdae7f3cca0e.png', '2019-11-02 02:11:47', NULL);
INSERT INTO `users` VALUES (8, 'boby', 'q@gmail.com', '6dad25f6ef20f4ce0c6d1ce47596081f93b38320', 'boby', 3, 'M', NULL, NULL, NULL, NULL, NULL, 'default.png', '2019-11-04 05:50:10', NULL);
INSERT INTO `users` VALUES (9, 'ronalds', 'ronald@gmail.com', '6dad25f6ef20f4ce0c6d1ce47596081f93b38320', 'ronalds', 4, 'M', NULL, NULL, NULL, NULL, NULL, 'https://i.imgur.com/pqggrK0.jpg', '2019-11-04 05:54:08', '2019-11-04 05:54:40');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
