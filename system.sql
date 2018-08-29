-- phpMyAdmin SQL Dump
-- version 4.1.3
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-06-08 05:22:48
-- 服务器版本： 5.6.24
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- 表的结构 `addproduct`
--

CREATE TABLE IF NOT EXISTS `addproduct` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `username` varchar(20) NOT NULL,
  `productid` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `size` varchar(20) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `number` int(20) NOT NULL,
  `unitprice` decimal(7,2) NOT NULL,
  `addnum` int(20) NOT NULL,
  `addcost` decimal(7,2) NOT NULL,
  `cardid` int(20) NOT NULL,
  `state` varchar(20) DEFAULT '待审批',
  `reason` varchar(20) NOT NULL DEFAULT '无',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `addproduct`
--

INSERT INTO `addproduct` (`id`, `date`, `username`, `productid`, `name`, `brand`, `size`, `unit`, `number`, `unitprice`, `addnum`, `addcost`, `cardid`, `state`, `reason`) VALUES
(1, '2016-05-26', 'admin', 110200101, '焊锡丝', '三芯', '1.0MM 1KG', '卷', 3, '251.95', 5, '0.00', 0, '待审批', '无'),
(2, '2016-04-26', 'admin', 110300101, '医用药棉', '众康', '100G', '包', 95, '5.51', 5, '0.00', 0, '已审批', '无'),
(4, '2016-05-06', 'admin', 120100301, '手电筒', '照星', '2节', '只', 40, '23.94', 5, '0.00', 0, '待审批', '无'),
(5, '2016-05-06', 'admin', 110300101, '医用药棉', '众康', '100G', '包', 95, '5.51', 10, '0.00', 0, '待审批', '无'),
(6, '2016-05-06', 'admin', 110200201, '砂纸', '上砂', '230*280mm', '张', 139, '1.69', 5, '0.00', 0, '已审批', '无'),
(7, '2016-05-20', '陈红亮', 110200201, '砂纸', '上砂', '230*280mm', '张', 147, '1.69', 1, '1.69', 222222, '审批通过', '无'),
(8, '2016-05-20', '陈红亮', 110200201, '砂纸', '上砂', '230*280mm', '张', 148, '1.69', 1, '1.69', 222222, '审批通过', '无'),
(11, '2016-05-20', '陈红亮', 123456, '鼠标', '123', '234', '345', 0, '1.00', 3, '3.00', 222222, '审批通过', '无'),
(12, '2016-05-22', '陈红亮', 110200201, '砂纸', '上砂', '230*280mm', '张', 147, '1.69', 853, '1441.57', 222222, '审批未通过', '无'),
(13, '2016-05-22', '严华', 110200201, '砂纸', '上砂', '230*280mm', '张', 147, '1.69', 3, '20000.00', 222222, '审批未通过', '经费卡余额不足'),
(14, '2016-05-23', '严华', 130402301, '网线', '东方之星', '超六类1.5米', '根', 13, '15.00', 1, '15.00', 222222, '待审批', '无'),
(15, '2016-05-23', '严华', 25245, '焊锡丝', '45234', '3452', '452', 0, '2.00', 10, '20.00', 222222, '待审批', '无'),
(16, '2016-05-23', '严华', 110200201, '砂纸', '上砂', '230*280mm', '张', 156, '1.69', 9853, '16651.57', 222222, '待审批', '无'),
(17, '2016-05-31', '严华', 130402301, '网线', '东方之星', '超六类1.5米', '根', 24, '5.00', 6, '30.00', 222222, '审批通过', '无'),
(18, '2016-05-31', '严华', 130403001, '电池', '白象', '1#R20S', '节', 181, '1.74', 1000, '1740.00', 222222, '审批未通过', '经费卡余额不足'),
(19, '2016-06-08', '严华', 110200201, '砂纸', '上砂', '230*280mm', '张', 92, '2.80', 8, '22.40', 222222, '待审批', '无');

-- --------------------------------------------------------

--
-- 表的结构 `cost`
--

CREATE TABLE IF NOT EXISTS `cost` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `lab` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `year` int(20) NOT NULL,
  `labcost` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `cost`
--

INSERT INTO `cost` (`id`, `lab`, `username`, `year`, `labcost`) VALUES
(1, '网络综合测试实验室', '严华', 2014, '130.00'),
(2, '现代信息交换实验室', '唐祖权', 2014, '300.00'),
(3, '数字信号处理实验室', '陈红亮', 2014, '400.00'),
(4, '电子工艺实习基地', '李欣', 2014, '200.00'),
(5, '网络综合测试实验室', '严华', 2015, '103.31'),
(6, '现代信息交换实验室', '唐祖权', 2015, '350.00'),
(7, '数字信号处理实验室', '陈红亮', 2015, '600.00'),
(8, '电子工艺实习基地', '李欣', 2015, '324.00'),
(9, '网络综合测试实验室', '严华', 2016, '113.31'),
(10, '现代信息交换实验室', '唐祖权', 2016, '305.60'),
(11, '数字信号处理实验室', '陈红亮', 2016, '311.69'),
(12, '电子工艺实习基地', '李欣', 2016, '231.00'),
(13, '网络综合测试实验室', '严华', 2017, '0.00'),
(14, '现代信息交换实验室', '唐祖权', 2017, '0.00'),
(15, '数字信号处理实验室', '陈红亮', 2017, '0.00'),
(16, '电子工艺实习基地', '李欣', 2017, '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productid` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `size` varchar(20) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `number` int(20) NOT NULL,
  `unitprice` decimal(7,2) NOT NULL,
  `count` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`productid`, `name`, `brand`, `size`, `unit`, `number`, `unitprice`, `count`) VALUES
