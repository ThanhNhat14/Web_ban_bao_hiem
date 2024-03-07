-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 22, 2023 lúc 07:20 PM
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
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL CHECK (octet_length(`id_admin`) = 5),
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email_admin` varchar(64) NOT NULL,
  `sdt_admin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email_admin`, `sdt_admin`) VALUES
(11225, 'admin', '123456789', 'admin123@gmail.com', '0156622005');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chinhsach`
--

CREATE TABLE `chinhsach` (
  `id_baohiem` int(11) NOT NULL,
  `ten_baohiem` varchar(100) NOT NULL,
  `gia_baohiem` varchar(50) NOT NULL,
  `hinhanh` varchar(50) NOT NULL,
  `mota` longtext NOT NULL,
  `ttt` tinyint(4) NOT NULL,
  `ttd` tinyint(4) NOT NULL,
  `tgck` int(11) NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `pttt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chinhsach`
--

INSERT INTO `chinhsach` (`id_baohiem`, `ten_baohiem`, `gia_baohiem`, `hinhanh`, `mota`, `ttt`, `ttd`, `tgck`, `id_danhmuc`, `pttt`) VALUES
(36, 'Bảo hiểm nhân thọ', '250003200', '1684762735_anh_bao_hiem_nhan_tho.png', 'Bao hiem nhan tho thoi han 10 nam', 25, 0, 10, 19, 0),
(37, 'Bảo hiểm xe SH-Tay ga', '250003', '1684762720_xe_SH.png', 'xe tay ga SH đỏ hạn 1 năm', 18, 0, 1, 20, 1),
(40, 'Bảo Hiểm xã hội', '90000', '1684760842_BHXH.jpg', 'Bảo hiểm xã hội thời hạn 1 năm', 7, 0, 1, 19, 0),
(41, 'Bảo hiểm xe OTO', '8000000', '1684762173_bao_hiem_oto1.jpg', 'Bảo hiểm oto thời hạn 1 năm', 18, 0, 1, 20, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `daili`
--

CREATE TABLE `daili` (
  `id_daili` int(7) NOT NULL CHECK (octet_length(`id_daili`) = 7),
  `id_admin` int(11) NOT NULL,
  `ten_daili` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email_daili` varchar(64) NOT NULL,
  `sdt_daili` varchar(10) NOT NULL,
  `diachi` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `daili`
--

INSERT INTO `daili` (`id_daili`, `id_admin`, `ten_daili`, `username`, `password`, `email_daili`, `sdt_daili`, `diachi`) VALUES
(1000001, 11225, 'Man Thiện', 'dl001', '987654321', 'daili001@gmail.com', '0921563253', '97 Man Thiện, Hiệp Phú, Thủ Đức, HCM'),
(1112000, 11225, 'Lê Văn Việt', 'dl002', 'daili002', 'daili002@gmail.com', '0923153262', '33, Tăng Nhơn Phú A, Thủ Đức, HCM'),
(3700003, 11225, 'Kim Sơn', 'dl003', 'khaks123', 'daili003@gmail.com', '0823615236', 'Kim Sơn, Ân Nghĩa, Hoài Ân, Bình Định');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id_danhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(100) NOT NULL,
  `thutu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id_danhmuc`, `tendanhmuc`, `thutu`) VALUES
(19, 'Bảo hiểm người', 99),
(20, 'Bảo hiểm tài sản', 122);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hopdong`
--

CREATE TABLE `hopdong` (
  `id_hopdong` int(6) NOT NULL,
  `id_baohiem` int(11) NOT NULL,
  `ten_baohiem` varchar(50) DEFAULT NULL,
  `ten_khachhang` varchar(50) NOT NULL,
  `gioitinh` enum('Nam','Nu') NOT NULL,
  `ngaysinh` date NOT NULL,
  `tuoi` tinyint(4) GENERATED ALWAYS AS (timestampdiff(YEAR,`ngaysinh`,curdate())) VIRTUAL,
  `nghenghiep` varchar(40) DEFAULT NULL,
  `thoihan_baohiem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hopdong`
--

INSERT INTO `hopdong` (`id_hopdong`, `id_baohiem`, `ten_baohiem`, `ten_khachhang`, `gioitinh`, `ngaysinh`, `nghenghiep`, `thoihan_baohiem`) VALUES
(38, 41, 'Bảo hiểm xe OTO', 'Thanh Nhật', 'Nam', '2000-12-09', 'Sinh viên', 1),
(39, 36, 'Bảo hiểm nhân thọ', 'Thanh Nhật', 'Nam', '2000-12-09', 'Sinh viên', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_cart`
--

CREATE TABLE `tb_cart` (
  `id_cart` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `code_cart` varchar(10) NOT NULL,
  `cart_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_cart`
--

INSERT INTO `tb_cart` (`id_cart`, `id`, `code_cart`, `cart_status`) VALUES
(30, 17, '1003', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_cart_detail`
--

CREATE TABLE `tb_cart_detail` (
  `id_cart_detail` int(11) NOT NULL,
  `code_cart` varchar(10) NOT NULL,
  `id_baohiem` int(11) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_cart_detail`
--

INSERT INTO `tb_cart_detail` (`id_cart_detail`, `code_cart`, `id_baohiem`, `soluong`) VALUES
(41, '1003', 41, 1),
(42, '1003', 36, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `ten_user` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dia_chi` text NOT NULL,
  `matkhau` varchar(10) NOT NULL,
  `gioitinh` text NOT NULL,
  `ngaysinh` date NOT NULL,
  `nghenghiep` text NOT NULL,
  `dienthoai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `ten_user`, `email`, `dia_chi`, `matkhau`, `gioitinh`, `ngaysinh`, `nghenghiep`, `dienthoai`) VALUES
(10, 'Lăng Lăng', 'lang99@gmail.com', 'An Giang', '091203', 'Nam', '2000-05-11', 'Sinh viên', 706830531),
(11, 'Bảo Bảo', 'hothanhnhat10a2@gmail.com', 'Dĩ An', '091203', 'Nữ', '2023-06-09', 'Sinh viên', 942401812),
(13, 'Kha Dung Tiên', 'kdt@gmail.com', 'Việt Nam', '123456', 'Bede', '2001-05-04', 'Sinh viên', 2147483647),
(14, 'Kha ', 'namfire123@gmail.com', 'Dĩ An', '091203', 'Nam', '2023-06-01', 'Sinh viên', 2147483647),
(15, 'Lăng Mua', 'lang9@gmail.com', 'An Giang', '091203', 'Nam', '2023-05-09', 'Sinh viên', 706830531),
(17, 'Thanh Nhật', 'nhat912@gmail.com', 'An Giang', '091203', 'Nam', '2000-12-09', 'Sinh viên', 706830531);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `id_admin` (`id_admin`);

--
-- Chỉ mục cho bảng `chinhsach`
--
ALTER TABLE `chinhsach`
  ADD PRIMARY KEY (`id_baohiem`);

--
-- Chỉ mục cho bảng `daili`
--
ALTER TABLE `daili`
  ADD PRIMARY KEY (`id_daili`),
  ADD UNIQUE KEY `id_daili` (`id_daili`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `sdt_daili` (`sdt_daili`),
  ADD KEY `fk_dl_id_ad` (`id_admin`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Chỉ mục cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`id_hopdong`),
  ADD UNIQUE KEY `id_hopdong` (`id_hopdong`),
  ADD KEY `khoangoaiidbaohiem` (`id_baohiem`);

--
-- Chỉ mục cho bảng `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Chỉ mục cho bảng `tb_cart_detail`
--
ALTER TABLE `tb_cart_detail`
  ADD PRIMARY KEY (`id_cart_detail`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chinhsach`
--
ALTER TABLE `chinhsach`
  MODIFY `id_baohiem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `id_hopdong` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `tb_cart_detail`
--
ALTER TABLE `tb_cart_detail`
  MODIFY `id_cart_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `daili`
--
ALTER TABLE `daili`
  ADD CONSTRAINT `fk_dl_id_ad` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
