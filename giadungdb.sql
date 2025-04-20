-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 20, 2025 lúc 03:20 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `giadungdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('an@gmail.com|127.0.0.1', 'i:1;', 1744536211),
('an@gmail.com|127.0.0.1:timer', 'i:1744536211;', 1744536211),
('anna@gmail.com|127.0.0.1', 'i:2;', 1744126963),
('anna@gmail.com|127.0.0.1:timer', 'i:1744126963;', 1744126963),
('t|127.0.0.1', 'i:1;', 1742993376),
('t|127.0.0.1:timer', 'i:1742993376;', 1742993376);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Bếp', 'bep', '1741861041.jpg', NULL, '2025-03-13 10:17:21', '2025-04-11 08:04:14'),
(2, 'Điện gia dụng', 'dien-gia-dung', '1742741616.jpg', NULL, '2025-03-23 14:53:38', '2025-03-23 14:53:38'),
(3, 'Khac', 'khac', '1742903011.jpg', NULL, '2025-03-23 14:54:25', '2025-03-25 11:43:32'),
(4, 'Xay ép', 'xay-ep', '1744359697.jpg', NULL, '2025-04-11 08:21:37', '2025-04-11 08:21:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Dang Nguyen An Thuan', 'anthuan12t4@gmail.com', '0987654321', 'Cần giúp lỗi cửa hàng', '2025-04-01 20:00:51', '2025-04-01 20:00:51'),
(2, 'Dang Nguyen An An', 'anna@gmail.com', '0987664322', 'Cửa hàng oke', '2025-04-01 20:08:38', '2025-04-01 20:08:38'),
(3, 'Dang Nguyen An Thuannz', 'anthuan12t4@gmail.com', '0987654333', 'ok oke', '2025-04-01 20:11:48', '2025-04-01 20:11:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contents`
--

