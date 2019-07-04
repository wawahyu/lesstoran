/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.1.36-MariaDB : Database - lesstoran
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel_ujikom` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE lesstoran`;

/*Table structure for table `detail_orders` */

CREATE TABLE `detail_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_order` int(10) unsigned DEFAULT NULL,
  `id_masakan` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_user` char(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_orders_id_order_index` (`id_order`),
  KEY `detail_orders_id_masakan_index` (`id_masakan`),
  KEY `detail_odrers_id_user` (`id_user`),
  CONSTRAINT `detail_odrers_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `detail_orders_id_masakan_foreign` FOREIGN KEY (`id_masakan`) REFERENCES `masakans` (`id`),
  CONSTRAINT `detail_orders_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_orders` */

insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (2,8,2,1,2,'-',2,'2019-04-01 16:12:51','2019-04-01 18:35:42',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (3,8,3,1,3,'-',2,'2019-04-01 18:02:36','2019-04-01 18:35:42',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (6,11,1,1,1,'-',2,'2019-04-01 20:38:50','2019-04-01 20:41:19',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (7,11,2,1,1,'-',2,'2019-04-01 20:38:57','2019-04-01 20:41:19',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (8,12,11,1,3,'-',2,'2019-04-02 06:11:01','2019-04-02 08:58:21',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (9,12,1,1,2,'-',2,'2019-04-02 08:56:08','2019-04-02 08:58:21',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (10,12,10,1,1,'-',2,'2019-04-02 08:57:49','2019-04-02 08:58:21',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (11,13,1,1,1,'-',2,'2019-04-02 09:02:19','2019-04-02 09:02:31',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (12,14,3,1,1,'-',2,'2019-04-02 09:05:45','2019-04-02 09:06:04',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (13,NULL,1,1,1,'-',1,'2019-04-03 07:11:53','2019-04-03 07:11:53',NULL);
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (14,15,2,NULL,1,'-',2,'2019-06-27 03:12:58','2019-06-27 03:15:01','127.0.0.1');
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (15,16,2,NULL,1,'-',2,'2019-06-27 03:18:20','2019-06-27 03:18:37','127.0.0.1');
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (16,16,3,NULL,1,'-',2,'2019-06-27 03:18:26','2019-06-27 03:18:37','127.0.0.1');
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (17,17,2,NULL,2,'-',2,'2019-06-27 06:36:55','2019-06-27 06:37:31','192.168.0.7');
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (18,18,2,NULL,1,'-',2,'2019-06-27 10:05:21','2019-06-27 10:05:59','127.0.0.1');
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (19,NULL,2,NULL,4,'-',1,'2019-06-27 10:24:07','2019-06-27 10:24:07','127.0.0.1');
insert  into `detail_orders`(`id`,`id_order`,`id_masakan`,`id_user`,`qty`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`) values (20,NULL,2,NULL,4,'-',1,'2019-06-27 10:24:07','2019-06-27 10:24:07','127.0.0.1');

/*Table structure for table `masakans` */

CREATE TABLE `masakans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `keterangan` int(10) DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `masakans` */

insert  into `masakans`(`id`,`nama`,`harga`,`status`,`keterangan`,`image`,`created_at`,`updated_at`) values (1,'Ayam Goreng',12000,2,1,'ayam goreng.png',NULL,'2019-05-06 05:55:01');
insert  into `masakans`(`id`,`nama`,`harga`,`status`,`keterangan`,`image`,`created_at`,`updated_at`) values (2,'Edit Jus Ayam',7000,1,2,'jus ayam.png',NULL,'2019-04-01 14:56:58');
insert  into `masakans`(`id`,`nama`,`harga`,`status`,`keterangan`,`image`,`created_at`,`updated_at`) values (3,'Minyak Goreng',3500,1,1,'FB_IMG_15388002141514708.jpg','2019-03-30 14:29:38','2019-03-30 14:29:38');
insert  into `masakans`(`id`,`nama`,`harga`,`status`,`keterangan`,`image`,`created_at`,`updated_at`) values (10,'Jus Kentang',15000,1,2,'Jus KentangFB_IMG_15388002141514708.jpg','2019-04-01 15:02:16','2019-04-01 15:02:16');
insert  into `masakans`(`id`,`nama`,`harga`,`status`,`keterangan`,`image`,`created_at`,`updated_at`) values (11,'Ubi Kukus',15000,1,1,'Ubi KukusFB_IMG_15388002325899827.jpg','2019-04-01 15:04:16','2019-04-01 15:04:16');
insert  into `masakans`(`id`,`nama`,`harga`,`status`,`keterangan`,`image`,`created_at`,`updated_at`) values (12,'Rempah rempah renyah',12000,1,1,'Rempah rempah renyahFB_IMG_15388002412288498.jpg','2019-04-02 09:55:01','2019-04-02 09:55:01');

/*Table structure for table `mejas` */

CREATE TABLE `mejas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `mejas` */

