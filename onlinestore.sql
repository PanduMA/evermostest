/*
 Navicat Premium Data Transfer

 Source Server         : mydb
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : onlinestore

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 13/04/2021 08:14:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
CREATE DATABASE onlinestore;
USE onlinestore;
-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Fashion', 'Category for anything related to fashion.', '2021-04-06 00:35:07', '2021-04-06 17:34:33');
INSERT INTO `categories` VALUES (2, 'Electronics', 'Gadgets, drones and more.', '2021-04-06 00:35:07', '2021-04-06 17:34:33');
INSERT INTO `categories` VALUES (3, 'Motors', 'Motor sports and more', '2021-04-06 00:35:07', '2021-04-06 17:34:54');
INSERT INTO `categories` VALUES (5, 'Movies', 'Movie products.', '2021-04-06 00:00:00', '2021-04-06 13:27:26');
INSERT INTO `categories` VALUES (6, 'Books', 'Kindle books, audio books and more.', '2021-04-06 00:00:00', '2021-04-06 13:27:47');
INSERT INTO `categories` VALUES (7, 'Sports', 'Drop into new winter gear.', '2021-04-06 02:24:24', '2021-04-06 01:24:24');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_order` int(25) NOT NULL,
  `price_condition` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int(50) NULL DEFAULT NULL,
  `notes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (3, 2147483647, 1, 1, 'disc', 'bank', NULL, 'testing', '2021-04-09 11:49:05', NULL);
INSERT INTO `orders` VALUES (4, 342, 2, 2, 'disc', 'bank', 2390000, 'testing ke2', '2021-04-09 12:38:51', NULL);
INSERT INTO `orders` VALUES (5, 132, 16, 2, 'normal', 'bank', 120000, 'testing ke4', '2021-04-09 15:18:59', NULL);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `price` int(25) NOT NULL,
  `price_discount` int(25) NULL DEFAULT NULL,
  `stok` int(50) NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 65 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'LG P880 4X HD', 'My first awesome phone!', 3360000, 3250000, 500, 3, '2021-04-09 19:51:17', '2021-04-06 17:12:26');
INSERT INTO `products` VALUES (2, 'Google Nexus 4', 'The most awesome phone of 2013!', 2459900, 2390000, 400, 2, '2021-04-09 19:51:23', '2021-04-02 17:12:26');
INSERT INTO `products` VALUES (3, 'Samsung Galaxy S4', 'How about no?', 6490000, 6395000, 760, 3, '2021-04-09 19:51:25', '2021-04-01 17:12:26');
INSERT INTO `products` VALUES (6, 'Bench Shirt', 'The best shirt!', 79000, 59000, 200, 1, '2021-04-09 19:51:27', '2021-04-03 02:12:21');
INSERT INTO `products` VALUES (7, 'Lenovo Laptop', 'My business partner.', 3995000, 3855000, 450, 2, '2021-04-09 19:51:30', '2021-04-01 02:13:39');
INSERT INTO `products` VALUES (8, 'Samsung Galaxy Tab 10.1', 'Good tablet.', 4590000, 4250000, 300, 2, '2021-04-09 19:51:32', '2014-05-31 02:14:08');
INSERT INTO `products` VALUES (9, 'Spalding Watch', 'My sports watch.', 1990000, 1500000, 120, 1, '2021-04-09 19:51:33', '2014-05-31 02:18:31');
INSERT INTO `products` VALUES (10, 'Sony Smart Watch', 'The coolest smart watch!', 2950000, 2859000, 100, 2, '2021-04-09 19:51:36', '2014-06-05 18:09:51');
INSERT INTO `products` VALUES (11, 'Huawei Y300', 'For testing purposes.', 3200000, 3170000, 70, 2, '2021-04-09 19:51:37', '2014-06-05 18:10:54');
INSERT INTO `products` VALUES (12, 'Abercrombie Lake Arnold Shirt', 'Perfect as gift!', 60000, 40000, 0, 1, '2021-04-09 20:09:22', '2014-06-05 18:12:11');
INSERT INTO `products` VALUES (13, 'Abercrombie Allen Brook Shirt', 'Cool red shirt!', 70000, 65000, 210, 1, '2021-04-09 19:51:42', '2014-06-05 18:12:49');
INSERT INTO `products` VALUES (14, 'Baseball Cap', 'Awesome product!', 98000, 90000, 340, 2, '2021-04-09 19:51:46', '2014-11-21 20:07:34');
INSERT INTO `products` VALUES (15, 'Wallet', 'You can absolutely use this one!', 65000, 45000, 30, 6, '2021-04-09 19:51:48', '2014-12-03 22:12:03');
INSERT INTO `products` VALUES (16, 'Amanda Waller Shirt', 'New awesome shirt!', 120000, 99000, 23, 1, '2021-04-09 20:18:59', '2014-12-12 01:52:54');

SET FOREIGN_KEY_CHECKS = 1;