INSERT INTO `contents` (`id`, `title`, `alias`, `introtext`, `fulltext`, `image`, `created_at`, `updated_at`, `status`) VALUES
(2, 'Máy giặt Aqua báo lỗi EA - Nguyên nhân và cách khắc phục nhanh', 'may-giat-aqua-bao-loi-ea-nguyen-nhan-va-cach-khac-phuc-nhanh', 'Đột ngột máy giặt Aqua báo lỗi EA đã khiến không ít người dùng cảm thấy lo lắng vì không biết phải xử lý như thế nào. Vậy nên trong bài viết sau, Siêu Thị Điện Máy - Nội Thất Chợ Lớn sẽ giúp bạn hiểu rõ hơn về các nguyên nhân gây ra lỗi này. Đồng thời một số cách khắc phục lỗi EA hiệu quả cũng được nêu rõ trong bài viết, cùng tìm hiểu chi tiết nhé!', '<h2>1. M&aacute;y giặt Aqua b&aacute;o lỗi EA cho biết điều g&igrave;?</h2>\r\n\r\n<p>M&aacute;y giặt Aqua b&aacute;o lỗi EA c&oacute; nghĩa l&agrave; cảm biến mực nước đang gặp vấn đề. Khi cảm biến n&agrave;y bị lỗi, m&aacute;y giặt kh&ocirc;ng thể nhận biết được mực nước trong lồng giặt đang ở mức n&agrave;o. Ch&iacute;nh v&igrave; thế, bạn sẽ thấy m&atilde; lỗi EA hiện tr&ecirc;n m&agrave;n h&igrave;nh v&agrave; m&aacute;y giặt cũng ngừng hoạt động.</p>\r\n\r\n<p>Th&ocirc;ng thường m&atilde; lỗi EA sẽ xuất hiện ở giai đoạn mới khởi động m&aacute;y giặt hoặc bắt đầu chọn chương tr&igrave;nh giặt, đ&oacute; cũng l&agrave; l&uacute;c cấp nước v&agrave;o m&aacute;y. Nếu lỗi n&agrave;y kh&ocirc;ng được khắc phục kịp thời th&igrave; b&ecirc;n cạnh việc m&aacute;y ngừng hoạt động th&igrave; t&igrave;nh trạng nước tr&agrave;n ra ngo&agrave;i cũng c&oacute; thể xảy ra, g&acirc;y ảnh hưởng đến hệ thống điện v&agrave; những bộ phận kh&aacute;c.</p>\r\n\r\n<p><em><img alt=\"Mã lỗi EA trên màn hình máy giặt Aqua\" src=\"https://cdn11.dienmaycholon.vn/filewebdmclnew/public/userupload/files/Knms/may-giat/ma-loi-ea-tren-may-giat-aqua.jpg\" /></em></p>\r\n\r\n<p><em>M&aacute;y giặt Aqua hiện m&atilde; lỗi EA tr&ecirc;n m&agrave;n hinh</em></p>\r\n\r\n<p><strong>Xem th&ecirc;m:&nbsp;</strong>Bảng m&atilde; lỗi m&aacute;y giặt Aqua n&ecirc;n nắm r&otilde; khi sử dụng</p>\r\n\r\n<h2>2. Nguy&ecirc;n nh&acirc;n khiến m&aacute;y giặt Aqua b&aacute;o lỗi EA</h2>\r\n\r\n<h3>2.1. Phao cảm biến mực nước m&aacute;y giặt bị hỏng</h3>\r\n\r\n<p>Như đ&atilde; đề cập, khi phao cảm biến mực nước bị hỏng, m&aacute;y giặt kh&ocirc;ng thể đo được lượng nước đ&atilde; cấp v&agrave;o m&aacute;y. V&igrave; thế l&uacute;c n&agrave;y m&atilde; lỗi EA sẽ hiện l&ecirc;n để bạn sớm nhận biết v&agrave; khắc phục. Phao cảm biến bị lỗi c&oacute; thể do b&aacute;m nhiều cặn bẩn hoặc đơn giản l&agrave; do qu&aacute; tr&igrave;nh sử dụng đ&atilde; qu&aacute; l&acirc;u.</p>\r\n\r\n<p><em><img alt=\"Phao cảm biến mực nước máy giặt bị hỏng\" src=\"https://cdn11.dienmaycholon.vn/filewebdmclnew/public/userupload/files/Knms/may-giat/phao-cam-bien-muc-nuoc-bi-loi.jpg\" /></em></p>\r\n\r\n<p><em>Phao cảm biến mực nước b&ecirc;n trong m&aacute;y giặt Aqua bị hỏng</em></p>\r\n\r\n<h3>2.2. D&acirc;y dẫn nối giữa cảm biến mức nước tới mạch điều khiển bị hỏng</h3>\r\n\r\n<p>D&acirc;y dẫn nối giữa cảm biến mực nước tới mạch điều khiển bị hỏng cũng l&agrave; nguy&ecirc;n nh&acirc;n phổ biến khiến m&aacute;y giặt Aqua b&aacute;o lỗi EA. Khi đoạn d&acirc;y dẫn n&agrave;y bị đứt, hở th&igrave; t&iacute;n hiệu kh&ocirc;ng được truyền tới mạch điều khiển trung t&acirc;m. Do đ&oacute; m&aacute;y giặt cũng kh&ocirc;ng thể nhận biết lượng nước đ&atilde; được cấp v&agrave;o đ&atilde; đủ hay chưa n&ecirc;n b&aacute;o lỗi EA.</p>\r\n\r\n<h3>2.3. Bo mạch điều khiển m&aacute;y giặt Aqua bị lỗi</h3>\r\n\r\n<p>Bo mạch điều khiển được xem l&agrave; &ldquo;cơ quan đầu n&atilde;o&rdquo; của m&aacute;y giặt. Do đ&oacute; khi bo mạch gặp vấn đề cũng c&oacute; thể dẫn đến lỗi EA m&aacute;y giặt Aqua.</p>\r\n\r\n<h2>3. C&aacute;ch khắc phục lỗi EA m&aacute;y giặt Aqua</h2>\r\n\r\n<p>C&oacute; thể thấy, lỗi EA m&aacute;y giặt Aqua sẽ li&ecirc;n quan đến nhiều bộ phận phức tạp b&ecirc;n trong. Vậy n&ecirc;n tốt nhất khi xuất hiện m&atilde; lỗi n&agrave;y, bạn n&ecirc;n li&ecirc;n hệ ngay với trung t&acirc;m bảo h&agrave;nh của h&atilde;ng để được hỗ trợ nhanh ch&oacute;ng.&nbsp;</p>\r\n\r\n<p>Khi đ&oacute; kỹ thuật vi&ecirc;n của h&atilde;ng sẽ đến gi&uacute;p bạn kiểm tra v&agrave; khắc phục lỗi EA đ&uacute;ng c&aacute;ch. Nếu phao cảm biến bị hỏng, họ sẽ gi&uacute;p bạn sửa chữa hoặc thay mới (nếu cần). Trong trường hợp d&acirc;y dẫn bị đứt/ hở, kỹ thuật vi&ecirc;n sẽ gi&uacute;p bạn nối lại hoặc thay thế bằng đoạn d&acirc;y dẫn mới. Đối với bo mạch bị lỗi th&igrave; họ phải th&aacute;o ra v&agrave; mang đi sửa.</p>\r\n\r\n<p><em>Kỹ thuật vi&ecirc;n hỗ trợ sửa chữa, khắc phục lỗi EA tr&ecirc;n m&aacute;y giặt Aqua</em></p>\r\n\r\n<p><strong>Xem th&ecirc;m:&nbsp;</strong>Nguy&ecirc;n nh&acirc;n g&acirc;y ra lỗi FA m&aacute;y giặt Aqua v&agrave; c&aacute;ch khắc phục hiệu quả</p>\r\n\r\n<p>Đối với lỗi n&agrave;y, bạn kh&ocirc;ng n&ecirc;n tự &yacute; th&aacute;o m&aacute;y ra để khắc phục, bởi khi đ&oacute; vấn đề c&oacute; thể trở n&ecirc;n nghi&ecirc;m trọng hơn. Đồng thời bạn cũng c&oacute; thể bị h&atilde;ng từ chối quyền lợi bảo h&agrave;nh. Tất nhi&ecirc;n l&uacute;c n&agrave;y bạn phải bỏ ra khoản chi ph&iacute; cao hơn để sửa chữa m&aacute;y giặt.</p>\r\n\r\n<p>Như vậy b&agrave;i viết đ&atilde; gi&uacute;p bạn hiểu hơn về t&igrave;nh trạng m&aacute;y giặt Aqua b&aacute;o lỗi EA. Hy vọng qua b&agrave;i viết n&agrave;y bạn c&oacute; thể b&igrave;nh tĩnh, xử l&yacute; đ&uacute;ng c&aacute;ch nếu như m&atilde; lỗi EA xuất hiện trong qu&aacute; tr&igrave;nh sử dụng.</p>\r\n\r\n<h4>Chọn mua m&aacute;y giặt Aqua ch&iacute;nh h&atilde;ng, gi&aacute; tốt ngay tại Si&ecirc;u Thị Điện M&aacute;y - Nội Thất Chợ Lớn</h4>', '1743457002.jpg', '2025-04-01 03:49:08', '2025-04-11 22:05:28', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` enum('fixed','percent') NOT NULL,
  `value` decimal(12,2) NOT NULL,
  `cart_value` decimal(12,2) NOT NULL,
  `expiry_date` date NOT NULL DEFAULT cast(current_timestamp() as date),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `cart_value`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 'GIAMGIA10', 'fixed', 100000.00, 0.00, '2026-10-10', '2025-03-30 07:38:10', '2025-03-30 07:38:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Quận huyện';

--
-- Đang đổ dữ liệu cho bảng `districts`
--

INSERT INTO `districts` (`id`, `province_id`, `name`) VALUES
(1, 1, 'Quận Ba Đình'),
(2, 1, 'Quận Hoàn Kiếm'),
(3, 1, 'Quận Tây Hồ'),
(4, 1, 'Quận Long Biên'),
(5, 1, 'Quận Cầu Giấy'),
(6, 1, 'Quận Đống Đa'),
(7, 1, 'Quận Hai Bà Trưng'),
(8, 1, 'Quận Hoàng Mai'),
(9, 1, 'Quận Thanh Xuân'),
(10, 1, 'Huyện Sóc Sơn'),
(11, 1, 'Huyện Đông Anh'),
(12, 1, 'Huyện Gia Lâm'),
(13, 1, 'Quận Nam Từ Liêm'),
(14, 1, 'Huyện Thanh Trì'),
(15, 1, 'Quận Bắc Từ Liêm'),
(16, 1, 'Huyện Mê Linh'),
(17, 1, 'Quận Hà Đông'),
(18, 1, 'Thị xã Sơn Tây'),
(19, 1, 'Huyện Ba Vì'),
(20, 1, 'Huyện Phúc Thọ'),
(21, 1, 'Huyện Đan Phượng'),
(22, 1, 'Huyện Hoài Đức'),
(23, 1, 'Huyện Quốc Oai'),
(24, 1, 'Huyện Thạch Thất'),
(25, 1, 'Huyện Chương Mỹ'),
(26, 1, 'Huyện Thanh Oai'),
(27, 1, 'Huyện Thường Tín'),
(28, 1, 'Huyện Phú Xuyên'),
(29, 1, 'Huyện Ứng Hòa'),
(30, 1, 'Huyện Mỹ Đức'),
(31, 2, 'Thành phố Hà Giang'),
(32, 2, 'Huyện Đồng Văn'),
(33, 2, 'Huyện Mèo Vạc'),
(34, 2, 'Huyện Yên Minh'),
(35, 2, 'Huyện Quản Bạ'),
(36, 2, 'Huyện Vị Xuyên'),
(37, 2, 'Huyện Bắc Mê'),
(38, 2, 'Huyện Hoàng Su Phì'),
(39, 2, 'Huyện Xín Mần'),
(40, 2, 'Huyện Bắc Quang'),
(41, 2, 'Huyện Quang Bình'),
(42, 3, 'Thành phố Cao Bằng'),
(43, 3, 'Huyện Bảo Lâm'),
(44, 3, 'Huyện Bảo Lạc'),
(45, 3, 'Huyện Hà Quảng'),
(46, 3, 'Huyện Trùng Khánh'),
(47, 3, 'Huyện Hạ Lang'),
(48, 3, 'Huyện Quảng Hòa'),
(49, 3, 'Huyện Hoà An'),
(50, 3, 'Huyện Nguyên Bình'),
(51, 3, 'Huyện Thạch An'),
(52, 4, 'Thành Phố Bắc Kạn'),
(53, 4, 'Huyện Pác Nặm'),
(54, 4, 'Huyện Ba Bể'),
(55, 4, 'Huyện Ngân Sơn'),
(56, 4, 'Huyện Bạch Thông'),
(57, 4, 'Huyện Chợ Đồn'),
(58, 4, 'Huyện Chợ Mới'),
(59, 4, 'Huyện Na Rì'),
(60, 5, 'Thành phố Tuyên Quang'),
(61, 5, 'Huyện Lâm Bình'),
(62, 5, 'Huyện Na Hang'),
(63, 5, 'Huyện Chiêm Hóa'),
(64, 5, 'Huyện Hàm Yên'),
(65, 5, 'Huyện Yên Sơn'),
(66, 5, 'Huyện Sơn Dương'),
(67, 6, 'Thành phố Lào Cai'),
(68, 6, 'Huyện Bát Xát'),
(69, 6, 'Huyện Mường Khương'),
(70, 6, 'Huyện Si Ma Cai'),
(71, 6, 'Huyện Bắc Hà'),
(72, 6, 'Huyện Bảo Thắng'),
(73, 6, 'Huyện Bảo Yên'),
(74, 6, 'Thị xã Sa Pa'),
(75, 6, 'Huyện Văn Bàn'),
(76, 7, 'Thành phố Điện Biên Phủ'),
(77, 7, 'Thị Xã Mường Lay'),
(78, 7, 'Huyện Mường Nhé'),
(79, 7, 'Huyện Mường Chà'),
(80, 7, 'Huyện Tủa Chùa'),
(81, 7, 'Huyện Tuần Giáo'),
(82, 7, 'Huyện Điện Biên'),
(83, 7, 'Huyện Điện Biên Đông'),
(84, 7, 'Huyện Mường Ảng'),
(85, 7, 'Huyện Nậm Pồ'),
(86, 8, 'Thành phố Lai Châu'),
(87, 8, 'Huyện Tam Đường'),
(88, 8, 'Huyện Mường Tè'),
(89, 8, 'Huyện Sìn Hồ'),
(90, 8, 'Huyện Phong Thổ'),
(91, 8, 'Huyện Than Uyên'),
(92, 8, 'Huyện Tân Uyên'),
(93, 8, 'Huyện Nậm Nhùn'),
(94, 9, 'Thành phố Sơn La'),
(95, 9, 'Huyện Quỳnh Nhai'),
(96, 9, 'Huyện Thuận Châu'),
(97, 9, 'Huyện Mường La'),
(98, 9, 'Huyện Bắc Yên'),
(99, 9, 'Huyện Phù Yên'),
(100, 9, 'Huyện Mộc Châu'),
(101, 9, 'Huyện Yên Châu'),
(102, 9, 'Huyện Mai Sơn'),
(103, 9, 'Huyện Sông Mã'),
(104, 9, 'Huyện Sốp Cộp'),
(105, 9, 'Huyện Vân Hồ'),
(106, 10, 'Thành phố Yên Bái'),
(107, 10, 'Thị xã Nghĩa Lộ'),
(108, 10, 'Huyện Lục Yên'),
(109, 10, 'Huyện Văn Yên'),
(110, 10, 'Huyện Mù Căng Chải'),
(111, 10, 'Huyện Trấn Yên'),
(112, 10, 'Huyện Trạm Tấu'),
(113, 10, 'Huyện Văn Chấn'),
(114, 10, 'Huyện Yên Bình'),
(115, 11, 'Thành phố Hòa Bình'),
(116, 11, 'Huyện Đà Bắc'),
(117, 11, 'Huyện Lương Sơn'),
(118, 11, 'Huyện Kim Bôi'),
(119, 11, 'Huyện Cao Phong'),
(120, 11, 'Huyện Tân Lạc'),
(121, 11, 'Huyện Mai Châu'),
(122, 11, 'Huyện Lạc Sơn'),
(123, 11, 'Huyện Yên Thủy'),
(124, 11, 'Huyện Lạc Thủy'),
(125, 12, 'Thành phố Thái Nguyên'),
(126, 12, 'Thành phố Sông Công'),
(127, 12, 'Huyện Định Hóa'),
(128, 12, 'Huyện Phú Lương'),
(129, 12, 'Huyện Đồng Hỷ'),
(130, 12, 'Huyện Võ Nhai'),
(131, 12, 'Huyện Đại Từ'),
(132, 12, 'Thị xã Phổ Yên'),
(133, 12, 'Huyện Phú Bình'),
(134, 13, 'Thành phố Lạng Sơn'),
(135, 13, 'Huyện Tràng Định'),
(136, 13, 'Huyện Bình Gia'),
(137, 13, 'Huyện Văn Lãng'),
(138, 13, 'Huyện Cao Lộc'),
(139, 13, 'Huyện Văn Quan'),
(140, 13, 'Huyện Bắc Sơn'),
(141, 13, 'Huyện Hữu Lũng'),
(142, 13, 'Huyện Chi Lăng'),
(143, 13, 'Huyện Lộc Bình'),
(144, 13, 'Huyện Đình Lập'),
(145, 14, 'Thành phố Hạ Long'),
(146, 14, 'Thành phố Móng Cái'),
(147, 14, 'Thành phố Cẩm Phả'),
(148, 14, 'Thành phố Uông Bí'),
(149, 14, 'Huyện Bình Liêu'),
(150, 14, 'Huyện Tiên Yên'),
(151, 14, 'Huyện Đầm Hà'),
(152, 14, 'Huyện Hải Hà'),
(153, 14, 'Huyện Ba Chẽ'),
(154, 14, 'Huyện Vân Đồn'),
(155, 14, 'Thị xã Đông Triều'),
(156, 14, 'Thị xã Quảng Yên'),
(157, 14, 'Huyện Cô Tô'),
(158, 15, 'Thành phố Bắc Giang'),
(159, 15, 'Huyện Yên Thế'),
(160, 15, 'Huyện Tân Yên'),
(161, 15, 'Huyện Lạng Giang'),
(162, 15, 'Huyện Lục Nam'),
(163, 15, 'Huyện Lục Ngạn'),
(164, 15, 'Huyện Sơn Động'),
(165, 15, 'Huyện Yên Dũng'),
(166, 15, 'Huyện Việt Yên'),
(167, 15, 'Huyện Hiệp Hòa'),
(168, 16, 'Thành phố Việt Trì'),
(169, 16, 'Thị xã Phú Thọ'),
(170, 16, 'Huyện Đoan Hùng'),
(171, 16, 'Huyện Hạ Hoà'),
(172, 16, 'Huyện Thanh Ba'),
(173, 16, 'Huyện Phù Ninh'),
(174, 16, 'Huyện Yên Lập'),
(175, 16, 'Huyện Cẩm Khê'),
(176, 16, 'Huyện Tam Nông'),
(177, 16, 'Huyện Lâm Thao'),
(178, 16, 'Huyện Thanh Sơn'),
(179, 16, 'Huyện Thanh Thuỷ'),
(180, 16, 'Huyện Tân Sơn'),
(181, 17, 'Thành phố Vĩnh Yên'),
(182, 17, 'Thành phố Phúc Yên'),
(183, 17, 'Huyện Lập Thạch'),
(184, 17, 'Huyện Tam Dương'),
(185, 17, 'Huyện Tam Đảo'),
(186, 17, 'Huyện Bình Xuyên'),
(187, 17, 'Huyện Yên Lạc'),
(188, 17, 'Huyện Vĩnh Tường'),
(189, 17, 'Huyện Sông Lô'),
(190, 18, 'Thành phố Bắc Ninh'),
(191, 18, 'Huyện Yên Phong'),
(192, 18, 'Huyện Quế Võ'),
(193, 18, 'Huyện Tiên Du'),
(194, 18, 'Thành phố Từ Sơn'),
(195, 18, 'Huyện Thuận Thành'),
(196, 18, 'Huyện Gia Bình'),
(197, 18, 'Huyện Lương Tài'),
(198, 19, 'Thành phố Hải Dương'),
(199, 19, 'Thành phố Chí Linh'),
(200, 19, 'Huyện Nam Sách'),
(201, 19, 'Thị xã Kinh Môn'),
(202, 19, 'Huyện Kim Thành'),
(203, 19, 'Huyện Thanh Hà'),
(204, 19, 'Huyện Cẩm Giàng'),
(205, 19, 'Huyện Bình Giang'),
(206, 19, 'Huyện Gia Lộc'),
(207, 19, 'Huyện Tứ Kỳ'),
(208, 19, 'Huyện Ninh Giang'),
(209, 19, 'Huyện Thanh Miện'),
(210, 20, 'Quận Hồng Bàng'),
(211, 20, 'Quận Ngô Quyền'),
(212, 20, 'Quận Lê Chân'),
(213, 20, 'Quận Hải An'),
(214, 20, 'Quận Kiến An'),
(215, 20, 'Quận Đồ Sơn'),
(216, 20, 'Quận Dương Kinh'),
(217, 20, 'Huyện Thuỷ Nguyên'),
(218, 20, 'Huyện An Dương'),
(219, 20, 'Huyện An Lão'),
(220, 20, 'Huyện Kiến Thuỵ'),
(221, 20, 'Huyện Tiên Lãng'),
(222, 20, 'Huyện Vĩnh Bảo'),
(223, 20, 'Huyện Cát Hải'),
(224, 20, 'Huyện Bạch Long Vĩ'),
(225, 21, 'Thành phố Hưng Yên'),
(226, 21, 'Huyện Văn Lâm'),
(227, 21, 'Huyện Văn Giang'),
(228, 21, 'Huyện Yên Mỹ'),
(229, 21, 'Thị xã Mỹ Hào'),
(230, 21, 'Huyện Ân Thi'),
(231, 21, 'Huyện Khoái Châu'),
(232, 21, 'Huyện Kim Động'),
(233, 21, 'Huyện Tiên Lữ'),
(234, 21, 'Huyện Phù Cừ'),
(235, 22, 'Thành phố Thái Bình'),
(236, 22, 'Huyện Quỳnh Phụ'),
(237, 22, 'Huyện Hưng Hà'),
(238, 22, 'Huyện Đông Hưng'),
(239, 22, 'Huyện Thái Thụy'),
(240, 22, 'Huyện Tiền Hải'),
(241, 22, 'Huyện Kiến Xương'),
(242, 22, 'Huyện Vũ Thư'),
(243, 23, 'Thành phố Phủ Lý'),
(244, 23, 'Thị xã Duy Tiên'),
(245, 23, 'Huyện Kim Bảng'),
(246, 23, 'Huyện Thanh Liêm'),
(247, 23, 'Huyện Bình Lục'),
(248, 23, 'Huyện Lý Nhân'),
(249, 24, 'Thành phố Nam Định'),
(250, 24, 'Huyện Vụ Bản'),
(251, 24, 'Huyện Ý Yên'),
(252, 24, 'Huyện Nghĩa Hưng'),
(253, 24, 'Huyện Nam Trực'),
(254, 24, 'Huyện Trực Ninh'),
(255, 24, 'Huyện Xuân Trường'),
(256, 24, 'Huyện Giao Thủy'),
(257, 24, 'Huyện Hải Hậu'),
(258, 25, 'Thành phố Tam Điệp'),
(259, 25, 'Huyện Nho Quan'),
(260, 25, 'Huyện Gia Viễn'),
(261, 25, 'Huyện Hoa Lư'),
(262, 25, 'Huyện Yên Khánh'),
(263, 25, 'Huyện Kim Sơn'),
(264, 25, 'Huyện Yên Mô'),
(265, 26, 'Thành phố Thanh Hóa'),
(266, 26, 'Thị xã Bỉm Sơn'),
(267, 26, 'Thành phố Sầm Sơn'),
(268, 26, 'Huyện Mường Lát'),
(269, 26, 'Huyện Quan Hóa'),
(270, 26, 'Huyện Bá Thước'),
(271, 26, 'Huyện Quan Sơn'),
(272, 26, 'Huyện Lang Chánh'),
(273, 26, 'Huyện Ngọc Lặc'),
(274, 26, 'Huyện Cẩm Thủy'),
(275, 26, 'Huyện Thạch Thành'),
(276, 26, 'Huyện Hà Trung'),
(277, 26, 'Huyện Vĩnh Lộc'),
(278, 26, 'Huyện Yên Định'),
(279, 26, 'Huyện Thọ Xuân'),
(280, 26, 'Huyện Thường Xuân'),
(281, 26, 'Huyện Triệu Sơn'),
(282, 26, 'Huyện Thiệu Hóa'),
(283, 26, 'Huyện Hoằng Hóa'),
(284, 26, 'Huyện Hậu Lộc'),
(285, 26, 'Huyện Nga Sơn'),
(286, 26, 'Huyện Như Xuân'),
(287, 26, 'Huyện Như Thanh'),
(288, 26, 'Huyện Nông Cống'),
(289, 26, 'Huyện Quảng Xương'),
(290, 26, 'Thị xã Nghi Sơn'),
(291, 27, 'Thành phố Vinh'),
(292, 27, 'Thị xã Cửa Lò'),
(293, 27, 'Thị xã Thái Hoà'),
(294, 27, 'Huyện Quế Phong'),
(295, 27, 'Huyện Quỳ Châu'),
(296, 27, 'Huyện Kỳ Sơn'),
(297, 27, 'Huyện Tương Dương'),
(298, 27, 'Huyện Nghĩa Đàn'),
(299, 27, 'Huyện Quỳ Hợp'),
(300, 27, 'Huyện Quỳnh Lưu'),
(301, 27, 'Huyện Con Cuông'),
(302, 27, 'Huyện Tân Kỳ'),
(303, 27, 'Huyện Anh Sơn'),
(304, 27, 'Huyện Diễn Châu'),
(305, 27, 'Huyện Yên Thành'),
(306, 27, 'Huyện Đô Lương'),
(307, 27, 'Huyện Thanh Chương'),
(308, 27, 'Huyện Nghi Lộc'),
(309, 27, 'Huyện Nam Đàn'),
(310, 27, 'Huyện Hưng Nguyên'),
(311, 27, 'Thị xã Hoàng Mai'),
(312, 28, 'Thành phố Hà Tĩnh'),
(313, 28, 'Thị xã Hồng Lĩnh'),
(314, 28, 'Huyện Hương Sơn'),
(315, 28, 'Huyện Đức Thọ'),
(316, 28, 'Huyện Vũ Quang'),
(317, 28, 'Huyện Nghi Xuân'),
(318, 28, 'Huyện Can Lộc'),
(319, 28, 'Huyện Hương Khê'),
(320, 28, 'Huyện Thạch Hà'),
(321, 28, 'Huyện Cẩm Xuyên'),
(322, 28, 'Huyện Kỳ Anh'),
(323, 28, 'Huyện Lộc Hà'),
(324, 28, 'Thị xã Kỳ Anh'),
(325, 29, 'Thành Phố Đồng Hới'),
(326, 29, 'Huyện Minh Hóa'),
(327, 29, 'Huyện Tuyên Hóa'),
(328, 29, 'Huyện Quảng Trạch'),
(329, 29, 'Huyện Bố Trạch'),
(330, 29, 'Huyện Quảng Ninh'),
(331, 29, 'Huyện Lệ Thủy'),
(332, 29, 'Thị xã Ba Đồn'),
(333, 30, 'Thành phố Đông Hà'),
(334, 30, 'Thị xã Quảng Trị'),
(335, 30, 'Huyện Vĩnh Linh'),
(336, 30, 'Huyện Hướng Hóa'),
(337, 30, 'Huyện Gio Linh'),
(338, 30, 'Huyện Đa Krông'),
(339, 30, 'Huyện Cam Lộ'),
(340, 30, 'Huyện Triệu Phong'),
(341, 30, 'Huyện Hải Lăng'),
(342, 30, 'Huyện Cồn Cỏ'),
(343, 31, 'Thành phố Huế'),
(344, 31, 'Huyện Phong Điền'),
(345, 31, 'Huyện Quảng Điền'),
(346, 31, 'Huyện Phú Vang'),
(347, 31, 'Thị xã Hương Thủy'),
(348, 31, 'Thị xã Hương Trà'),
(349, 31, 'Huyện A Lưới'),
(350, 31, 'Huyện Phú Lộc'),
(351, 31, 'Huyện Nam Đông'),
(352, 32, 'Quận Liên Chiểu'),
(353, 32, 'Quận Thanh Khê'),
(354, 32, 'Quận Hải Châu'),
(355, 32, 'Quận Sơn Trà'),
(356, 32, 'Quận Ngũ Hành Sơn'),
(357, 32, 'Quận Cẩm Lệ'),
(358, 32, 'Huyện Hòa Vang'),
(359, 32, 'Huyện Hoàng Sa'),
(360, 33, 'Thành phố Tam Kỳ'),
(361, 33, 'Thành phố Hội An'),
(362, 33, 'Huyện Tây Giang'),
(363, 33, 'Huyện Đông Giang'),
(364, 33, 'Huyện Đại Lộc'),
(365, 33, 'Thị xã Điện Bàn'),
(366, 33, 'Huyện Duy Xuyên'),
(367, 33, 'Huyện Quế Sơn'),
(368, 33, 'Huyện Nam Giang'),
(369, 33, 'Huyện Phước Sơn'),
(370, 33, 'Huyện Hiệp Đức'),
(371, 33, 'Huyện Thăng Bình'),
(372, 33, 'Huyện Tiên Phước'),
(373, 33, 'Huyện Bắc Trà My'),
(374, 33, 'Huyện Nam Trà My'),
(375, 33, 'Huyện Núi Thành'),
(376, 33, 'Huyện Phú Ninh'),
(377, 33, 'Huyện Nông Sơn'),
(378, 34, 'Thành phố Quảng Ngãi'),
(379, 34, 'Huyện Bình Sơn'),
(380, 34, 'Huyện Trà Bồng'),
(381, 34, 'Huyện Sơn Tịnh'),
(382, 34, 'Huyện Tư Nghĩa'),
(383, 34, 'Huyện Sơn Hà'),
(384, 34, 'Huyện Sơn Tây'),
(385, 34, 'Huyện Minh Long'),
(386, 34, 'Huyện Nghĩa Hành'),
(387, 34, 'Huyện Mộ Đức'),
(388, 34, 'Thị xã Đức Phổ'),
(389, 34, 'Huyện Ba Tơ'),
(390, 34, 'Huyện Lý Sơn'),
(391, 35, 'Thành phố Quy Nhơn'),
(392, 35, 'Huyện An Lão'),
(393, 35, 'Thị xã Hoài Nhơn'),
(394, 35, 'Huyện Hoài Ân'),
(395, 35, 'Huyện Phù Mỹ'),
(396, 35, 'Huyện Vĩnh Thạnh'),
(397, 35, 'Huyện Tây Sơn'),
(398, 35, 'Huyện Phù Cát'),
(399, 35, 'Thị xã An Nhơn'),
(400, 35, 'Huyện Tuy Phước'),
(401, 35, 'Huyện Vân Canh'),
(402, 36, 'Thành phố Tuy Hoà'),
(403, 36, 'Thị xã Sông Cầu'),
(404, 36, 'Huyện Đồng Xuân'),
(405, 36, 'Huyện Tuy An'),
(406, 36, 'Huyện Sơn Hòa'),
(407, 36, 'Huyện Sông Hinh'),
(408, 36, 'Huyện Tây Hoà'),
(409, 36, 'Huyện Phú Hoà'),
(410, 36, 'Thị xã Đông Hòa'),
(411, 37, 'Thành phố Nha Trang'),
(412, 37, 'Thành phố Cam Ranh'),
(413, 37, 'Huyện Cam Lâm'),
(414, 37, 'Huyện Vạn Ninh'),
(415, 37, 'Thị xã Ninh Hòa'),
(416, 37, 'Huyện Khánh Vĩnh'),
(417, 37, 'Huyện Diên Khánh'),
(418, 37, 'Huyện Khánh Sơn'),
(419, 37, 'Huyện Trường Sa'),
(420, 38, 'Thành phố Phan Rang-Tháp Chàm'),
(421, 38, 'Huyện Bác Ái'),
(422, 38, 'Huyện Ninh Sơn'),
(423, 38, 'Huyện Ninh Hải'),
(424, 38, 'Huyện Ninh Phước'),
(425, 38, 'Huyện Thuận Bắc'),
(426, 38, 'Huyện Thuận Nam'),
(427, 39, 'Thành phố Phan Thiết'),
(428, 39, 'Thị xã La Gi'),
(429, 39, 'Huyện Tuy Phong'),
(430, 39, 'Huyện Bắc Bình'),
(431, 39, 'Huyện Hàm Thuận Bắc'),
(432, 39, 'Huyện Hàm Thuận Nam'),
(433, 39, 'Huyện Tánh Linh'),
(434, 39, 'Huyện Đức Linh'),
(435, 39, 'Huyện Hàm Tân'),
(436, 39, 'Huyện Phú Quí'),
(437, 40, 'Thành phố Kon Tum'),
(438, 40, 'Huyện Đắk Glei'),
(439, 40, 'Huyện Ngọc Hồi'),
(440, 40, 'Huyện Đắk Tô'),
(441, 40, 'Huyện Kon Plông'),
(442, 40, 'Huyện Kon Rẫy'),
(443, 40, 'Huyện Đắk Hà'),
(444, 40, 'Huyện Sa Thầy'),
(445, 40, 'Huyện Tu Mơ Rông'),
(446, 41, 'Thành phố Pleiku'),
(447, 41, 'Thị xã An Khê'),
(448, 41, 'Thị xã Ayun Pa'),
(449, 41, 'Huyện KBang'),
(450, 41, 'Huyện Đăk Đoa'),
(451, 41, 'Huyện Chư Păh'),
(452, 41, 'Huyện Ia Grai'),
(453, 41, 'Huyện Mang Yang'),
(454, 41, 'Huyện Kông Chro'),
(455, 41, 'Huyện Đức Cơ'),
(456, 41, 'Huyện Chư Prông'),
(457, 41, 'Huyện Chư Sê'),
(458, 41, 'Huyện Đăk Pơ'),
(459, 41, 'Huyện Ia Pa'),
(460, 41, 'Huyện Krông Pa'),
(461, 41, 'Huyện Phú Thiện'),
(462, 41, 'Huyện Chư Pưh'),
(463, 42, 'Thành phố Buôn Ma Thuột'),
(464, 42, 'Thị Xã Buôn Hồ'),
(465, 42, 'Huyện Ea Súp'),
(466, 42, 'Huyện Buôn Đôn'),
(467, 42, 'Huyện Krông Búk'),
(468, 42, 'Huyện Krông Năng'),
(469, 42, 'Huyện Ea Kar'),
(470, 42, 'Huyện Krông Bông'),
(471, 42, 'Huyện Krông Pắc'),
(472, 42, 'Huyện Krông A Na'),
(473, 42, 'Huyện Lắk'),
(474, 42, 'Huyện Cư Kuin'),
(475, 43, 'Thành phố Gia Nghĩa'),
(476, 43, 'Huyện Đăk Glong'),
(477, 43, 'Huyện Cư Jút'),
(478, 43, 'Huyện Đắk Mil'),
(479, 43, 'Huyện Krông Nô'),
(480, 43, 'Huyện Đắk Song'),
(481, 43, 'Huyện Tuy Đức'),
(482, 44, 'Thành phố Đà Lạt'),
(483, 44, 'Thành phố Bảo Lộc'),
(484, 44, 'Huyện Đam Rông'),
(485, 44, 'Huyện Lạc Dương'),
(486, 44, 'Huyện Lâm Hà'),
(487, 44, 'Huyện Đơn Dương'),
(488, 44, 'Huyện Đức Trọng'),
(489, 44, 'Huyện Di Linh'),
(490, 44, 'Huyện Bảo Lâm'),
(491, 44, 'Huyện Đạ Huoai'),
(492, 44, 'Huyện Đạ Tẻh'),
(493, 44, 'Huyện Cát Tiên'),
(494, 45, 'Thị xã Phước Long'),
(495, 45, 'Thành phố Đồng Xoài'),
(496, 45, 'Thị xã Bình Long'),
(497, 45, 'Huyện Bù Gia Mập'),
(498, 45, 'Huyện Lộc Ninh'),
(499, 45, 'Huyện Bù Đốp'),
(500, 45, 'Huyện Hớn Quản'),
(501, 45, 'Huyện Đồng Phú'),
(502, 45, 'Huyện Bù Đăng'),
(503, 45, 'Huyện Chơn Thành'),
(504, 45, 'Huyện Phú Riềng'),
(505, 46, 'Thành phố Tây Ninh'),
(506, 46, 'Huyện Tân Biên'),
(507, 46, 'Huyện Tân Châu'),
(508, 46, 'Huyện Dương Minh Châu'),
(509, 46, 'Huyện Châu Thành'),
(510, 46, 'Thị xã Hòa Thành'),
(511, 46, 'Huyện Gò Dầu'),
(512, 46, 'Huyện Bến Cầu'),
(513, 46, 'Thị xã Trảng Bàng'),
(514, 47, 'Thành phố Thủ Dầu Một'),
(515, 47, 'Huyện Bàu Bàng'),
(516, 47, 'Huyện Dầu Tiếng'),
(517, 47, 'Thị xã Bến Cát'),
(518, 47, 'Huyện Phú Giáo'),
(519, 47, 'Thị xã Tân Uyên'),
(520, 47, 'Thành phố Dĩ An'),
(521, 47, 'Thành phố Thuận An'),
(522, 47, 'Huyện Bắc Tân Uyên'),
(523, 48, 'Thành phố Biên Hòa'),
(524, 48, 'Thành phố Long Khánh'),
(525, 48, 'Huyện Tân Phú'),
(526, 48, 'Huyện Vĩnh Cửu'),
(527, 48, 'Huyện Định Quán'),
(528, 48, 'Huyện Trảng Bom'),
(529, 48, 'Huyện Thống Nhất'),
(530, 48, 'Huyện Cẩm Mỹ'),
(531, 48, 'Huyện Long Thành'),
(532, 48, 'Huyện Xuân Lộc'),
(533, 48, 'Huyện Nhơn Trạch'),
(534, 49, 'Thành phố Vũng Tàu'),
(535, 49, 'Thành phố Bà Rịa'),
(536, 49, 'Huyện Châu Đức'),
(537, 49, 'Huyện Xuyên Mộc'),
(538, 49, 'Huyện Long Điền'),
(539, 49, 'Huyện Đất Đỏ'),
(540, 49, 'Thị xã Phú Mỹ'),
(541, 49, 'Huyện Côn Đảo'),
(542, 50, 'Quận 1'),
(543, 50, 'Quận 12'),
(544, 50, 'Quận Gò Vấp'),
(545, 50, 'Quận Bình Thạnh'),
(546, 50, 'Quận Tân Bình'),
(547, 50, 'Quận Tân Phú'),
(548, 50, 'Quận Phú Nhuận'),
(549, 50, 'Thành phố Thủ Đức'),
(550, 50, 'Quận 3'),
(551, 50, 'Quận 10'),
(552, 50, 'Quận 11'),
(553, 50, 'Quận 4'),
(554, 50, 'Quận 5'),
(555, 50, 'Quận 6'),
(556, 50, 'Quận 8'),
(557, 50, 'Quận Bình Tân'),
(558, 50, 'Quận 7'),
(559, 50, 'Huyện Củ Chi'),
(560, 50, 'Huyện Hóc Môn'),
(561, 50, 'Huyện Bình Chánh'),
(562, 50, 'Huyện Nhà Bè'),
(563, 50, 'Huyện Cần Giờ'),
(564, 51, 'Thành phố Tân An'),
(565, 51, 'Thị xã Kiến Tường'),
(566, 51, 'Huyện Tân Hưng'),
(567, 51, 'Huyện Vĩnh Hưng'),
(568, 51, 'Huyện Mộc Hóa'),
(569, 51, 'Huyện Tân Thạnh'),
(570, 51, 'Huyện Thạnh Hóa'),
(571, 51, 'Huyện Đức Huệ'),
(572, 51, 'Huyện Đức Hòa'),
(573, 51, 'Huyện Bến Lức'),
(574, 51, 'Huyện Thủ Thừa'),
(575, 51, 'Huyện Tân Trụ'),
(576, 51, 'Huyện Cần Đước'),
(577, 51, 'Huyện Cần Giuộc'),
(578, 51, 'Huyện Châu Thành'),
(579, 52, 'Thành phố Mỹ Tho'),
(580, 52, 'Thị xã Gò Công'),
(581, 52, 'Thị xã Cai Lậy'),
(582, 52, 'Huyện Tân Phước'),
(583, 52, 'Huyện Cái Bè'),
(584, 52, 'Huyện Cai Lậy'),
(585, 52, 'Huyện Châu Thành'),
(586, 52, 'Huyện Chợ Gạo'),
(587, 52, 'Huyện Gò Công Tây'),
(588, 52, 'Huyện Gò Công Đông'),
(589, 52, 'Huyện Tân Phú Đông'),
(590, 53, 'Thành phố Bến Tre'),
(591, 53, 'Huyện Châu Thành'),
(592, 53, 'Huyện Chợ Lách'),
(593, 53, 'Huyện Mỏ Cày Nam'),
(594, 53, 'Huyện Giồng Trôm'),
(595, 53, 'Huyện Bình Đại'),
(596, 53, 'Huyện Ba Tri'),
(597, 53, 'Huyện Thạnh Phú'),
(598, 53, 'Huyện Mỏ Cày Bắc'),
(599, 54, 'Thành phố Trà Vinh'),
(600, 54, 'Huyện Càng Long'),
(601, 54, 'Huyện Cầu Kè'),
(602, 54, 'Huyện Tiểu Cần'),
(603, 54, 'Huyện Châu Thành'),
(604, 54, 'Huyện Cầu Ngang'),
(605, 54, 'Huyện Trà Cú'),
(606, 54, 'Huyện Duyên Hải'),
(607, 54, 'Thị xã Duyên Hải'),
(608, 55, 'Thành phố Vĩnh Long'),
(609, 55, 'Huyện Long Hồ'),
(610, 55, 'Huyện Mang Thít'),
(611, 55, 'Huyện  Vũng Liêm'),
(612, 55, 'Huyện Tam Bình'),
(613, 55, 'Thị xã Bình Minh'),
(614, 55, 'Huyện Trà Ôn'),
(615, 55, 'Huyện Bình Tân'),
(616, 56, 'Thành phố Cao Lãnh'),
(617, 56, 'Thành phố Sa Đéc'),
(618, 56, 'Thành phố Hồng Ngự'),
(619, 56, 'Huyện Tân Hồng'),
(620, 56, 'Huyện Hồng Ngự'),
(621, 56, 'Huyện Tam Nông'),
(622, 56, 'Huyện Tháp Mười'),
(623, 56, 'Huyện Cao Lãnh'),
(624, 56, 'Huyện Thanh Bình'),
(625, 56, 'Huyện Lấp Vò'),
(626, 56, 'Huyện Lai Vung'),
(627, 56, 'Huyện Châu Thành'),
(628, 57, 'Thành phố Long Xuyên'),
(629, 57, 'Thành phố Châu Đốc'),
(630, 57, 'Huyện An Phú'),
(631, 57, 'Thị xã Tân Châu'),
(632, 57, 'Huyện Phú Tân'),
(633, 57, 'Huyện Châu Phú'),
(634, 57, 'Huyện Tịnh Biên'),
(635, 57, 'Huyện Tri Tôn'),
(636, 57, 'Huyện Châu Thành'),
(637, 57, 'Huyện Chợ Mới'),
(638, 57, 'Huyện Thoại Sơn'),
(639, 58, 'Thành phố Rạch Giá'),
(640, 58, 'Thành phố Hà Tiên'),
(641, 58, 'Huyện Kiên Lương'),
(642, 58, 'Huyện Hòn Đất'),
(643, 58, 'Huyện Tân Hiệp'),
(644, 58, 'Huyện Châu Thành'),
(645, 58, 'Huyện Giồng Riềng'),
(646, 58, 'Huyện Gò Quao'),
(647, 58, 'Huyện An Biên'),
(648, 58, 'Huyện An Minh'),
(649, 58, 'Huyện Vĩnh Thuận'),
(650, 58, 'Thành phố Phú Quốc'),
(651, 58, 'Huyện Kiên Hải'),
(652, 58, 'Huyện U Minh Thượng'),
(653, 58, 'Huyện Giang Thành'),
(654, 59, 'Quận Ninh Kiều'),
(655, 59, 'Quận Ô Môn'),
(656, 59, 'Quận Bình Thuỷ'),
(657, 59, 'Quận Cái Răng'),
(658, 59, 'Quận Thốt Nốt'),
(659, 59, 'Huyện Vĩnh Thạnh'),
(660, 59, 'Huyện Cờ Đỏ'),
(661, 59, 'Huyện Phong Điền'),
(662, 59, 'Huyện Thới Lai'),
(663, 60, 'Thành phố Vị Thanh'),
(664, 60, 'Thành phố Ngã Bảy'),
(665, 60, 'Huyện Châu Thành A'),
(666, 60, 'Huyện Châu Thành'),
(667, 60, 'Huyện Phụng Hiệp'),
(668, 60, 'Huyện Vị Thuỷ'),
(669, 60, 'Huyện Long Mỹ'),
(670, 60, 'Thị xã Long Mỹ'),
(671, 61, 'Thành phố Sóc Trăng'),
(672, 61, 'Huyện Châu Thành'),
(673, 61, 'Huyện Kế Sách'),
(674, 61, 'Huyện Mỹ Tú'),
(675, 61, 'Huyện Cù Lao Dung'),
(676, 61, 'Huyện Long Phú'),
(677, 61, 'Huyện Mỹ Xuyên'),
(678, 61, 'Thị xã Ngã Năm'),
(679, 61, 'Huyện Thạnh Trị'),
(680, 61, 'Thị xã Vĩnh Châu'),
(681, 61, 'Huyện Trần Đề'),
(682, 62, 'Thành phố Bạc Liêu'),
(683, 62, 'Huyện Hồng Dân'),
(684, 62, 'Huyện Phước Long'),
(685, 62, 'Huyện Vĩnh Lợi'),
(686, 62, 'Thị xã Giá Rai'),
(687, 62, 'Huyện Đông Hải'),
(688, 62, 'Huyện Hoà Bình'),
(689, 63, 'Thành phố Cà Mau'),
(690, 63, 'Huyện U Minh'),
(691, 63, 'Huyện Thới Bình'),
(692, 63, 'Huyện Trần Văn Thời'),
(693, 63, 'Huyện Cái Nước'),
(694, 63, 'Huyện Đầm Dơi'),
(695, 63, 'Huyện Năm Căn'),
(696, 63, 'Huyện Phú Tân'),
(697, 63, 'Huyện Ngọc Hiển');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2025_02_23_062916_create_nha_cung_caps_table', 2),
(12, '2025_02_26_093748_add_image_to_producers_table', 4),
(32, '0001_01_01_000000_create_users_table', 5),
(33, '0001_01_01_000001_create_cache_table', 5),
(34, '0001_01_01_000002_create_jobs_table', 5),
(35, '2025_02_26_090530_create_producers_table', 5),
(36, '2025_02_26_110353_create_categories_table', 5),
(37, '2025_02_26_135530_create_products_table', 5),
(38, '2025_03_04_181501_create_coupons_table', 5),
(39, '2025_03_05_140702_create_orders_table', 5),
(40, '2025_03_05_140716_create_order_items_table', 5),
(41, '2025_03_05_140733_create_addresses_table', 5),
(42, '2025_03_05_140744_create_transactions_table', 5),
(43, '2025_03_20_115717_create_slides_table', 6),
(44, '2025_04_01_004155_create_news_table', 7),
(45, '2025_04_16_215410_add_slug_to_products_table', 8),
(46, '2025_04_18_001609_create_purchase_orders_table', 9),
(47, '2025_04_18_001518_create_purchase_order_items_table', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `introtext` text DEFAULT NULL,
  `fulltext` text DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(50) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_method` enum('cod','bank_transfer','paypal') NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `shipping_fee` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total` decimal(12,2) NOT NULL,
  `status` enum('pending','confirmed','processing','shipped','delivered','canceled','returned') NOT NULL DEFAULT 'pending',
  `delivered_date` timestamp NULL DEFAULT NULL,
  `canceled_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `province`, `district`, `address`, `payment_method`, `subtotal`, `shipping_fee`, `discount`, `total`, `status`, `delivered_date`, `canceled_date`, `created_at`, `updated_at`) VALUES