(110200201, '砂纸', '上砂', '230*280mm', '张', 92, '2.80', 48),
(120100301, '手电筒', '照星', '2节', '只', 40, '23.94', 30),
(130402301, '网线', '东方之星', '超六类1.5米', '根', 30, '5.00', 40),
(130403001, '电池', '白象', '1#R20S', '节', 181, '1.74', 15);

-- --------------------------------------------------------

--
-- 表的结构 `tbudget`
--

CREATE TABLE IF NOT EXISTS `tbudget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardid` int(20) NOT NULL,
  `budget` decimal(7,2) NOT NULL,
  `balance` decimal(7,2) NOT NULL,
  `period1` date NOT NULL,
  `period2` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `tbudget`
--

INSERT INTO `tbudget` (`id`, `cardid`, `budget`, `balance`, `period1`, `period2`) VALUES
(2, 222222, '200.00', '44.65', '2016-01-01', '2016-12-31'),
(4, 333333, '300.00', '233.00', '2014-01-01', '2014-12-31'),
(6, 555555, '300.00', '188.00', '2015-01-01', '2015-12-31'),
(7, 666666, '600.00', '600.00', '2017-01-01', '2017-12-31');

-- --------------------------------------------------------

--
-- 表的结构 `useapply`
--

CREATE TABLE IF NOT EXISTS `useapply` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `userid` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `productid` int(20) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '无',
  `brand` varchar(20) NOT NULL DEFAULT '无',
  `size` varchar(20) NOT NULL DEFAULT '无',
  `unit` varchar(20) NOT NULL DEFAULT '无',
  `number` int(20) NOT NULL DEFAULT '0',
  `unitprice` decimal(7,2) NOT NULL DEFAULT '0.00',
  `usenum` int(20) NOT NULL DEFAULT '0',
  `cost` decimal(7,2) NOT NULL DEFAULT '0.00',
  `remainnum` int(20) NOT NULL DEFAULT '0',
  `rusenum` int(20) NOT NULL DEFAULT '0',
  `rcost` decimal(7,2) NOT NULL DEFAULT '0.00',
  `lab` varchar(20) NOT NULL,
  `applystate` varchar(20) NOT NULL DEFAULT '待审批',
  `usedstate` varchar(20) NOT NULL DEFAULT '未提交',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- 转存表中的数据 `useapply`
--

INSERT INTO `useapply` (`id`, `date`, `userid`, `username`, `productid`, `name`, `brand`, `size`, `unit`, `number`, `unitprice`, `usenum`, `cost`, `remainnum`, `rusenum`, `rcost`, `lab`, `applystate`, `usedstate`) VALUES
(65, '2016-05-25', 102, '陈红亮', 110200201, '砂纸', '上砂', '230*280mm', '张', 140, '1.69', 1, '1.69', 0, 0, '0.00', '数字信号处理实验室', '审批通过', '未提交'),
(66, '2016-05-31', 104, '唐祖权', 110200201, '砂纸', '上砂', '230*280mm', '张', 140, '1.69', 2, '3.38', 0, 0, '0.00', '现代信息交换实验室', '审批通过', '未提交'),
(67, '2016-05-31', 104, '唐祖权', 130402301, '网线', '东方之星', '超六类1.5米', '根', 24, '5.00', 1, '5.00', 0, 0, '0.00', '现代信息交换实验室', '待审批', '未提交'),
(68, '2016-05-31', 104, '唐祖权', 110200201, '砂纸', '上砂', '230*280mm', '张', 140, '1.69', 2, '3.38', 1, 1, '1.69', '现代信息交换实验室', '审批通过', '审批通过'),
(69, '2016-05-31', 104, '唐祖权', 130403001, '电池', '白象', '1#R20S', '节', 181, '1.74', 1, '1.74', 0, 0, '0.00', '现代信息交换实验室', '待审批', '未提交'),
(70, '2016-06-08', 104, '唐祖权', 110200201, '砂纸', '上砂', '230*280mm', '张', 100, '2.80', 10, '28.00', 2, 8, '22.40', '现代信息交换实验室', '审批通过', '审批通过'),
(71, '2016-06-08', 104, '唐祖权', 120100301, '手电筒', '照星', '2节', '只', 40, '23.94', 5, '119.70', 0, 0, '0.00', '现代信息交换实验室', '待审批', '未提交'),
(72, '2016-06-08', 103, '严华', 120100301, '手电筒', '照星', '2节', '只', 40, '23.94', 2, '47.88', 0, 0, '0.00', '网络综合测试实验室', '待审批', '未提交'),
(73, '2016-06-08', 105, '李欣', 120100301, '手电筒', '照星', '2节', '只', 40, '23.94', 3, '71.82', 0, 0, '0.00', '电子工艺实习基地', '待审批', '未提交'),
(74, '2016-06-08', 103, '严华', 120100301, '手电筒', '照星', '2节', '只', 40, '23.94', 50, '1197.00', 0, 0, '0.00', '网络综合测试实验室', '待审批', '未提交');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(20) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT '111',
  `username` varchar(20) NOT NULL,
  `lab` varchar(20) NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `dean` tinyint(1) NOT NULL DEFAULT '0',
  `supervisor` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `userid`, `password`, `username`, `lab`, `admin`, `dean`, `supervisor`) VALUES
(1, 103, '111', '严华', '网络综合测试实验室', 1, 0, 0),
(2, 104, '111', '唐祖权', '现代信息交换实验室', 0, 0, 0),
(3, 102, '111', '陈红亮', '数字信号处理实验室', 0, 0, 1),
(4, 101, '111', '安博文', '', 0, 1, 0),
(5, 105, '111', '李欣', '电子工艺实习基地', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
