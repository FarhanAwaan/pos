-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2020 at 01:59 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashionbeast_pos`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllBike` ()  BEGIN
	SELECT * FROM bike;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bike`
--

CREATE TABLE `bike` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bike`
--

INSERT INTO `bike` (`id`, `name`, `date`) VALUES
(7, '70cc', '18-06-2019'),
(8, 'Honda CG 125', '14-05-2020');

-- --------------------------------------------------------

--
-- Table structure for table `bill_paid`
--

CREATE TABLE `bill_paid` (
  `id` int(200) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `pending_amount` varchar(200) NOT NULL,
  `paid_amount` varchar(200) NOT NULL,
  `remaining_amount` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_paid`
--

INSERT INTO `bill_paid` (`id`, `customer_id`, `pending_amount`, `paid_amount`, `remaining_amount`, `date`) VALUES
(4, '11', '2000', '2000', '0', '15-06-2020'),
(5, '12', '7800', '6000', '1800', '15-06-2020');

-- --------------------------------------------------------

--
-- Table structure for table `buy_items`
--

CREATE TABLE `buy_items` (
  `id` int(200) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `item_id` varchar(200) NOT NULL,
  `vendor_id` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `retail_price` varchar(200) NOT NULL,
  `cost_price` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buy_items`
--

INSERT INTO `buy_items` (`id`, `invoice_no`, `item_id`, `vendor_id`, `qty`, `retail_price`, `cost_price`, `date`) VALUES
(1, 'P20190424074101', '16', '2', '10', '1100', '1000', '24-04-2019'),
(2, 'P20190424074139', '17', '3', '10', '550', '500', '23-04-2019'),
(3, 'P20190424110757', '18', '5', '10', '1350', '1200', '24-04-2019'),
(4, 'P20190618070207', '19', '7', '1', '120', '100', '18-06-2019'),
(5, 'P20190618070539', '19', '7', '1', '130', '110', '18-06-2019'),
(6, 'P20190618070627', '19', '7', '3', '135', '112', '18-06-2019'),
(7, 'P20190618083729', '20', '7', '10', '550', '450', '18-06-2019'),
(8, 'P20190719104530', '21', '7', '50', '210', '200', '19-07-2019'),
(9, 'P20191212122044', '22', '7', '120', '16000', '15000', '12-12-2019'),
(10, 'P20200327213605', '24', '9', '1', '3000', '3500', '27-03-2020'),
(11, 'P20200514104109', '25', '9', '10', '2500', '2000', '14-05-2020'),
(12, '', '26', '', '200', '310', '300', '16-06-2020');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `date`) VALUES
(10, 'honda', '18-06-2019');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pending_amount` varchar(200) NOT NULL DEFAULT '0',
  `date` varchar(200) NOT NULL,
  `shop_name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `number1` varchar(200) NOT NULL,
  `number2` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `pending_amount`, `date`, `shop_name`, `address`, `number1`, `number2`) VALUES
(11, 'Test 2', '123', '11-05-2020', 'Shop 001', 'Rawalpindi', '112233', '112233'),
(12, 'Customer 1', '1800', '14-05-2020', 'Alha Shop', 'Islamabad', '123123', '124124');

-- --------------------------------------------------------

--
-- Table structure for table `expenditure`
--

CREATE TABLE `expenditure` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenditure`
--

INSERT INTO `expenditure` (`id`, `name`, `amount`, `date`) VALUES
(4, 'Misc', '10000', '2020-03-27'),
(5, 'Electricity Bill', '500', '2020-05-14'),
(6, 'Internet Bill', '1000', '2020-05-14'),
(7, 'Labour Meal', '500', '2020-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `bike_id` varchar(200) NOT NULL,
  `company_id` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `old_stock` varchar(200) NOT NULL,
  `old_stoct_price` varchar(200) NOT NULL,
  `new_stock` varchar(200) NOT NULL,
  `new_stoct_price` varchar(200) NOT NULL,
  `total_stock` varchar(200) NOT NULL,
  `old_stock_cprice` varchar(200) NOT NULL,
  `new_stock_cprice` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `bike_id`, `company_id`, `date`, `old_stock`, `old_stoct_price`, `new_stock`, `new_stoct_price`, `total_stock`, `old_stock_cprice`, `new_stock_cprice`) VALUES
(25, 'Silencer', '8', '10', '14-05-2020', '1', '2500', '34', '3434', '1', '2000', '0'),
(24, 'headlight', '7', '10', '27-03-2020', '2', '23', '', '', '0', '22', ''),
(26, 'Race Cover', '7', '10', '16-06-2020', '200', '310', '11', '1200', '200', '300', '0');

-- --------------------------------------------------------

--
-- Table structure for table `labour`
--

CREATE TABLE `labour` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact1` varchar(200) NOT NULL,
  `contact2` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labour`
--

INSERT INTO `labour` (`id`, `name`, `contact1`, `contact2`, `address`, `date`) VALUES
(6, 'Labour 1', '112233', '1122445', 'Rawalpindi', '14-05-2020');

-- --------------------------------------------------------

--
-- Table structure for table `labour_sell`
--

CREATE TABLE `labour_sell` (
  `id` int(200) NOT NULL,
  `labour_id` varchar(200) NOT NULL,
  `item_id` varchar(200) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `discount` varchar(200) NOT NULL DEFAULT '0',
  `commission` varchar(200) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labour_sell`
