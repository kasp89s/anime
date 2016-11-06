ALTER TABLE `productincomingprice` CHANGE `time` `time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `relatedproduct` ADD FOREIGN KEY (`idProduct`) REFERENCES `anime_line`.`product`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `relatedproduct` CHANGE `relatedProductId` `relatedProductId` VARCHAR(255) NULL COMMENT 'json';

====

ALTER TABLE  `productimage` CHANGE  `id`  `id` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT ;

ALTER TABLE `shippingpaymentmethodrelation` ADD FOREIGN KEY (`shippingMethodId`) REFERENCES `anime_line`.`shippingmethod`(`id`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `shippingpaymentmethodrelation` ADD FOREIGN KEY (`paymentMethodId`) REFERENCES `anime_line`.`paymentmethod`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

=========================

ALTER TABLE `news` ADD `imageFileName` VARCHAR(255) NULL DEFAULT NULL AFTER `content`;