(21, NULL, 4, 'Dang Van A', 'anthuan@gmail.com', '0987654321', '43', '475', 'gia nghĩa 1', 'cod', 4160000.00, 40000.00, 0.00, 4200000.00, 'delivered', '2025-04-17 15:16:08', '2025-04-13 11:51:48', '2025-04-13 09:44:38', '2025-04-17 15:16:08'),
(22, 'DH20250413ABC123', 4, 'Dang Van A', 'anthuan@gmail.com', '0987654321', '62', '686', 'giá rai', 'cod', 1685000.00, 0.00, 0.00, 1685000.00, 'delivered', '2025-04-17 15:15:57', '2025-04-13 13:08:53', '2025-04-13 10:06:09', '2025-04-17 15:15:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `size` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `price`, `quantity`, `subtotal`, `size`, `color`, `created_at`, `updated_at`) VALUES
(37, 21, 37, 'Máy pha cà phê Espresso Zamboo ZB-68CF', 1040000.00, 4, 4160000.00, '240ml', 'Trắng', '2025-04-13 09:44:38', '2025-04-13 09:44:38'),
(38, 22, 31, 'Quạt lửng Senko L1638', 450000.00, 1, 450000.00, '39cm', 'Xám', '2025-04-13 10:06:09', '2025-04-13 10:06:09'),
(39, 22, 34, 'Nồi cơm điện Sharp', 760000.00, 1, 760000.00, '3.8 lít', 'Trắng', '2025-04-13 10:06:09', '2025-04-13 10:06:09'),
(40, 22, 36, 'Máy pha cà phê Espresso Tiross TS621', 475000.00, 1, 475000.00, '18.5cm x 18.6cm x 26cm', 'Đen', '2025-04-13 10:06:09', '2025-04-13 10:06:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `producers`
--

CREATE TABLE `producers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `producers`
--

INSERT INTO `producers` (`id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Senko', 'senko', '1744360521.jpg', 'đang hợp tác', '2025-04-11 08:35:21', '2025-04-11 08:35:21'),
(4, 'Supor', 'supor', '1744360551.jpg', 'đang hợp tác', '2025-04-11 08:35:51', '2025-04-11 08:35:51'),
(5, 'Sunhouse', 'sunhouse', '1744360576.jpg', 'đang hợp tác', '2025-04-11 08:36:16', '2025-04-11 08:36:16'),
(6, 'Tefal', 'tefal', '1744360606.jpg', 'đang hợp tác', '2025-04-11 08:36:46', '2025-04-11 08:36:46'),
(7, 'Sharp', 'sharp', '1744360627.jpg', 'đang hợp tác', '2025-04-11 08:37:07', '2025-04-11 08:37:07'),
(8, 'Philips', 'philips', '1744360654.jpg', 'đang hợp tác', '2025-04-11 08:37:34', '2025-04-11 08:37:34'),
(9, 'Midea', 'midea', '1744360670.jpg', 'đang hợp tác', '2025-04-11 08:37:50', '2025-04-11 08:37:50'),
(10, 'Pureit', 'pureit', '1744360719.jpg', 'đang hợp tác', '2025-04-11 08:38:39', '2025-04-11 08:38:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `regular_price` decimal(12,2) NOT NULL,
  `sale_price` decimal(12,2) DEFAULT NULL,
  `import_price` decimal(12,2) DEFAULT NULL COMMENT 'Giá nhập',
  `sale` decimal(5,2) DEFAULT NULL COMMENT 'Giảm giá (%)',
  `SKU` varchar(255) NOT NULL,
  `stock_status` enum('instock','outofstock') NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `producer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `has_variants` tinyint(1) DEFAULT 0,
  `quantity` bigint(20) UNSIGNED DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `short_description`, `description`, `regular_price`, `sale_price`, `import_price`, `sale`, `SKU`, `stock_status`, `featured`, `image`, `images`, `category_id`, `producer_id`, `created_at`, `updated_at`, `has_variants`, `quantity`, `color`, `size`) VALUES
(31, 'Quạt lửng Senko L1638', 'quat-lung-senko-l1638', NULL, '<h2>Đặc điểm nổi bật</h2>\r\n\r\n<ul>\r\n	<li>Thiết kế ch&acirc;n đế&nbsp;<a href=\"https://www.nguyenkim.com/quat-senko-vi/\" title=\"quạt Senko\">quạt Senko</a>&nbsp;to, vững chắc, kh&ocirc;ng rung lắc khi hoạt động</li>\r\n	<li>3 c&aacute;nh quạt c&oacute; đường k&iacute;nh 39 cm l&agrave;m m&aacute;t hiệu quả tr&ecirc;n kh&ocirc;ng gian lớn</li>\r\n	<li>C&oacute; thể thay đổi chiều cao từ 75.6 - 91.5 cm ph&ugrave; hợp với nhu cầu sử dụng</li>\r\n	<li>T&ugrave;y chỉnh 3 mức gi&oacute; dễ d&agrave;ng bằng n&uacute;t nhấn,&nbsp;ph&ugrave; hợp với cả người lớn tuổi</li>\r\n	<li>C&ocirc;ng suất hoạt động 47W cho quạt l&agrave;m m&aacute;t nhanh, ti&ecirc;u thụ điện năng &iacute;t</li>\r\n	<li>Lồng&nbsp;quạt c&oacute; nan đan kh&iacute;t, bảo đảm an to&agrave;n,&nbsp;c&oacute; thể th&aacute;o rời dễ lau ch&ugrave;i</li>\r\n	<li>Quạt Senko L1638 sử dụng motor bạc thau quấn d&acirc;y đồng 100% bền bỉ</li>\r\n</ul>', 500000.00, 450000.00, 300000.00, 10.00, 'QL01', 'instock', 1, '1744360914.jpg', '1744360914-1.jpg,1744360914-2.jpg', 2, 3, '2025-04-11 08:41:54', '2025-04-11 08:41:54', 0, 100, 'Xám', '39cm'),
(34, 'Nồi cơm điện Sharp', 'noi-com-dien-sharp', NULL, '<p><strong><span style=\"font-size:16px\">Th&ocirc;ng tin sản phẩm</span></strong></p>\r\n\r\n<p>Nồi cơm điện Sharp 3,8 l&iacute;t KSH-D44V&nbsp;thuộc d&ograve;ng&nbsp;nồi cơm điện nắp rời&nbsp;của thương hiệu Sharp - Nhật Bản. Mẫu nồi n&agrave;y c&oacute; dung t&iacute;ch lớn 3,8 l&iacute;t đ&aacute;p ứng nhu cầu d&ugrave;ng cho từ 6 người trở l&ecirc;n. Kh&ocirc;ng chỉ c&oacute; thiết kế đẹp, sản phẩm c&ograve;n c&oacute; khả năng nấu cơm ch&iacute;n nhanh ch&oacute;ng, hiệu quả.</p>\r\n\r\n<p><img alt=\"Kích thước của nồi cơm điện Sharp 3,8 lít KSH-D44V\" src=\"https://st.meta.vn/Data/image/2019/06/15/noi-com-dien-sharp-3-8-lit-ksh-740v-d40v-6.jpg\" style=\"height:525px; width:700px\" title=\"Kích thước của nồi cơm điện Sharp 3,8 lít KSH-D44V\" /></p>\r\n\r\n<h2>Ưu điểm nổi bật của&nbsp;nồi cơm điện Sharp 3,8 l&iacute;t&nbsp;KSH-D44V</h2>\r\n\r\n<ul>\r\n	<li>Thiết kế đơn giản, c&aacute;c bộ phận c&oacute; thể th&aacute;o rời được n&ecirc;n sử dụng rất thuận tiện.</li>\r\n	<li>Dung t&iacute;ch nồi l&agrave; 3,8 l&iacute;t, đ&aacute;p ứng nhu cầu sử dụng cho 6 người trở l&ecirc;n.</li>\r\n	<li>Nồi c&oacute; chức năng nấu v&agrave; giữ ấm (l&ecirc;n tới 5 tiếng) cơ bản.</li>\r\n	<li>C&ocirc;ng nghệ nấu 1D kết hợp c&ocirc;ng suất 1.350W.</li>\r\n	<li>Bảng điều khiển dạng n&uacute;t gạt dễ d&agrave;ng sử dụng.</li>\r\n	<li>L&ograve;ng nồi l&agrave;m từ hợp kim nh&ocirc;m an to&agrave;n.</li>\r\n	<li>Phụ kiện đi k&egrave;m: Cốc đong gạo, muống xới cơm.</li>\r\n</ul>\r\n\r\n<h2>Đ&aacute;nh gi&aacute; chi tiết&nbsp;nồi cơm điện Sharp 3,8 l&iacute;t&nbsp;KSH-D44V</h2>\r\n\r\n<h3>Thiết kế đơn giản, sử dụng dễ d&agrave;ng</h3>\r\n\r\n<p><img alt=\"nồi cơm điện Sharp KSH-D44V có thiết kế đơn giản, đẹp mắt\" src=\"https://st.meta.vn/Data/image/2019/06/14/noi-com-dien-sharp-3-8-lit-ksh-740v-d40v.jpg\" style=\"height:525px; width:700px\" title=\"nồi cơm điện Sharp KSH-D44V có thiết kế đơn giản, đẹp mắt\" /></p>\r\n\r\n<p>Nồi cơm điện Sharp&nbsp;KSH-D44V&nbsp;sở hữu thiết kế đơn giản, đẹp mắt. Với m&agrave;u trắng chủ đạo điểm th&ecirc;m c&aacute;c họa tiết hoa rực rỡ, chiếc nồi n&agrave;y sẽ tạo th&agrave;nh điểm nhấn ấn tượng cho nhiều kh&ocirc;ng gian bếp. C&aacute;c bộ phận như nắp nồi, l&ograve;ng nồi đều c&oacute; thể th&aacute;o rời dễ d&agrave;ng gi&uacute;p việc sử dụng v&agrave; vệ sinh thuận tiện nhất.</p>\r\n\r\n<p>Vỏ nồi được l&agrave;m từ chất liệu bền bỉ, cao cấp, hạn chế b&aacute;m d&iacute;nh bụi bẩn, thuận tiện cho qu&aacute; tr&igrave;nh lau ch&ugrave;i. Ngo&agrave;i ra, nồi c&ograve;n c&oacute; tay cầm l&agrave;m từ&nbsp;chất liệu Phenolic c&aacute;ch nhiệt hiệu quả, chắc chắn để bạn thuận tiện di chuyển nồi khi cần thiết.</p>\r\n\r\n<p><img alt=\"nồi cơm điện Sharp KSH D44V có tay cầm cách nhiệt, dễ sử dụng\" src=\"https://st.meta.vn/Data/image/2019/06/14/noi-com-dien-sharp-3-8-lit-ksh-740v-d40v-3.jpg\" style=\"height:525px; width:700px\" title=\"nồi cơm điện Sharp KSH D44V có tay cầm cách nhiệt, dễ sử dụng\" /></p>\r\n\r\n<h3>Dung t&iacute;ch 3,8 l&iacute;t ph&ugrave; hợp d&ugrave;ng cho 6 người trở l&ecirc;n</h3>\r\n\r\n<p>Nồi c&oacute; dung t&iacute;ch 3,8 l&iacute;t, c&oacute; thể nấu được khoảng 10 cốc gạo, đ&aacute;p ứng nhu cầu sử dụng cho 6 - 15 người d&ugrave;ng. Ch&iacute;nh v&igrave; thế, sản phẩm n&agrave;y thường được nhiều qu&aacute;n ăn, bếp ăn quy m&ocirc; nhỏ lựa chọn sử dụng.</p>\r\n\r\n<h3>C&ocirc;ng suất hoạt động mạnh mẽ kết hợp c&ocirc;ng nghệ nấu 1D</h3>\r\n\r\n<p>Nồi cơm điện&nbsp;Sharp KSH D44V được trang bị c&ocirc;ng nghệ nấu 1D với duy nhất 1 m&acirc;m nhiệt lớn ở b&ecirc;n dưới đ&aacute;y nồi kết hợp c&ugrave;ng c&ocirc;ng suất 1.350W gi&uacute;p gia nhiệt nhanh ch&oacute;ng để cơm ch&iacute;n nhanh, dẻo ngon hơn.</p>\r\n\r\n<p><img alt=\"Mâm nhiệt của nồi cơm điện Sharp 3,8 lít KSH D44V khá lớn\" src=\"https://st.meta.vn/Data/image/2019/06/14/noi-com-dien-sharp-3-8-lit-ksh-740v-d40v-5.jpg\" style=\"height:525px; width:700px\" title=\"Mâm nhiệt của nồi cơm điện Sharp 3,8 lít KSH D44V khá lớn\" /></p>\r\n\r\n<h3>Trang bị chế độ nấu v&agrave; giữ ấm cơ bản - khả năng giữ ấm tới 5 tiếng</h3>\r\n\r\n<p>KSH D44V được trang bị 2 chức năng nấu (COOK) v&agrave; giữ ấm (WARM) cơ bản. B&ecirc;n cạnh cơm, bạn c&oacute; thể d&ugrave;ng nồi để nấu một v&agrave;i m&oacute;n ăn đơn giản. Sau khi nấu xong, nồi sẽ tự động chuyển sang chế độ giữ ấm với thời gian giữ ấm l&ecirc;n tới 5 tiếng cực kỳ tiện lợi.</p>\r\n\r\n<h3>L&ograve;ng nồi l&agrave;m từ hợp kim nh&ocirc;m cho khả năng truyền nhiệt tốt</h3>\r\n\r\n<p>Sharp KSH D44V c&oacute; bộ phận l&otilde;i nồi được được l&agrave;m từ chất liệu hợp kim nh&ocirc;m bền bỉ, cao cấp, c&oacute; khả năng truyền nhiệt tốt nhằm tiết kiệm điện năng hiệu quả hơn. Mặc d&ugrave; l&otilde;i nồi n&agrave;y kh&ocirc;ng c&oacute; phủ chống d&iacute;nh nhưng vẫn c&oacute; thể vệ sinh dễ d&agrave;ng, thuận tiện.</p>\r\n\r\n<p><img alt=\"Sharp KSH D44V có bộ phận lõi nồi được được làm từ chất liệu hợp kim nhôm bền bỉ\" src=\"https://st.meta.vn/Data/image/2019/06/14/noi-com-dien-sharp-3-8-lit-ksh-740v-d40v-4.jpg\" style=\"height:525px; width:700px\" title=\"Sharp KSH D44V có bộ phận lõi nồi được được làm từ chất liệu hợp kim nhôm bền bỉ\" /></p>\r\n\r\n<h3>Bảng điều khiển dạng n&uacute;t gạt dễ d&ugrave;ng</h3>\r\n\r\n<p>Nồi cơm điện Sharp KSH D44V c&oacute; bảng điều khiển dạng n&uacute;t gạt rất dễ sử dụng. Bạn chỉ cần nhấn n&uacute;t gạt xuống dưới để tiến h&agrave;nh nấu, sau đ&oacute; n&uacute;t gạt n&agrave;y sẽ tự động nhảy l&ecirc;n để chuyển trạng th&aacute;i giữ ấm v&ocirc; c&ugrave;ng tiện dụng.</p>\r\n\r\n<p>Bảng điều khiển n&agrave;y cũng c&oacute; đ&egrave;n b&aacute;o hiệu để người d&ugrave;ng dễ d&agrave;ng quan s&aacute;t.</p>\r\n\r\n<p><img alt=\"Bảng điều khiển của nồi Sharp KSH D44V rất dễ sử dụng\" src=\"https://st.meta.vn/Data/image/2019/06/14/noi-com-dien-sharp-3-8-lit-ksh-740v-d40v-2.jpg\" style=\"height:525px; width:700px\" title=\"Bảng điều khiển của nồi Sharp KSH D44V rất dễ sử dụng\" /></p>\r\n\r\n<h3>Phụ kiện đầy đủ</h3>\r\n\r\n<p>Nồi được trang bị cốc đong gi&uacute;p bạn dễ ước lượng phần gạo cần nấu. Ngo&agrave;i ra nồi cũng c&oacute; muỗng xới cơm l&agrave;m từ nhựa an to&agrave;n gi&uacute;p việc lấy cơm dễ d&agrave;ng hơn.</p>\r\n\r\n<h3>D&acirc;y điện th&aacute;o rời dễ d&agrave;ng</h3>\r\n\r\n<p>D&acirc;y điện của nồi được thiết kế c&oacute; thể th&aacute;o rời dễ d&agrave;ng, gi&uacute;p bạn thuận tiện hơn khi sử dụng v&agrave; bảo quản.</p>\r\n\r\n<p><img alt=\"Dây điện của nồi Sharp KSH D44V có thể tháo rời\" src=\"https://st.meta.vn/Data/image/2019/06/14/noi-com-dien-sharp-3-8-lit-ksh-740v-d40v-7.jpg\" style=\"height:525px; width:700px\" title=\"Dây điện của nồi Sharp KSH D44V có thể tháo rời\" /></p>\r\n\r\n<h3>Lưu &yacute; khi sử dụng</h3>\r\n\r\n<ul>\r\n	<li>Sử dụng nguồn điện đ&uacute;ng với quy định của nh&agrave; sản xuất.</li>\r\n	<li>Lau kh&ocirc; đ&aacute;y của l&otilde;i nồi trước khi cho v&agrave;o cắm điện.</li>\r\n	<li>K&ecirc; đặt nồi ở vị tr&iacute; bằng phẳng, kh&ocirc; r&aacute;o, tr&aacute;nh xa nguồn nhiệt cao, nơi ẩm thấp.</li>\r\n	<li>V&igrave; l&ograve;ng nồi kh&ocirc;ng c&oacute; chống d&iacute;nh n&ecirc;n khi vệ sinh bạn cần ng&acirc;m l&ograve;ng nồi trước để gi&uacute;p việc l&agrave;m sạch dễ d&agrave;ng hơn.</li>\r\n	<li>Kh&ocirc;ng d&ugrave;ng dụng cụ vệ sinh bằng kim loại để cọ l&ograve;ng nồi.</li>\r\n</ul>\r\n\r\n<p>Nồi cơm điện Sharp KSH D44V l&agrave; lựa chọn l&yacute; tưởng d&agrave;nh cho những gia đ&igrave;nh c&oacute; đ&ocirc;ng th&agrave;nh vi&ecirc;n hoặc qu&aacute;n ăn, bếp ăn nhỏ. Nếu đang muốn sở hữu một chiếc nồi cơm điện đ&aacute;p ứng nhu cầu sử dụng cơ bản, bạn đừng bỏ qua model n&agrave;y nh&eacute;.</p>', 0.00, 0.00, 0.00, NULL, 'NCD01', 'instock', 1, '1744363667.webp', '1744363667-1.webp,1744363667-2.webp,1744363667-3.webp,1744363667-4.webp', 2, 7, '2025-04-11 09:27:47', '2025-04-11 09:27:47', 1, 0, NULL, NULL),
(36, 'Máy pha cà phê Espresso Tiross TS621', 'may-pha-ca-phe-espresso-tiross-ts621', NULL, '<p>Tiross TS621 l&agrave; m&aacute;y pha c&agrave; ph&ecirc; b&aacute;n tự động, c&oacute; chức năng pha Espresso v&agrave; Capuchino, pha được 1-4 t&aacute;ch c&agrave; ph&ecirc; trong 1 lần, gi&uacute;p bạn c&oacute; được ly c&agrave; ph&ecirc; thơm ngon một c&aacute;ch nhanh ch&oacute;ng v&agrave; tiện lợi.</p>\r\n\r\n<p><strong>Video giới thiệu m&aacute;y pha c&agrave; ph&ecirc; Tiross TS621</strong></p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"394\" src=\"https://www.youtube.com/embed/AQDAK1SsAOc?playsinline=1\" width=\"700\"></iframe></p>\r\n\r\n<p><em>Đ&aacute;nh gi&aacute; m&aacute;y pha c&agrave; ph&ecirc; Espresso Tiross TS-621</em></p>\r\n\r\n<h2>Ưu điểm của&nbsp;Tiross TS621</h2>\r\n\r\n<ul>\r\n	<li>M&aacute;y pha c&agrave; ph&ecirc;&nbsp;<a href=\"https://meta.vn/may-pha-ca-phe-espresso-tiross-ts-621-p10195\" title=\"Tiross TS621\">Tiross TS621</a>&nbsp;c&oacute; thiết kế hiện đại, sang trọng, k&iacute;ch thước nhỏ gọn.</li>\r\n	<li>C&ocirc;ng suất cao, c&oacute; thể pha được từ 1 - 4 ly c&agrave; ph&ecirc;/lần.</li>\r\n	<li>C&oacute; đầu đ&aacute;nh bọt sữa &aacute;p suất cao, pha được cả c&agrave; ph&ecirc; Espresso v&agrave; Cappuccino, đ&aacute;nh bọt nhanh v&agrave; mịn.</li>\r\n	<li>Th&aacute;o lắp đơn giản gi&uacute;p việc vệ sinh trở n&ecirc;n dễ d&agrave;ng hơn.</li>\r\n	<li>Thao t&aacute;c sử dụng nhanh ch&oacute;ng, tiện lợi.&nbsp;</li>\r\n</ul>\r\n\r\n<h3><img alt=\"Cấu tạo máy pha cà phê Espresso Tiross TS621 \" src=\"https://s.meta.com.vn/Data/image/2019/03/08/may-pha-ca-phe-espresso-tiross-ts-621-ctao.jpg\" style=\"height:500px; width:667px\" title=\"Cấu tạo máy pha cà phê Espresso Tiross TS621 \" /></h3>\r\n\r\n<h2>Đ&aacute;nh gi&aacute; m&aacute;y pha c&agrave; ph&ecirc; Espresso Tiross TS621&nbsp;chi tiết</h2>\r\n\r\n<p><img alt=\"Hình ảnh máy pha cà phê Espresso Tiross TS621\" src=\"https://s.meta.com.vn/Data/image/2019/03/08/may-pha-ca-phe-espresso-tiross-ts-621.jpg\" style=\"height:500px; width:667px\" title=\"Hình ảnh máy pha cà phê Espresso Tiross TS621\" /></p>\r\n\r\n<p><strong>M&aacute;y pha c&agrave; ph&ecirc; Espresso Tiross TS621</strong>&nbsp;l&agrave; chiếc&nbsp;<a href=\"https://meta.vn/may-pha-ca-phe-ban-tu-dong-c812\" title=\"máy pha cà phê bán tự động \">m&aacute;y pha c&agrave; ph&ecirc; b&aacute;n tự động</a>&nbsp;gi&aacute; rẻ c&oacute; k&iacute;ch thước nhỏ gọn, thiết kế sang trọng, ph&ugrave; hợp với những căn bếp hiện đại. Chiếc m&aacute;y pha c&agrave; ph&ecirc; nhỏ gọn của Tiross c&oacute; c&ocirc;ng suất 800W được trang bị v&ograve;i đ&aacute;nh sữa gi&uacute;p pha được từ 1 - 4 ly c&agrave; ph&ecirc;/lần, bao gồm cả c&agrave; ph&ecirc; Espresso v&agrave; Cappuccino. Sản phẩm ph&ugrave; hợp sử dụng trong gia đ&igrave;nh hoặc trong c&aacute;c văn ph&ograve;ng, cơ quan, c&ocirc;ng sở&hellip;&nbsp;</p>\r\n\r\n<h3>Thiết kế sang trọng, k&iacute;ch thước nhỏ gọn</h3>\r\n\r\n<p><img alt=\"Máy pha cà phê Espresso Tiross TS621 có thiết kế sang trọng \" src=\"https://s.meta.com.vn/Data/image/2019/03/08/may-pha-ca-phe-espresso-tiross-ts-621-den.jpg\" style=\"height:500px; width:667px\" title=\"Máy pha cà phê Espresso Tiross TS621 có thiết kế sang trọng \" /></p>\r\n\r\n<p><a href=\"https://meta.vn/may-pha-ca-phe-c581\" title=\"Máy pha cà phê Espresso\">M&aacute;y pha c&agrave; ph&ecirc; Espresso</a>&nbsp;Tiross TS621 c&oacute; thiết kế hiện đại, sang trọng với phần vỏ ngo&agrave;i được l&agrave;m chủ yếu từ nhựa chịu nhiệt, lớp sơn đen l&igrave; tạo cảm gi&aacute;c thanh lịch, cao cấp. Sản phẩm c&oacute; kiểu d&aacute;ng chắc chắn, trọng lượng nhẹ, k&iacute;ch thước nhỏ gọn, ph&ugrave; hợp để bạn đặt tr&ecirc;n kệ bếp, b&agrave;n bar&hellip; m&agrave; kh&ocirc;ng chiếm nhiều diện t&iacute;ch, gi&uacute;p t&ocirc; điểm kh&ocirc;ng gian bếp của c&aacute;c gia đ&igrave;nh hiện đại.</p>\r\n\r\n<h3>Chất liệu cao cấp, vệ sinh đơn giản</h3>\r\n\r\n<p><img alt=\"Máy pha cà phê Espresso Tiross TS621 màu đen, dễ vệ sinh\" src=\"https://s.meta.com.vn/Data/image/2019/03/08/may-pha-ca-phe-espresso-tiross-ts-621-sau.jpg\" style=\"height:500px; width:667px\" title=\"Máy pha cà phê Espresso Tiross TS621 màu đen, dễ vệ sinh\" /></p>\r\n\r\n<p>Phần vỏ ngo&agrave;i của&nbsp;<a href=\"https://meta.vn/may-pha-ca-phe-c581?brands=255\" title=\"máy pha cà phê Tiross\">m&aacute;y pha c&agrave; ph&ecirc; Tiross</a>&nbsp;TS621 được đ&aacute;nh gi&aacute; cao nhờ chất liệu nhựa cao cấp, c&oacute; khả năng chịu lực khi va chạm với vật cứng, cũng như dễ d&agrave;ng vệ sinh sau khi sử dụng.&nbsp;</p>\r\n\r\n<p>Lớp nhựa vỏ m&aacute;y cũng c&oacute; khả năng chịu nhiệt tốt gi&uacute;p hạn chế t&igrave;nh trạng h&oacute;a chất th&ocirc;i nhiễm ra đồ uống trong qu&aacute; tr&igrave;nh pha chế với nước ở nhiệt độ cao, đảm bảo an to&agrave;n cho người sử dụng.</p>\r\n\r\n<h3>Cốc đựng dung t&iacute;ch lớn, tiết kiệm thời gian pha chế</h3>\r\n\r\n<p><img alt=\"Cốc đựng cà phê của máy pha cafe Tiross TS621\" src=\"https://st.meta.vn/Data/image/2022/06/18/may-pha-ca-phe-espresso-tiross-ts-621-2.jpg\" style=\"height:467px; width:700px\" title=\"Cốc đựng cà phê của máy pha cafe Tiross TS621\" /></p>\r\n\r\n<p>Cốc đựng của m&aacute;y pha c&agrave; ph&ecirc; Espresso Tiross TS621 được l&agrave;m từ thủy tinh c&oacute; dung t&iacute;ch lớn gi&uacute;p bạn chứa được lượng c&agrave; ph&ecirc; tương đương từ 1 - 4 ly c&agrave; ph&ecirc;. B&ecirc;n cạnh đ&oacute;, cốc đựng c&agrave; ph&ecirc; của m&aacute;y cũng c&oacute; thể th&aacute;o rời n&ecirc;n việc vệ sinh sẽ dễ d&agrave;ng v&agrave; đảm bảo hơn.</p>\r\n\r\n<h3>C&ocirc;ng suất cao, pha chế được nhiều m&oacute;n đồ uống kh&aacute;c nhau</h3>\r\n\r\n<p><img alt=\"Tay cầm phin lọc cà phê máy pha cà phê Tiross TS621\" src=\"https://s.meta.com.vn/Data/image/2019/03/08/may-pha-ca-phe-espresso-tiross-ts-621-phin-loc.jpg\" style=\"height:500px; width:667px\" title=\"Tay cầm phin lọc cà phê máy pha cà phê Tiross TS621\" /></p>\r\n\r\n<p>Giống như&nbsp;<a href=\"https://meta.vn/may-pha-ca-phe-espresso-tiross-ts620-p10197\" title=\"máy pha cà phê Tiross TS620\">m&aacute;y pha c&agrave; ph&ecirc; Tiross TS620</a>,&nbsp;m&aacute;y pha cafe Tiross TS621 c&oacute; c&ocirc;ng suất 800W, tốc độ pha c&agrave; ph&ecirc; nhanh ch&oacute;ng, chỉ cần 3 - 4 ph&uacute;t l&agrave; c&oacute; thể pha khoảng 1 - 4 ly gi&uacute;p bạn tiết kiệm tối đa thời gian pha chế. Kh&ocirc;ng chỉ pha được c&agrave; ph&ecirc;&nbsp;Espresso, m&aacute;y pha c&agrave; ph&ecirc; Tiross TS621 c&ograve;n được trang bị v&ograve;i đ&aacute;nh sữa gi&uacute;p bạn tạo bọt cho sữa để pha chế c&aacute;c loại đồ uống như Cappuccino, Mocha, Latte&hellip;</p>\r\n\r\n<h3>V&ograve;i hơi đ&aacute;nh sữa tạo bọt mịn</h3>\r\n\r\n<p><img alt=\"Vòi hơi đánh sữa tạo bọt mịn Tiross TS621\" src=\"https://st.meta.vn/Data/image/2022/06/18/may-pha-ca-phe-espresso-tiross-ts-621-1.jpg\" style=\"height:394px; width:700px\" title=\"Vòi hơi đánh sữa tạo bọt mịn Tiross TS621\" /></p>\r\n\r\n<p><a href=\"https://meta.vn/may-pha-ca-phe-ban-tu-dong-c812?brands=255\" title=\"Máy pha cà phê bán tự động Tiross\">M&aacute;y pha c&agrave; ph&ecirc; b&aacute;n tự động Tiross</a>&nbsp;TS621 được trang bị v&ograve;i đ&aacute;nh sữa với rơ le nhiệt độc lập gi&uacute;p đảm bảo lượng nhiệt th&iacute;ch hợp cho việc đ&aacute;nh sữa, tạo bọt mịn cho những m&oacute;n đồ uống như Cappuccino, Latte, Mocha&hellip; Bạn c&oacute; thể đựng sữa trực tiếp v&agrave;o cốc hay b&igrave;nh chứa thủy tinh đi k&egrave;m để thao t&aacute;c với v&ograve;i hơi đ&aacute;nh sữa đều được.</p>\r\n\r\n<h3>Hệ thống chống nhỏ giọt tiện dụng</h3>\r\n\r\n<p><img alt=\"Hệ thống chống nhỏ giọt tiện dụng của máy pha cà phê Tiross TS621\" src=\"https://s.meta.com.vn/Data/image/2019/03/08/may-pha-ca-phe-espresso-tiross-ts-621-khay-hung.jpg\" style=\"height:500px; width:667px\" title=\"Hệ thống chống nhỏ giọt tiện dụng của máy pha cà phê Tiross TS621\" /></p>\r\n\r\n<p>Hệ thống chống nhỏ giọt được thiết kế ở phần đế của m&aacute;y pha c&agrave; ph&ecirc; Tiross TS621 gi&uacute;p giữ vệ sinh m&aacute;y mỗi khi bạn lấy b&igrave;nh đựng cafe ra ngo&agrave;i trong khi pha. Khay hứng nước c&oacute; thể th&aacute;o ra vệ sinh dễ d&agrave;ng m&agrave; kh&ocirc;ng tốn nhiều c&ocirc;ng sức.</p>\r\n\r\n<h3>M&agrave;ng lọc inox dễ vệ sinh</h3>\r\n\r\n<p><img alt=\"Nắp đậy máy pha cà phê Espresso Tiross TS621\" src=\"https://s.meta.com.vn/Data/image/2019/03/08/may-pha-ca-phe-espresso-tiross-ts-621-nap.jpg\" style=\"height:500px; width:667px\" title=\"Nắp đậy máy pha cà phê Espresso Tiross TS621\" /></p>\r\n\r\n<p><a href=\"https://meta.vn/tiross.html\" title=\"Tiross\">Tiross</a>&nbsp;TS621 sử dụng m&agrave;ng lọc lưới inox dễ vệ sinh v&agrave; kh&ocirc;ng phải thay thế sau mỗi lần sử dụng như m&agrave;ng lọc giấy, gi&uacute;p tiết kiệm thời gian, c&ocirc;ng sức cũng như chi ph&iacute; mua m&agrave;ng lọc giấy cho bạn.</p>\r\n\r\n<h3>Bảng điều khiển đơn giản, sử dụng dễ d&agrave;ng</h3>\r\n\r\n<p>Bảng điều khiển của&nbsp;<a href=\"https://meta.vn/may-pha-ca-phe-c581\" title=\"máy pha cafe\">m&aacute;y pha cafe</a>&nbsp;Tiross TS621 c&oacute; dạng n&uacute;m xoay cơ học được thiết kế rất trực quan, đơn giản, dễ sử dụng v&agrave; dễ quan s&aacute;t. Bạn chỉ cần xoay n&uacute;m điều khiển đến vị tr&iacute; chương tr&igrave;nh m&agrave; m&igrave;nh muốn sử dụng sau đ&oacute; chờ m&aacute;y chạy xong chu tr&igrave;nh l&agrave; được.&nbsp;</p>\r\n\r\n<p><img alt=\"Núm vặn chọn các chế độ của máy pha cafe Espresso Tiross TS621\" src=\"https://s.meta.com.vn/Data/image/2019/03/08/may-pha-ca-phe-espresso-tiross-ts-621-num-van.jpg\" style=\"height:500px; width:667px\" title=\"Núm vặn chọn các chế độ của máy pha cafe Espresso Tiross TS621\" /></p>\r\n\r\n<p>Nh&igrave;n chung, với mức gi&aacute; chỉ&nbsp;1.090.000 đồng th&igrave; m&aacute;y pha c&agrave; ph&ecirc; b&aacute;n tự động Espresso Tiross TS621 l&agrave; một chiếc m&aacute;y pha c&agrave; ph&ecirc; đảm bảo cả về mặt thẩm mỹ v&agrave; c&ocirc;ng năng, ph&ugrave; hợp để sử dụng trong gia đ&igrave;nh hoặc văn ph&ograve;ng, c&ocirc;ng sở&hellip;</p>\r\n\r\n<p><strong>Lưu &yacute;:</strong>&nbsp;H&igrave;nh ảnh sản phẩm chỉ c&oacute; t&iacute;nh chất minh họa, chi tiết sản phẩm, m&agrave;u sắc c&oacute; thể thay đổi t&ugrave;y theo sản phẩm thực tế.</p>', 500000.00, 475000.00, 300000.00, 5.00, 'PCP01', 'instock', 1, '1744382076.webp', '1744382076-1.webp,1744382076-2.webp,1744382076-3.webp,1744382076-4.webp', 4, 6, '2025-04-11 14:34:36', '2025-04-11 14:34:36', 0, 100, 'Đen', '18.5cm x 18.6cm x 26cm'),
(37, 'Máy pha cà phê Espresso Zamboo ZB-68CF', 'may-pha-ca-phe-espresso-zamboo-zb-68cf', NULL, '<p>Nằm trong ph&acirc;n kh&uacute;c m&aacute;y pha c&agrave; ph&ecirc; b&igrave;nh d&acirc;n, Zamboo ZB-68CF mang đến đầy đủ chức năng để pha những ly Espresso thơm ngon c&ugrave;ng khả năng đ&aacute;nh sữa để pha Capuchino v&agrave; Latte. Tất cả những điều đ&oacute; g&oacute;i gọn trong một thiết kế nhỏ xinh v&agrave; mức gi&aacute; cực kỳ hợp l&yacute;.</p>\r\n\r\n<p style=\"text-align:center\"><iframe frameborder=\"0\" height=\"394\" src=\"https://www.youtube.com/embed/XX_Fgpr1D5U?playsinline=1\" width=\"700\"></iframe></p>\r\n\r\n<h2>Đ&aacute;nh gi&aacute; m&aacute;y pha c&agrave; ph&ecirc; Espresso Zamboo ZB-68CF</h2>\r\n\r\n<p><strong>Zamboo ZB-68CF</strong>&nbsp;c&oacute; hai chức năng pha c&agrave; ph&ecirc;&nbsp;Espresso v&agrave; đ&aacute;nh sữa pha Cappuccino, Latte theo phong c&aacute;ch &Yacute;, ph&ugrave; hợp sử dụng cho gia đ&igrave;nh, văn ph&ograve;ng...</p>\r\n\r\n<p><img alt=\"Máy pha cà phê Espresso Zamboo ZB-68CF\" src=\"https://st.meta.vn/Data/image/2020/11/07/may-pha-ca-phe-espresso-zamboo-zb-68cf.jpg\" style=\"height:525px; width:700px\" title=\"Máy pha cà phê Espresso Zamboo ZB-68CF\" /></p>\r\n\r\n<p>M&aacute;y pha c&agrave; ph&ecirc; Espresso Zamboo ZB-68CF</p>\r\n\r\n<p>M&aacute;y pha c&agrave; ph&ecirc; thiết kế kiểu d&aacute;ng sang trọng, nhỏ gọn, phối hợp h&agrave;i h&ograve;a giữa&nbsp;m&agrave;u đen, xanh hay c&agrave; ph&ecirc; của nhựa ABS v&agrave; inox. B&igrave;nh chứa nước cũng l&agrave; b&igrave;nh đun (boiler) được đ&uacute;c nguy&ecirc;n khối bằng th&eacute;p với dung t&iacute;ch 240ml.</p>\r\n\r\n<p><a href=\"https://meta.vn/may-pha-ca-phe-ban-tu-dong-c812\" target=\"_blank\" title=\"Máy phà cà phê bán tự động\">M&aacute;y ph&agrave; c&agrave; ph&ecirc; b&aacute;n tự động</a>&nbsp;c&oacute; c&ocirc;ng suất hoạt động l&agrave; 800W, dễ d&agrave;ng pha cho bạn từ 1 - 4 ly c&agrave; ph&ecirc; Espresso trong thời gian ngắn với &aacute;p suất đạt 3,5 bar tương đương 50 PSI trong thang đo lường &aacute;p lực nước. Đ&acirc;y l&agrave; một trong những mẫu&nbsp;<a href=\"https://meta.vn/may-pha-ca-phe-c581\" target=\"_blank\" title=\"Máy pha cà phê giá rẻ dành cho gia đình, văn phòng\">m&aacute;y pha c&agrave; ph&ecirc; gi&aacute; rẻ l&yacute; tưởng d&agrave;nh cho gia đ&igrave;nh, văn ph&ograve;ng</a>&nbsp;hiện nay.</p>\r\n\r\n<p><img alt=\"Zamboo ZB-68CF có 1 bình đựng cà phê bằng thủy tinh\" src=\"https://st.meta.vn/Data/image/2023/11/13/may-pha-ca-phe-espresso-zamboo-zb-68cf-3.jpg\" style=\"height:525px; width:700px\" title=\"Zamboo ZB-68CF bình đựng cà phê bằng thủy tinh\" /></p>\r\n\r\n<p>Zamboo ZB-68CF c&oacute; 1 v&ograve;i hơi inox</p>\r\n\r\n<p><a href=\"https://meta.vn/zamboo.html\" target=\"_blank\" title=\"Sản phẩm Zamboo\">Zamboo</a>&nbsp;ZB-68CF hoạt động dựa tr&ecirc;n nguy&ecirc;n l&yacute; nước được l&agrave;m n&oacute;ng từ 90 - 95 độ C trong b&igrave;nh đun, khi &aacute;p suất đạt 3.5 bar th&igrave; được xả thẳng v&agrave;o trong phin lọc bằng inox 304 c&oacute; chứa c&agrave; ph&ecirc;. Nhờ lực &eacute;p mạnh của hơi nước m&aacute;y sẽ &eacute;p được c&aacute;c chất c&oacute; trong c&agrave; ph&ecirc; tạo n&ecirc;n những ly c&agrave; ph&ecirc; Espresso thơm ngon, đậm đ&agrave;.&nbsp;</p>\r\n\r\n<p><img alt=\"Máy pha cà phê Espresso Zamboo ZB-68CF màu nâu\" src=\"https://st.meta.vn/Data/image/2021/08/25/may-pha-ca-phe-espresso-zamboo-zb-68cf.jpg\" style=\"height:700px; width:700px\" title=\"Máy pha cà phê Espresso Zamboo ZB-68CF màu nâu \" /></p>\r\n\r\n<p>M&aacute;y pha c&agrave; ph&ecirc; Zamboo ZB-68CF m&agrave;u n&acirc;u</p>\r\n\r\n<p>Ly c&agrave; ph&ecirc; sẽ trở n&ecirc;n hấp dẫn hơn nếu bạn d&ugrave;ng những loại c&agrave; ph&ecirc; bột rang mộc hoặc c&aacute;c loại c&agrave; ph&ecirc; b&aacute;n sẵn như Trung Nguy&ecirc;n/Hiland Coffee.&nbsp;</p>\r\n\r\n<p>Với c&agrave; ph&ecirc; hạt rang mộc bạn c&oacute; thể d&ugrave;ng m&aacute;y xay c&agrave; ph&ecirc; xay nhỏ k&iacute;ch cỡ từ 0,4 - 0,6 mm để pha được những ly c&agrave; ph&ecirc; ngon bởi k&iacute;ch cỡ hạt c&agrave; ph&ecirc; cũng ảnh hưởng tới hương vị của c&agrave; ph&ecirc;.</p>\r\n\r\n<p>Với người th&iacute;ch vị thơm tự nhi&ecirc;n v&agrave; &iacute;t cafein th&igrave; n&ecirc;n chọn mua c&agrave; ph&ecirc; Arabica. Những người th&iacute;ch uống đậm th&igrave; n&ecirc;n chọn hạt Robusta. Ngo&agrave;i ra bạn c&oacute; thể pha trộn c&agrave; ph&ecirc; theo tỉ lệ t&ugrave;y &yacute; nếu bạn c&oacute; sẵn 2 loại hạt c&agrave; ph&ecirc; n&agrave;y.&nbsp;</p>\r\n\r\n<p><img alt=\"Máy pha cà phê màu xanh Zamboo ZB-68CF\" src=\"https://st.meta.vn/Data/image/2021/08/25/may-pha-ca-phe-espresso-zamboo-zb-68cf-1.jpg\" style=\"height:700px; width:700px\" title=\"Máy pha cà phê màu xanh Zamboo ZB-68CF\" /></p>\r\n\r\n<p>M&aacute;y pha c&agrave; ph&ecirc; Zamboo ZB-68CF m&agrave;u xanh</p>\r\n\r\n<p><a href=\"https://meta.vn/may-pha-ca-phe-c581?brands=2420\" target=\"_blank\" title=\"Máy pha cà phê Zamboo\">M&aacute;y pha c&agrave; ph&ecirc;&nbsp;Zamboo</a>&nbsp;c&oacute; c&ocirc;ng tắc tắt/mở ri&ecirc;ng, n&uacute;m điều khiển hiển thị dễ d&agrave;ng với đ&egrave;n Led xanh. Tay phin lọc được l&agrave;m từ nh&ocirc;m. V&ograve;i đ&aacute;nh sữa bằng inox dễ th&aacute;o rời. Phin lọc inox c&oacute; thể chứa khoảng 20g c&agrave; ph&ecirc; bột.&nbsp;</p>\r\n\r\n<p><img alt=\"Núm điều khiển máy pha cà phê Zamboo ZB-68CF\" src=\"https://st.meta.vn/Data/image/2023/11/13/may-pha-ca-phe-espresso-zamboo-zb-68cf-6.jpg\" style=\"height:450px; width:600px\" title=\"Núm điều khiển máy pha cà phê Zamboo ZB-68CF\" /></p>\r\n\r\n<p>Ly đựng c&agrave; ph&ecirc; th&agrave;nh phẩm l&agrave;m từ thủy tinh trong suốt với dung t&iacute;ch từ 50 - 200 ml. Ph&iacute;a dưới v&ograve;i chảy ra c&agrave; ph&ecirc; c&oacute; khay hứng nhỏ giọt bằng inox dễ d&agrave;ng th&aacute;o rời vệ sinh.</p>\r\n\r\n<p><img alt=\"Khay hứng nước thừa của máy pha cà phê Zamboo ZB-68CF\" src=\"https://st.meta.vn/Data/image/2023/11/13/may-pha-ca-phe-espresso-zamboo-zb-68cf-5.jpg\" style=\"height:450px; width:600px\" title=\"Khay hứng nước thừa của máy pha cà phê Zamboo ZB-68CF\" /></p>\r\n\r\n<p><strong>Lưu &yacute;:</strong>&nbsp;H&igrave;nh ảnh sản phẩm chỉ c&oacute; t&iacute;nh chất minh họa, chi tiết sản phẩm, m&agrave;u sắc c&oacute; thể thay đổi t&ugrave;y theo sản phẩm thực tế.</p>', 0.00, 0.00, 0.00, 0.00, 'PCP02', 'instock', 1, '1744382353.webp', '1744382353-1.webp,1744382353-2.webp,1744382353-3.webp,1744382353-4.webp', 4, 6, '2025-04-11 14:39:14', '2025-04-11 14:52:53', 1, 0, NULL, NULL),
(38, 'Bình đun siêu tốc Sunhouse 1.5 lít SHD1057', 'binh-dun-sieu-toc-sunhouse-15-lit-shd1057', NULL, '<p><img alt=\"binh-dun-sieu-toc-sunhouse-1-5l-shd1057-1\" src=\"https://cdn.nguyenkimmall.com/images/thumbnails/696/522/detailed/505/10035662-binh-dun-sieu-toc-sunhouse-1-5l-shd1057-1.jpg\" style=\"height:522px; width:696px\" /></p>\r\n\r\n<table>\r\n	<caption>Th&ocirc;ng số kỹ thuật</caption>\r\n	<tbody>\r\n		<tr>\r\n			<td>Model:</td>\r\n			<td>SHD1057</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u sắc:</td>\r\n			<td>Bạc Inox</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Nh&agrave; sản xuất:</td>\r\n			<td>Sunhouse</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất xứ:</td>\r\n			<td>Trung Quốc</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Năm ra mắt :</td>\r\n			<td>Đang cập nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Thời gian bảo h&agrave;nh:</td>\r\n			<td>12 Th&aacute;ng</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Địa điểm bảo h&agrave;nh:</td>\r\n			<td>Nguyễn Kim</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dung t&iacute;ch ấm - b&igrave;nh:</td>\r\n			<td>1.5 L&iacute;t</td>\r\n		</tr>\r\n		<tr>\r\n			<td>C&ocirc;ng suất:</td>\r\n			<td>1500 W</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất liệu ruột b&igrave;nh:</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><a href=\"javascript:void(0)\" id=\"productSpecification_viewFull\">Xem th&ecirc;m th&ocirc;ng số kỹ thuật</a></p>\r\n\r\n<h3>Đun s&ocirc;i nước nhanh hơn, thiết kế nhỏ gọn, dễ d&agrave;ng vệ sinh</h3>\r\n\r\n<p><strong>B&igrave;nh đun si&ecirc;u tốc Sunhouse 1.5 l&iacute;t SHD1057&nbsp;</strong>được l&agrave;m bằng chất liệu inox c&oacute; độ bền cao v&agrave; kh&ocirc;ng g&acirc;y hại cho sức khỏe của người d&ugrave;ng, &iacute;t hao ph&iacute; điện năng gi&uacute;p bạn tiết kiệm hơn. Kết hợp với tay cầm bằng nhựa c&aacute;ch nhiệt tốt, đảm bảo an to&agrave;n khi sử dụng. Nắp bật dễ sử dụng cũng như&nbsp;<a href=\"https://www.nguyenkim.com/meo-nho-giup-lam-sach-can-trong-am-nuoc-sieu-toc.html\" rel=\"noopener noreferrer\" target=\"_blank\">vệ sinh</a>.</p>\r\n\r\n<p><img alt=\"ẤM SIÊU TỐC SUNHOUSE SHD1057\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/gia-dung/Am-nuoc-binh-nuoc/Sunhouse/am-sieu-toc-inox-sunhouse-shd1057-1_1.jpg\" style=\"width:100%\" /></p>\r\n\r\n<h3>Tự ngắt điện an to&agrave;n</h3>\r\n\r\n<p><a href=\"https://www.nguyenkim.com/am-sieu-toc-goldsun/\">Ấm si&ecirc;u tốc Goldsun</a>&nbsp;được trang bị t&iacute;nh năng tự ngắt điện khi nước đ&atilde; được đun s&ocirc;i kết hợp c&ugrave;ng đ&egrave;n LED tự động bật/tắt gi&uacute;p ngăn chặn hiện tượng ch&aacute;y nổ, an to&agrave;n khi sử dụng trong gia đ&igrave;nh. B&ecirc;n cạnh đ&oacute;, chức năng n&agrave;y đồng thời gi&uacute;p l&agrave;m tăng tuổi thọ sản phẩm v&agrave; ph&ograve;ng chống ch&aacute;y nổ.</p>\r\n\r\n<p><img alt=\"Ấm siêu tốc Goldsun EK-GBB1218S1 tiết kiêmj điện năng\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/gia-dung/Am-nuoc-binh-nuoc/Sunhouse/am-sieu-toc-inox-sunhouse-shd1057-1.jpg\" style=\"width:100%\" /></p>\r\n\r\n<p><img alt=\"Ấm siêu tốc Goldsun EK-GBB1218S1 đế xoay 360 độ\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/gia-dung/binh-dun/sunhouse/am-sieu-toc-inox-sunhouse-shd1057-5.jpg\" style=\"width:100%\" /></p>\r\n\r\n<h3>Đ&egrave;n LED tự động b&aacute;o hiệu bật/tắt</h3>\r\n\r\n<p>Đ&egrave;n s&aacute;ng đỏ từ khi bắt đầu cho đến khi kết th&uacute;c qu&aacute; tr&igrave;nh đun s&ocirc;i nước, để bạn dễ d&agrave;ng nhận biết nước đ&atilde; s&ocirc;i hay chưa m&agrave; kh&ocirc;ng cần mở nắp&nbsp;<a href=\"https://www.nguyenkim.com/gia-dung/\" rel=\"noopener noreferrer\" target=\"_blank\">thiết bị</a>.</p>\r\n\r\n<h3>C&ocirc;ng suất mạnh mẽ</h3>\r\n\r\n<p>B&igrave;nh đun si&ecirc;u tốc Sunhouse 1.5 l&iacute;t SHD1057 c&oacute; c&ocirc;ng suất 1500W gi&uacute;p đun s&ocirc;i 1.5l nước trong thời gian nhanh ch&oacute;ng, chỉ trong 4 &ndash; 6 ph&uacute;t. B&ecirc;n cạnh đ&oacute;, việc đun s&ocirc;i nhanh cũng gi&uacute;p bạn tiết kiệm thời gian v&agrave; điện năng tối đa.</p>\r\n\r\n<p><img alt=\"Ấm siêu tốc Goldsun EK-GBB1218S1 công suất cao\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/gia-dung/Am-nuoc-binh-nuoc/Sunhouse/am-sieu-toc-inox-sunhouse-shd1057-2.jpg\" style=\"width:100%\" /></p>\r\n\r\n<p><img alt=\"Ấm siêu tốc Goldsun EK-GBB1218S1 đế xoay 360 độ\" src=\"https://cdn.nguyenkimmall.com/images/companies/_1/Content/gia-dung/Am-nuoc-binh-nuoc/%E1%BA%A5m%20si%C3%AAu%20t%E1%BB%91c%20goldsun%20gs%20ek-gf1836s/am-sieu-toc-sunhouse-shd1057-5.jpg\" style=\"width:100%\" /></p>\r\n\r\n<h3>Đế xoay 360 độ</h3>\r\n\r\n<p>Đế tiếp điện được thiết kế tiện lợi t&aacute;ch rời khỏi th&acirc;n ấm, gi&uacute;p việc đổ nước &ndash; tiếp nước dễ d&agrave;ng, linh hoạt.&nbsp;<a href=\"https://www.nguyenkim.com/am-nuoc-binh-nuoc/\" rel=\"noopener noreferrer\" target=\"_blank\">Chiếc ấm si&ecirc;u tốc</a>&nbsp;c&oacute; đế tiếp điện được thiết kế độc lập, c&oacute; thể xoay 360 độ,người d&ugrave;ng c&oacute; thể đặt ấm l&ecirc;n hay nhấc ấm ra khỏi đế ở bất cứ g&oacute;c n&agrave;o m&agrave; kh&ocirc;ng phải lo lắng đến vấn đề phải đặt sao cho khớp.</p>', 210000.00, 178500.00, 90000.00, 15.00, 'DST01', 'instock', 1, '1744810037.webp', '1744810037-1.webp,1744810037-2.webp,1744810037-3.webp,1744810037-4.webp,1744810037-5.webp', 2, 5, '2025-04-16 13:27:19', '2025-04-16 13:27:19', 0, 100, 'Bạc', '1.5 Lít'),
(39, 'Nồi lẩu điện Comet 3.5 lít CM7731', 'noi-lau-dien-comet-3.5-lit-cm7731', NULL, '<h2>&nbsp;</h2>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:14px\">Lưu &yacute;: Sản phẩm c&oacute; 2 m&agrave;u, giao m&agrave;u ngẫu nhi&ecirc;n</span></li>\r\n	<li><span style=\"font-size:14px\">Dung t&iacute;ch 3.5 l&iacute;t, c&ocirc;ng suất 1300W gi&uacute;p nấu lẩu nhanh ch&oacute;ng</span></li>\r\n	<li><span style=\"font-size:14px\">L&ograve;ng nồi chống d&iacute;nh cho sức n&oacute;ng được trải đều v&agrave; dễ vệ sinh</span></li>\r\n	<li><span style=\"font-size:14px\">Nắp nồi bằng thủy tinh trong suốt dễ quan s&aacute;t</span></li>\r\n	<li><span style=\"font-size:14px\">N&uacute;t điều khiển dạng k&eacute;o trượt dễ thao t&aacute;c</span></li>\r\n	<li><span style=\"font-size:14px\">Nồi điện đa năng&nbsp;với nhiều chức năng nấu nướng</span></li>\r\n</ul>', 0.00, 0.00, 0.00, NULL, 'NLD01', 'instock', 1, '1744810388.webp', '1744810388-1.webp,1744810388-2.webp,1744810388-3.webp,1744810388-4.webp,1744810388-5.webp', 2, 7, '2025-04-16 13:33:09', '2025-04-16 13:33:09', 1, 0, NULL, NULL),
(40, 'Ca nấu mì đa năng Daewoo DEN-M550', 'ca-nau-mi-da-nang-daewoo-den-m550', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">C&ocirc;ng suất 550W mạnh mẽ</span></li>\r\n	<li><span style=\"font-size:14px\">Dung t&iacute;ch 700ml tiện dụng</span></li>\r\n	<li><span style=\"font-size:14px\">Bảo h&agrave;nh 12 th&aacute;ng ch&iacute;nh h&atilde;ng</span></li>\r\n	<li><span style=\"font-size:14px\">C&oacute; thể nấu m&igrave;, nấu canh, nước s&ocirc;i nhanh ch&oacute;ng</span></li>\r\n	<li><span style=\"font-size:14px\">C&oacute; quai cầm tiện lợi c&ugrave;ng nắp vung k&iacute;nh dễ quan s&aacute;t</span></li>\r\n</ul>', 349000.00, 349000.00, 200000.00, 0.00, 'CNM01', 'instock', 1, '1744810511.webp', '1744810511-1.webp', 2, 9, '2025-04-16 13:35:11', '2025-04-16 13:35:11', 0, 30, 'Trắng', '700ml'),
(41, 'Nồi lẩu điện Sunhouse 3.5 lít SHD4523', 'noi-lau-dien-sunhouse-3.5-lit-shd4523', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">Nồi lẩu điện Sunhouse&nbsp;thiết kế nhỏ gọn, nắp thủy tinh trong suốt dễ quan s&aacute;t thực phẩm b&ecirc;n trong</span></li>\r\n	<li><span style=\"font-size:14px\">L&ograve;ng nồi được tr&aacute;ng một lớp chống d&iacute;nh Whitford (USA) an to&agrave;n, dễ vệ sinh</span></li>\r\n	<li><span style=\"font-size:14px\">Nồi điện đa năng&nbsp;ngo&agrave;i d&ugrave;ng nấu lẩu c&ograve;n c&oacute; thể x&agrave;o, r&aacute;n, hầm, rất tiện dụng</span></li>\r\n	<li><span style=\"font-size:14px\">L&agrave;m n&oacute;ng nhanh, tỏa nhiệt đều nhờ m&acirc;m nhiệt c&oacute; cấu tạo một v&ograve;ng trở nhiệt 1300W</span></li>\r\n	<li><span style=\"font-size:14px\">C&aacute;c bộ phận nồi c&oacute; thể th&aacute;o lắp n&ecirc;n việc vệ sinh, lau ch&ugrave;i rất đơn giản v&agrave; nhẹ nh&agrave;ng</span></li>\r\n</ul>', 770000.00, 731500.00, 450000.00, 5.00, 'NLD02', 'instock', 1, '1744810618.webp', '1744810618-1.webp,1744810618-2.webp', 2, 5, '2025-04-16 13:36:58', '2025-04-16 13:36:58', 0, 18, 'Đen', '3.5 lít'),
(42, 'Nồi lẩu điện Happy Cook HCHP-350ST 3.5 lít', 'noi-lau-dien-happy-cook-hchp-350st-3.5-lit', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">T&ugrave;y chỉnh nhiệt độ bằng n&uacute;m vặn</span></li>\r\n	<li><span style=\"font-size:14px\">Nồi điện đa năng&nbsp;nấu ăn nhanh tiết kiệm điện hiệu quả</span></li>\r\n	<li><span style=\"font-size:14px\">Thiết kế tiện &iacute;ch với nắp k&iacute;nh trong suốt</span></li>\r\n	<li><span style=\"font-size:14px\">Tay cầm v&agrave; quai n&uacute;m bọc nhựa c&aacute;ch nhiệt an to&agrave;n</span></li>\r\n	<li><span style=\"font-size:14px\">Điều chỉnh nhiệt độ bằng n&uacute;m vặn đơn giản</span></li>\r\n	<li><span style=\"font-size:14px\">Thiết kế đơn giản, m&agrave;u sắc nh&atilde; nhặn</span></li>\r\n</ul>', 630000.00, 630000.00, 400000.00, 0.00, 'NLD03', 'instock', 1, '1744810763.webp', '1744810763-1.webp,1744810763-2.webp', 2, 8, '2025-04-16 13:39:24', '2025-04-16 13:39:24', 0, 20, 'Bạc', '3.5 lít'),
(43, 'Nồi lẩu hấp đa năng Perfect PF-LH12', 'noi-lau-hap-da-nang-perfect-pf-lh12', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">Dung t&iacute;ch của&nbsp;nồi lẩu điện&nbsp;l&agrave; 2 l&iacute;t nấu được nhiều thực phẩm hơn</span></li>\r\n	<li><span style=\"font-size:14px\">C&ocirc;ng suất 700W gi&uacute;p l&agrave;m ch&iacute;n thực phẩm nhanh ch&oacute;ng</span></li>\r\n	<li><span style=\"font-size:14px\">Đa dạng chế độ với mức hẹn giờ gợi &yacute; cho bạn t&ugrave;y chỉnh dễ d&agrave;ng</span></li>\r\n	<li><span style=\"font-size:14px\">2 tầng hấp, lẩu kết hợp tối đa h&oacute;a nhu cầu v&agrave; mục đ&iacute;ch sử dụng</span></li>\r\n	<li><span style=\"font-size:14px\">Dung t&iacute;ch tổng thể nồi hấp 20 l&iacute;t gi&uacute;p hấp được nhiều thực phẩm c&ugrave;ng l&uacute;c</span></li>\r\n	<li><span style=\"font-size:14px\">Nhiệt tập trung v&agrave; đối lưu đều 360&deg; r&uacute;t ngắn thời gian hấp v&agrave; giữ trọn m&ugrave;i vị tươi ngon</span></li>\r\n	<li><span style=\"font-size:14px\">C&oacute; ngăn thu nước từ thực phẩm giữ nguy&ecirc;n hương vị của m&oacute;n ăn</span></li>\r\n	<li><span style=\"font-size:14px\">Hấp ph&acirc;n tầng, hấp c&aacute;ch thuỷ, vừa giữ trọn dinh dưỡng, vừa kh&ocirc;ng lẫn m&ugrave;i</span></li>\r\n	<li><span style=\"font-size:14px\">Nắp k&iacute;nh k&iacute;n hơi, nhiệt đối lưu gi&uacute;p hấp nhanh ch&oacute;ng tiết kiệm thời gian</span></li>\r\n	<li><span style=\"font-size:14px\">Tr&ecirc;n hấp, dưới nấu ch&aacute;o hầm xương t&iacute;ch hợp v&ocirc; c&ugrave;ng tiện lợi</span></li>\r\n	<li><span style=\"font-size:14px\">Ngo&agrave;i ra, khay ri&ecirc;ng t&aacute;ch rời c&oacute; thể nấu lẩu, &aacute;p chảo tiệc sum họp bao sang trọng tiện lợi</span></li>\r\n	<li><span style=\"font-size:14px\">L&ograve;ng nồi &aacute;p chảo - nấu lẩu phủ men chống d&iacute;nh Ceramic, khay hấp inox, l&ograve;ng hấp nhựa PC&nbsp;</span></li>\r\n	<li><span style=\"font-size:14px\">C&oacute; thể th&ocirc;ng tầng để hấp g&agrave; c&aacute;nh ti&ecirc;n, c&aacute;c m&oacute;n cao tần,...</span></li>\r\n</ul>', 0.00, 0.00, 0.00, NULL, 'NLH01', 'instock', 1, '1744810950.webp', '1744810950-1.webp,1744810950-2.webp,1744810950-3.webp,1744810950-4.webp,1744810950-5.webp', 2, 10, '2025-04-16 13:42:31', '2025-04-16 13:42:31', 1, 0, NULL, NULL),
(44, 'Bếp hồng ngoại đơn Perfect PF-BH82', 'bếp-hồng-ngoại-dơn-perfect-pf-bh82', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">Bếp hồng ngoại&nbsp;thiết kế tối giản 1 v&ugrave;ng bếp, gọn nhẹ kh&ocirc;ng chiếm nhiều diện t&iacute;ch</span></li>\r\n	<li><span style=\"font-size:14px\">Th&iacute;ch hợp d&ugrave;ng cho gia đ&igrave;nh, qu&aacute;n ăn c&oacute; phục vụ lẩu, m&oacute;n ăn n&oacute;ng trực tiếp</span></li>\r\n	<li><span style=\"font-size:14px\">Mặt k&iacute;nh cường lực pha l&ecirc; chịu nhiệt, thẩm mỹ cao dễ d&agrave;ng lau ch&ugrave;i vệ sinh</span></li>\r\n	<li><span style=\"font-size:14px\">C&ocirc;ng suất 2200W gi&uacute;p l&agrave;m n&oacute;ng nhanh đi k&egrave;m nhiều chế độ nấu sẵn tiện lợi</span></li>\r\n	<li><span style=\"font-size:14px\">Bảng điều khiển cảm ứng si&ecirc;u nhạy, chế độ hẹn giờ tiện dụng cho bạn nấu nướng</span></li>\r\n</ul>', 690000.00, 690000.00, 555000.00, 0.00, 'BHN01', 'instock', 1, '1744811194.webp', '1744811194-1.webp,1744811194-2.webp,1744811194-3.webp', 1, 8, '2025-04-16 13:46:35', '2025-04-16 13:46:35', 0, 320, 'Đen', '33.8cm x 460cm'),
(45, 'Bếp hồng ngoại đơn Perfect PF-BH86', 'bep-hong-ngoai-don-perfect-pf-bh82', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">Bếp hồng ngoại&nbsp;thiết kế tinh giản 1 v&ugrave;ng bếp, gọn nhẹ kh&ocirc;ng chiếm nhiều diện t&iacute;ch&nbsp;</span></li>\r\n	<li><span style=\"font-size:14px\">Th&iacute;ch hợp d&ugrave;ng cho gia đ&igrave;nh, qu&aacute;n ăn c&oacute; phục vụ lẩu, m&oacute;n ăn n&oacute;ng trực tiếp</span></li>\r\n	<li><span style=\"font-size:14px\">Mặt k&iacute;nh Ceramic s&aacute;ng b&oacute;ng, chịu nhiệt, thẩm mỹ cao dễ d&agrave;ng lau ch&ugrave;i vệ sinh</span></li>\r\n	<li><span style=\"font-size:14px\">C&ocirc;ng suất 2200W gi&uacute;p l&agrave;m n&oacute;ng nhanh đi k&egrave;m nhiều chế độ nấu sẵn tiện lợi</span></li>\r\n	<li><span style=\"font-size:14px\">Bảng điều khiển cảm ứng si&ecirc;u nhạy, chế độ hẹn giờ tiện dụng cho bạn nấu nướng</span></li>\r\n</ul>', 500000.00, 400000.00, 355000.00, 20.00, 'BHN02', 'instock', 1, '1744811390.webp', '1744811390-1.webp,1744811390-2.webp,1744811390-3.webp,1744811390-4.webp', 1, 8, '2025-04-16 13:49:50', '2025-04-16 13:49:50', 0, 30, 'Đồng ánh kim', '32cm x 450cm'),
(46, 'Bếp từ đơn Bear DCL-A22Q5', 'bep-tu-don-bear-dcl-a22q5', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">Bếp điện đơn c&oacute; k&iacute;ch thước nhỏ gọn, thiết kế trẻ trung, thời thượng</span></li>\r\n	<li><span style=\"font-size:14px\">Bếp đa năng, d&ugrave;ng chi&ecirc;n, x&agrave;o, hầm, nấu lẩu,... v&ocirc; c&ugrave;ng tiện lợi</span></li>\r\n	<li><span style=\"font-size:14px\">Tổng c&ocirc;ng suất 2000W với nhiều v&ugrave;ng nấu cho bạn nấu nhiều m&oacute;n c&ugrave;ng l&uacute;c</span></li>\r\n	<li><span style=\"font-size:14px\">Mặt bếp được l&agrave;m từ k&iacute;nh chịu nhiệt cao đảm bảo an to&agrave;n khi d&ugrave;ng</span></li>\r\n	<li><span style=\"font-size:14px\">Điều khiển cảm ứng v&agrave; n&uacute;t vặn tiện t&ugrave;y chỉnh c&aacute;c chức năng kh&aacute;c nhau</span></li>\r\n	<li><span style=\"font-size:14px\">Hệ thống tản nhiệt đa chiều gi&uacute;p giảm tiếng ồn khi bếp hoạt động</span></li>\r\n</ul>', 0.00, 0.00, 0.00, NULL, 'BTD01', 'instock', 1, '1744811606.webp', '1744811606-1.webp,1744811606-2.webp,1744811606-3.webp,1744811606-4.webp', 1, 9, '2025-04-16 13:53:27', '2025-04-16 13:53:27', 1, 0, NULL, NULL),
(47, 'Túi thực phẩm Inochi Shinsen 1.4L', 'tui-thuc-pham-inochi-shinsen-1.4l', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">K&iacute;ch thước t&uacute;i: 180 x 280 mm&nbsp;</span></li>\r\n	<li><span style=\"font-size:14px\">Sử dụng ở nhiệt độ -40&deg;C đến 100&deg;C</span></li>\r\n	<li><span style=\"font-size:14px\">120 t&uacute;i/cuộn thoải m&aacute;i sử dụng</span></li>\r\n	<li><span style=\"font-size:14px\">Kh&ocirc;ng đựng chất lỏng, buộc k&iacute;n miệng t&uacute;i trước khi để v&agrave;o t&uacute;i lạnh</span></li>\r\n	<li><span style=\"font-size:14px\">Được sản xuất theo ti&ecirc;u chuẩn Ch&acirc;u &Acirc;u</span></li>\r\n	<li><span style=\"font-size:14px\">Sản phẩm dẻo dai, co gi&atilde;n tốt v&agrave; kh&oacute; r&aacute;ch</span></li>\r\n	<li><span style=\"font-size:14px\">Th&agrave;nh phần nhựa an to&agrave;n,&nbsp;kh&ocirc;ng chứa Chiorine v&agrave; bất kỳ chất phụ gia n&agrave;o</span></li>\r\n</ul>', 25000.00, 19500.00, 9000.00, 22.00, 'TTP01', 'instock', 1, '1744811773.webp', '1744811773-1.webp', 3, 5, '2025-04-16 13:56:13', '2025-04-16 13:56:13', 0, 200, 'Trắng trong', '4.7cm x 4.7cm x 18cm'),
(48, 'Lốc 20 đôi đũa tre tròn Spriing dùng 1 lần', 'loc-20-doi-dua-tre-tron-spring-dung-1-lan', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">D&ugrave;ng để gắp thức ăn, sử dụng 1 lần v&ocirc; c&ugrave;ng tiện lợi&nbsp;</span></li>\r\n	<li><span style=\"font-size:14px\">Gỗ tre, 1 lốc 20 đ&ocirc;i, sử dụng thoải m&aacute;i</span></li>\r\n</ul>', 12000.00, 10080.00, 7000.00, 16.00, 'Dua01', 'instock', 1, '1744811922.webp', '1744811922-1.webp', 3, 4, '2025-04-16 13:58:42', '2025-04-16 13:58:42', 0, 50, 'Vàng', '20cm'),
(49, 'Muỗng xới cơm chống dính Sendai', 'muong-xoi-com-chong-dinh-sendai', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">Th&agrave;nh phần nhựa PP nguy&ecirc;n sinh, hạt m&agrave;u, phụ gia kh&aacute;ng khuẩn (Ag+)</span></li>\r\n	<li><span style=\"font-size:14px\">C&oacute; khả năng chống d&iacute;nh, an to&agrave;n cho sức khỏe</span></li>\r\n	<li><span style=\"font-size:14px\">Dễ d&agrave;ng vệ sinh sau khi sử dụng</span></li>\r\n	<li><span style=\"font-size:14px\">Thiết kế nhỏ gọn dễ cầm nắm khi d&ugrave;ng</span></li>\r\n</ul>', 0.00, 0.00, 0.00, NULL, 'K03', 'instock', 1, '1744812074.webp', '1744812074-1.webp,1744812074-2.webp,1744812074-3.webp,1744812074-4.webp', 3, 5, '2025-04-16 14:01:14', '2025-04-16 14:01:14', 1, 0, NULL, NULL),
(50, 'Khăn lau bếp Kinkit 18x24 cm', 'khan-lau-bep-kinkit-18x24-cm', NULL, '<ul>\r\n	<li><span style=\"font-size:14px\">Giặt trước khi sử dụng lần đầu v&ograve; nhẹ ở nhiệt độ dưới 40 độ C</span></li>\r\n	<li><span style=\"font-size:14px\">Lưu &yacute;: Kh&ocirc;ng sử dụng bột giặt c&oacute; chất l&agrave;m trắng hoặc thuốc tẩy</span></li>\r\n	<li><span style=\"font-size:14px\">Kh&ocirc;ng ch&agrave; s&aacute;t hay vắt qu&aacute; mạnh, kh&ocirc;ng được l&agrave; ủi</span></li>\r\n	<li><span style=\"font-size:14px\">Chất liệu 80% Polyester, 20% Polyamide</span></li>\r\n	<li><span style=\"font-size:14px\">K&iacute;ch thước&nbsp;180*240mm cho bạn tiện lau ch&ugrave;i</span></li>\r\n</ul>', 21000.00, 20370.00, 12000.00, 3.00, 'K04', 'instock', 1, '1744812228.webp', '1744812228-1.webp', 3, 5, '2025-04-16 14:03:49', '2025-04-16 14:03:49', 0, 100, 'Vàng đậm', '18cm x 24cm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT 0,
  `SKU` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `import_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `regular_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `sale_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `sale` decimal(5,2) DEFAULT 0.00 COMMENT 'Giảm giá (%)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `size`, `color`, `quantity`, `SKU`, `created_at`, `updated_at`, `import_price`, `regular_price`, `sale_price`, `sale`) VALUES
(27, 34, '3.8 lít', 'Trắng', 50, 'NCD01-3.8 lít-trắng', '2025-04-11 09:27:47', '2025-04-11 09:27:47', 500000.00, 800000.00, 760000.00, 5.00),
(28, 34, '5 lít', 'Trắng', 40, 'NCD01-5 lít-trắng', '2025-04-11 09:27:47', '2025-04-11 09:27:47', 700000.00, 1200000.00, 1200000.00, 0.00),
(29, 34, '7 lít', 'Trắng', 20, 'NCD01-7 lít-trắng', '2025-04-11 09:27:47', '2025-04-11 09:27:47', 1200000.00, 1500000.00, 1350000.00, 10.00),
(30, 37, '240ml', 'Trắng', 10, 'PCP02-240ml-trắng', '2025-04-11 14:39:14', '2025-04-11 14:52:53', 700000.00, 1300000.00, 1040000.00, 20.00),
(31, 37, '240ml', 'Xanh lá', 23, 'PCP02-240ml-xanh lá', '2025-04-11 14:39:14', '2025-04-11 14:52:53', 700000.00, 1300000.00, 1170000.00, 10.00),
(32, 39, '3.5 lít', 'Đen', 20, 'NLD01-3.5 lít-Đen', '2025-04-16 13:33:09', '2025-04-16 13:33:09', 290000.00, 450000.00, 450000.00, 0.00),
(33, 39, '3.5 lít', 'Trắng', 20, 'NLD01-3.5 lít-trắng', '2025-04-16 13:33:09', '2025-04-16 13:33:09', 290000.00, 450000.00, 450000.00, 0.00),
(34, 43, '20 lít', 'Trắng', 30, 'NLH01-20 lít-trắng', '2025-04-16 13:42:31', '2025-04-16 13:42:31', 420000.00, 690000.00, 676200.00, 2.00),
(35, 43, '20 lít', 'Đen', 30, 'NLH01-20 lít-Đen', '2025-04-16 13:42:31', '2025-04-16 13:42:31', 420000.00, 690000.00, 676200.00, 2.00),
(36, 46, '25cm x 38.5cm x 6.9cm', 'Đồng ánh kim', 40, 'BTD01-25cm x 38.5cm x 6.9cm-Đồng ánh kim', '2025-04-16 13:53:27', '2025-04-16 13:53:27', 800000.00, 1500000.00, 1440000.00, 4.00),
(37, 46, '25cm x 38.5cm x 6.9cm', 'Đen', 40, 'BTD01-25cm x 38.5cm x 6.9cm-Đen', '2025-04-16 13:53:27', '2025-04-16 13:53:27', 800000.00, 1500000.00, 1440000.00, 4.00),
(38, 49, '20.2cm x 7.3cm x 1.3 cm', 'Trắng', 50, 'K03-20.2cm x 7.3cm x 1.3 cm-trắng', '2025-04-16 14:01:14', '2025-04-16 14:01:14', 6000.00, 18000.00, 18000.00, 0.00),
(39, 49, '20.2cm x 7.3cm x 1.3 cm', 'Xanh nhạt', 50, 'K03-20.2cm x 7.3cm x 1.3 cm-xanh nhạt', '2025-04-16 14:01:14', '2025-04-16 14:01:14', 6000.00, 18000.00, 18000.00, 0.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tỉnh thành';

--
-- Đang đổ dữ liệu cho bảng `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(1, 'Hà Nội'),
(2, 'Hà Giang'),
(3, 'Cao Bằng'),
(4, 'Bắc Kạn'),
(5, 'Tuyên Quang'),
(6, 'Lào Cai'),
(7, 'Điện Biên'),
(8, 'Lai Châu'),
(9, 'Sơn La'),
(10, 'Yên Bái'),
(11, 'Hoà Bình'),
(12, 'Thái Nguyên'),
(13, 'Lạng Sơn'),
(14, 'Quảng Ninh'),
(15, 'Bắc Giang'),
(16, 'Phú Thọ'),
(17, 'Vĩnh Phúc'),
(18, 'Bắc Ninh'),
(19, 'Hải Dương'),
(20, 'Hải Phòng'),
(21, 'Hưng Yên'),
(22, 'Thái Bình'),
(23, 'Hà Nam'),
(24, 'Nam Định'),
(25, 'Ninh Bình'),
(26, 'Thanh Hóa'),
(27, 'Nghệ An'),
(28, 'Hà Tĩnh'),
(29, 'Quảng Bình'),
(30, 'Quảng Trị'),
(31, 'Thừa Thiên Huế'),
(32, 'Đà Nẵng'),
(33, 'Quảng Nam'),
(34, 'Quảng Ngãi'),
(35, 'Bình Định'),
(36, 'Phú Yên'),
(37, 'Khánh Hòa'),
(38, 'Ninh Thuận'),
(39, 'Bình Thuận'),
(40, 'Kon Tum'),
(41, 'Gia Lai'),
(42, 'Đắk Lắk'),
(43, 'Đắk Nông'),
(44, 'Lâm Đồng'),
(45, 'Bình Phước'),
(46, 'Tây Ninh'),
(47, 'Bình Dương'),
(48, 'Đồng Nai'),
(49, 'Bà Rịa - Vũng Tàu'),
(50, 'Hồ Chí Minh'),
(51, 'Long An'),
(52, 'Tiền Giang'),
(53, 'Bến Tre'),
(54, 'Trà Vinh'),
(55, 'Vĩnh Long'),
(56, 'Đồng Tháp'),
(57, 'An Giang'),
(58, 'Kiên Giang'),
(59, 'Cần Thơ'),
(60, 'Hậu Giang'),
(61, 'Sóc Trăng'),
(62, 'Bạc Liêu'),
(63, 'Cà Mau');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `batch_code` varchar(255) NOT NULL,
  `imported_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `import_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `search_histories`
--

CREATE TABLE `search_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `search_histories`
--

INSERT INTO `search_histories` (`id`, `user_id`, `keyword`, `created_at`, `updated_at`) VALUES
(1, 4, 'Máy pha cà phê', '2025-04-13 13:46:20', '2025-04-13 13:46:20'),
(2, 4, 'Máy pha cà phê', '2025-04-13 13:48:37', '2025-04-13 13:48:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7p5zhVolTNpFdJd6vuuCQeoUpzR9RM6756IJTy15', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiMnBQYTNDOGZON0NWMVlkMzdzS0RDbEdwNmJmUzVnVFluTjJpV0hhYyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM4OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vaW1wb3J0L2FkZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ1MTM2MzU5O319', 1745155060);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`id`, `tagline`, `title`, `subtitle`, `link`, `image`, `status`, `created_at`, `updated_at`) VALUES
(4, 'test111', 'test', 'test subtitle', 'http://localhost:8000/shop', '1742634981.jpg', '1', '2025-03-22 09:16:22', '2025-03-23 08:55:04'),
(5, 'test', '112', '1222', 'http://localhost:8000/shop', '1742719301.jpg', '1', '2025-03-23 08:41:42', '2025-03-23 08:41:42'),
(6, 'banner1', 'mmm', 'test subtitle', 'http://localhost:8000/shop', '1742719430.jpg', '0', '2025-03-23 08:43:50', '2025-03-27 18:13:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `mode` enum('cod','bank_transfer','paypal') NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `order_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES
(17, 4, 21, 'cod', 'pending', '2025-04-13 09:44:38', '2025-04-13 09:44:38'),
(18, 4, 22, 'cod', 'pending', '2025-04-13 10:06:09', '2025-04-13 10:06:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'USR' COMMENT 'ADM for Admin and USR for User or Customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `avatar`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'testadmin@gmail.com', '0987654321', NULL, '$2y$12$iDUU1orS6MbIy2pF0woTiOA8ZKfCRRbpQTl2rgu8HqMg8eDX7iuGm', '', 'ADM', NULL, '2025-03-13 10:12:54', '2025-03-13 10:12:54'),
(3, 'DNAT', 'at@gmail.com', '0987654433', NULL, '$2y$12$FGkh1jpyqLM7Uy7PGN5HAubVUmumQA0Gvovp7Mz/0pT7mw5nPagte', 'avatars/bBevkMOE2BoGAAb0dEAlMgaOglciYNK0c3XFnowI.jpg', 'USR', NULL, '2025-04-01 21:12:59', '2025-04-01 21:12:59'),
(4, 'An Thuận', 'anti1@gmail.com', '0998765435', NULL, '$2y$12$KdsvCyZwzJdejaqsKhPSl.aT1diaMSmjKQEZI.bIMKxGc/XjSFCum', 'uploads/avatars/1744550193_dmx.jpg', 'USR', NULL, '2025-04-01 21:27:35', '2025-04-13 13:17:23'),
(5, 'Người dùng 1', 'nguoidung@gmail.com', '0987654435', NULL, '$2y$12$bB1JV511IzDz9sJ0urpJqulHPy64ABDSsNskjZt1Dpu3xPBJnsw2q', 'uploads/avatars/1744862712_bep.jpg', 'USR', NULL, '2025-04-17 04:04:26', '2025-04-17 04:05:12');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `province_id` (`province_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `producers`
--
ALTER TABLE `producers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `producers_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_producer_id_foreign` (`producer_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `SKU` (`SKU`),
  ADD KEY `fk_product` (`product_id`);

--
-- Chỉ mục cho bảng `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `purchase_order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `search_histories`
--
ALTER TABLE `search_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=698;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT cho bảng `producers`
--
ALTER TABLE `producers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `search_histories`
--
ALTER TABLE `search_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_producer_id_foreign` FOREIGN KEY (`producer_id`) REFERENCES `producers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD CONSTRAINT `purchase_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `search_histories`
--
ALTER TABLE `search_histories`
  ADD CONSTRAINT `search_histories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