--

INSERT INTO `labour_sell` (`id`, `labour_id`, `item_id`, `invoice_no`, `qty`, `price`, `discount`, `commission`, `date`) VALUES
(2, '6', '25', 'L20200514110658', '1', '2000', '0', '1', '2020-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `role` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `date`, `role`) VALUES
(1, 'admin@admin.com', 'admin!1234', '2019-04-24', 'admin'),
(2, 'staff@pos.com', 'staff@123', '2020-06-10', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `retail_sell`
--

CREATE TABLE `retail_sell` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `item_id` varchar(200) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `discount` varchar(200) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retail_sell`
--

INSERT INTO `retail_sell` (`id`, `name`, `item_id`, `invoice_no`, `qty`, `price`, `discount`, `date`) VALUES
(6, 'Regular Shopkeeper', '24', 'S20200514105156', '1', '3000', '0', '2020-05-14'),
(7, 'undefined	', '25', 'S20200609104037', '1', '2000', '10', '2020-06-09'),
(8, 'undefined	', '25', 'S20200609104143', '1', '2000', '10', '2020-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `returnid` int(200) NOT NULL,
  `title` varchar(400) NOT NULL,
  `returnitemid` int(200) NOT NULL,
  `cid` int(200) NOT NULL,
  `vid` int(200) NOT NULL,
  `returnee` enum('customer','vendor') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`returnid`, `title`, `returnitemid`, `cid`, `vid`, `returnee`, `created_date`, `updated_date`) VALUES
(1, 'lights', 25, 11, 11, 'customer', '2020-06-16 18:42:54', '2020-06-16 17:48:54'),
(2, 'battery', 24, 12, 12, 'vendor', '2020-06-16 18:42:47', '2020-06-16 17:49:15'),
(3, 'lights', 25, 11, 11, 'customer', '2020-06-16 18:42:54', '2020-06-16 17:48:54'),
(5, 'battery', 24, 12, 12, 'vendor', '2020-06-16 18:42:47', '2020-06-16 17:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(200) NOT NULL,
  `item_id` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `cprice` varchar(200) NOT NULL,
  `rprice` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `shop_name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `number1` varchar(200) NOT NULL,
  `number2` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `date`, `shop_name`, `address`, `number1`, `number2`) VALUES
(11, 'Vendor 1', '27-03-2020', 'alpha', 'alpha zolo falcon', '12345', '2323'),
(12, 'Vendor 14', '27-03-2020', 'alpha zolo', 'alpha zolo falcon4', '1234544', '232344');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_sell`
--

CREATE TABLE `vendor_sell` (
  `id` int(200) NOT NULL,
  `customer_id` varchar(200) NOT NULL,
  `item_id` varchar(200) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL,
  `discount` varchar(200) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `time` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor_sell`
--

INSERT INTO `vendor_sell` (`id`, `customer_id`, `item_id`, `invoice_no`, `qty`, `price`, `discount`, `date`, `time`) VALUES
(20, '12', '25', 'S20200514104844', '2', '2000', '10', '2020-05-14', '01:49:23pm'),
(21, '11', '25', 'S20200514110846', '1', '2000', '0', '2020-05-16', '02:09:09pm'),
(22, '12', '25', 'S20200609103234', '2', '2000', '0', '2020-06-09', '01:33:16pm'),
(23, '12', '25', 'S20200613164200', '1', '2100', '0', '0000-00-00', '07:43:09pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bike`
--
ALTER TABLE `bike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_paid`
--
ALTER TABLE `bill_paid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_items`
--
ALTER TABLE `buy_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditure`
--
ALTER TABLE `expenditure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labour`
--
ALTER TABLE `labour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labour_sell`
--
ALTER TABLE `labour_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_sell`
--
ALTER TABLE `retail_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`returnid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_sell`
--
ALTER TABLE `vendor_sell`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bike`
--
ALTER TABLE `bike`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bill_paid`
--
ALTER TABLE `bill_paid`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buy_items`
--
ALTER TABLE `buy_items`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `expenditure`
--
ALTER TABLE `expenditure`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `labour`
--
ALTER TABLE `labour`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `labour_sell`
--
ALTER TABLE `labour_sell`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `retail_sell`
--
ALTER TABLE `retail_sell`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `returnid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vendor_sell`
--
ALTER TABLE `vendor_sell`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
