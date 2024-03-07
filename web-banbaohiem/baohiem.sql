SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; /*tự động tăng (!=0)*/
START TRANSACTION;
SET time_zone = "+00:00";

/*DATABASE: `PTIT`*/

CREATE DATABASE IF NOT EXISTS `baohiem` DEFAULT CHARACTER SET UTF8MB4 COLLATE UTF8MB4_GENERAL_CI;
USE `baohiem`;

DROP TABLE IF EXISTS `admin`; 
CREATE TABLE `admin`(
    `id_admin` int(5) UNIQUE NOT NULL CHECK (octet_length(`id_admin`)=5),
    `username` varchar(30) NOT NULL,
    `password` varchar(100) NOT NULL,
    `email_admin` varchar(64) NOT NULL,
    `sdt_admin` varchar(10) NOT NULL,
    PRIMARY KEY (`id_admin`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `daili`;
CREATE TABLE `daili`(
    `id_daili` int(7) UNIQUE NOT NULL CHECK (octet_length(`id_daili`)=7),
    `id_admin` int NOT NULL,
    `ten_daili` varchar(50) NOT NULL,
    `username` varchar(30) UNIQUE NOT NULL,
    `password` varchar(100) NOT NULL,
    `email_daili` varchar(64) NOT NULL,
    `sdt_daili` varchar(10) UNIQUE NOT NULL,
    `diachi` varchar(60) NOT NULL,
    PRIMARY KEY (`id_daili`),
    CONSTRAINT `fk_dl_id_ad` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `chinhsach`;
CREATE TABLE `chinhsach`(
    `id_baohiem` int(4) UNIQUE NOT NULL CHECK (octet_length(`id_baohiem`)=4),
    `ten_baohiem` varchar(50) NOT NULL,
    `gia_baohiem` bigint DEFAULT NULL,
    `ttt` tinyint DEFAULT NULL, /* tuoi toi thieu tham gia bao hiem*/
    `ttd` tinyint DEFAULT NULL, /*tuoi toi da tham gia bao hiem*/
    `tgck` int DEFAULT NULL, /* thoi gian chu ky bao hiem*/
    `pttt` enum('Tien_mat', 'Khac') DEFAULT NULL,
    PRIMARY KEY(`id_baohiem`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;

DROP TABLE IF EXISTS `hopdong`;
CREATE TABLE `hopdong`(
    `id_hopdong` int UNIQUE NOT NULL CHECK (octet_length(`id_hopdong`)=7),
    `id_daili` int NOT NULL,
    `ten_daili` varchar(50) DEFAULT NULL,
    `id_baohiem` int NOT NULL,
    `ten_baohiem` varchar(50) DEFAULT NULL,
    `ten_khachhang` varchar(50) NOT NULL,
    `gioitinh` enum('Nam', 'Nu') NOT NULL,
    `ngaysinh` date NOT NULL,
    `tuoi`  tinyint GENERATED ALWAYS AS (timestampdiff(YEAR,`ngaysinh`, curdate())) VIRTUAL,
    `nghenghiep` varchar(40) DEFAULT NULL,
    `ngayky_hopdong` date NOT NULL,
    `pttt` enum('Tien_mat','Khac') NOT NULL,
    `handongtien` date DEFAULT NULL,
    `trangthai` enum('1','0'), /*1 la da dong tien, 0 la chua dong*/
    `thoihan_baohiem` int DEFAULT NULL,
    PRIMARY KEY (`id_hopdong`),
    CONSTRAINT `fk_hd_id_dl` FOREIGN KEY(`id_daili`) REFERENCES `daili` (`id_daili`),
    CONSTRAINT `fk_hd_id_bh` FOREIGN KEY(`id_baohiem`) REFERENCES `chinhsach`(`id_baohiem`)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8MB4;



INSERT INTO `chinhsach` (`id_baohiem`, `ten_baohiem`, `gia_baohiem`, `ttt`, `ttd`, `tgck`, `pttt`) VALUES ('2562', 'Bảo hiểm xe oto', '15000000', '18', NULL, '1', 'Khac');
INSERT INTO `admin` (`id_admin`, `username`, `password`, `email_admin`, `sdt_admin`) VALUES ('11225', 'admin', '123456789', 'admin123@gmail.com', '0156622005');
INSERT INTO `daili` (`id_daili`, `id_admin`, `ten_daili`, `username`, `password`, `email_daili`, `sdt_daili`, `diachi`) VALUES ('1000001', '11225', 'Man Thiện', 'dl001', '987654321', 'daili001@gmail.com', '0921563253', '97 Man Thiện, Hiệp Phú, Thủ Đức, HCM');
INSERT INTO `daili` (`id_daili`, `id_admin`, `ten_daili`, `username`, `password`, `email_daili`, `sdt_daili`, `diachi`) VALUES ('1112000', '11225', 'Lê Văn Việt', 'dl002', 'daili002', 'daili002@gmail.com', '0923153262', '33, Tăng Nhơn Phú A, Thủ Đức, HCM');
INSERT INTO `daili` (`id_daili`, `id_admin`, `ten_daili`, `username`, `password`, `email_daili`, `sdt_daili`, `diachi`) VALUES ('3700003', '11225', 'Kim Sơn', 'dl003', 'khaks123', 'daili003@gmail.com', '0823615236', 'Kim Sơn, Ân Nghĩa, Hoài Ân, Bình Định');
INSERT INTO `hopdong` (`id_hopdong`, `id_daili`, `ten_daili`, `id_baohiem`, `ten_baohiem`, `ten_khachhang`, `gioitinh`, `ngaysinh`, `nghenghiep`, `ngayky_hopdong`, `pttt`, `handongtien`, `trangthai`, `thoihan_baohiem`) VALUES ('252525', '3700003', 'Kim Sơn', '2333', 'Bảo hiểm Nhân Thọ', 'Lê Thị E', 'Nu', '1978-10-22', 'Giáo viên', '2023-05-15', 'Tien_mat', '2033-05-15', '0', '10');
