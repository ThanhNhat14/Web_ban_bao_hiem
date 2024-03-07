-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 01, 2023 lúc 06:33 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `baohiem`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `xacnhan_thanhtoan`
--

CREATE TABLE `xacnhan_thanhtoan` (
  `id_thanhtoan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_baohiem` int(11) NOT NULL,
  `id_cart_detail` int(11) NOT NULL,
  `ten_baohiem` varchar(50) NOT NULL,
  `chu_so_huu` varchar(50) NOT NULL,
  `cccd` varchar(12) NOT NULL,
  `ngaysinh` date NOT NULL,
  `tuoi` tinyint(4) GENERATED ALWAYS AS (timestampdiff(YEAR,`ngaysinh`,curdate())) VIRTUAL,
  `sdt_chu` varchar(10) NOT NULL,
  `gioitinh_chu` enum('Nam','Nữ') NOT NULL,
  `diachi_chu` text NOT NULL,
  `han_bao_hiem_chu` int(11) NOT NULL,
  `tien_baohiem` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `xacnhan_thanhtoan`
--

INSERT INTO `xacnhan_thanhtoan` (`id_thanhtoan`, `id_user`, `id_baohiem`, `id_cart_detail`, `ten_baohiem`, `chu_so_huu`, `cccd`, `ngaysinh`, `sdt_chu`, `gioitinh_chu`, `diachi_chu`, `han_bao_hiem_chu`, `tien_baohiem`) VALUES
(27, 11, 9, 343, 'Bảo hiểm xe máy dưới 175cc', '111', '111', '0000-00-00', '1111', 'Nam', '11', 1, 90000),
(28, 11, 9, 343, 'Bảo hiểm xe máy dưới 175cc', '111', '111', '0000-00-00', '1111', 'Nam', '11', 1, 90000);

--
-- Bẫy `xacnhan_thanhtoan`
--
DELIMITER $$
CREATE TRIGGER `check_ngaysinh` BEFORE INSERT ON `xacnhan_thanhtoan` FOR EACH ROW BEGIN
    IF NEW.ngaysinh >= CURDATE() THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Ngaysinh phai nho hon ngay hien tai.';
    END IF;
END
$$
DELIMITER ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `xacnhan_thanhtoan`
--
ALTER TABLE `xacnhan_thanhtoan`
  ADD PRIMARY KEY (`id_thanhtoan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `xacnhan_thanhtoan`
--
ALTER TABLE `xacnhan_thanhtoan`
  MODIFY `id_thanhtoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
