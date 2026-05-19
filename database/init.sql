SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EmroTube`
--
CREATE DATABASE IF NOT EXISTS `EmroTube` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `EmroTube`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `banner_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_title` (`title`),
  UNIQUE KEY `uq_code` (`code`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `category`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_category_ai_insert_category_stat`;
CREATE TRIGGER `trg_category_ai_insert_category_stat`
AFTER INSERT ON `category`
FOR EACH ROW
BEGIN
    INSERT INTO category_stat (category_id)
    VALUES (NEW.id) ;
END$$
DELIMITER ;


-- --------------------------------------------------------

--
-- Table structure for table `category_stat`
--

CREATE TABLE IF NOT EXISTS `category_stat` (
  `category_id` int NOT NULL,
  `video_count` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE IF NOT EXISTS `channel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `banner_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `github_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_name` (`name`),
  UNIQUE KEY `uq_code` (`code`),
  KEY `fk_channel_user_user_id` (`user_id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `channel`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_channel_ai_insert_channel_stat`;
CREATE TRIGGER `trg_channel_ai_insert_channel_stat`
AFTER INSERT ON `channel` 
FOR EACH ROW 
BEGIN
    INSERT INTO channel_stat (channel_id)
    VALUES (NEW.id); 
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_channel_ai_insert_history_stat`;
CREATE TRIGGER `trg_channel_ai_insert_history_stat` 
AFTER INSERT ON `channel` 
FOR EACH ROW
BEGIN
    INSERT INTO history_stat (channel_id)
    VALUES (NEW.id); 
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_channel_ai_insert_liked_stat`;
CREATE TRIGGER `trg_channel_ai_insert_liked_stat`
AFTER INSERT ON `channel`
FOR EACH ROW
BEGIN
    INSERT INTO liked_stat (channel_id)
    VALUES (NEW.id);
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_channel_ai_insert_watch_later_stat`;
CREATE TRIGGER `trg_channel_ai_insert_watch_later_stat`
AFTER INSERT ON `channel`
FOR EACH ROW
BEGIN
    INSERT INTO watch_later_stat (channel_id)
    VALUES (NEW.id);
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `channel_stat`
--

CREATE TABLE IF NOT EXISTS `channel_stat` (
  `channel_id` int NOT NULL,
  `subscriber_count` int NOT NULL DEFAULT '0',
  `video_count` int NOT NULL DEFAULT '0',
  `view_count` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `video_id` int NOT NULL,
  `reply_id` int DEFAULT NULL,
  `commenter_id` int NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_code` (`code`),
  KEY `idx_video_created_at` (`video_id`,`created_at`),
  KEY `idx_reply_id_created_at` (`reply_id`,`created_at`),
  KEY `idx_commenter_id_created_at` (`commenter_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `comment`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_comment_ad_update_comment_stat`;
CREATE TRIGGER `trg_comment_ad_update_comment_stat`
AFTER DELETE ON `comment`
FOR EACH ROW
BEGIN
    IF OLD.reply_id IS NOT NULL THEN
        UPDATE comment_stat cs
        SET 
            cs.reply_count = cs.reply_count - 1
        WHERE cs.comment_id = OLD.reply_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_comment_ad_update_video_stat`;
CREATE TRIGGER `trg_comment_ad_update_video_stat`
AFTER DELETE ON `comment`
FOR EACH ROW
BEGIN
    UPDATE video_stat vs
    SET 
        vs.comment_count = vs.comment_count - 1
    WHERE vs.video_id = OLD.video_id ;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_comment_ai_insert_comment_stat`;
CREATE TRIGGER `trg_comment_ai_insert_comment_stat`
AFTER INSERT ON `comment`
FOR EACH ROW
BEGIN
    INSERT INTO comment_stat (comment_id)
    VALUES (NEW.id) ;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_comment_ai_update_comment_stat`;
CREATE TRIGGER `trg_comment_ai_update_comment_stat`
AFTER INSERT ON `comment`
FOR EACH ROW
BEGIN
    IF NEW.reply_id IS NOT NULL THEN
        UPDATE comment_stat cs
        SET 
            cs.reply_count = cs.reply_count + 1
        WHERE cs.comment_id = NEW.reply_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_comment_ai_update_video_stat`;
CREATE TRIGGER `trg_comment_ai_update_video_stat`
AFTER INSERT ON `comment`
FOR EACH ROW
BEGIN
    UPDATE video_stat vs
    SET 
        vs.comment_count = vs.comment_count + 1
    WHERE vs.video_id = NEW.video_id ;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comment_like`
--

CREATE TABLE IF NOT EXISTS `comment_like` (
  `comment_id` int NOT NULL,
  `channel_id` int NOT NULL,
  `type` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`,`channel_id`),
  KEY `fk_comment_like_channel_channel_id` (`channel_id`),
  KEY `idx_comment_id_type` (`comment_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `comment_like`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_comment_like_ad_update_comment_stat`;
CREATE TRIGGER `trg_comment_like_ad_update_comment_stat`
AFTER DELETE ON `comment_like`
FOR EACH ROW
BEGIN
    -- Beğeni Kaldırıldıysa
    IF OLD.type = 1 THEN
        UPDATE comment_stat cs
        SET 
            cs.like_count = cs.like_count - 1
        WHERE cs.comment_id = OLD.comment_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_comment_like_ai_update_comment_stat`;
CREATE TRIGGER `trg_comment_like_ai_update_comment_stat`
AFTER INSERT ON `comment_like`
FOR EACH ROW
BEGIN
    -- Beğeni Eklendiyse
    IF NEW.type = 1 THEN
        UPDATE comment_stat cs
        SET 
            cs.like_count = cs.like_count + 1
        WHERE cs.comment_id = NEW.comment_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_comment_like_au_update_comment_stat`;
CREATE TRIGGER `trg_comment_like_au_update_comment_stat`
AFTER UPDATE ON `comment_like`
FOR EACH ROW
BEGIN
    -- Beğeni Kaldırıldıysa
    IF OLD.type = 1 THEN
        UPDATE comment_stat cs
        SET 
            cs.like_count = cs.like_count - 1
        WHERE cs.comment_id = OLD.comment_id ;
    END IF;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comment_stat`
--

CREATE TABLE IF NOT EXISTS `comment_stat` (
  `comment_id` int NOT NULL,
  `like_count` int NOT NULL DEFAULT '0',
  `dislike_count` int NOT NULL DEFAULT '0',
  `reply_count` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `channel_id` int NOT NULL,
  `video_id` int NOT NULL,
  `watch_time` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_history_video_video_id` (`video_id`),
  KEY `idx_channel_id_created_at` (`channel_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `history`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_history_ad_update_history_stat`;
CREATE TRIGGER `trg_history_ad_update_history_stat`
AFTER DELETE ON `history`
FOR EACH ROW
BEGIN
    UPDATE history_stat hs
    JOIN video v ON v.id = OLD.video_id
    SET 
        hs.video_count = hs.video_count - 1,
        hs.total_duration = hs.total_duration - v.duration
    WHERE hs.channel_id = OLD.channel_id ;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_history_ai_update_history_stat`;
CREATE TRIGGER `trg_history_ai_update_history_stat`
AFTER INSERT ON `history`
FOR EACH ROW
BEGIN
    UPDATE history_stat hs
    JOIN video v ON v.id = NEW.video_id
    SET 
        hs.video_count = hs.video_count + 1,
        hs.total_duration = hs.total_duration + v.duration
    WHERE hs.channel_id = NEW.channel_id ;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history_stat`
--

CREATE TABLE IF NOT EXISTS `history_stat` (
  `channel_id` int NOT NULL AUTO_INCREMENT,
  `video_count` int NOT NULL DEFAULT '0',
  `total_duration` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE IF NOT EXISTS `liked` (
  `channel_id` int NOT NULL,
  `video_id` int NOT NULL,
  `type` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`video_id`,`channel_id`),
  KEY `idx_video_id_type` (`video_id`,`type`),
  KEY `idx_channel_id_created_at` (`channel_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `liked`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_liked_ad_update_liked_stat`;
CREATE TRIGGER `trg_liked_ad_update_liked_stat`
AFTER DELETE ON `liked`
FOR EACH ROW
BEGIN
    IF OLD.type = 1 THEN
        UPDATE liked_stat ls
        JOIN video v ON v.id = OLD.video_id
        SET 
            ls.video_count = ls.video_count - 1,
            ls.total_duration = ls.total_duration - v.duration
        WHERE ls.channel_id = OLD.channel_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_liked_ad_update_video_stat`;
CREATE TRIGGER `trg_liked_ad_update_video_stat`
AFTER DELETE ON `liked`
FOR EACH ROW
BEGIN
    -- Beğeni Kaldırıldıysa
    IF OLD.type = 1 THEN
        UPDATE video_stat vs
        SET 
            vs.like_count = vs.like_count - 1
        WHERE vs.video_id = OLD.video_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_liked_ai_update_liked_stat`;
CREATE TRIGGER `trg_liked_ai_update_liked_stat`
AFTER INSERT ON `liked`
FOR EACH ROW
BEGIN
    IF NEW.type = 1 THEN
        UPDATE liked_stat ls
        JOIN video v ON v.id = NEW.video_id
        SET 
            ls.video_count = ls.video_count + 1,
            ls.total_duration = ls.total_duration + v.duration
        WHERE ls.channel_id = NEW.channel_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_liked_ai_update_video_stat`;
CREATE TRIGGER `trg_liked_ai_update_video_stat`
AFTER INSERT ON `liked`
FOR EACH ROW
BEGIN
    -- Beğeni Eklendiyse
    IF NEW.type = 1 THEN
        UPDATE video_stat vs
        SET 
            vs.like_count = vs.like_count + 1
        WHERE vs.video_id = NEW.video_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_liked_au_update_liked_stat`;
CREATE TRIGGER `trg_liked_au_update_liked_stat`
AFTER UPDATE ON `liked`
FOR EACH ROW
BEGIN
    -- Beğeni Kaldırıldıysa
    IF OLD.type = 1 THEN
        UPDATE liked_stat ls
        JOIN video v ON v.id = OLD.video_id
        SET 
            ls.video_count = ls.video_count - 1,
            ls.total_duration = ls.total_duration - v.duration
        WHERE ls.channel_id = OLD.channel_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_liked_au_update_video_stat`;
CREATE TRIGGER `trg_liked_au_update_video_stat`
AFTER UPDATE ON `liked`
FOR EACH ROW
BEGIN
    -- Beğeni Kaldırıldıysa
    IF OLD.type = 1 THEN
        UPDATE video_stat vs
        SET 
            vs.like_count = vs.like_count - 1
        WHERE vs.video_id = OLD.video_id ;
    END IF;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `liked_stat`
--

CREATE TABLE IF NOT EXISTS `liked_stat` (
  `channel_id` int NOT NULL AUTO_INCREMENT,
  `video_count` int NOT NULL DEFAULT '0',
  `total_duration` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `channel_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `banner_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `view_type` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_code` (`code`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_channel_id_created_at` (`channel_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `playlist`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_playlist_ai_insert_playlist_stat`;
CREATE TRIGGER `trg_playlist_ai_insert_playlist_stat`
AFTER INSERT ON `playlist`
FOR EACH ROW
BEGIN
    INSERT INTO playlist_stat (playlist_id)
    VALUES (NEW.id) ;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `playlist_stat`
--

CREATE TABLE IF NOT EXISTS `playlist_stat` (
  `playlist_id` int NOT NULL,
  `video_count` int NOT NULL DEFAULT '0',
  `view_count` int NOT NULL DEFAULT '0',
  `total_duration` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`playlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `playlist_video`
--

CREATE TABLE IF NOT EXISTS `playlist_video` (
  `order` int NOT NULL,
  `playlist_id` int NOT NULL,
  `video_id` int NOT NULL,
  PRIMARY KEY (`order`,`playlist_id`),
  KEY `fk_playlist_video_playlist_playlist_id` (`playlist_id`),
  KEY `fk_playlist_video_video_video_id` (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `playlist_video`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_playlist_video_ad_update_playlist_stat`;
CREATE TRIGGER `trg_playlist_video_ad_update_playlist_stat`
AFTER DELETE ON `playlist_video`
FOR EACH ROW
BEGIN
    UPDATE playlist_stat ps
    JOIN video v ON v.id = OLD.video_id
    SET 
        ps.video_count = ps.video_count - 1,
        ps.total_duration = ps.total_duration - v.duration
    WHERE ps.playlist_id = OLD.playlist_id ;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_playlist_video_ai_update_playlist_stat`;
CREATE TRIGGER `trg_playlist_video_ai_update_playlist_stat`
AFTER INSERT ON `playlist_video`
FOR EACH ROW
BEGIN
    UPDATE playlist_stat ps
    JOIN video v ON v.id = NEW.video_id
    SET 
        ps.video_count = ps.video_count + 1,
        ps.total_duration = ps.total_duration + v.duration
    WHERE ps.playlist_id = NEW.playlist_id ;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE IF NOT EXISTS `subscription` (
  `subscriber_id` int NOT NULL,
  `subscribed_id` int NOT NULL,
  `subscribe_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subscriber_id`,`subscribed_id`),
  KEY `idx_subscriber_id_created_at` (`subscriber_id`,`created_at`),
  KEY `idx_subscribed_id_created_at` (`subscribed_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `subscription`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_subscription_ad_update_channel_stat`;
CREATE TRIGGER `trg_subscription_ad_update_channel_stat`
AFTER DELETE ON `subscription`
FOR EACH ROW
BEGIN
    IF OLD.type = 0 THEN
        UPDATE channel_stat cs
        SET 
            cs.subscriber_count = cs.subscriber_count - 1
        WHERE cs.channel_id = OLD.subscribed_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_subscription_ai_update_channel_stat`;
CREATE TRIGGER `trg_subscription_ai_update_channel_stat`
AFTER INSERT ON `subscription`
FOR EACH ROW
BEGIN
    IF NEW.type = 0 THEN
        UPDATE channel_stat cs
        SET 
            cs.subscriber_count = cs.subscriber_count + 1
        WHERE cs.channel_id = NEW.subscribed_id ;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_subscription_au_update_channel_stat`;
CREATE TRIGGER `trg_subscription_au_update_channel_stat`
AFTER UPDATE ON `subscription`
FOR EACH ROW
BEGIN
    -- Abonelik iptal edilip başka tür olduysa
    IF OLD.type = 0 AND NEW.type <> 0 THEN
        UPDATE channel_stat cs
        SET 
            cs.subscriber_count = cs.subscriber_count - 1
        WHERE cs.channel_id = NEW.subscribed_id ;
    END IF;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `active_channel_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_code` (`code`),
  UNIQUE KEY `uq_username` (`username`),
  UNIQUE KEY `uq_email` (`email`),
  KEY `fk_user_channel_active_channel_id` (`active_channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `uploader_id` int NOT NULL,
  `video_type` int NOT NULL,
  `view_type` int NOT NULL,
  `comment_type` int NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `thumbnail_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transcript` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_code` (`code`),
  KEY `idx_created_at` (`created_at`),
  KEY `idx_uploader_id_created_at` (`uploader_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `video`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_video_ad_update_channel_stat`;
CREATE TRIGGER `trg_video_ad_update_channel_stat`
AFTER DELETE ON `video`
FOR EACH ROW
BEGIN
    UPDATE channel_stat cs
    SET 
        cs.video_count = cs.video_count - 1
    WHERE channel_id = OLD.uploader_id ;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_video_ai_insert_video_stat`;
CREATE TRIGGER `trg_video_ai_insert_video_stat`
AFTER INSERT ON `video`
FOR EACH ROW
BEGIN
    INSERT INTO video_stat (video_id)
    VALUES (NEW.id) ;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_video_ai_update_channel_stat`;
CREATE TRIGGER `trg_video_ai_update_channel_stat`
AFTER INSERT ON `video`
FOR EACH ROW
BEGIN
    UPDATE channel_stat cs
    SET 
        cs.video_count = cs.video_count + 1
    WHERE cs.channel_id = NEW.uploader_id ;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `video_caption`
--

CREATE TABLE IF NOT EXISTS `video_caption` (
  `code` char(16) COLLATE utf8mb4_general_ci NOT NULL,
  `video_id` int NOT NULL,
  `language_code` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `language_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`video_id`,`language_code`),
  UNIQUE KEY `uq_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_category`
--

CREATE TABLE IF NOT EXISTS `video_category` (
  `video_id` int NOT NULL,
  `category_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`video_id`,`category_id`),
  KEY `idx_category_id_created_at` (`category_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `video_category`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_video_category_ad_update_category_stat`;
CREATE TRIGGER `trg_video_category_ad_update_category_stat`
AFTER DELETE ON `video_category`
FOR EACH ROW
BEGIN
    UPDATE category_stat cs
    SET 
        cs.video_count = cs.video_count - 1
    WHERE cs.category_id = OLD.category_id ;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_video_category_ai_update_category_stat`;
CREATE TRIGGER `trg_video_category_ai_update_category_stat`
AFTER INSERT ON `video_category`
FOR EACH ROW
BEGIN
    UPDATE category_stat cs
    SET 
        cs.video_count = cs.video_count + 1
    WHERE cs.category_id = NEW.category_id ;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `video_stat`
--

CREATE TABLE IF NOT EXISTS `video_stat` (
  `video_id` int NOT NULL,
  `like_count` int NOT NULL DEFAULT '0',
  `dislike_count` int NOT NULL DEFAULT '0',
  `comment_count` int NOT NULL DEFAULT '0',
  `view_count` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_all_media`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_all_media` (
`code` char(16)
,`type` int
,`view_type` int
,`title` varchar(255)
,`thumbnail` varchar(255)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
,`duration` int
,`view_count` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_category_content`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_category_content` (
`video_code` char(16)
,`category_code` char(16)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_category_edit`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_category_edit` (
`code` char(16)
,`title` varchar(255)
,`description` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_category_header`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_category_header` (
`code` char(16)
,`title` varchar(255)
,`description` text
,`banner` varchar(255)
,`video_count` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_channels`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_channels` (
`code` char(16)
,`title` varchar(255)
,`avatar` varchar(255)
,`subscriber_count` int
,`video_count` int
,`date` timestamp
,`user_code` char(16)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_channel_details`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_channel_details` (
`code` char(16)
,`description` text
,`instagram_url` varchar(255)
,`twitter_url` varchar(255)
,`facebook_url` varchar(255)
,`linkedin_url` varchar(255)
,`github_url` varchar(255)
,`subscriber_count` int
,`video_count` int
,`view_count` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_channel_edit`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_channel_edit` (
`code` char(16)
,`name` varchar(255)
,`title` varchar(255)
,`description` text
,`instagram_url` varchar(255)
,`twitter_url` varchar(255)
,`facebook_url` varchar(255)
,`linkedin_url` varchar(255)
,`github_url` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_channel_header`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_channel_header` (
`code` char(16)
,`title` varchar(255)
,`avatar` varchar(255)
,`banner` varchar(255)
,`subscriber_count` int
,`video_count` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_history_content`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_history_content` (
`channel_code` char(16)
,`video_code` char(16)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_history_header`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_history_header` (
`channel_code` char(16)
,`video_count` int
,`total_duration` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_liked_content`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_liked_content` (
`channel_code` char(16)
,`video_code` char(16)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_liked_header`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_liked_header` (
`channel_code` char(16)
,`video_count` int
,`total_duration` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_musics`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_musics` (
`code` char(16)
,`type` int
,`view_type` int
,`title` varchar(255)
,`thumbnail` varchar(255)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
,`duration` int
,`view_count` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_music_edit`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_music_edit` (
`code` char(16)
,`title` varchar(255)
,`description` text
,`view_type` int
,`comment_type` int
,`transcript` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_playlists`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_playlists` (
`code` char(16)
,`title` varchar(255)
,`banner` varchar(255)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
,`video_count` int
,`view_type` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_playlist_content`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_playlist_content` (
`playlist_code` char(16)
,`video_code` char(16)
,`order` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_playlist_edit`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_playlist_edit` (
`code` char(16)
,`title` varchar(255)
,`description` text
,`view_type` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_playlist_header`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_playlist_header` (
`code` char(16)
,`title` varchar(255)
,`description` text
,`banner` varchar(255)
,`channel_code` char(16)
,`channel_avatar` varchar(255)
,`channel_title` varchar(255)
,`video_count` int
,`total_duration` int
,`view_type` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_public_categories`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_public_categories` (
`code` char(16)
,`title` varchar(255)
,`description` text
,`banner` varchar(255)
,`video_count` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_public_musics`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_public_musics` (
`code` char(16)
,`type` int
,`view_type` int
,`title` varchar(255)
,`thumbnail` varchar(255)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
,`duration` int
,`view_count` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_public_playlists`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_public_playlists` (
`code` char(16)
,`title` varchar(255)
,`banner` varchar(255)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
,`video_count` int
,`view_type` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_public_shorts`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_public_shorts` (
`code` char(16)
,`type` int
,`view_type` int
,`title` varchar(255)
,`thumbnail` varchar(255)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
,`duration` int
,`view_count` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_public_videos`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_public_videos` (
`code` char(16)
,`type` int
,`view_type` int
,`title` varchar(255)
,`thumbnail` varchar(255)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
,`duration` int
,`view_count` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_shorts`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_shorts` (
`code` char(16)
,`type` int
,`view_type` int
,`title` varchar(255)
,`thumbnail` varchar(255)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
,`duration` int
,`view_count` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_short_edit`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_short_edit` (
`code` char(16)
,`title` varchar(255)
,`description` text
,`view_type` int
,`comment_type` int
,`transcript` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_active_channel`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_user_active_channel` (
`code` char(16)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_auth`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_user_auth` (
`code` char(16)
,`username` varchar(255)
,`password_hash` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_edit`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_user_edit` (
`code` char(16)
,`username` varchar(255)
,`email` varchar(255)
,`name` varchar(255)
,`surname` varchar(255)
,`country` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_videos`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_videos` (
`code` char(16)
,`type` int
,`view_type` int
,`title` varchar(255)
,`thumbnail` varchar(255)
,`channel_code` char(16)
,`channel_title` varchar(255)
,`channel_avatar` varchar(255)
,`duration` int
,`view_count` int
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_video_edit`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_video_edit` (
`code` char(16)
,`title` varchar(255)
,`description` text
,`view_type` int
,`comment_type` int
,`transcript` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_watch_later_content`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_watch_later_content` (
`channel_code` char(16)
,`video_code` char(16)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_watch_later_header`
-- (See below for the actual view)
--
CREATE TABLE IF NOT EXISTS `vw_watch_later_header` (
`channel_code` char(16)
,`video_count` int
,`total_duration` int
);

-- --------------------------------------------------------

--
-- Table structure for table `watch_later`
--

CREATE TABLE IF NOT EXISTS `watch_later` (
  `channel_id` int NOT NULL,
  `video_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`channel_id`,`video_id`),
  KEY `fk_watch_later_video_video_id` (`video_id`),
  KEY `idx_channel_id_created_at` (`channel_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `watch_later`
--
DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_watch_later_ad_update_watch_later_stat`;
CREATE TRIGGER `trg_watch_later_ad_update_watch_later_stat`
AFTER DELETE ON `watch_later`
FOR EACH ROW
BEGIN
    UPDATE watch_later_stat ws
    JOIN video v ON v.id = OLD.video_id
    SET 
        ws.video_count = ws.video_count - 1,
        ws.total_duration = ws.total_duration - v.duration
    WHERE ws.channel_id = OLD.channel_id ;
END$$
DELIMITER ;

DELIMITER $$
-- DROP TRIGGER IF EXISTS `trg_watch_later_ai_update_watch_later_stat`;
CREATE TRIGGER `trg_watch_later_ai_update_watch_later_stat`
AFTER INSERT ON `watch_later`
FOR EACH ROW
BEGIN
    UPDATE watch_later_stat ws
    JOIN video v ON v.id = NEW.video_id
    SET 
        ws.video_count = ws.video_count + 1,
        ws.total_duration = ws.total_duration + v.duration
    WHERE ws.channel_id = NEW.channel_id ;
END$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `watch_later_stat`
--

CREATE TABLE IF NOT EXISTS `watch_later_stat` (
  `channel_id` int NOT NULL AUTO_INCREMENT,
  `video_count` int NOT NULL DEFAULT '0',
  `total_duration` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `vw_all_media`
--
DROP TABLE IF EXISTS `vw_all_media`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_all_media`  AS SELECT `v`.`code` AS `code`, `v`.`video_type` AS `type`, `v`.`view_type` AS `view_type`, `v`.`title` AS `title`, `v`.`thumbnail_path` AS `thumbnail`, `c`.`code` AS `channel_code`, `c`.`title` AS `channel_title`, `c`.`avatar_path` AS `channel_avatar`, `v`.`duration` AS `duration`, `vs`.`view_count` AS `view_count`, `v`.`created_at` AS `date` FROM ((`video` `v` join `channel` `c` on((`v`.`uploader_id` = `c`.`id`))) join `video_stat` `vs` on((`v`.`id` = `vs`.`video_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_category_content`
--
DROP TABLE IF EXISTS `vw_category_content`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_category_content`  AS SELECT `v`.`code` AS `video_code`, `c`.`code` AS `category_code`, `vc`.`created_at` AS `created_at` FROM ((`video_category` `vc` join `video` `v` on((`v`.`id` = `vc`.`video_id`))) join `category` `c` on((`c`.`id` = `vc`.`category_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_category_edit`
--
DROP TABLE IF EXISTS `vw_category_edit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_category_edit`  AS SELECT `category`.`code` AS `code`, `category`.`title` AS `title`, `category`.`description` AS `description` FROM `category` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_category_header`
--
DROP TABLE IF EXISTS `vw_category_header`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_category_header`  AS SELECT `c`.`code` AS `code`, `c`.`title` AS `title`, `c`.`description` AS `description`, `c`.`banner_path` AS `banner`, `cs`.`video_count` AS `video_count` FROM (`category` `c` join `category_stat` `cs` on((`c`.`id` = `cs`.`category_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_channels`
--
DROP TABLE IF EXISTS `vw_channels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_channels`  AS SELECT `c`.`code` AS `code`, `c`.`title` AS `title`, `c`.`avatar_path` AS `avatar`, `cs`.`subscriber_count` AS `subscriber_count`, `cs`.`video_count` AS `video_count`, `c`.`created_at` AS `date`, `u`.`code` AS `user_code` FROM ((`channel` `c` join `channel_stat` `cs` on((`cs`.`channel_id` = `c`.`id`))) join `user` `u` on((`u`.`id` = `c`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_channel_details`
--
DROP TABLE IF EXISTS `vw_channel_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_channel_details`  AS SELECT `c`.`code` AS `code`, `c`.`description` AS `description`, `c`.`instagram_url` AS `instagram_url`, `c`.`twitter_url` AS `twitter_url`, `c`.`facebook_url` AS `facebook_url`, `c`.`linkedin_url` AS `linkedin_url`, `c`.`github_url` AS `github_url`, `cs`.`subscriber_count` AS `subscriber_count`, `cs`.`video_count` AS `video_count`, `cs`.`view_count` AS `view_count`, `c`.`created_at` AS `date` FROM (`channel` `c` join `channel_stat` `cs` on((`c`.`id` = `cs`.`channel_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_channel_edit`
--
DROP TABLE IF EXISTS `vw_channel_edit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_channel_edit`  AS SELECT `channel`.`code` AS `code`, `channel`.`name` AS `name`, `channel`.`title` AS `title`, `channel`.`description` AS `description`, `channel`.`instagram_url` AS `instagram_url`, `channel`.`twitter_url` AS `twitter_url`, `channel`.`facebook_url` AS `facebook_url`, `channel`.`linkedin_url` AS `linkedin_url`, `channel`.`github_url` AS `github_url` FROM `channel` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_channel_header`
--
DROP TABLE IF EXISTS `vw_channel_header`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_channel_header`  AS SELECT `c`.`code` AS `code`, `c`.`title` AS `title`, `c`.`avatar_path` AS `avatar`, `c`.`banner_path` AS `banner`, `cs`.`subscriber_count` AS `subscriber_count`, `cs`.`video_count` AS `video_count` FROM (`channel` `c` join `channel_stat` `cs` on((`c`.`id` = `cs`.`channel_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_history_content`
--
DROP TABLE IF EXISTS `vw_history_content`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_history_content`  AS SELECT `c`.`code` AS `channel_code`, `v`.`code` AS `video_code`, `h`.`created_at` AS `created_at` FROM ((`history` `h` join `channel` `c` on((`c`.`id` = `h`.`channel_id`))) join `video` `v` on((`v`.`id` = `h`.`video_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_history_header`
--
DROP TABLE IF EXISTS `vw_history_header`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_history_header`  AS SELECT `c`.`code` AS `channel_code`, `hs`.`video_count` AS `video_count`, `hs`.`total_duration` AS `total_duration` FROM (`history_stat` `hs` join `channel` `c` on((`c`.`id` = `hs`.`channel_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_liked_content`
--
DROP TABLE IF EXISTS `vw_liked_content`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_liked_content`  AS SELECT `c`.`code` AS `channel_code`, `v`.`code` AS `video_code`, `l`.`created_at` AS `created_at` FROM ((`liked` `l` join `channel` `c` on((`c`.`id` = `l`.`channel_id`))) join `video` `v` on((`v`.`id` = `l`.`video_id`))) WHERE (`l`.`type` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_liked_header`
--
DROP TABLE IF EXISTS `vw_liked_header`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_liked_header`  AS SELECT `c`.`code` AS `channel_code`, `ls`.`video_count` AS `video_count`, `ls`.`total_duration` AS `total_duration` FROM (`liked_stat` `ls` join `channel` `c` on((`c`.`id` = `ls`.`channel_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_musics`
--
DROP TABLE IF EXISTS `vw_musics`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_musics`  AS SELECT `vw_all_media`.`code` AS `code`, `vw_all_media`.`type` AS `type`, `vw_all_media`.`view_type` AS `view_type`, `vw_all_media`.`title` AS `title`, `vw_all_media`.`thumbnail` AS `thumbnail`, `vw_all_media`.`channel_code` AS `channel_code`, `vw_all_media`.`channel_title` AS `channel_title`, `vw_all_media`.`channel_avatar` AS `channel_avatar`, `vw_all_media`.`duration` AS `duration`, `vw_all_media`.`view_count` AS `view_count`, `vw_all_media`.`date` AS `date` FROM `vw_all_media` WHERE (`vw_all_media`.`type` = 2) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_music_edit`
--
DROP TABLE IF EXISTS `vw_music_edit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_music_edit`  AS SELECT `video`.`code` AS `code`, `video`.`title` AS `title`, `video`.`description` AS `description`, `video`.`view_type` AS `view_type`, `video`.`comment_type` AS `comment_type`, `video`.`transcript` AS `transcript` FROM `video` WHERE (`video`.`video_type` = 2) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_playlists`
--
DROP TABLE IF EXISTS `vw_playlists`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_playlists`  AS SELECT `p`.`code` AS `code`, `p`.`title` AS `title`, `p`.`banner_path` AS `banner`, `c`.`code` AS `channel_code`, `c`.`title` AS `channel_title`, `c`.`avatar_path` AS `channel_avatar`, `ps`.`video_count` AS `video_count`, `p`.`view_type` AS `view_type`, `p`.`created_at` AS `date` FROM ((`playlist` `p` join `channel` `c` on((`p`.`channel_id` = `c`.`id`))) join `playlist_stat` `ps` on((`ps`.`playlist_id` = `p`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_playlist_content`
--
DROP TABLE IF EXISTS `vw_playlist_content`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_playlist_content`  AS SELECT `p`.`code` AS `playlist_code`, `v`.`code` AS `video_code`, `pv`.`order` AS `order` FROM ((`playlist_video` `pv` join `playlist` `p` on((`p`.`id` = `pv`.`playlist_id`))) join `video` `v` on((`v`.`id` = `pv`.`video_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_playlist_edit`
--
DROP TABLE IF EXISTS `vw_playlist_edit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_playlist_edit`  AS SELECT `playlist`.`code` AS `code`, `playlist`.`title` AS `title`, `playlist`.`description` AS `description`, `playlist`.`view_type` AS `view_type` FROM `playlist` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_playlist_header`
--
DROP TABLE IF EXISTS `vw_playlist_header`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_playlist_header`  AS SELECT `p`.`code` AS `code`, `p`.`title` AS `title`, `p`.`description` AS `description`, `p`.`banner_path` AS `banner`, `c`.`code` AS `channel_code`, `c`.`avatar_path` AS `channel_avatar`, `c`.`title` AS `channel_title`, `ps`.`video_count` AS `video_count`, `ps`.`total_duration` AS `total_duration`, `p`.`view_type` AS `view_type` FROM ((`playlist` `p` join `channel` `c` on((`p`.`channel_id` = `c`.`id`))) join `playlist_stat` `ps` on((`p`.`id` = `ps`.`playlist_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_public_categories`
--
DROP TABLE IF EXISTS `vw_public_categories`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_public_categories`  AS SELECT `c`.`code` AS `code`, `c`.`title` AS `title`, `c`.`description` AS `description`, `c`.`banner_path` AS `banner`, `cs`.`video_count` AS `video_count`, `c`.`created_at` AS `date` FROM (`category` `c` join `category_stat` `cs` on((`cs`.`category_id` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_public_musics`
--
DROP TABLE IF EXISTS `vw_public_musics`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_public_musics`  AS SELECT `vw_all_media`.`code` AS `code`, `vw_all_media`.`type` AS `type`, `vw_all_media`.`view_type` AS `view_type`, `vw_all_media`.`title` AS `title`, `vw_all_media`.`thumbnail` AS `thumbnail`, `vw_all_media`.`channel_code` AS `channel_code`, `vw_all_media`.`channel_title` AS `channel_title`, `vw_all_media`.`channel_avatar` AS `channel_avatar`, `vw_all_media`.`duration` AS `duration`, `vw_all_media`.`view_count` AS `view_count`, `vw_all_media`.`date` AS `date` FROM `vw_all_media` WHERE ((`vw_all_media`.`type` = 2) AND (`vw_all_media`.`view_type` = 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_public_playlists`
--
DROP TABLE IF EXISTS `vw_public_playlists`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_public_playlists`  AS SELECT `vw_playlists`.`code` AS `code`, `vw_playlists`.`title` AS `title`, `vw_playlists`.`banner` AS `banner`, `vw_playlists`.`channel_code` AS `channel_code`, `vw_playlists`.`channel_title` AS `channel_title`, `vw_playlists`.`channel_avatar` AS `channel_avatar`, `vw_playlists`.`video_count` AS `video_count`, `vw_playlists`.`view_type` AS `view_type`, `vw_playlists`.`date` AS `date` FROM `vw_playlists` WHERE (`vw_playlists`.`view_type` = 0) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_public_shorts`
--
DROP TABLE IF EXISTS `vw_public_shorts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_public_shorts`  AS SELECT `vw_all_media`.`code` AS `code`, `vw_all_media`.`type` AS `type`, `vw_all_media`.`view_type` AS `view_type`, `vw_all_media`.`title` AS `title`, `vw_all_media`.`thumbnail` AS `thumbnail`, `vw_all_media`.`channel_code` AS `channel_code`, `vw_all_media`.`channel_title` AS `channel_title`, `vw_all_media`.`channel_avatar` AS `channel_avatar`, `vw_all_media`.`duration` AS `duration`, `vw_all_media`.`view_count` AS `view_count`, `vw_all_media`.`date` AS `date` FROM `vw_all_media` WHERE ((`vw_all_media`.`type` = 1) AND (`vw_all_media`.`view_type` = 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_public_videos`
--
DROP TABLE IF EXISTS `vw_public_videos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_public_videos`  AS SELECT `vw_all_media`.`code` AS `code`, `vw_all_media`.`type` AS `type`, `vw_all_media`.`view_type` AS `view_type`, `vw_all_media`.`title` AS `title`, `vw_all_media`.`thumbnail` AS `thumbnail`, `vw_all_media`.`channel_code` AS `channel_code`, `vw_all_media`.`channel_title` AS `channel_title`, `vw_all_media`.`channel_avatar` AS `channel_avatar`, `vw_all_media`.`duration` AS `duration`, `vw_all_media`.`view_count` AS `view_count`, `vw_all_media`.`date` AS `date` FROM `vw_all_media` WHERE ((`vw_all_media`.`type` = 0) AND (`vw_all_media`.`view_type` = 0)) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_shorts`
--
DROP TABLE IF EXISTS `vw_shorts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_shorts`  AS SELECT `vw_all_media`.`code` AS `code`, `vw_all_media`.`type` AS `type`, `vw_all_media`.`view_type` AS `view_type`, `vw_all_media`.`title` AS `title`, `vw_all_media`.`thumbnail` AS `thumbnail`, `vw_all_media`.`channel_code` AS `channel_code`, `vw_all_media`.`channel_title` AS `channel_title`, `vw_all_media`.`channel_avatar` AS `channel_avatar`, `vw_all_media`.`duration` AS `duration`, `vw_all_media`.`view_count` AS `view_count`, `vw_all_media`.`date` AS `date` FROM `vw_all_media` WHERE (`vw_all_media`.`type` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_short_edit`
--
DROP TABLE IF EXISTS `vw_short_edit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_short_edit`  AS SELECT `video`.`code` AS `code`, `video`.`title` AS `title`, `video`.`description` AS `description`, `video`.`view_type` AS `view_type`, `video`.`comment_type` AS `comment_type`, `video`.`transcript` AS `transcript` FROM `video` WHERE (`video`.`video_type` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_user_active_channel`
--
DROP TABLE IF EXISTS `vw_user_active_channel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_user_active_channel`  AS SELECT `u`.`code` AS `code`, `c`.`code` AS `channel_code`, `c`.`title` AS `channel_title`, `c`.`avatar_path` AS `channel_avatar` FROM (`user` `u` left join `channel` `c` on((`u`.`active_channel_id` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_user_auth`
--
DROP TABLE IF EXISTS `vw_user_auth`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_user_auth`  AS SELECT `user`.`code` AS `code`, `user`.`username` AS `username`, `user`.`password_hash` AS `password_hash` FROM `user` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_user_edit`
--
DROP TABLE IF EXISTS `vw_user_edit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_user_edit`  AS SELECT `user`.`code` AS `code`, `user`.`username` AS `username`, `user`.`email` AS `email`, `user`.`name` AS `name`, `user`.`surname` AS `surname`, `user`.`country` AS `country` FROM `user` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_videos`
--
DROP TABLE IF EXISTS `vw_videos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_videos`  AS SELECT `vw_all_media`.`code` AS `code`, `vw_all_media`.`type` AS `type`, `vw_all_media`.`view_type` AS `view_type`, `vw_all_media`.`title` AS `title`, `vw_all_media`.`thumbnail` AS `thumbnail`, `vw_all_media`.`channel_code` AS `channel_code`, `vw_all_media`.`channel_title` AS `channel_title`, `vw_all_media`.`channel_avatar` AS `channel_avatar`, `vw_all_media`.`duration` AS `duration`, `vw_all_media`.`view_count` AS `view_count`, `vw_all_media`.`date` AS `date` FROM `vw_all_media` WHERE (`vw_all_media`.`type` = 0) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_video_edit`
--
DROP TABLE IF EXISTS `vw_video_edit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_video_edit`  AS SELECT `video`.`code` AS `code`, `video`.`title` AS `title`, `video`.`description` AS `description`, `video`.`view_type` AS `view_type`, `video`.`comment_type` AS `comment_type`, `video`.`transcript` AS `transcript` FROM `video` WHERE (`video`.`video_type` = 0) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_watch_later_content`
--
DROP TABLE IF EXISTS `vw_watch_later_content`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_watch_later_content`  AS SELECT `c`.`code` AS `channel_code`, `v`.`code` AS `video_code`, `wl`.`created_at` AS `created_at` FROM ((`watch_later` `wl` join `channel` `c` on((`c`.`id` = `wl`.`channel_id`))) join `video` `v` on((`v`.`id` = `wl`.`video_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_watch_later_header`
--
DROP TABLE IF EXISTS `vw_watch_later_header`;

CREATE ALGORITHM=UNDEFINED DEFINER=`EmroTube`@`%` SQL SECURITY DEFINER VIEW `vw_watch_later_header`  AS SELECT `c`.`code` AS `channel_code`, `wls`.`video_count` AS `video_count`, `wls`.`total_duration` AS `total_duration` FROM (`watch_later_stat` `wls` join `channel` `c` on((`c`.`id` = `wls`.`channel_id`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_stat`
--
ALTER TABLE `category_stat`
  ADD CONSTRAINT `fk_category_stat_category_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `fk_channel_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `channel_stat`
--
ALTER TABLE `channel_stat`
  ADD CONSTRAINT `fk_channel_stat_channel_channel_id` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_channel_commenter_id` FOREIGN KEY (`commenter_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_comment_reply_id` FOREIGN KEY (`reply_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_video_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_like`
--
ALTER TABLE `comment_like`
  ADD CONSTRAINT `fk_comment_like_channel_channel_id` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_like_comment_comment_id` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_stat`
--
ALTER TABLE `comment_stat`
  ADD CONSTRAINT `fk_comment_stat_comment_comment_id` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_channel_channel_id` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_history_video_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_stat`
--
ALTER TABLE `history_stat`
  ADD CONSTRAINT `fk_history_stat_channel_channel_id` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `liked`
--
ALTER TABLE `liked`
  ADD CONSTRAINT `fk_video_like_channel_channel_id` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_video_like_video_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `liked_stat`
--
ALTER TABLE `liked_stat`
  ADD CONSTRAINT `fk_liked_stat_channel_channel_id` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `fk_playlist_channel_channel_id` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist_stat`
--
ALTER TABLE `playlist_stat`
  ADD CONSTRAINT `fk_playlist_stat_playlist_playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `playlist_video`
--
ALTER TABLE `playlist_video`
  ADD CONSTRAINT `fk_playlist_video_playlist_playlist_id` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_playlist_video_video_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `fk_subscription_channel_subscribed_id` FOREIGN KEY (`subscribed_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_subscription_channel_subscriber_id` FOREIGN KEY (`subscriber_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_channel_active_channel_id` FOREIGN KEY (`active_channel_id`) REFERENCES `channel` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `fk_video_channel_uploader_id` FOREIGN KEY (`uploader_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video_caption`
--
ALTER TABLE `video_caption`
  ADD CONSTRAINT `fk_video_caption_video_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video_category`
--
ALTER TABLE `video_category`
  ADD CONSTRAINT `fk_video_category_category_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_video_category_video_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video_stat`
--
ALTER TABLE `video_stat`
  ADD CONSTRAINT `fk_video_stat_video_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `watch_later`
--
ALTER TABLE `watch_later`
  ADD CONSTRAINT `fk_watch_later_channel_channel_id` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_watch_later_video_video_id` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `watch_later_stat`
--
ALTER TABLE `watch_later_stat`
  ADD CONSTRAINT `fk_watch_later_stat_channel_channel_id` FOREIGN KEY (`channel_id`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;