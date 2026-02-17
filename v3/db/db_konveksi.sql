/*
 Navicat Premium Data Transfer

 Source Server         : mySQL
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : 192.168.102.15:3306
 Source Schema         : db_konveksi

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 16/10/2024 16:25:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('ea14de7f6c20e2c8f8f12e88d1a02a1236bb81b1', 'i:1;', 1728701530);
INSERT INTO `cache` VALUES ('ea14de7f6c20e2c8f8f12e88d1a02a1236bb81b1:timer', 'i:1728701530;', 1728701530);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int(11) NULL DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED NULL DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_09_12_061505_create_base_table', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id`) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('E74DRBNDwHrJXia0rrQPuJcuUCL6z1OyPw8lMgxd', '9d253ef3-f0a0-4206-b13f-951d7a333b56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:131.0) Gecko/20100101 Firefox/131.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMmV6WGZ0eWRQM0xuWm5tbUhqczNNY0F1QjdDbkZwZE1VMWpFTEpHUiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cDovL2xpdmV3aXJlX2tvbnZla3NpLnRlc3QvYWRtaW4iO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNToiaHR0cDovL2xpdmV3aXJlX2tvbnZla3NpLnRlc3QvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiOWQyNTNlZjMtZjBhMC00MjA2LWIxM2YtOTUxZDdhMzMzYjU2Ijt9', 1729040765);
INSERT INTO `sessions` VALUES ('iGhF4gYb0e4SBvXaTCQiQ8R8BorThsCrKmBaOdFj', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXJJWHQ0bXV0aEZkeEpFMGdhY2xMYjFpQkJSTU83S1NOdXo3SHp3diI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sb2NhbGhvc3QvbGl2ZXdpcmVfa29udmVrc2kvcHVibGljL2FkbWluL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1729041799);
INSERT INTO `sessions` VALUES ('lQzo9O6a3KlLFiSw7Yn9y8chh3mc64uQh4U6hh01', '9d253ef3-f0a0-4206-b13f-951d7a333b56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidjFPQUNEY3dYZHFRWGNQSHZoTW04cG9xS09uQzVhV0ZNNmJnVnVLMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODM6Imh0dHA6Ly9saXZld2lyZV9rb252ZWtzaS50ZXN0L2FkbWluL3Blc2FuL2VkaXQvOWQzOThiZTktYWFmNC00ZDhmLThkZWUtNmM0ODg2MmU3ZDZiIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cDovL2xpdmV3aXJlX2tvbnZla3NpLnRlc3QvYWRtaW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiOWQyNTNlZjMtZjBhMC00MjA2LWIxM2YtOTUxZDdhMzMzYjU2Ijt9', 1729042608);
INSERT INTO `sessions` VALUES ('wLrpu3XeNUpVb1ps5vAPj0yqT5xUrC2nqWRedsSM', '9d253ef3-f0a0-4206-b13f-951d7a333b56', '192.168.102.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid1RtTUVPS0JJbnBhcDVtQTRueGc5MXJsSFpMbm14a29SdThydXhSUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODA6Imh0dHA6Ly8xOTIuMTY4LjEwMi4xNTo5MjAwL2FkbWluL3Blc2FuL2VkaXQvOWQzOThiZTktYWFmNC00ZDhmLThkZWUtNmM0ODg2MmU3ZDZiIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMjoiaHR0cDovLzE5Mi4xNjguMTAyLjE1OjkyMDAvYWRtaW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiOWQyNTNlZjMtZjBhMC00MjA2LWIxM2YtOTUxZDdhMzMzYjU2Ijt9', 1729042506);

-- ----------------------------
-- Table structure for tbl_jenis_kain
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jenis_kain`;
CREATE TABLE `tbl_jenis_kain`  (
  `kodejeniskain` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `namajeniskain` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kain, Aksesori',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kodejeniskain`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_jenis_kain
-- ----------------------------
INSERT INTO `tbl_jenis_kain` VALUES ('346d39f7-83a9-44c9-9b08-bf1abf12b68d', 'Polyester', NULL, NULL, NULL);
INSERT INTO `tbl_jenis_kain` VALUES ('407a8fb3-19ff-4bf5-971c-b19dbbc16d8c', 'Spandex (Lycra)', NULL, NULL, NULL);
INSERT INTO `tbl_jenis_kain` VALUES ('469ed138-cbda-4d52-9841-8d658cb55a22', 'Katun', NULL, NULL, NULL);
INSERT INTO `tbl_jenis_kain` VALUES ('812fcad8-ad83-4fee-b033-e6db595443ad', 'Rayon', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_kategori
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kategori`;
CREATE TABLE `tbl_kategori`  (
  `kodekategori` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `namakategori` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Topi, Seragam, Celana',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kodekategori`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_kategori
-- ----------------------------
INSERT INTO `tbl_kategori` VALUES ('1832bbdf-cfdf-4d31-80f4-cb05c3bbf642', 'Topi', NULL, NULL, NULL);
INSERT INTO `tbl_kategori` VALUES ('250a613f-6643-44f8-b7e9-9d371627f2b8', 'Celana', NULL, NULL, NULL);
INSERT INTO `tbl_kategori` VALUES ('a6f115eb-071b-471d-a262-8e9ae95418ee', 'Aksesoris', NULL, NULL, NULL);
INSERT INTO `tbl_kategori` VALUES ('c5ed9b01-66cd-44ef-8750-3df55d219bd1', 'Baju', NULL, NULL, NULL);
INSERT INTO `tbl_kategori` VALUES ('d4c8c0c7-419c-48b7-a99f-1dd51566bb66', 'Tas', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pelanggan`;
CREATE TABLE `tbl_pelanggan`  (
  `kodepelanggan` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `namapelanggan` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nohp` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gmaps` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kodepelanggan`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pelanggan
-- ----------------------------
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4385-4ff0-8f76-0284c4ed23af', 'Lalita Latika Haryanti', 'cahyanto.wijayanti@yahoo.com', '0979 8236 4096', 'Ds. Casablanca No. 239, Bogor 22848, Sulteng', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-447f-4da6-bff0-b75fd2503483', 'Diah Azalea Hariyah', 'suryatmi.kajen@gmail.com', '0728 7738 522', 'Gg. Pasirkoja No. 47, Administrasi Jakarta Utara 63377, Kalsel', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4517-4fdf-8702-466819f65577', 'Mutia Pudjiastuti', 'indah.damanik@sirait.go.id', '0733 7377 125', 'Kpg. HOS. Cjokroaminoto (Pasirkaliki) No. 13, Medan 71442, Kaltara', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-45e8-483a-9079-0efb1a7fd2f7', 'Ganda Nababan', 'putra.ulva@gmail.com', '0929 8499 507', 'Psr. Gajah Mada No. 815, Ambon 33977, Sultra', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-46b9-4aa6-9516-16930a273a9c', 'Rika Mardhiyah', 'maman08@gmail.com', '0993 5223 9865', 'Kpg. B.Agam 1 No. 282, Banjar 25199, Aceh', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-473c-4e40-bb79-4101231b1bac', 'Darimin Wijaya', 'tamba.banawa@yahoo.co.id', '0876 6833 308', 'Jln. Moch. Ramdan No. 276, Bitung 49881, Sulbar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-47be-467f-82e3-cde02634c383', 'Amalia Hariyah', 'halim.usyi@yahoo.co.id', '(+62) 484 5634 343', 'Ki. Hang No. 588, Magelang 91502, Pabar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4843-405b-b6c4-31defd5b477a', 'Warta Pradipta', 'puspita.eman@yuniar.com', '0825 7615 1063', 'Dk. Dewi Sartika No. 951, Padangsidempuan 98810, Sultra', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-48c5-42ae-bfd8-d27782b4e1c8', 'Elma Oktaviani M.Farm', 'kayla62@haryanti.com', '0828 155 595', 'Kpg. Sutoyo No. 561, Cirebon 52701, Malut', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4960-4b63-ba6b-3156f9ca7ad0', 'Lanjar Uwais S.Kom', 'vicky42@wijaya.co', '0828 7378 165', 'Psr. Daan No. 63, Malang 56656, Sulsel', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4a03-477c-9be2-0cd4b8b9daec', 'Bakiadi Prasetyo', 'handayani.jamalia@yahoo.co.id', '0247 9430 758', 'Dk. Acordion No. 413, Surabaya 29568, Sulbar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4a9d-4f4d-a090-73ba58009a1c', 'Emong Simbolon', 'wakiman.zulkarnain@wacana.tv', '0868 7701 7653', 'Psr. Baabur Royan No. 169, Palangka Raya 29347, Sulbar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4b35-49e5-bc08-5cd08511b357', 'Cawuk Gunawan', 'zulaika.unjani@gmail.co.id', '0530 6920 711', 'Kpg. Yohanes No. 448, Sibolga 54530, Kepri', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4bc3-42fc-aba3-2fe0c8c8729b', 'Hendri Ramadan', 'janet92@prakasa.net', '0314 1801 0662', 'Dk. Surapati No. 372, Jayapura 46984, Lampung', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4c4a-4248-8845-5365b7354924', 'Latika Permata', 'mursita00@budiman.info', '(+62) 865 4031 8678', 'Gg. Bass No. 784, Administrasi Jakarta Timur 82275, Riau', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4cd1-4e09-a7ad-4e3b09c1938d', 'Dinda Utami', 'hartati.jarwadi@yahoo.com', '0854 8635 0922', 'Ds. Otto No. 914, Banjarbaru 52616, Babel', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4d54-4c24-b84f-6f2ad3526623', 'Sari Usamah', 'permadi.elvin@yahoo.co.id', '(+62) 291 1375 5801', 'Kpg. Umalas No. 776, Serang 92998, Aceh', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4dd7-4a07-a010-16e4b4127f0c', 'Kemal Rahman Latupono S.Ked', 'gadriansyah@wahyuni.org', '(+62) 731 1417 737', 'Gg. Bah Jaya No. 736, Binjai 46953, Kalteng', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4e5c-4d88-9219-c27ea04547cf', 'Gaduh Simbolon', 'uchita69@fujiati.co', '0743 8410 250', 'Ki. Surapati No. 263, Pekanbaru 10894, Sumut', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4ee1-4324-8d5b-5be2c47e3a17', 'Enteng Natsir S.I.Kom', 'samiah69@napitupulu.web.id', '(+62) 489 0702 428', 'Ki. Abdul Muis No. 760, Tebing Tinggi 79041, Sumbar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-4f6a-4175-9c99-2b27cdb6a112', 'Hilda Pratiwi', 'csuryono@suryatmi.com', '0826 4644 298', 'Gg. Yos No. 505, Cirebon 98619, Sumut', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5011-4728-8f7b-0aebe4380bfb', 'Ulva Namaga', 'yolanda.asmuni@gmail.co.id', '020 5498 7130', 'Dk. Banda No. 5, Bandar Lampung 51969, Jambi', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-50ab-4a51-8cad-dd8bde2b0aa2', 'Harsaya Nyoman Wibisono', 'yessi26@waskita.org', '0897 5560 2533', 'Ki. Bak Mandi No. 402, Pagar Alam 63267, Sulbar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5151-4251-b402-95ca136b5c42', 'Hendra Bakiadi Rajata', 'viman.megantara@yahoo.com', '(+62) 537 6955 640', 'Dk. Peta No. 358, Palu 25343, Jateng', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-51e7-4a97-b893-601858a048d6', 'Saadat Damanik S.Kom', 'daruna40@damanik.web.id', '0924 5445 973', 'Ds. Gajah Mada No. 573, Bontang 91124, Sumsel', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-527a-4de3-b5c8-cee2c901a3b2', 'Ayu Cici Kusmawati', 'ganep.hardiansyah@gmail.com', '0941 4133 8323', 'Ki. Mahakam No. 406, Tidore Kepulauan 88461, Gorontalo', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5308-45ca-b7e3-375a662dc4e9', 'Clara Yuliarti S.Pd', 'nilam.prasasta@lestari.web.id', '(+62) 595 1407 053', 'Jr. Rajawali Timur No. 702, Pematangsiantar 56661, Aceh', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5391-41d6-9d90-e73a79ec05fc', 'Najib Kurniawan S.E.', 'zmangunsong@farida.id', '0496 4959 177', 'Dk. Lumban Tobing No. 833, Bandung 92380, Gorontalo', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5419-496a-baf7-bee62dc938cc', 'Titi Cinta Suartini S.IP', 'rudi25@pertiwi.net', '(+62) 332 0676 997', 'Jr. Raya Setiabudhi No. 606, Singkawang 36000, Jambi', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-54a0-4f33-8a53-f36601d64966', 'Febi Hastuti', 'suwarno.cagak@nasyiah.desa.id', '0753 1173 258', 'Jr. Antapani Lama No. 250, Sibolga 20039, Pabar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5527-4743-8576-74fc3400c6ca', 'Laila Diana Yuliarti S.I.Kom', 'puspita.septi@yahoo.com', '(+62) 23 4385 7906', 'Kpg. Cemara No. 581, Samarinda 65827, Malut', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-55b4-48ef-9507-07f3e647ae8d', 'Murti Sihombing', 'eka31@yahoo.com', '0271 7274 8140', 'Kpg. Cikapayang No. 421, Salatiga 15057, Lampung', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-564d-4414-abb6-54e1c04d2879', 'Icha Lili Yolanda S.T.', 'hnasyiah@gmail.co.id', '(+62) 26 7877 881', 'Jr. Mulyadi No. 41, Bogor 42620, Jabar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-56f2-43fc-a0fd-7e6778a57e0c', 'Bagya Simanjuntak', 'rahayu.maulana@gmail.com', '(+62) 885 9738 7621', 'Kpg. Basuki Rahmat  No. 999, Madiun 67576, Sumut', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5786-4141-a444-4740e90e1f52', 'Gandi Hutagalung', 'mandasari.amalia@gmail.com', '(+62) 940 6688 0642', 'Psr. Basudewo No. 614, Probolinggo 13709, Sumbar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5816-48dc-a312-bf82aeca6e60', 'Endra Sitorus', 'hesti.hidayanto@ardianto.web.id', '0640 3913 5244', 'Gg. Basudewo No. 949, Serang 69553, NTT', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-589f-4e2e-b7b8-62bb07d83d62', 'Sabrina Ajeng Haryanti S.H.', 'suci42@wastuti.info', '0371 7202 838', 'Ki. Astana Anyar No. 148, Malang 53993, Riau', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5927-47b5-b9ab-d6e9f6a260de', 'Balijan Ramadan', 'laksita.gaduh@gmail.co.id', '(+62) 884 954 682', 'Dk. Pasteur No. 732, Bitung 59483, DIY', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-59af-4085-8724-de92251f82a4', 'Farah Jamalia Wijayanti', 'mandasari.rahmi@gmail.co.id', '(+62) 28 9774 065', 'Dk. Cikapayang No. 476, Pasuruan 54675, Kaltara', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5a38-4337-881b-13f438c7e0c4', 'Fitriani Shania Permata S.Kom', 'elon50@gmail.com', '(+62) 836 7714 478', 'Gg. Basoka No. 335, Tarakan 22148, Gorontalo', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5ac0-45b3-bffc-de751d09e119', 'Daruna Adriansyah S.H.', 'zizi03@kusmawati.org', '0220 0433 623', 'Dk. Raden No. 102, Kupang 68237, Bali', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5b60-4444-8867-7e55902bbc68', 'Daru Nainggolan', 'harjo96@gmail.co.id', '0247 4755 900', 'Gg. BKR No. 73, Bitung 84096, Sulbar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5c01-4e2f-8918-3a04b0d0606a', 'Ana Yuniar', 'rpurnawati@gmail.co.id', '0755 3177 2588', 'Jln. Dewi Sartika No. 856, Padangsidempuan 40531, Kaltim', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5cae-4931-8d95-f4d8f990cf47', 'Hasan Suryono', 'pratama.ivan@gmail.com', '0681 8657 0225', 'Jln. K.H. Maskur No. 541, Yogyakarta 91590, Riau', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5d63-48db-9d6f-d8688ab66c1b', 'Jaya Paiman Mandala M.Ak', 'mandasari.tugiman@hakim.asia', '0593 4986 8174', 'Psr. Madiun No. 835, Lhokseumawe 86210, Kalbar', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5e14-4051-aae3-1dee0bf8e431', 'Yulia Permata S.E.', 'damanik.melinda@gunawan.desa.id', '0249 9623 144', 'Jr. Sutoyo No. 218, Kediri 31795, Sultra', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5ec3-456f-9237-ba846a49a0e1', 'Pangestu Wacana', 'yosef98@gmail.com', '(+62) 520 2387 722', 'Ds. Balikpapan No. 43, Tegal 32597, Kaltara', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-5f7d-4ac9-9de0-1da241776f08', 'Dirja Uwais', 'galak.melani@yahoo.co.id', '0951 2491 817', 'Kpg. BKR No. 689, Solok 42782, Bali', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-6035-44c7-831b-b23c469c78ab', 'Ophelia Yuliarti', 'candriani@gmail.co.id', '(+62) 700 8427 1295', 'Psr. Yoga No. 227, Tidore Kepulauan 25260, Maluku', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_pelanggan` VALUES ('9d253ef4-60f7-4470-b65b-ebc30b62f399', 'Kani Palastri', 'gandi.firgantoro@dabukke.info', '(+62) 693 4976 1697', 'Dk. Kebonjati No. 73, Malang 19814, Jateng', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);

-- ----------------------------
-- Table structure for tbl_pendukung
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pendukung`;
CREATE TABLE `tbl_pendukung`  (
  `kodedatapendukung` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `namadatapendukung` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kuning, XL, M',
  `kategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Warna, Ukuran',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kodedatapendukung`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pendukung
-- ----------------------------
INSERT INTO `tbl_pendukung` VALUES ('17f1993c-0375-4bb2-b489-8165cb7355c0', 'Kuning', 'warna', NULL, NULL, NULL);
INSERT INTO `tbl_pendukung` VALUES ('2c482a49-9892-4580-9362-1be0f103cd57', 'Hitam', 'warna', NULL, NULL, NULL);
INSERT INTO `tbl_pendukung` VALUES ('436b256a-b9b2-4262-b4f3-d299778b8d68', 'M', 'ukuran', NULL, NULL, NULL);
INSERT INTO `tbl_pendukung` VALUES ('44daa75f-16a9-419c-857e-a31244a85bff', 'S', 'ukuran', NULL, NULL, NULL);
INSERT INTO `tbl_pendukung` VALUES ('4bf1bbf1-e9a4-41e8-b4ea-ca4d56d48a39', 'Putih', 'warna', NULL, NULL, NULL);
INSERT INTO `tbl_pendukung` VALUES ('67324110-6801-4d71-b691-49157a45057d', 'XL', 'ukuran', NULL, NULL, NULL);
INSERT INTO `tbl_pendukung` VALUES ('9fe7347b-4995-4180-8846-ba21adfd504a', 'L', 'ukuran', NULL, NULL, NULL);
INSERT INTO `tbl_pendukung` VALUES ('b2ce2d1b-add3-4a26-9f55-c14f3cb91d8d', 'XXL', 'ukuran', NULL, NULL, NULL);
INSERT INTO `tbl_pendukung` VALUES ('fb16fcf7-91e8-45ca-aa48-d6ce29febef7', 'Biru', 'warna', NULL, NULL, NULL);
INSERT INTO `tbl_pendukung` VALUES ('fe26add8-3871-4015-a847-ac474555227a', 'Merah', 'warna', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tbl_pesan_dt
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pesan_dt`;
CREATE TABLE `tbl_pesan_dt`  (
  `kodepesandt` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodepesanhd` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodeproduk` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodejeniskain` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `hargapokok` int(11) NOT NULL DEFAULT 0,
  `hargajual` int(11) NOT NULL DEFAULT 0,
  `ukuran` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kodepesandt`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pesan_dt
-- ----------------------------
INSERT INTO `tbl_pesan_dt` VALUES ('9d39784b-dc47-4c0f-afb2-729dadd1582b', '9d39783f-63a8-40f9-bdf8-b1b117da314d', '9d253ef4-3f95-4697-8bad-7143ff9885cf', '346d39f7-83a9-44c9-9b08-bf1abf12b68d', 1, 10000, 15000, 'M', 'Kuning');
INSERT INTO `tbl_pesan_dt` VALUES ('9d39784b-df33-42b6-8c1b-e84e6bfb69d5', '9d39783f-63a8-40f9-bdf8-b1b117da314d', '9d253ef4-3f95-4697-8bad-7143ff9885cf', '346d39f7-83a9-44c9-9b08-bf1abf12b68d', 1, 10000, 15000, 'M', 'Kuning');
INSERT INTO `tbl_pesan_dt` VALUES ('9d398be9-ad5a-4831-b302-41b38d7b5c04', '9d398be9-aaf4-4d8f-8dee-6c48862e7d6b', '9d253ef4-3f95-4697-8bad-7143ff9885cf', '346d39f7-83a9-44c9-9b08-bf1abf12b68d', 10, 10000, 15000, 'S', 'Kuning');
INSERT INTO `tbl_pesan_dt` VALUES ('9d41687e-36d8-402f-a142-bb9df54428a0', '9d254002-fcf9-4ad0-b636-3ff28d9d98f9', '9d253ef4-418b-4338-a5a5-d8feb682afaf', '407a8fb3-19ff-4bf5-971c-b19dbbc16d8c', 25, 14000, 18000, 'M', 'Kuning');
INSERT INTO `tbl_pesan_dt` VALUES ('9d41687e-39ca-4061-acd3-e781114ee091', '9d254002-fcf9-4ad0-b636-3ff28d9d98f9', '9d253ef4-3f95-4697-8bad-7143ff9885cf', '469ed138-cbda-4d52-9841-8d658cb55a22', 25, 10000, 15000, 'L', 'Putih');

-- ----------------------------
-- Table structure for tbl_pesan_hd
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pesan_hd`;
CREATE TABLE `tbl_pesan_hd`  (
  `kodepesanhd` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodeuser` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodepelanggan` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noinvoice` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pengiriman` date NOT NULL COMMENT 'tanggal harus selesai',
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'keterangan noted untuk pesanan',
  `dp` int(11) NOT NULL DEFAULT 0,
  `totalbayar` int(11) NOT NULL DEFAULT 0,
  `statuspesan` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Pending / Belum Dikerjakan, 1 = Sedang Dikerjakan, 2 = Siap Dikirim, 3 = Selesai, 9 = Batal ',
  `statusbayar` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Belum Dibayar, 1 = Lunas ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kodepesanhd`) USING BTREE,
  UNIQUE INDEX `tbl_pesan_hd_noinvoice_unique`(`noinvoice`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pesan_hd
-- ----------------------------
INSERT INTO `tbl_pesan_hd` VALUES ('9d254002-fcf9-4ad0-b636-3ff28d9d98f9', '9d253ef3-f0a0-4206-b13f-951d7a333b56', '9d253ef4-4517-4fdf-8702-466819f65577', 'INVOICE00001', '2024-10-25', '', 0, 825000, 0, 0, '2024-10-02 01:38:52', '2024-10-02 01:38:52', NULL);
INSERT INTO `tbl_pesan_hd` VALUES ('9d39783f-63a8-40f9-bdf8-b1b117da314d', '9d253ef3-f0a0-4206-b13f-951d7a333b56', '9d253ef4-4385-4ff0-8f76-0284c4ed23af', 'INVOICE00002', '2024-04-25', '', 0, 30000, 0, 0, '2024-10-12 02:52:41', '2024-10-12 02:52:41', NULL);
INSERT INTO `tbl_pesan_hd` VALUES ('9d398be9-aaf4-4d8f-8dee-6c48862e7d6b', '9d253ef3-f0a0-4206-b13f-951d7a333b56', '9d253ef4-4385-4ff0-8f76-0284c4ed23af', 'INVOICE00003', '2024-10-14', '', 0, 150000, 0, 0, '2024-10-12 03:47:40', '2024-10-12 03:47:40', NULL);

-- ----------------------------
-- Table structure for tbl_produk
-- ----------------------------
DROP TABLE IF EXISTS `tbl_produk`;
CREATE TABLE `tbl_produk`  (
  `kodeproduk` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodekategori` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaproduk` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hargapokok` int(11) NOT NULL DEFAULT 0,
  `hargajual` int(11) NOT NULL DEFAULT 0,
  `gambarproduk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `seoproduk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kodeproduk`) USING BTREE,
  UNIQUE INDEX `tbl_produk_namaproduk_unique`(`namaproduk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_produk
-- ----------------------------
INSERT INTO `tbl_produk` VALUES ('9d253ef4-3f95-4697-8bad-7143ff9885cf', 'c5ed9b01-66cd-44ef-8750-3df55d219bd1', 'Kaos (T-shirt) Anak', 10000, 15000, '85BeD9v37uZU2raRp6In2jFEaShSNiapyntFkH66.jpg', 'kaos-t-shirt-anak', '2024-10-02 01:35:55', '2024-10-12 02:51:12', NULL);
INSERT INTO `tbl_produk` VALUES ('9d253ef4-4025-485d-90d8-e863b03b7612', 'c5ed9b01-66cd-44ef-8750-3df55d219bd1', 'Kemeja Pegawai', 20000, 22000, NULL, 'kemeja-pegawai', '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_produk` VALUES ('9d253ef4-40b2-4e8a-8ef5-b5d044ee048d', '250a613f-6643-44f8-b7e9-9d371627f2b8', 'Celana Anak (SMP)', 11000, 15000, NULL, 'celana-anak-smp', '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_produk` VALUES ('9d253ef4-418b-4338-a5a5-d8feb682afaf', '250a613f-6643-44f8-b7e9-9d371627f2b8', 'Celana Anak (SMA)', 14000, 18000, NULL, 'celana-anak-sma', '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `kodeuser` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `namauser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `akses` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ADMIN, STAFF, PETUGAS',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kodeuser`) USING BTREE,
  UNIQUE INDEX `tbl_user_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('9d253ef3-f0a0-4206-b13f-951d7a333b56', 'admin', '$2y$12$F6Y0w8Sz03sYoFnHyktr.OscWoQs535yVhgIwV0E3TK0gAP/5MDIi', 'Admin Sistem', 'ADMIN', '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);
INSERT INTO `tbl_user` VALUES ('9d253ef4-38b6-40ee-b1d0-277b01e83b8d', 'staff', '$2y$12$huBw0vVbaa/m/8rpIytnaeOu0zOtO5e8FYYagf9f48PypmxsGw74y', 'Staff Aplikasi', 'STAFF', '2024-10-02 01:35:55', '2024-10-02 01:35:55', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin Default', 'iwan@gmail.com', NULL, '$2y$12$CbNeh6cNZykfHqnjt.q9LOSYZKUhCHach3CoOIdJ24.RKXrTAjriy', NULL, '2024-10-02 01:35:55', '2024-10-02 01:35:55');

SET FOREIGN_KEY_CHECKS = 1;