insert  into `mejas`(`id`,`nama`,`created_at`,`updated_at`) values (1,'12','2019-03-31 13:36:02','2019-03-31 06:36:02');

/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2013_03_18_133332_create_roles_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (2,'2014_10_12_000000_create_users_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (3,'2014_10_12_100000_create_password_resets_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (4,'2019_03_18_133559_create_masakans_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (5,'2019_03_18_133811_create_orders_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (6,'2019_03_18_133924_create_detail__orders_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (7,'2019_03_18_134222_create_transaksis_table',1);

/*Table structure for table `orders` */

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_meja` int(11) unsigned DEFAULT NULL,
  `id_user` int(10) unsigned DEFAULT NULL,
  `keterangan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ip_user` char(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_id_user_index` (`id_user`),
  KEY `orders_id_meja_foreign` (`id_meja`),
  CONSTRAINT `orders_id_meja_foreign` FOREIGN KEY (`id_meja`) REFERENCES `mejas` (`id`),
  CONSTRAINT `orders_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`id_meja`,`id_user`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`,`atas_nama`) values (8,1,1,'-',4,'2019-04-01 18:35:42','2019-04-02 04:01:44',NULL,NULL);
insert  into `orders`(`id`,`id_meja`,`id_user`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`,`atas_nama`) values (11,1,1,'-',4,'2019-04-01 20:41:19','2019-04-02 05:59:41',NULL,NULL);
insert  into `orders`(`id`,`id_meja`,`id_user`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`,`atas_nama`) values (12,1,1,'-',4,'2019-04-02 08:58:21','2019-04-02 09:01:05',NULL,NULL);
insert  into `orders`(`id`,`id_meja`,`id_user`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`,`atas_nama`) values (13,1,1,'-',4,'2019-04-02 09:02:31','2019-04-02 09:04:35',NULL,NULL);
insert  into `orders`(`id`,`id_meja`,`id_user`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`,`atas_nama`) values (14,1,1,'-',4,'2019-04-02 09:06:04','2019-04-02 09:15:33',NULL,NULL);
insert  into `orders`(`id`,`id_meja`,`id_user`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`,`atas_nama`) values (15,1,NULL,'-',1,'2019-06-27 03:15:01','2019-06-27 03:15:01','127.0.0.1',NULL);
insert  into `orders`(`id`,`id_meja`,`id_user`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`,`atas_nama`) values (16,1,NULL,'-',1,'2019-06-27 03:18:37','2019-06-27 03:18:37','127.0.0.1',NULL);
insert  into `orders`(`id`,`id_meja`,`id_user`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`,`atas_nama`) values (17,NULL,NULL,'-',1,'2019-06-27 06:37:31','2019-06-27 06:37:31','192.168.0.7','Wahyu');
insert  into `orders`(`id`,`id_meja`,`id_user`,`keterangan`,`status`,`created_at`,`updated_at`,`ip_user`,`atas_nama`) values (18,NULL,NULL,'-',1,'2019-06-27 10:05:59','2019-06-27 10:05:59','127.0.0.1','Wahyu');

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `roles` */

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`nama`,`created_at`,`updated_at`) values (1,'administrator','2019-03-23 09:02:19','2019-03-23 09:02:19');
insert  into `roles`(`id`,`nama`,`created_at`,`updated_at`) values (2,'waiter','2019-03-23 09:02:19','2019-03-23 09:02:19');
insert  into `roles`(`id`,`nama`,`created_at`,`updated_at`) values (3,'kasir','2019-03-23 09:02:19','2019-03-23 09:02:19');
insert  into `roles`(`id`,`nama`,`created_at`,`updated_at`) values (4,'owner','2019-03-23 09:02:20','2019-03-23 09:02:20');
insert  into `roles`(`id`,`nama`,`created_at`,`updated_at`) values (5,'pelanggan','2019-03-23 09:02:20','2019-03-23 09:02:20');

/*Table structure for table `transaksis` */

CREATE TABLE `transaksis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_order` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksis_id_user_index` (`id_user`),
  KEY `transaksis_id_order_index` (`id_order`),
  CONSTRAINT `transaksis_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  CONSTRAINT `transaksis_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaksis` */

insert  into `transaksis`(`id`,`id_order`,`id_user`,`total_harga`,`total_bayar`,`created_at`,`updated_at`) values (1,8,1,24500,25000,'2019-04-02 04:02:25','2019-04-02 04:02:25');
insert  into `transaksis`(`id`,`id_order`,`id_user`,`total_harga`,`total_bayar`,`created_at`,`updated_at`) values (2,11,1,19000,20000,'2019-04-02 05:59:41','2019-04-02 05:59:41');
insert  into `transaksis`(`id`,`id_order`,`id_user`,`total_harga`,`total_bayar`,`created_at`,`updated_at`) values (3,12,1,84000,100000,'2019-04-02 09:01:06','2019-04-02 09:01:06');
insert  into `transaksis`(`id`,`id_order`,`id_user`,`total_harga`,`total_bayar`,`created_at`,`updated_at`) values (4,13,1,12000,15000,'2019-04-02 09:04:36','2019-04-02 09:04:36');
insert  into `transaksis`(`id`,`id_order`,`id_user`,`total_harga`,`total_bayar`,`created_at`,`updated_at`) values (8,14,1,3500,3500,'2019-04-02 09:15:33','2019-04-02 09:15:33');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(10) unsigned NOT NULL DEFAULT '5',
  `active` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_role_index` (`id_role`),
  CONSTRAINT `users_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`password`,`id_role`,`active`,`remember_token`,`created_at`,`updated_at`) values (1,'administrasi','admin','admin@restoran.info','$2y$10$nXfEgPO2rrF/Wq9Rpp6ufeEKapT9mobcxXS/UTTrTzaDgoJBLVh6e',1,1,NULL,'2019-03-23 09:02:20','2019-04-03 13:16:42');
insert  into `users`(`id`,`name`,`username`,`email`,`password`,`id_role`,`active`,`remember_token`,`created_at`,`updated_at`) values (2,'owner','owner','owner@restoran.info','$2y$10$zHZxQUomg58nPNv1Kl8MMOcFQq0GhWGZhntG2ooliR45wBbWFDyzO',4,1,NULL,'2019-03-23 09:02:21','2019-03-23 09:02:21');
insert  into `users`(`id`,`name`,`username`,`email`,`password`,`id_role`,`active`,`remember_token`,`created_at`,`updated_at`) values (3,'Wahyu Wahyudin Edit','wahyukasir','kasirwahyu@mail.id','$2y$10$.RcUMw9InnOr1TP51kWZlOjrD.MMODRtcnhMZE2Ug9cyOaZ5Cg8eC',3,1,NULL,'2019-04-01 13:13:38','2019-04-01 13:30:03');
insert  into `users`(`id`,`name`,`username`,`email`,`password`,`id_role`,`active`,`remember_token`,`created_at`,`updated_at`) values (4,'Wahyu Wahyudin','wahyuuser','userwahyu@mail.id','$2y$10$TujFsyMBZQTuIbPrNoqbje2MmyDXS06eZEsOBEAy9TOnl5GjN83H2',5,1,NULL,'2019-04-01 13:14:25','2019-04-01 13:14:25');
insert  into `users`(`id`,`name`,`username`,`email`,`password`,`id_role`,`active`,`remember_token`,`created_at`,`updated_at`) values (5,'customer','customer','customer@restoran.info','$2y$10$uJVp.eGVTagbCAjLe/A7DOjo8W108aaK81LwfdaO5kiHk51rUG1Em',5,1,NULL,'2019-04-03 13:59:20','2019-04-03 13:59:20');
insert  into `users`(`id`,`name`,`username`,`email`,`password`,`id_role`,`active`,`remember_token`,`created_at`,`updated_at`) values (6,'cashier','cashier','cashier@restoran.info','$2y$10$DJnJd1jEYY7YHaXg1x2S4uLx/BXVhQWvhSti9H4YPtoVK3YJUNgB.',3,1,NULL,'2019-04-03 14:34:52','2019-04-03 14:34:52');
insert  into `users`(`id`,`name`,`username`,`email`,`password`,`id_role`,`active`,`remember_token`,`created_at`,`updated_at`) values (7,'waiter','waiter','waiter@restoran.info','$2y$10$GCR.URi1bIMmm3BUbFcAR.6FtarEteEB9OojJOYU5FI9HNeo6Jl2e',2,1,NULL,'2019-04-03 14:47:32','2019-04-03 14:47:32');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
