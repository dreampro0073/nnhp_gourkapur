<?php 

// Devendra 02Nov2023

ALTER TABLE `entries` ADD `checkout_date` TIMESTAMP NULL DEFAULT NULL AFTER `check_out`;
ALTER TABLE `penalties` ADD `type` TINYINT NOT NULL DEFAULT '0' AFTER `entry_id`;

ALTER TABLE `user_sessions` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `user_sessions` ADD `date` DATE NULL DEFAULT NULL AFTER `session_id`;

?>