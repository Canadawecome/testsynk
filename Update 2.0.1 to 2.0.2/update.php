<?php
/**
 * update
 * 
 * @package Sngine v2+
 * @author Zamblek
 */

// fetch bootstrap
require('bootstrap.php');

// [1] update the sngine tables
$query = "
ALTER TABLE `system_options`
  ADD COLUMN `social_login_enabled` enum('1','0') NOT NULL DEFAULT '0'
  , ADD COLUMN `facebook_login_enabled` enum('1','0') NOT NULL DEFAULT '0'
  , ADD COLUMN `facebook_appid` varchar(255) NULL
  , ADD COLUMN `facebook_secret` varchar(255) NULL
  , ADD COLUMN `twitter_login_enabled` enum('1','0') NOT NULL DEFAULT '0'
  , ADD COLUMN `twitter_appid` varchar(255) NULL
  , ADD COLUMN `twitter_secret` varchar(255) NULL
  , ADD COLUMN `google_login_enabled` enum('1','0') NOT NULL DEFAULT '0'
  , ADD COLUMN `google_appid` varchar(255) NULL
  , ADD COLUMN `google_secret` varchar(255) NULL;

ALTER TABLE `users`
  ADD COLUMN `facebook_connected` enum('0','1') NOT NULL DEFAULT '0'
  , ADD COLUMN `facebook_id` varchar(255) NULL
  , ADD COLUMN `twitter_connected` enum('0','1') NOT NULL DEFAULT '0'
  , ADD COLUMN `twitter_id` varchar(255) NULL
  , ADD COLUMN `google_connected` enum('0','1') NOT NULL DEFAULT '0'
  , ADD COLUMN `google_id` varchar(255) NULL;

ALTER TABLE `users` ADD UNIQUE KEY `facebook_id`(`facebook_id`);

ALTER TABLE `users` ADD UNIQUE KEY `google_id`(`google_id`);

ALTER TABLE `users` ADD UNIQUE KEY `twitter_id`(`twitter_id`);
";

$db->multi_query($query) or _error("Error", $db->error);
// flush multi_queries
do{} while(mysqli_more_results($db) && mysqli_next_result($db));

// [2] Done
_error("System Updated", "Sngine has been updated to 2.0.2");

?>