CREATE TABLE IF NOT EXISTS `MYMO_PREFIXvideo_servers` (
    `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `order` int(4) NOT NULL,
    `movie_id` BIGINT(20) NOT NULL,
    `status` INT(4) DEFAULT (1),
    `created_by` BIGINT(20) NOT NULL,
    `updated_by` BIGINT(20) NOT NULL,
    `created_at` timestamp(0) NULL DEFAULT NULL,
    `updated_at` timestamp(0) NULL DEFAULT NULL,
    PRIMARY KEY  (`id`),
    INDEX `MYMO_PREFIXvideo_servers_movie_index`(`movie_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `MYMO_PREFIXvideo_files` (
    `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
    `label` varchar(255) NOT NULL,
    `source` varchar(255) NOT NULL,
    `url` LONGTEXT NOT NULL,
    `order` int(4) NOT NULL,
    `movie_id` BIGINT(20) NOT NULL,
    `server_id` BIGINT(20) NOT NULL,
    `status` INT(4) DEFAULT (1),
    `created_by` BIGINT(20) NOT NULL,
    `updated_by` BIGINT(20) NOT NULL,
    `created_at` timestamp(0) NULL DEFAULT NULL,
    `updated_at` timestamp(0) NULL DEFAULT NULL,
    PRIMARY KEY  (id),
    INDEX `MYMO_PREFIXfiles_movie_index`(`movie_id`) USING BTREE,
    INDEX `MYMO_PREFIXfiles_server_index`(`server_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `MYMO_PREFIXvideo_files_subtitle` (
    `id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
    `label` varchar(255) NOT NULL,
    `url` LONGTEXT NOT NULL,
    `order` int(4) NOT NULL,
    `status` INT(4) DEFAULT (1),
    `video_file_id` BIGINT(20) NOT NULL,
    `created_by` BIGINT(20) NOT NULL,
    `updated_by` BIGINT(20) NOT NULL,
    `created_at` timestamp(0) NULL DEFAULT NULL,
    `updated_at` timestamp(0) NULL DEFAULT NULL,
    PRIMARY KEY  (id),
    INDEX `MYMO_PREFIXsubtitle_video_file_index`(`video_file_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `MYMO_PREFIXsliders`  (
   `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
   `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
   `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
   `created_by` BIGINT(20) NOT NULL,
   `updated_by` BIGINT(20) NOT NULL,
   `created_at` timestamp(0) NULL DEFAULT NULL,
   `updated_at` timestamp(0) NULL DEFAULT NULL,
   PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `MYMO_PREFIXbanner_ads`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `MYMO_PREFIXbanner_ads_key_unique`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `MYMO_PREFIXmovie_rating`  (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `movie_id` bigint(20) NOT NULL,
    `client_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
    `star` double(8, 2) NOT NULL,
    `created_at` timestamp(0) NULL DEFAULT NULL,
    `updated_at` timestamp(0) NULL DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE,
    INDEX `MYMO_PREFIXmovie_rating_movie_id_index`(`movie_id`) USING BTREE,
    INDEX `MYMO_PREFIXmovie_rating_client_ip_index`(`client_ip`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `MYMO_PREFIXmovie_views`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `movie_id` bigint(20) NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `day` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `MYMO_PREFIXmovie_views_movie_id_index`(`movie_id`) USING BTREE,
  INDEX `MYMO_PREFIXmovie_views_day_index`(`day`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

CREATE TABLE IF NOT EXISTS `MYMO_PREFIXtv_live_stream`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `label1` varchar(250) NOT NULL,
  `label2` varchar(250) NULL DEFAULT NULL,
  `label3` varchar(250) NULL DEFAULT NULL,
  `stream_from1` varchar(50) NOT NULL,
  `stream_from2` varchar(50) NULL DEFAULT NULL,
  `stream_from3` varchar(50) NULL DEFAULT NULL,
  `stream_url1` TEXT NOT NULL,
  `stream_url2` TEXT NULL DEFAULT NULL,
  `stream_url3` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `MYMO_PREFIXtv_live_post_id_index`(`post_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;