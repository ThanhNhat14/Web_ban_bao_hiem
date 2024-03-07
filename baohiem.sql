-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 01, 2023 lúc 09:50 AM
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
(11225, 'admin', '091203', 'admin123@gmail.com', '0156622005');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chinhsach`
--

CREATE TABLE `chinhsach` (
  `id_baohiem` int(11) NOT NULL,
  `ten_baohiem` varchar(100) NOT NULL,
  `gia_baohiem` varchar(50) NOT NULL,
  `hinhanh` text NOT NULL,
  `mota` longtext NOT NULL,
  `ttt` tinyint(4) NOT NULL,
  `ttd` tinyint(4) NOT NULL,
  `tgck` int(11) NOT NULL,
  `id_danhmuc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chinhsach`
--

INSERT INTO `chinhsach` (`id_baohiem`, `ten_baohiem`, `gia_baohiem`, `hinhanh`, `mota`, `ttt`, `ttd`, `tgck`, `id_danhmuc`) VALUES
(8, 'Bảo hiểm nhân thọ', '200000000', '1685344904_anh_bao_hiem_nhan_tho.png', 'Bảo hiểm nhân thọ\r\nThời hạn:10 năm\r\nDành cho lứa tuổi từ 10 lên 70.', 10, 70, 10, 1),
(9, 'Bảo hiểm xe máy dưới 175cc', '90000', '1685344915_xe_110cc.png', 'Bảo hiểm xe máy\r\nThời hạn 1 năm\r\nDành cho xe máy dưới 175 phân khối\r\nMọi người trên 18 tuổi', 18, 100, 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id_danhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id_danhmuc`, `tendanhmuc`) VALUES
(1, 'Bảo hiểm người'),
(2, 'Bảo hiểm tài sản');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hopdong`
--

CREATE TABLE `hopdong` (
  `id_hopdong` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_baohiem` int(11) NOT NULL,
  `ten_baohiem` varchar(100) DEFAULT NULL,
  `soluong` int(11) NOT NULL,
  `ten_khachhang` varchar(50) NOT NULL,
  `gioitinh` enum('Nam','Nữ') NOT NULL,
  `ngaysinh` date NOT NULL,
  `tuoi` tinyint(4) GENERATED ALWAYS AS (timestampdiff(YEAR,`ngaysinh`,curdate())) VIRTUAL,
  `nghenghiep` varchar(50) DEFAULT NULL,
  `diachi` text NOT NULL,
  `ngayky_hopdong` timestamp NOT NULL DEFAULT current_timestamp(),
  `thoihan_baohiem` int(11) DEFAULT NULL,
  `handongtien` date NOT NULL,
  `trangthai` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bẫy `hopdong`
--
DELIMITER $$
CREATE TRIGGER `trg_calculate_handongtien` BEFORE INSERT ON `hopdong` FOR EACH ROW BEGIN
    DECLARE v_id_danhmuc INT;
    DECLARE v_handongtien DATE;
    
    -- Lấy giá trị id_danhmuc từ bảng chinhsach dựa trên id_baohiem
    SELECT id_danhmuc INTO v_id_danhmuc FROM chinhsach WHERE id_baohiem = NEW.id_baohiem;
    
    -- Tính toán giá trị handongtien dựa trên id_danhmuc
    IF v_id_danhmuc = 1 THEN
        SET v_handongtien = DATE_ADD(NEW.ngayky_hopdong, INTERVAL 1 YEAR);
    ELSEIF v_id_danhmuc = 2 THEN
        SET v_handongtien = DATE_ADD(NEW.ngayky_hopdong, INTERVAL 6 MONTH);
    END IF;
    
    -- Gán giá trị tính toán cho cột handongtien
    SET NEW.handongtien = v_handongtien;
END
$$
DELIMITER ;

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tuvan`
--

CREATE TABLE `tuvan` (
  `id` int(11) NOT NULL,
  `ten` varchar(40) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `comment` longtext NOT NULL,
  `time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `ten_user` varchar(50) NOT NULL,
  `email` varchar(64) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `gioitinh` enum('Nam','Nữ') NOT NULL,
  `ngaysinh` date NOT NULL,
  `tuoi` int(4) GENERATED ALWAYS AS (timestampdiff(YEAR,`ngaysinh`,curdate())) VIRTUAL,
  `nghenghiep` text NOT NULL,
  `dienthoai` varchar(10) NOT NULL,
  `dia_chi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `ten_user`, `email`, `matkhau`, `gioitinh`, `ngaysinh`, `nghenghiep`, `dienthoai`, `dia_chi`) VALUES
(7, 'Thanh Lăng', 'thanhlang@gmail.com', '010622', 'Nam', '2000-12-21', 'Sinh viên', '0706830531', 'An Giang'),
(10, 'Nguyễn Thị Bảo Trân', 'tran1511@gmail.com', '151101', 'Nữ', '2008-11-15', 'Sinh viên', '0942401812', 'Dĩ An'),
(11, 'Hồ Thanh Nhật', 'htn@gmail.com', '091203', 'Nam', '2003-12-09', 'Sinh viên', '0706830555', 'An Giang');

--
-- Bẫy `user`
--
DELIMITER $$
CREATE TRIGGER `trg_before_insert_user` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
      IF ( NEW.ngaysinh >= CURDATE()) THEN
          SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Bạn không thể có ngày sinh mà ngày đó lại trước ngày hôm nay ;)))';
      END IF;
  END
$$
DELIMITER ;

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
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `chinhsach`
--
ALTER TABLE `chinhsach`
  ADD PRIMARY KEY (`id_baohiem`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Chỉ mục cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`id_hopdong`);

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
-- Chỉ mục cho bảng `tuvan`
--
ALTER TABLE `tuvan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `xacnhan_thanhtoan`
--
ALTER TABLE `xacnhan_thanhtoan`
  ADD PRIMARY KEY (`id_thanhtoan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chinhsach`
--
ALTER TABLE `chinhsach`
  MODIFY `id_baohiem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `hopdong`
--
ALTER TABLE `hopdong`
  MODIFY `id_hopdong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT cho bảng `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT cho bảng `tb_cart_detail`
--
ALTER TABLE `tb_cart_detail`
  MODIFY `id_cart_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT cho bảng `tuvan`
--
ALTER TABLE `tuvan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `xacnhan_thanhtoan`
--
ALTER TABLE `xacnhan_thanhtoan`
  MODIFY `id_thanhtoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
