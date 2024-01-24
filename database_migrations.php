<?php 

// Devendra 02Nov2023

ALTER TABLE `entries` ADD `checkout_date` TIMESTAMP NULL DEFAULT NULL AFTER `check_out`;
ALTER TABLE `penalties` ADD `type` TINYINT NOT NULL DEFAULT '0' AFTER `entry_id`;

?>