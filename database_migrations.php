<?php 

// Devendra 02Nov2023

CREATE TABLE `r_hos`.`sitting_entries` ( `id` INT NOT NULL AUTO_INCREMENT , `unique_id` INT NULL DEFAULT NULL , `name` VARCHAR(255) NULL DEFAULT NULL , `pnr_uid` VARCHAR(20) NULL DEFAULT NULL , `mobile_no` VARCHAR(20) NULL DEFAULT NULL , `train_no` VARCHAR(20) NULL DEFAULT NULL , `address` VARCHAR(255) NULL DEFAULT NULL , `no_of_adults` INT NULL DEFAULT '0' , `no_of_children` INT NOT NULL DEFAULT '0' , `no_of_baby_staff` INT NOT NULL DEFAULT '0' , `seat_no` VARCHAR(10) NULL DEFAULT NULL , `check_in` TIMESTAMP NULL DEFAULT NULL , `check_out` TIMESTAMP NULL DEFAULT NULL , `hours_occ` INT NOT NULL DEFAULT '0' , `paid_amount` VARCHAR(20) NULL DEFAULT NULL , `pay_type` TINYINT(1) NULL DEFAULT NULL , `remarks` VARCHAR(255) NULL DEFAULT NULL , `status` TINYINT(1) NULL DEFAULT '0' , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `created_at` TIMESTAMP NULL DEFAULT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `sitting_entries` ADD `shift` VARCHAR(10) NULL DEFAULT NULL AFTER `remarks`;

ALTER TABLE `sitting_entries` ADD `date` DATE NULL DEFAULT NULL AFTER `seat_no`;

ALTER TABLE `massage_entries` ADD `name` VARCHAR(255) NULL DEFAULT NULL AFTER `unique_id`;

ALTER TABLE `massage_entries` ADD `time_period` INT NOT NULL DEFAULT '0' AFTER `pay_type`;

//DIpanshu 18Nov
ALTER TABLE `massage_entries` CHANGE `in_time` `in_time` TIME NULL DEFAULT NULL, CHANGE `out_time` `out_time` TIME NULL DEFAULT NULL;

ALTER TABLE `massage_entries` ADD `date` DATE NULL DEFAULT NULL AFTER `unique_id`;
ALTER TABLE `sitting_entries` CHANGE `check_in` `check_in` TIME NULL DEFAULT NULL, CHANGE `check_out` `check_out` TIME NULL DEFAULT NULL;


ALTER TABLE `locker_entries` CHANGE `checkout_date` `checkout_date` TIMESTAMP NULL DEFAULT NULL;

ALTER TABLE `locker_entries` ADD `penality` INT NULL DEFAULT NULL AFTER `paid_amount`;

CREATE TABLE `locker_penalty` ( `id` INT NOT NULL , `locker_entry_id` INT NULL DEFAULT NULL , `penalty_amount` VARCHAR(10) NULL DEFAULT NULL , `shift` VARCHAR(10) NULL DEFAULT NULL , `created_at` TIMESTAMP NULL DEFAULT NULL , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;

ALTER TABLE `locker_penalty` ADD `pay_type` TINYINT(2) NULL DEFAULT NULL AFTER `penalty_amount`;
ALTER TABLE `locker_penalty` ADD `date` DATE NULL DEFAULT NULL AFTER `shift`;

ALTER TABLE `massage_entries` CHANGE `delete_by` `deleted_by` INT(11) NOT NULL DEFAULT '0';

ALTER TABLE `locker_entries` CHANGE `locker_id` `locker_id` VARCHAR(55) NOT NULL DEFAULT '0';
ALTER TABLE `locker_entries` CHANGE `locker_id` `locker_ids` VARCHAR(55) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';

ALTER TABLE `locker_entries` ADD `checkin_date` TIMESTAMP NULL DEFAULT NULL AFTER `date`;

?>