<?php 

// Devendra 02Nov2023

ALTER TABLE `entries` ADD `checkout_date` TIMESTAMP NULL DEFAULT NULL AFTER `check_out`;
ALTER TABLE `penalties` ADD `type` TINYINT NOT NULL DEFAULT '0' AFTER `entry_id`;

ALTER TABLE `user_sessions` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `user_sessions` ADD `date` DATE NULL DEFAULT NULL AFTER `session_id`;

ALTER TABLE `entries` ADD `e_paid_amount` VARCHAR(50) NULL DEFAULT NULL AFTER `paid_amount`;
ALTER TABLE `entries` ADD `e_added_by` INT NOT NULL DEFAULT '0' AFTER `user_session_id`, ADD `e_user_session_id` VARCHAR(255) NULL DEFAULT NULL AFTER `e_added_by`;

ALTER TABLE `entries` CHANGE `total_amount` `total_amount` INT(11) NULL DEFAULT '0', CHANGE `paid_amount` `paid_amount` INT(11) NULL DEFAULT '0', CHANGE `e_paid_amount` `e_paid_amount` INT(11) NULL DEFAULT '0', CHANGE `discount_amount` `discount_amount` INT(11) NULL DEFAULT '0';

?>