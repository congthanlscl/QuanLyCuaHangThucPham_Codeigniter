-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 11, 2021 lúc 09:05 PM
-- Phiên bản máy phục vụ: 5.7.34-0ubuntu0.18.04.1
-- Phiên bản PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `QuanLyBanHang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_article`
--

CREATE TABLE `tbl_article` (
  `article_id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `slug` varchar(200) NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_bill`
--

CREATE TABLE `tbl_bill` (
  `bill_id` varchar(11) NOT NULL,
  `customer_name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `customer_address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_bill`
--

INSERT INTO `tbl_bill` (`bill_id`, `customer_name`, `customer_phone`, `customer_address`, `create_time`, `notes`, `status`, `user_id`) VALUES
('ORD-0000002', 'Dương Công Thần', '0329588215', 'Hà Nội đâsd', '2021-06-09 00:00:00', '', 1, 1),
('ORD-0000003', 'Dương Công Thần', '0329588215', 'Hà Nội đâsd', '2021-06-09 00:00:00', '', 1, 1),
('ORD-0000004', 'Dương Công Thần', '0329588215', 'Gia Lâm Hà Nội', '2021-06-09 00:00:00', 'Test coi sao', 2, 1),
('ORD-0000005', 'Dương Công Thần 2', '0329588215', 'Hà Nội', '2021-06-09 00:00:00', 'dsdasdasdasd', 2, 1),
('ORD-0000006', 'Dương Công Thần 4', '0329588215', 'Gia Lâm Hà Nội', '2021-06-09 00:00:00', 'Gửi nhanh nhé !', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_slug` varchar(500) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_categories`
--

INSERT INTO `tbl_categories` (`category_id`, `category_name`, `category_slug`, `create_time`, `update_time`) VALUES
(1, 'danh mục 1', 'danh-muc-1.html', '2021-03-11 07:41:48', '2021-03-21 00:00:00'),
(2, 'Danh mục 2', 'danh-muc-2.html', '2021-06-08 14:00:02', '2021-06-08 14:00:02'),
(3, 'Danh mục 3', 'danh-muc-3.html', '2021-06-08 14:00:13', '2021-06-08 14:00:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_address` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_name`, `customer_address`, `customer_phone`) VALUES
(1, 'Dương Công Thần', 'Hà Nội đâsd', '0329588215');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_groups`
--

CREATE TABLE `tbl_groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_groups`
--

INSERT INTO `tbl_groups` (`group_id`, `group_name`, `permission`) VALUES
(1, 'Admin', '[]');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_input`
--

CREATE TABLE `tbl_input` (
  `input_id` varchar(100) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_input`
--

INSERT INTO `tbl_input` (`input_id`, `provider_id`, `warehouse_id`, `create_time`) VALUES
('PC-00001', 1, 1, '2021-05-22 03:01:12'),
('PC-00002', 1, 1, '2021-05-22 03:50:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `inventory_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`inventory_id`, `stock`, `product_id`, `warehouse_id`, `create_time`) VALUES
(2, 23, 10, 1, '2021-05-22 00:00:00'),
(3, 0, 11, 1, '2021-06-08 00:00:00'),
(4, 0, 12, 1, '2021-06-08 00:00:00'),
(5, 0, 13, 1, '2021-06-08 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `bill_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `quantity`, `total`, `status`, `product_id`, `bill_id`) VALUES
(4, 3, 60000, '1', 10, 'ORD-0000002'),
(5, 1, 20000, '1', 10, 'ORD-0000003'),
(6, 1, 30150, '2', 11, 'ORD-0000004'),
(7, 1, 15300, '2', 13, 'ORD-0000004'),
(8, 1, 139000, '2', 12, 'ORD-0000005'),
(9, 1, 15300, '2', 13, 'ORD-0000006'),
(10, 1, 30150, '2', 11, 'ORD-0000006'),
(11, 1, 139000, '2', 12, 'ORD-0000006'),
(12, 3, 60000, '2', 10, 'ORD-0000006');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_permission`
--

CREATE TABLE `tbl_permission` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_slug` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `keyword` varchar(2000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `description`, `product_slug`, `price`, `purchase_price`, `discount`, `keyword`, `image`, `create_time`, `update_time`, `category_id`, `unit_id`, `tag_id`, `status`) VALUES
(10, 'Sản phẩm 1', '<p>&aacute;dasdasdasd</p>\n', 'san-pham-1.html', 20000, 5000, 0, 'ádasdadsd', '/images/products/2fcee4889b803f63e4b48689403cfd8c.jpg', '2021-05-22 01:32:59', '2021-05-22 01:32:59', 1, 2, 0, 1),
(11, 'Mận Mộc Châu Size Vip', '<p>Mận ngon</p>\n', 'man-moc-chau-size-vip.html', 45000, 15000, 33, 'mận', '/images/products/2a516d3c762acde64af26e057f14fb63.png', '2021-06-08 14:37:15', '2021-06-08 14:37:15', 2, 1, 0, 1),
(12, 'Vịt nuôi dân dã', '<p>Vịt ngon</p>\n', 'vit-nuoi-dan-da.html', 139000, 60000, 0, 'vịt', '/images/products/8abf974c5abe060074c60b0fd63fa1c4.jpg', '2021-06-08 14:41:11', '2021-06-08 14:41:11', 3, 1, 6, 1),
(13, 'Kem ốc quế vani hoa quả TT 125ml', '<p>Kem ngon</p>\n', 'kem-oc-que-vani-hoa-qua-tt-125ml.html', 17000, 10000, 10, 'kem', '/images/products/2e7d46edd34b4c08512a1515b973dc39.png', '2021-06-08 14:42:33', '2021-06-08 14:42:33', 1, 2, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_provider`
--

CREATE TABLE `tbl_provider` (
  `provider_id` int(11) NOT NULL,
  `provider_name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_address` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_provider`
--

INSERT INTO `tbl_provider` (`provider_id`, `provider_name`, `provider_address`, `provider_phone`) VALUES
(1, 'Dương Công Thần', 'Hà Nội', '0329588215');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `input_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`purchase_id`, `product_id`, `quantity`, `total`, `input_id`) VALUES
(1, 10, 10, 50000, 'PC-00001'),
(2, 10, 20, 100000, 'PC-00001');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `company_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `company_addr` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `company_phone` varchar(15) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `tax_code` varchar(100) NOT NULL,
  `purchase_bill` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `company_name`, `company_addr`, `company_phone`, `company_email`, `tax_code`, `purchase_bill`) VALUES
(1, 'Test 1', 'Hà Nội', '0329588215', 'congthanls@gmail.com', 'tax-0001', '<style>body{margin:0;padding:0;background-color:#FAFAFA;font:12pt Tohoma}*{box-sizing:border-box;-moz-box-sizing:border-box}.page{width:21cm;overflow:hidden;min-height:297mm;padding:1.5cm;margin-left:auto;margin-right:auto;background:#fff;box-shadow:0 0 5px rgba(0,0,0,.1)}.subpage{padding:1cm;border:5px red solid;height:237mm;outline:2cm #FFEAEA solid}@page{size:A4;margin:0}button{width:100px;height:24px}.header{overflow:hidden}.logo{background-color:#FFF;text-align:left;float:left;width:20%}.company{background-color:#FFF;width:100%;float:left;font-size:16px}.company h3{margin-top:0;margin-bottom:3px}.company h4{margin-top:0;margin-bottom:3px}.email{display:inline;margin-left:5px}.phone{display:inline}.title{text-align:center;position:relative;font-size:21px;top:1px;font-weight:700}.after-title{width:100%}.date{margin-top:10px}.hl{width:50%;float:left;padding-left:5%}.customer-name{width:100%;clear:left;float:left}.tax-code{width:50%;float:left}.footer{text-align:center;padding-top:24px;position:relative;height:150px;width:20%;color:#000;float:left;font-size:15px;bottom:1px}.TableData{background:#fff;font:11px;width:100%;border-collapse:collapse;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:12px;border:thin solid #d3d3d3}.TableData TH{background:rgba(0, 0, 255, .1);text-align:center;font-weight:700;color:#000;border:solid 1px #ccc;height:24px}.TableData TR{height:24px;border:thin solid #d3d3d3}.TableData TR TD{padding-right:2px;padding-left:2px;border:thin solid #d3d3d3;width:10%;text-align:center}.TableData TR:hover{background:rgba(0, 0, 0, .05)}.TableData .cotSo{width:5%}.TableData .tong{text-align:center;font-weight:700;text-transform:uppercase;padding-right:4px}.TableData .cotSoLuong input{text-align:center}.cols{float:left;width:50%}@media print{@page{margin:0;border:initial;border-radius:initial;width:initial;min-height:initial;box-shadow:initial;background:initial;page-break-after:always}}</style><div id=\"page\" class=\"page\"><div class=\"header cols\"><div class=\"company\"><h3>CÔNG TY <span style=\"color:red\">{Ten_cong_ty}</span></h3><h4>Địa chỉ: <span style=\"color:red\">{Dia_chi_cong_ty}</span></h4><h4 class=\"phone\">ĐT: <span style=\"color:red\">{So_dien_thoai_cong_ty}</span></h4><h4 class=\"email\">Email: <span style=\"color:red\">{Email}</span></h4></div></div><div class=\"cols\"><div class=\"title\">{Tieu_de}<br></div><div class=\"after-title\"><div class=\"date\"><h3 style=\"font-size:17px;font-weight:500;margin-top:5px;text-align:center\"><span>Ngày</span><span style=\"color:red\">{Ngay}</span> <span>tháng</span><span style=\"color:red\">{Thang}</span> <span>năm</span><span style=\"color:red\">{Nam}</span></h3></div><div class=\"hl\"><h3 style=\"font-size:17px;font-weight:500;margin-top:-1px\"><span>NO:</span><span style=\"color:red\">{NO}</span></h3></div><div class=\"tax-code\"><h3 style=\"font-size:16px;font-weight:500;margin-top:0;margin-bottom:2px\"><span>Mã số thuế:</span><span style=\"color:red\">{Ma_so_thue}</span></h3></div></div></div><div class=\"customer-info\"><div class=\"customer-name\"><h3 style=\"font-size:16px;font-weight:500;margin-top:0;margin-bottom:2px\"><span>{Doi_tuong}:</span><span style=\"color:red\">{Khach_hang}</span></h3></div><div class=\"customer-address\"><h3 style=\"font-size:16px;font-weight:500;margin-top:0;margin-bottom:2px\"><span>Địa chỉ:</span><span style=\"color:red\">{Dia_chi_khach_hang}</span></h3></div><div class=\"customer-phone\"><h3 style=\"font-size:16px;font-weight:500;margin-top:0;margin-bottom:2px\"><span>Số điện thoại:</span><span style=\"color:red\">{So_dien_thoai_khach_hang}</span></h3></div></div><table class=\"TableData\"><tr><td colspan=\"7\">{Danh_sach_don_hang}</td></tr></table><div class=\"footer\"><span style=\"font-weight:700\">{Doi_tuong}</span><br><span style=\"font-style:italic\">(ký & ghi rõ họ tên)</span></div><div class=\"footer\"><span style=\"font-weight:700\">Người nhận hàng</span><br><span style=\"font-style:italic\">(ký & ghi rõ họ tên)</span></div><div class=\"footer\"><span style=\"font-weight:700\">Thủ kho</span><br><span style=\"font-style:italic\">(ký & ghi rõ họ tên)</span></div><div class=\"footer\"><span style=\"font-weight:700\">Nhân viên kế toán</span><br><span style=\"font-style:italic\">(ký & ghi rõ họ tên)</span></div><div class=\"footer\"><span style=\"font-weight:700\">Giám đốc</span><br><span style=\"font-style:italic\">(ký & ghi rõ họ tên)</span></div></div>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_tags`
--

CREATE TABLE `tbl_tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tag_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_tags`
--

INSERT INTO `tbl_tags` (`tag_id`, `tag_name`, `tag_image`) VALUES
(0, 'Không có nhãn (Mặc đinh)', ''),
(3, 'Hot', '/images/tags/4194726ee334e1085d93e002837b73f0.png'),
(6, 'Bán chạy nhất', '/images/tags/37f82bd2bfb2a6e06ad62213e71d5ac4.png'),
(7, 'Nên mua', '/images/tags/ab5222b768fa224a4d6a23e24ac2df42.png'),
(8, 'Tốt cho trẻ', '/images/tags/278f2cd105559ecc9ae165722aeb71c2.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_unit`
--

INSERT INTO `tbl_unit` (`unit_id`, `unit_name`) VALUES
(1, 'Kg'),
(2, 'Túi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `email`, `password`, `group_id`) VALUES
(1, 'congthanls', 'congthanls@gmail.com', '25f9e794323b453885f5181f1b624d0b', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `warehouse_id` int(11) NOT NULL,
  `warehouse_name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`warehouse_id`, `warehouse_name`) VALUES
(1, 'Nhà kho 1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_article`
--
ALTER TABLE `tbl_article`
  ADD PRIMARY KEY (`article_id`);

--
-- Chỉ mục cho bảng `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Chỉ mục cho bảng `tbl_groups`
--
ALTER TABLE `tbl_groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Chỉ mục cho bảng `tbl_input`
--
ALTER TABLE `tbl_input`
  ADD PRIMARY KEY (`input_id`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `provider_id` (`provider_id`);

--
-- Chỉ mục cho bảng `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Chỉ mục cho bảng `tbl_permission`
--
ALTER TABLE `tbl_permission`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Chỉ mục cho bảng `tbl_provider`
--
ALTER TABLE `tbl_provider`
  ADD PRIMARY KEY (`provider_id`);

--
-- Chỉ mục cho bảng `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `input_id` (`input_id`);

--
-- Chỉ mục cho bảng `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_tags`
--
ALTER TABLE `tbl_tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Chỉ mục cho bảng `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Chỉ mục cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Chỉ mục cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_article`
--
ALTER TABLE `tbl_article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_groups`
--
ALTER TABLE `tbl_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_permission`
--
ALTER TABLE `tbl_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_provider`
--
ALTER TABLE `tbl_provider`
  MODIFY `provider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_tags`
--
ALTER TABLE `tbl_tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD CONSTRAINT `tbl_bill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);

--
-- Các ràng buộc cho bảng `tbl_input`
--
ALTER TABLE `tbl_input`
  ADD CONSTRAINT `tbl_input_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `tbl_warehouse` (`warehouse_id`),
  ADD CONSTRAINT `tbl_input_ibfk_2` FOREIGN KEY (`provider_id`) REFERENCES `tbl_provider` (`provider_id`);

--
-- Các ràng buộc cho bảng `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD CONSTRAINT `tbl_inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`),
  ADD CONSTRAINT `tbl_inventory_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `tbl_warehouse` (`warehouse_id`);

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`),
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `tbl_bill` (`bill_id`);

--
-- Các ràng buộc cho bảng `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`category_id`),
  ADD CONSTRAINT `tbl_products_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `tbl_unit` (`unit_id`),
  ADD CONSTRAINT `tbl_products_ibfk_3` FOREIGN KEY (`tag_id`) REFERENCES `tbl_tags` (`tag_id`);

--
-- Các ràng buộc cho bảng `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD CONSTRAINT `tbl_purchase_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`product_id`),
  ADD CONSTRAINT `tbl_purchase_ibfk_3` FOREIGN KEY (`input_id`) REFERENCES `tbl_input` (`input_id`);

--
-- Các ràng buộc cho bảng `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `tbl_users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tbl_groups` (`group_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
