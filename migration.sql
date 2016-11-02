ALTER TABLE `productincomingprice` CHANGE `time` `time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `relatedproduct` ADD FOREIGN KEY (`idProduct`) REFERENCES `anime_line`.`product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `relatedproduct` CHANGE `relatedProductId` `relatedProductId` VARCHAR(255) NULL COMMENT 'json';

====

ALTER TABLE  `productimage` CHANGE  `id`  `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ;