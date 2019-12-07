/*
 Navicat Premium Data Transfer

 Source Server         : LocalDB
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : db_hr

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 21/11/2019 17:04:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_absen
-- ----------------------------
DROP TABLE IF EXISTS `tb_absen`;
CREATE TABLE `tb_absen`  (
  `tgl_absen` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jam_masuk` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jam_keluar` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nik` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telat` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`tgl_absen`) USING BTREE,
  INDEX `fk_absen_user`(`nik`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_akses
-- ----------------------------
DROP TABLE IF EXISTS `tb_akses`;
CREATE TABLE `tb_akses`  (
  `id_akses` int(11) NOT NULL,
  `ket` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_akses`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_akses
-- ----------------------------
INSERT INTO `tb_akses` VALUES (1, 'Administrator');
INSERT INTO `tb_akses` VALUES (2, 'Direktur');
INSERT INTO `tb_akses` VALUES (3, 'Deputi');
INSERT INTO `tb_akses` VALUES (4, 'Manager');
INSERT INTO `tb_akses` VALUES (5, 'Staff');

-- ----------------------------
-- Table structure for tb_divisi
-- ----------------------------
DROP TABLE IF EXISTS `tb_divisi`;
CREATE TABLE `tb_divisi`  (
  `id_div` int(11) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_div` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_dd` int(11) NULL DEFAULT NULL,
  `nama_dd` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_dir` int(11) NULL DEFAULT NULL,
  `nama_dir` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_div`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_divisi
-- ----------------------------
INSERT INTO `tb_divisi` VALUES (1, 'Administration', 'Administration, Finance and Acounting', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (2, 'Finance', 'Administration, Finance and Acounting', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (3, 'Accounting', 'Administration, Finance and Acounting', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (4, 'Human Resources', 'Human Resources and General Affair', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (5, 'Facility', 'Human Resources and General Affair', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (6, 'Information Technology', 'Human Resources and General Affair', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (7, 'Library', 'Human Resources and General Affair', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (8, 'Knowledge Management', 'Knowledge Management and Partnership', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (9, 'Partnership', 'Knowledge Management and Partnership', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (10, 'Consultancy', 'Research and Consultancy', 2, 'Programme', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (11, 'Research', 'Research and Consultancy', 2, 'Programme', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (12, 'Training', 'Training', 2, 'Programme', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (13, 'Comunity Development', 'Comunity Development', 2, 'Programme', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (14, 'Laboratory', 'Laboratory', 2, 'Programme', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (15, 'Administration', 'Administration', 1, 'Administration', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (16, 'Programme', 'Programme', 2, 'Programme', 1, 'Director');
INSERT INTO `tb_divisi` VALUES (17, 'SEAMEO-RECFON', 'SEAMEO-RECFON', 3, 'Director', 1, 'Director');

-- ----------------------------
-- Table structure for tb_dtl_cuti
-- ----------------------------
DROP TABLE IF EXISTS `tb_dtl_cuti`;
CREATE TABLE `tb_dtl_cuti`  (
  `id_cuti` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_cuti` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  `id_peg` int(11) NULL DEFAULT NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `tipe_cuti` int(11) NULL DEFAULT NULL,
  `lama_hari` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `supervisor` int(11) NULL DEFAULT NULL,
  `plt` int(11) NULL DEFAULT NULL,
  `approval` int(1) NULL DEFAULT NULL,
  `ket` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `lampiran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `year` int(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id_cuti`) USING BTREE,
  INDEX `fk_to_tipe_cuti`(`tipe_cuti`) USING BTREE,
  CONSTRAINT `fk_to_tipe_cuti` FOREIGN KEY (`tipe_cuti`) REFERENCES `tbl_jen_cuti` (`id_jen_cuti`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_dtl_cuti
-- ----------------------------
INSERT INTO `tb_dtl_cuti` VALUES ('5dd639fc346ab', '11/21/2019', '2019-11-21 14:17:16.215061', 5, '2019-11-21', '2019-11-25', 1, '5', 4, 4, 2, 'Test', '/assets/files/leave/file_cuti_5dd639fc346ab.pdf', 2019);

-- ----------------------------
-- Table structure for tb_dtl_lembur
-- ----------------------------
DROP TABLE IF EXISTS `tb_dtl_lembur`;
CREATE TABLE `tb_dtl_lembur`  (
  `id_overtime` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_peg` int(11) NULL DEFAULT NULL,
  `id_spv` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_overtime` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `time_start` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `time_end` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `time_total` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `desc` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `timestamp` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `year` int(4) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_dtl_lembur
-- ----------------------------
INSERT INTO `tb_dtl_lembur` VALUES ('5dd4dabd7af57', 5, '4', '15-10-2019', '18:00', '23:00', '5', 2, 'asxa', '2019-11-20 13:18:37', 2019);
INSERT INTO `tb_dtl_lembur` VALUES ('5dd64958da84d', 4, '3', '17-10-2019', '18:00', '21:00', '3', 1, 'zxcsdasd', '2019-11-21 15:22:48', 2019);

-- ----------------------------
-- Table structure for tb_dtl_research
-- ----------------------------
DROP TABLE IF EXISTS `tb_dtl_research`;
CREATE TABLE `tb_dtl_research`  (
  `id_research` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date_submission` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_peg` int(11) NULL DEFAULT NULL,
  `id_spv` int(11) NULL DEFAULT NULL,
  `id_plt` int(11) NULL DEFAULT NULL,
  `nama_research` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `picopi` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sponsor` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_keg` int(11) NULL DEFAULT NULL,
  `jenis_keg_lain` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sumber_dana` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_mou` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_research` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_buget` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_ethic` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_installment` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_izin_riset` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lokasi` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `lama_hari` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ket` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `approval` int(1) NULL DEFAULT NULL,
  `timestamp` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `year` int(4) NULL DEFAULT NULL,
  INDEX `fk_type_research`(`jenis_keg`) USING BTREE,
  CONSTRAINT `fk_type_research` FOREIGN KEY (`jenis_keg`) REFERENCES `tb_type_research` (`id_type_research`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_dtl_umum
-- ----------------------------
DROP TABLE IF EXISTS `tb_dtl_umum`;
CREATE TABLE `tb_dtl_umum`  (
  `id_general` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_submission` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_spv` int(11) NULL DEFAULT NULL,
  `id_peg` int(11) NULL DEFAULT NULL,
  `plt` int(11) NULL DEFAULT NULL,
  `id_duty_type` int(11) NULL DEFAULT NULL,
  `others_duty_type` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lampiran` varbinary(255) NULL DEFAULT NULL,
  `instansi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lokasi` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `start_date` date NULL DEFAULT NULL,
  `end_date` date NULL DEFAULT NULL,
  `lama_hari` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ket` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `approval` int(1) NULL DEFAULT NULL,
  `timestamp` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `year` int(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id_general`) USING BTREE,
  INDEX `fk_duty_type`(`id_duty_type`) USING BTREE,
  CONSTRAINT `fk_duty_type` FOREIGN KEY (`id_duty_type`) REFERENCES `tb_duty_type` (`id_duty_type`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_dtl_umum
-- ----------------------------
INSERT INTO `tb_dtl_umum` VALUES ('5dbd4e8e0a0e5', '11/02/2019', 4, 5, 3, 3, '', NULL, 'zxc', 'zxcs', '2019-11-01', '2019-11-09', '9', 'zxc', 2, '2019-11-02 16:38:22', 2019);
INSERT INTO `tb_dtl_umum` VALUES ('5dd3a74088b91', '11/19/2019', 4, 3, 4, 3, '', NULL, 'zxc', 'asda', '2019-11-19', '2019-11-19', '1', 'zxc', 2, '2019-11-19 15:26:40', 2019);
INSERT INTO `tb_dtl_umum` VALUES ('5dd3a9f8c56c6', '11/19/2019', 7, 4, 3, 5, '', NULL, 'asd', 'zxc', '2019-11-19', '2019-11-19', '1', 'zxc', 2, '2019-11-19 15:38:16', 2019);
INSERT INTO `tb_dtl_umum` VALUES ('5dd4ba7483865', '11/20/2019', 1, 2, 1, 3, '', NULL, 'asdasd', 'zxczxc', '2019-11-20', '2019-11-20', '1', 'asd', 0, '2019-11-20 11:00:52', 2019);

-- ----------------------------
-- Table structure for tb_duty_type
-- ----------------------------
DROP TABLE IF EXISTS `tb_duty_type`;
CREATE TABLE `tb_duty_type`  (
  `id_duty_type` int(11) NOT NULL AUTO_INCREMENT,
  `name_duty_type_en` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name_duty_type_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_duty_type`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_duty_type
-- ----------------------------
INSERT INTO `tb_duty_type` VALUES (1, 'Conference', 'Konferensi');
INSERT INTO `tb_duty_type` VALUES (2, 'Seminar', 'Seminar');
INSERT INTO `tb_duty_type` VALUES (3, 'Symposium', 'Simposium');
INSERT INTO `tb_duty_type` VALUES (4, 'Work', 'Kerja');
INSERT INTO `tb_duty_type` VALUES (5, 'Work Meeting', 'Rapat Kerja');
INSERT INTO `tb_duty_type` VALUES (6, 'Consultation', 'Konsultasi');
INSERT INTO `tb_duty_type` VALUES (7, 'Training', 'Pelatihan');
INSERT INTO `tb_duty_type` VALUES (8, 'Others', 'Lain - Lain');

-- ----------------------------
-- Table structure for tb_leave_quota
-- ----------------------------
DROP TABLE IF EXISTS `tb_leave_quota`;
CREATE TABLE `tb_leave_quota`  (
  `id_leave_quota` int(11) NOT NULL,
  `id_type_leave` int(11) NULL DEFAULT NULL,
  `year` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `quota` int(2) NULL DEFAULT NULL,
  `id_peg` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_leave_quota`) USING BTREE,
  INDEX `fk_quota_jen_cut`(`id_type_leave`) USING BTREE,
  INDEX `fk_quota_to_peg`(`id_peg`) USING BTREE,
  CONSTRAINT `fk_quota_jen_cut` FOREIGN KEY (`id_type_leave`) REFERENCES `tbl_jen_cuti` (`id_jen_cuti`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_quota_to_peg` FOREIGN KEY (`id_peg`) REFERENCES `tb_peg` (`id_peg`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_notif
-- ----------------------------
DROP TABLE IF EXISTS `tb_notif`;
CREATE TABLE `tb_notif`  (
  `id_notif` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `notif_en` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `notif_id` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `stat_notif` int(11) NULL DEFAULT NULL,
  `id_peg` int(11) NULL DEFAULT NULL,
  `pages` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `date` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `timestamp` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id_notif`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_notif
-- ----------------------------
INSERT INTO `tb_notif` VALUES ('5dd639fc34770', 'New Leave Submission from Betuah Gmail.', 'Pengajuan cuti baru dari Betuah Gmail.', 0, 4, 'approval', '11/21/2019', '2019-11-21 14:17:16');
INSERT INTO `tb_notif` VALUES ('5dd639fc34779', 'Betuah Gmail has submit your name as a delegation.', 'Betuah Gmail mengajukan nama Anda sebagai delegasinya.', 0, 4, NULL, '11/21/2019', '2019-11-21 14:17:16');
INSERT INTO `tb_notif` VALUES ('5dd63a528b6d3', 'Betuah Gmail has changed the leave submission data with ID 5dd639fc346ab.', 'Betuah Gmail telah merubah data pengajuan cuti dengan ID 5dd639fc346ab.', 1, 4, 'approval', '11/21/2019', '2019-11-21 14:18:42');
INSERT INTO `tb_notif` VALUES ('5dd63a528b6dc', 'Betuah Gmail has changed his delegated and you are no longer a delegate.', 'Betuah Gmail telah merubah delegasinya dan Anda sudah tidak menjadi delegasinya lagi.', 0, NULL, NULL, '11/21/2019', '2019-11-21 14:18:42');
INSERT INTO `tb_notif` VALUES ('5dd63a528b6e3', 'Betuah Gmail has delegated his duties to you from 11/21/2019  until  11/25/2019.', 'Betuah Gmail telah mendelegasikan tugasnya kepada Anda dari tanggal 11/21/2019  sampai tanggal  11/25/2019.', 1, 4, NULL, '11/21/2019', '2019-11-21 14:18:42');
INSERT INTO `tb_notif` VALUES ('5dd63c7de86c0', 'Betuah Anugerah Manager has approved your leave submission with leave date submission 11/21/2019.', 'Betuah Anugerah Manager telah menyetujui pengajuan cuti Anda dengan tanggal pengajuan cuti 11/21/2019.', 1, 5, 'leave', '11/21/2019', '2019-11-21 14:27:57');
INSERT INTO `tb_notif` VALUES ('5dd63c7de86c9', 'Betuah Gmail delegates his duties to you for 5 days from date 2019-11-21 until 2019-11-25.', 'Betuah Gmail mendelegasikan tugasnya kepada Anda selama 5 hari dari tanggal 2019-11-21 sampai tanggal 2019-11-25.', 0, 4, NULL, '11/21/2019', '2019-11-21 14:27:57');
INSERT INTO `tb_notif` VALUES ('5dd64958da85c', 'New Overtime Submission from Betuah Anugerah Manager.', 'Pengajuan Lembur baru dari Betuah Anugerah Manager.', 0, 3, 'approval', '11/21/2019', '2019-11-21 15:22:48');

-- ----------------------------
-- Table structure for tb_peg
-- ----------------------------
DROP TABLE IF EXISTS `tb_peg`;
CREATE TABLE `tb_peg`  (
  `id_peg` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `nik_peg` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jekel` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_lahir` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `jabatan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pic` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `bahasa` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tempat_lahir` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_div` int(11) NULL DEFAULT NULL,
  `pic_google` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_peg`) USING BTREE,
  INDEX `fk_peg_User`(`nik_peg`) USING BTREE,
  INDEX `fk_to_usr`(`id_user`) USING BTREE,
  INDEX `fk_to_div`(`id_div`) USING BTREE,
  CONSTRAINT `fk_to_div` FOREIGN KEY (`id_div`) REFERENCES `tb_divisi` (`id_div`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_to_usr` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_peg
-- ----------------------------
INSERT INTO `tb_peg` VALUES (1, 1, NULL, 'Administrator', 'Male', NULL, NULL, NULL, NULL, 'EN', NULL, 1, 'https://lh6.googleusercontent.com/-8tkfZ7hYTJY/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rckKIP7qJd18rV4Fx1gYEhv0IShQg/photo.jpg');
INSERT INTO `tb_peg` VALUES (2, 2, '12121212', 'Alex', 'Male', '-', '-', NULL, NULL, 'EN', '-', 17, 'https://lh4.googleusercontent.com/-ba6qG8tDr3Q/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rciW8qWdo8vANJrblxsaYSVyn7igw/photo.jpg');
INSERT INTO `tb_peg` VALUES (3, 3, NULL, 'Mikasa', 'Female', NULL, NULL, NULL, NULL, 'EN', NULL, 15, 'https://lh6.googleusercontent.com/-DwXIhw508Q0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfDOfStT9cG-xIs26fPa63PMMAfig/photo.jpg');
INSERT INTO `tb_peg` VALUES (4, 4, '2233442', 'Betuah Anugerah Manager', 'Male', '27-07-1995', 'Prum BIP Blok A14 No 01 RT/RW 01/13,\r\nTajurhalang, Bogor, Jawa Barat, Indonesia 16321', NULL, '', 'EN', 'Bogor', 1, 'https://lh4.googleusercontent.com/-dL0Cn9_Q6qU/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdb5-WMeLOu4P1zCxUfA_-k2Eemjg/photo.jpg');
INSERT INTO `tb_peg` VALUES (5, 5, '777777', 'Betuah Gmail', 'Male', '14-01-2019', 'Testing 22', NULL, '', 'EN', 'Stabat', 1, 'https://lh3.googleusercontent.com/a-/AAuE7mA24o6rFw-f3QkhuH7etp58ZiCXWyGQgn3BjMAvcw');
INSERT INTO `tb_peg` VALUES (7, 7, NULL, 'Test Deputi', 'Male', NULL, NULL, NULL, NULL, 'EN', NULL, 16, 'https://lh6.googleusercontent.com/-N8ANWOkG-TA/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rc73bjkCoRSuYS2DUQqUfFlgkIxkw/photo.jpg');

-- ----------------------------
-- Table structure for tb_pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pengajuan`;
CREATE TABLE `tb_pengajuan`  (
  `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NULL DEFAULT NULL,
  `type_pengajuan` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_pengajuan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `approval_status` int(1) NULL DEFAULT NULL,
  `user_approval` int(11) NULL DEFAULT NULL,
  `time` timestamp(0) NULL DEFAULT NULL,
  `plt` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`) USING BTREE,
  INDEX `fk_pengajuan_usr`(`id_user`) USING BTREE,
  CONSTRAINT `fk_pengajuan_usr` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_type_research
-- ----------------------------
DROP TABLE IF EXISTS `tb_type_research`;
CREATE TABLE `tb_type_research`  (
  `id_type_research` int(11) NOT NULL,
  `type_research_en` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type_research_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_type_research`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_type_research
-- ----------------------------
INSERT INTO `tb_type_research` VALUES (1, 'Data Retrieval', 'Pengambilan Data');
INSERT INTO `tb_type_research` VALUES (2, 'Laboratory Test', 'Uji Laboratorium');
INSERT INTO `tb_type_research` VALUES (3, 'Others', 'Lain - Lain');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_akses` int(11) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `fk_to_akses`(`id_akses`) USING BTREE,
  INDEX `email`(`email`) USING BTREE,
  CONSTRAINT `fk_to_akses` FOREIGN KEY (`id_akses`) REFERENCES `tb_akses` (`id_akses`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES (1, 'dev@seameo-recfon.org', '', 1, 1, NULL);
INSERT INTO `tb_user` VALUES (2, 'rootserver122@gmail.com', '', 2, 1, NULL);
INSERT INTO `tb_user` VALUES (3, 'suratbetuah@gmail.com', '', 3, 1, NULL);
INSERT INTO `tb_user` VALUES (4, 'betuah@seamolec.org', '315740bf2f7dc5e22b3c121fa88e3bb8522d7cfd2d2052e65abcb2ff6bd1e71c1443d61d02f056bad911ec5f8d7539cf0b746dba206bab09bdbd5c742c278b10Ql8JrHIoWyHb8In19u/B13jYMnuAb06KWM8k7BZvKCM=', 4, 1, NULL);
INSERT INTO `tb_user` VALUES (5, 'betuahanugerah@gmail.com', 'f626b744ac094effed8e44b9b6d76c22e9063a9e3cc3b1aff33977afb971aae6e20b9295a7dbb984c9a1d46b5af5cdb9578e88eb83fd2f5c7fccb710350119e1Aj0Vyi3qH0Gp1bh0jF5Uzj52dS5SO282R6NhmmRiYSc=', 5, 1, NULL);
INSERT INTO `tb_user` VALUES (7, 'hrseameorecfon@gmail.com', NULL, 3, 1, NULL);

-- ----------------------------
-- Table structure for tbl_jen_cuti
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jen_cuti`;
CREATE TABLE `tbl_jen_cuti`  (
  `id_jen_cuti` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jen_cut` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `quota` int(11) NULL DEFAULT NULL,
  `nama_jen_cut_en` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_jen_cuti`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_jen_cuti
-- ----------------------------
INSERT INTO `tbl_jen_cuti` VALUES (1, 'Cuti Tahunan', 12, 'Annual Leave');
INSERT INTO `tbl_jen_cuti` VALUES (2, 'Cuti Sakit', NULL, 'Sick Leave');
INSERT INTO `tbl_jen_cuti` VALUES (3, 'Cuti Bersalin', 60, 'Maternity Leave');
INSERT INTO `tbl_jen_cuti` VALUES (4, 'Cuti Haid', 12, 'Menstruation Leave');
INSERT INTO `tbl_jen_cuti` VALUES (5, 'Cuti Pernikahan', 3, 'Wedding Leave');
INSERT INTO `tbl_jen_cuti` VALUES (6, 'Cuti Besar', NULL, 'Sabbatical Leave');
INSERT INTO `tbl_jen_cuti` VALUES (7, 'Cuti Keluarga', 3, 'Family Leave');
INSERT INTO `tbl_jen_cuti` VALUES (8, 'Cuti Di Luar Tanggungan', NULL, 'Unpaid Leave');
INSERT INTO `tbl_jen_cuti` VALUES (9, 'Lain - Lain', NULL, 'Others');

-- ----------------------------
-- View structure for v_available
-- ----------------------------
DROP VIEW IF EXISTS `v_available`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_available` AS SELECT
tb_peg.id_peg,
tb_peg.id_user,
tb_user.id_akses,
tb_peg.nama,
tb_peg.pic,
tb_peg.pic_google,
tb_peg.id_div,
tb_divisi.nama_unit,
tb_divisi.nama_div,
tb_dtl_research.id_research,
tb_dtl_research.start_date AS sdate_research,
tb_dtl_research.end_date AS ndate_research,
tb_dtl_research.approval AS approval_research,
tb_dtl_cuti.id_cuti,
tb_dtl_cuti.start_date AS sdate_cuti,
tb_dtl_cuti.end_date AS ndate_cuti,
tb_dtl_cuti.approval AS approval_cuti,
tb_dtl_umum.id_general,
tb_dtl_umum.end_date AS ndate_general,
tb_dtl_umum.start_date AS sdate_general,
tb_dtl_umum.approval AS approval_general
FROM
tb_peg
LEFT JOIN tb_user ON tb_peg.id_user = tb_user.id_user
LEFT JOIN tb_divisi ON tb_peg.id_div = tb_divisi.id_div
LEFT JOIN tb_dtl_cuti ON tb_peg.id_peg = tb_dtl_cuti.id_peg
LEFT JOIN tb_dtl_research ON tb_peg.id_peg = tb_dtl_research.id_peg
LEFT JOIN tb_dtl_umum ON tb_peg.id_peg = tb_dtl_umum.id_peg ;

-- ----------------------------
-- View structure for v_cuti
-- ----------------------------
DROP VIEW IF EXISTS `v_cuti`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_cuti` AS SELECT
tb_dtl_cuti.id_cuti,
tb_dtl_cuti.id_peg,
peg_cut.nama AS nama_user,
peg_cut.pic AS pic,
peg_cut.pic_google AS pic_google,
peg_user.email AS email_peg,
peg_cut.jekel,
peg_cut.id_div,
tb_divisi.nama_div,
tb_divisi.nama_unit,
tb_divisi.id_dd,
tb_divisi.nama_dd,
tb_divisi.id_dir,
tb_divisi.nama_dir,
tb_dtl_cuti.tgl_cuti,
tb_dtl_cuti.start_date,
tb_dtl_cuti.end_date,
tb_dtl_cuti.tipe_cuti,
tbl_jen_cuti.nama_jen_cut,
tbl_jen_cuti.nama_jen_cut_en,
tbl_jen_cuti.quota,
tb_dtl_cuti.lama_hari,
tb_dtl_cuti.supervisor,
peg_supervisor.nama AS nama_supervisor,
spv_user.email AS spv_mail,
tb_dtl_cuti.plt,
peg_plt.nama AS nama_plt,
plt_user.email AS plt_mail,
tb_dtl_cuti.approval,
tb_dtl_cuti.ket,
tb_dtl_cuti.lampiran,
tb_dtl_cuti.year,
tb_dtl_cuti.date
FROM
tb_dtl_cuti
INNER JOIN tb_peg AS peg_cut ON tb_dtl_cuti.id_peg = peg_cut.id_peg
INNER JOIN tb_user AS peg_user ON peg_cut.id_user = peg_user.id_user
INNER JOIN tb_peg AS peg_plt ON tb_dtl_cuti.plt = peg_plt.id_user
INNER JOIN tb_peg AS peg_supervisor ON tb_dtl_cuti.supervisor = peg_supervisor.id_user
INNER JOIN tb_user AS spv_user ON peg_supervisor.id_user = spv_user.id_user
INNER JOIN tb_user AS plt_user ON peg_plt.id_user = plt_user.id_user
INNER JOIN tb_divisi ON peg_cut.id_div = tb_divisi.id_div
INNER JOIN tbl_jen_cuti ON tb_dtl_cuti.tipe_cuti = tbl_jen_cuti.id_jen_cuti ;

-- ----------------------------
-- View structure for v_general
-- ----------------------------
DROP VIEW IF EXISTS `v_general`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_general` AS SELECT
	tb_dtl_umum.id_general,
	tb_dtl_umum.date_submission,
	tb_dtl_umum.id_peg,
	peg_gen.id_user,
	peg_gen.nama,
	peg_gen.pic,
	peg_gen.pic_google,
	usr_gen.email,
	tb_divisi.id_div,
	tb_divisi.nama_unit,
	tb_divisi.nama_div,
	tb_divisi.id_dd,
	tb_divisi.nama_dd,
	tb_divisi.id_dir,
	tb_divisi.nama_dir,
	tb_dtl_umum.id_spv,
	peg_spv.nama AS nama_spv,
	usr_spv.email AS email_spv,
	tb_dtl_umum.plt,
	peg_plt.nama AS nama_plt,
	usr_plt.email AS email_plt,
	tb_dtl_umum.id_duty_type,
	tb_duty_type.name_duty_type_en,
	tb_duty_type.name_duty_type_id,
	tb_dtl_umum.others_duty_type,
	tb_dtl_umum.lampiran,
	tb_dtl_umum.instansi,
	tb_dtl_umum.lokasi,
	tb_dtl_umum.start_date,
	tb_dtl_umum.end_date,
	tb_dtl_umum.lama_hari,
	tb_dtl_umum.ket,
	tb_dtl_umum.year,
	tb_dtl_umum.approval 
FROM
	tb_dtl_umum
	INNER JOIN tb_peg AS peg_gen ON tb_dtl_umum.id_peg = peg_gen.id_peg
	INNER JOIN tb_user AS usr_gen ON peg_gen.id_user = usr_gen.id_user
	INNER JOIN tb_divisi ON peg_gen.id_div = tb_divisi.id_div
	INNER JOIN tb_peg AS peg_spv ON tb_dtl_umum.id_spv = peg_spv.id_peg
	INNER JOIN tb_user AS usr_spv ON peg_spv.id_user = usr_spv.id_user
	INNER JOIN tb_peg AS peg_plt ON tb_dtl_umum.plt = peg_plt.id_peg
	INNER JOIN tb_user AS usr_plt ON peg_plt.id_user = usr_plt.id_user
	INNER JOIN tb_duty_type ON tb_dtl_umum.id_duty_type = tb_duty_type.id_duty_type ;

-- ----------------------------
-- View structure for v_overtime
-- ----------------------------
DROP VIEW IF EXISTS `v_overtime`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_overtime` AS SELECT
tb_dtl_lembur.id_overtime,
tb_dtl_lembur.id_peg,
tb_peg.id_user,
tb_peg.nama,
tb_peg.pic,
tb_peg.pic_google,
tb_user.email,
tb_peg.id_div,
tb_divisi.nama_unit,
tb_divisi.nama_div,
tb_divisi.id_dd,
tb_divisi.nama_dd,
tb_divisi.id_dir,
tb_divisi.nama_dir,
tb_dtl_lembur.date_overtime,
tb_dtl_lembur.time_start,
tb_dtl_lembur.time_end,
tb_dtl_lembur.time_total,
tb_dtl_lembur.`status`,
tb_dtl_lembur.id_spv,
peg_svp.nama AS nama_svp,
usr_spv.email AS email_svp,
tb_dtl_lembur.`desc`,
tb_dtl_lembur.year,
tb_dtl_lembur.`timestamp`
FROM
tb_dtl_lembur
INNER JOIN tb_peg ON tb_dtl_lembur.id_peg = tb_peg.id_peg
INNER JOIN tb_divisi ON tb_peg.id_div = tb_divisi.id_div
INNER JOIN tb_user ON tb_peg.id_user = tb_user.id_user
INNER JOIN tb_peg AS peg_svp ON tb_dtl_lembur.id_spv = peg_svp.id_peg
INNER JOIN tb_user AS usr_spv ON peg_svp.id_user = usr_spv.id_user ;

-- ----------------------------
-- View structure for v_pegawai
-- ----------------------------
DROP VIEW IF EXISTS `v_pegawai`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_pegawai` AS SELECT
tb_user.id_user,
tb_user.id_akses,
tb_akses.ket,
tb_peg.id_peg,
tb_user.email,
tb_user.`password`,
tb_user.`status`,
tb_user.last_login,
tb_peg.nik_peg,
tb_peg.nama,
tb_peg.jekel,
tb_peg.tgl_lahir,
tb_peg.alamat,
tb_peg.jabatan,
tb_peg.pic,
tb_peg.pic_google,
tb_peg.bahasa,
tb_peg.tempat_lahir,
tb_peg.id_div,
tb_divisi.nama_div,
tb_divisi.nama_unit,
tb_divisi.id_dd,
tb_divisi.nama_dd,
tb_divisi.id_dir,
tb_divisi.nama_dir
FROM
tb_user
INNER JOIN tb_akses ON tb_user.id_akses = tb_akses.id_akses
INNER JOIN tb_peg ON tb_peg.id_user = tb_user.id_user
INNER JOIN tb_divisi ON tb_peg.id_div = tb_divisi.id_div ;

-- ----------------------------
-- View structure for v_research
-- ----------------------------
DROP VIEW IF EXISTS `v_research`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_research` AS SELECT
tb_dtl_research.id_research,
tb_dtl_research.id_peg,
tb_dtl_research.date_submission,
res_peg.id_user,
tb_akses.id_akses,
tb_akses.ket AS ket_akses,
res_peg.nama,
res_peg.pic,
res_peg.pic_google,
res_usr.email,
res_peg.id_div,
tb_divisi.nama_unit,
tb_divisi.nama_div,
tb_divisi.id_dd,
tb_divisi.nama_dd,
tb_divisi.id_dir,
tb_divisi.nama_dir,
tb_dtl_research.id_spv,
res_spv.nama AS nama_spv,
usr_spv.email AS email_spv,
tb_dtl_research.id_plt,
res_plt.nama AS nama_plt,
usr_plt.email AS email_plt,
tb_dtl_research.nama_research,
tb_dtl_research.jabatan,
tb_dtl_research.picopi,
tb_dtl_research.sponsor,
tb_dtl_research.jenis_keg,
tb_type_research.type_research_en,
tb_type_research.type_research_id,
tb_dtl_research.jenis_keg_lain,
tb_dtl_research.sumber_dana,
tb_dtl_research.tgl_mou,
tb_dtl_research.tgl_research,
tb_dtl_research.tgl_buget,
tb_dtl_research.tgl_ethic,
tb_dtl_research.tgl_installment,
tb_dtl_research.tgl_izin_riset,
tb_dtl_research.lokasi,
tb_dtl_research.start_date,
tb_dtl_research.end_date,
tb_dtl_research.lama_hari,
tb_dtl_research.ket,
tb_dtl_research.year,
tb_dtl_research.approval
FROM
tb_dtl_research
INNER JOIN tb_peg AS res_peg ON tb_dtl_research.id_peg = res_peg.id_peg
INNER JOIN tb_user AS res_usr ON res_peg.id_user = res_usr.id_user
INNER JOIN tb_divisi ON res_peg.id_div = tb_divisi.id_div
INNER JOIN tb_peg AS res_spv ON tb_dtl_research.id_spv = res_spv.id_peg
INNER JOIN tb_user AS usr_spv ON res_spv.id_user = usr_spv.id_user
INNER JOIN tb_peg AS res_plt ON tb_dtl_research.id_plt = res_plt.id_peg
INNER JOIN tb_user AS usr_plt ON res_plt.id_user = usr_plt.id_user
INNER JOIN tb_type_research ON tb_dtl_research.jenis_keg = tb_type_research.id_type_research
INNER JOIN tb_akses ON res_usr.id_akses = tb_akses.id_akses ;

-- ----------------------------
-- View structure for v_supervisor
-- ----------------------------
DROP VIEW IF EXISTS `v_supervisor`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_supervisor` AS SELECT
tb_user.id_akses,
tb_user.email,
tb_peg.id_peg,
tb_peg.id_user,
tb_akses.ket,
tb_peg.nama,
tb_peg.nik_peg,
tb_peg.id_div,
tb_divisi.nama_unit,
tb_divisi.nama_div,
tb_divisi.id_dd,
tb_divisi.nama_dd,
tb_divisi.id_dir,
tb_divisi.nama_dir
FROM
tb_peg
INNER JOIN tb_user ON tb_peg.id_user = tb_user.id_user
INNER JOIN tb_akses ON tb_user.id_akses = tb_akses.id_akses
INNER JOIN tb_divisi ON tb_peg.id_div = tb_divisi.id_div ;

SET FOREIGN_KEY_CHECKS = 1;
