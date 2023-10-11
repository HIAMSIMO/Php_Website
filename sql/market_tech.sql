-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2023 at 12:15 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market_tech`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
CREATE TABLE IF NOT EXISTS `billing` (
  `ID_billing` int(11) NOT NULL AUTO_INCREMENT,
  `ID_cmd` int(10) NOT NULL,
  `payment_date` datetime NOT NULL,
  `delivery_date` datetime NOT NULL,
  `delivery_location` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_billing`),
  KEY `billing_ibfk_2` (`ID_cmd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `ID_cart` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user` int(10) NOT NULL,
  `reference` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  PRIMARY KEY (`ID_cart`),
  KEY `fzff_fk` (`ID_user`),
  KEY `fzff_ff` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ID_cart`, `ID_user`, `reference`, `price`, `quantity`) VALUES
(4, 2, 17, 300, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID_cat` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`ID_cat`, `name`) VALUES
(1, 'Laptop'),
(2, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ID_cmd` int(100) NOT NULL AUTO_INCREMENT,
  `ID_user` int(10) NOT NULL,
  `reference` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `date_commande` datetime NOT NULL,
  `price` varchar(20) NOT NULL,
  `payement_method` varchar(25) NOT NULL,
  PRIMARY KEY (`ID_cmd`),
  KEY `orders_ibfk_3` (`ID_user`),
  KEY `orders_ibfk_2` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID_cmd`, `ID_user`, `reference`, `quantity`, `date_commande`, `price`, `payement_method`) VALUES
(73, 2, 18, 2, '2023-01-17 23:50:59', '500', 'Online payement'),
(74, 2, 19, 3, '2023-01-17 23:50:59', '400', 'Online payement'),
(75, 2, 2, 1, '2023-01-18 00:16:13', '12500', 'Cash on Delivery'),
(76, 2, 17, 2, '2023-01-18 00:16:13', '300', 'Cash on Delivery'),
(77, 2, 18, 2, '2023-01-18 08:29:26', '500', 'Cash on Delivery'),
(78, 2, 17, 1, '2023-01-18 08:29:26', '300', 'Cash on Delivery'),
(79, 2, 18, 1, '2023-01-18 23:59:57', '500', 'Cash on Delivery'),
(80, 2, 14, 1, '2023-01-18 23:59:57', '4900', 'Cash on Delivery'),
(81, 2, 17, 1, '2023-01-18 23:59:57', '300', 'Cash on Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `reference` int(11) NOT NULL AUTO_INCREMENT,
  `ID_cat` int(10) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `Tittle` varchar(100) NOT NULL,
  `minor_detail1` varchar(100) NOT NULL,
  `minor_detail2` varchar(100) NOT NULL,
  `minor_detail3` varchar(100) NOT NULL,
  `description_para1` text NOT NULL,
  `description_para2` text NOT NULL,
  `description_para3` text NOT NULL,
  `description_para4` text NOT NULL,
  `description_photo1` varchar(25) NOT NULL,
  `description_photo2` varchar(25) NOT NULL,
  `description_photo3` varchar(25) NOT NULL,
  `price` varchar(10) NOT NULL,
  `stock_quantity` int(10) NOT NULL,
  `photo` varchar(60) NOT NULL,
  PRIMARY KEY (`reference`),
  KEY `fki_c` (`ID_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`reference`, `ID_cat`, `brand`, `model`, `Tittle`, `minor_detail1`, `minor_detail2`, `minor_detail3`, `description_para1`, `description_para2`, `description_para3`, `description_para4`, `description_photo1`, `description_photo2`, `description_photo3`, `price`, `stock_quantity`, `photo`) VALUES
(1, 1, 'ASUS', 'ROG Strix G15', '2022 ASUS ROG Strix G15 Advantage Edition', 'Screen size 15.6 inches QHD 165Hz Gaming Laptop', 'AMD Ryzen 9 5980HX', 'RGB Backlit Keyboard', 'Upgraded Seal is opened for upgrade only, 1-Year warranty on Upgraded RAM/SSD from SnowBell, and original 1-Year Manufacture warranty on remaining components. 15.6\" QHD 165Hz Display The 2560 x 1440 resolution with 100% sRGB color gamut boasts impressive color and clarity. Game with ultra fast 165hz refresh rate and 3ms response time.', 'AMD Ryzen 9 5980HX processor Take on anything with up to the latest AMD Ryzen 9 5980HX CPU made with cutting-edge 7nm fabrication technology, activate up to 8 cores and 16 threads to handle demanding work.', '16GB DDR4 RAM Substantial high-bandwidth RAM to smoothly run your games and photo- and video-editing applications, as well as multiple programs and browser tabs all at once. \r\n 1TB PCIe SSD Save files fast and store more data. With massive amounts of storage and advanced communication power, PCI-e SSDs are great for major gaming applications, multiple servers, daily backups, and more.', 'Windows 11 Pro included Hook up next-gen devices via the USB 3.2 Type-C with DisplayPort 1.4 and USB Power Delivery. Three Type-A USB 3.2 ports are ready for your favorite gaming gear, while HDMI 2.0b lets you connect a 4K monitor or TV at up to 60Hz. Black. Bonus 32GB SnowBell USB Card.', 'rogg15_1.jpg', 'rogg15_2.jpg', 'rogg15_3.jpg', '16500', 9, 'rog_strix_g15.jpg'),
(2, 1, 'ASUS', 'TUF Dash 15', 'ASUS TUF Dash 15 (2022) Gaming Laptop', '15.6', 'Intel Core i7-12650H', 'GeForce RTX 3060', 'ASUS TUF Dash 15 (2022) Gaming Laptop, 15.6\" 144Hz FHD Display, Intel Core i7-12650H, GeForce RTX 3060, 16GB DDR5, 512GB SSD, Thunderbolt 4, Thunderbolt 4, Windows 11 Home, Off Black, FX517ZM-AS73', 'READY FOR ANYTHING - Use your gaming laptop to stream and multi-task with ease thanks to an  Intel Core i7-12650H Processor with 24MB Cache, up to 4.7 GHz, 10 cores (6 P-cores and 4 E-cores) and 16GB of blisteringly fast 4800MHz DDR5 RAM on Windows 11', 'FULL CONNECTIVITY - Wi-Fi 6, Bluetooth 5.2, 1x Thunderbolt 4, 1x USB 3.2 Type-C (Gen2), 2x USB 3.2 Type-A (Gen1), 1x HDMI 2.0b, 1x 3.5mm Audio Jack, 1x LAN', 'MILITARY GRADE TOUGHNESS - Durable MIL-STD-810H military standard lives in the TUF line as the devices are tested against drops, vibration, humidity and extreme temperatures to ensure reliability', 'tuf_1.jpg', 'tuf_2.jpg', 'tuf_3.jpg', '12500', 7, 'TUFDash15.jpg'),
(10, 1, 'ASUS', 'VivoBook 15', 'ASUS Vivobook 15 Thin and Light Laptop', '15.6 inches FHD, 512 GB', 'Ram : 8GB, Windows 11 Home', 'Graphics coprocessor:Intel Iris Xe Graphics', 'ã€Empower Your Dynamic Lifestyleã€‘With an overall weight under 4 lbs (1.81 kg), the extremely portable ASUS VivoBook 15 is the lightweight laptop that keeps up with your fast-paced lifestyle', 'ã€11th Gen Intel Core i5 Processorã€‘Brings the perfect combination of features to make you unstoppable, and breaks the boundaries of performance with unmatched capabilities in productivity, multitasking, collaboration, creation, gaming, and entertainment on ultra-thin-and-light laptops. Get things done fast with high performance, instant responsiveness, and best-in-class connectivity with 11th Gen Intel Core i5-1135G7 (4C/8T, 2.4GHz/4.2GHz)', 'ã€Get a Wilder View Of The Worldã€‘The NanoEdge display gives ASUS VivoBook 15 a vast screen area for an immersive viewing experience for work and play.\r\n\r\nã€Exactly Your Typeã€‘The full-size backlit keyboard on the ASUS VivoBook 15 is perfect for working in dim environments. Ergonomically designed, the keyboard\'s sturdy, one-piece construction and 1.4mm key travel provide a comfortable typing experience', 'ã€Multiple Ports Availableã€‘Connect your laptop with other devices. 1x USB 3.2 Type-A, 1x USB 3.2 Type-C, 2x USB 2.0 Type-A, 1x HDMI, 1x3.5mm Combo Audio Jack', 'vivobook15_1.jpg', 'vivobook15_2.jpg', 'vivobook15_3.jpg', '5000', 12, 'vivobook15.jpg'),
(11, 1, 'ASUS', 'VivoBook Business', 'Asus 2022 VivoBook Business', '15.6 Inches, 512 GB', 'Core i3 4.1 GHz, 20GB, Windows 11', 'Graphics coprocessor:Intel UHD Graphics', 'Storage & RAM Enjoy up to 15x faster performance than a traditional hard drive with 512 GB PCIe NVMe M.2 SSD storage and experience improved multitasking with higher bandwidth thanks to 20 GB of RAM', 'ã€Processorã€‘11th Gen Intel Core i3-1115G4 3.0GHz Dual-Core Processor (6MB Intel Smart Cache, up to 4.10GHz)', 'ã€Displayã€‘15.6-inch, FHD (1920 x 1080) 16:9 aspect ratio, IPS-level Panel, LED Backlit, 250nits, 45% NTSC color gamut, Glossy display, Touch screen, Screen-to-body ratio: 83 ï¼…', 'ã€Operating Systemã€‘Windows 11 Home, 64-bit, English\r\nã€Connectivityã€‘Wi-Fi 5(802.11ac) (Dual band) 1*1 + Bluetooth 4.1', 'vivobookbusiness_1.jpg', 'vivobookbusiness_2.jpg', 'vivobookbusiness_3.jpg', '5000', 14, 'VivoBookbusiness.jpg'),
(12, 1, 'DELL', 'XPS 13', 'Dell XPS 13 9310 Laptop', '13.4 Inches, 1 TB', 'Core i7 Family, 32 GB, Windows 11 Home', 'Graphics coprocessor:Intel Iris Xe Graphics', '13.4-inch OLED 3.5K (3456x2160) InfinityEdge Touch Anti-Reflective 400-Nit Display', '11 Gen Intel Core i7-1185G7, vPro (12 MB cache, 4 cores, 8 threads, up to 4.80 GHz)', '16GB 4267MHz LPDDR4x Memory Onboard; 512GB M.2 PCIe NVMe Solid State Drive', 'Killer Wi-Fi 6 AX1650 (2 x 2) and Bluetooth 5.1\r\nWindows 11 Home, English', 'XPS1.jpg', 'XPS2.jpg', 'XPS3.jpg', '10500', 0, 'xps13.jpg'),
(13, 1, 'DELL', 'Latitude 7390', '2018 Dell Latitude 7390', '13.3 Inches, 512 GB', 'Core i7-8650U, 16 GB, Windows 10 Pro', 'Graphics Coprocessor: Intel UHD Graphics 620', 'This Certified Refurbished product is tested and certified to look and work like new. The refurbishing process includes functionality testing, basic cleaning, inspection, and repackaging. The product ships with all relevant accessories, a minimum 90-day warranty, and may arrive in a generic box.', 'For long-term storage of your files, this system is equipped with a 512 GB solid state drive.', 'Wi-Fi are built-in for wired and wireless networking, and Bluetooth technology will also allow you to connect additional compatible peripherals wirelessly.', 'Experience faster data speeds with a PCIe SSD, and higher transfer rates with Thunderbolt 3 connection.', 'Latitude_1.jpg', 'Latitude_2.jpg', 'Latitude_3.jpg', '3500', 10, 'Dell Latitude.jpg'),
(14, 1, 'DELL', 'Inspiron 15 3000', 'Dell Inspiron 15 3000', '15.6 Inches, color black, 256 GB', 'Core i5, 12 GB, Windows 10', 'Card Description	Integrated', '> 11th Gen Intel Core i5-1135G7 Quad-Core Processor 2.4Ghz / 12GB 2666 DDR4 SDRAM / 256GB Solid State Drive', '> 802.11ac Wireless and Bluetooth / Integrated Stereo Speakers / Keyboard with numeric keypad / 10/100/1000 Gigabit Ethernet Port / Integrated Webcam with Dual Digital Microphone Array', '> Digital Media Reader / Headphone/microphone combo jack / 3-in-1 SD media card reader / 2 x USB 3.2 Type A Ports / 1 x USB 3.2 Type C Port / 1 x USB 2.0 / 1 x HDMI', '> 3-cell Lithium Battery / Microsoft Windows 10 operating system (S Mode) / Finish: Black\r\n\r\n> 15.6-inch Full HD 1920x1080 IPS Display / Intel Iris Xe Graphics', 'Inspiron15_1.jpg', 'Inspiron15_2.jpg', 'Inspiron15_3.jpg', '4900', 7, 'Inspiron 15.jpg'),
(15, 1, 'DELL', 'Inspiron 15 new', 'Dell Inspiron 15 Touchscreen Laptop 2022 Newest', '15.6 Inches, 1 TB, Core i7', '16 GB, Windows 11', 'Card Descriptio: Integrated', 'ã€11th Intel Core i7-1165G7ã€‘11th Generation Intel Core i7-1165G7 Processor (4 Cores, 8 Threads, 12MB Intel Smart Cache, Base Frequency at 2.80 GHz, Up to 4.70 Ghz at Maximum Turbo Speed)', 'ã€15.6\" FHD IPS Touch Displayã€‘Ultra-wide 178-degree viewing angles with consistent detail and a vibrant 1920 x 1080 resolution, you\'ll always have a great view of your favorite content.', 'ã€16GB system memoryã€‘Reams of high-bandwidth DDR4 RAM to smoothly run your graphics-heavy PC games and video-editing applications, as well as numerous programs and browser tabs all at once.', 'ã€Upgraded to 1TB PCIE SSDã€‘Save files fast and store more data. With massive amounts of storage and advanced communication power, SSDs are great for major gaming applications, multiple servers, daily backups, and more.', 'Dell Inspiron 15_1.jpg', 'Dell Inspiron 15_2.jpg', 'Dell Inspiron 15_3.jpg', '8900', 3, 'Dell Inspiron 15 new'),
(16, 2, 'Ytonet ', 'Computer Carrying Case', 'Ytonet Laptop Case Compatible for HP, Dell, Lenovo, Asus Notebook', 'Color: Grey', 'hp laptop case, hp envy 5055, acer aspire 5, hp x360, hp pavilion x360, acer predator helios 300', 'Form Factor: Sleeve,  shell  Soft', 'âœ”This laptop sleeve dimensions: 15.7 x 11.2 x 2 inch (L x W x H); The laptop compartment dimensions: 14.6 x 10.6 x 1.6 inch (L x W x H); One compartment for 15.6 inch laptop, the additional mesh pocket storage space keeps the items well-organized, such as your pens, cables, mouse, earphone, mobile phones, iPad or laptop accessories. Constructed with a modern slim and lightweight design to accommodate daily use and protection needs', 'âœ”TSA Friendly Design: With portable handle, top opening double zippers gliding smoothly freely 90-180 degree opening and offers convenient access to devices. Slim and lightweight laptop sleeve does not bulk your items up and can easily slide into a briefcase, backpack bag. Made of soft and water-resistant nylon fabric, our laptop sleeve features a polyester foam padding layer for bump and shock absorption and protection of your device against dust, dirt, bump, shock and accidental scratches', 'âœ”Organize Your Digital Life: our laptop sleeve case is perfect for women and men\'s daily use on business trip, travel, school, office etc. 15.6 laptop case sleeve, computer cases for dell laptops, laptop travel sleeve, professional slim laptop case, laptop case with organizer, laptop bag sleeve 15.6, laptop sleeve bag, laptop case 15.6 inch, hp laptop case, lenovo laptop case, dell laptop case, laptop carrying case bag, birthday gift for men, gift for men valentines day\r\nâœ”Compatibility: Our laptop case sleeve is compatible with Acer Aspire E 15 E5-575 E5-576, 15.6 Acer Aspire 6 Aspire 3 CB515 Chromebook, Acer Predator Helios 300, Acer Flagship CB3-532; HP OMEN 15 2018, HP 15-BA009DX, HP Pavilion Power 15, HP Pavilion Notebook 15, HP ProBook 450, 455, 650, Thinkpad T580 E580 P51 and most popular up to 15.6 inch notebooks', 'âœ”LIFE-TIME PROMISES from Ytonet and friendly 7x24 hours customer service (Kindly note: Please check your device dimensions against our laptop sleeve\'s internal dimensions to ensure perfect fit. If you don\'t know how to choose, please contact us!)', 'Ytonet Laptop Case_1.jpg', 'Ytonet Laptop Case_2.jpg', 'Ytonet Laptop Case_3.jpg', '160', 60, 'Ytonet Laptop Case.jpg'),
(17, 2, 'UGREEN', 'USB C Hub', 'UGREEN USB C Hub, 6-in-1 USB C to USB Adapter', 'Color: gray', 'MicroSD, USB Type C, HDMI, USB 3.0', '	6-in-1 USB C Hub with HDMI, 3 USB 3.0 Ports, SD TF Card Reader, 5Gbps Superspeed Data Transfer, Por', '6-in-1 USB C Hub: Expand more ports to connect more. UGREEN 6-in-1 USB C to USB adapter features a 4K HDMI output port, SD and TF card readers, and 3 USB 3.0 ports. All hub ports can work simultaneously and save you the trouble of plugging & unplugging repeatedly.', 'HDMI Port for 4K UHD Visual Feast: Mirror or extend your screen with UGREEN USB C to HDMI adapter to directly stream 4K UHD, Full HD 1080p, or 3D video to HDTV, monitor, or projector. You could not only enjoy movies with your family on a bigger screen, but also make a vivid presentation in a meeting.\r\n5Gbps Superspeed Data Transfer: This USB C to USB adapter adds 3 extra USB 3.0 ports for connecting multiple USB peripheral devices such as flash drives, hard drives, keyboards, mice, printers, MP3 players and more.Supports super faster data transfer up to 5Gbps, which allows you to transfer HD movies or files in just seconds.', 'Reading SD/TF Cards Simultaneously: Built-in SD and TF slots easily access files from universal SD card and Micro SD cards; Supports 2 cards reading simultaneously. With speeds up to 104MB/S, this USB C Hub easily transfers photos or videos from your camera\' cards to the laptop in seconds, so you can see and share your photos anywhere and anytime.', 'Sleek Aluminum Design: UGREEN mac USB adapter is compatible with Mac and has a sleek aluminum finish perfectly complements Apple devices. The aluminum case is also better for heat dissipation, making this USB C adapter safer to use.\r\nWide Compatibility: The usb c to usb adapter is compatible with almost USB-C devices such as MacBook Pro, MacBook Air, MacBook M1, M2, iMac, iPad Pro, Chromebook, Surface, Dell, HP, etc.', 'UGREEN_1.jpg', 'UGREEN_2.jpg', 'UGREEN_3.jpg', '300', 4, 'UGREEN.jpg'),
(18, 2, 'VIVO', 'Monitor Arm Desk Mount', 'VIVO Single Monitor Arm Desk Mount, Holds Screens up to 32 inch Regular and 38 inch Ultrawide; 16inc', 'Table Mount, 	Table Mount', 'Minimum Compatible Size 13 Inches', 'Compatible Devices, Monitors Maximum Tilt Angle, 90 Degrees', 'Screen Compatibility - This single-arm mount fits screens that weigh up to 22 lbs with backside mounting (VESA 75x75mm or 100x100mm). This covers most monitors on the market between 13â€ and 32â€, as well as ultrawide monitors up to 38â€.', 'Articulation & Height Adjustment - Adjustable arm offers +90Â° to -90Â° tilt, 360Â° swivel, 360Â° rotation, and height adjustment along the center pole. Monitor can be placed in portrait or landscape orientation.', 'Integrated Cable Management - Keep your power and AV cables clean and organized with detachable cable clips on the arms and center pole.', 'Easy Installation - Mounting your monitor is a simple process with detachable VESA plates. We provide all the necessary hardware and instructions for easy assembly.\r\nWe\'ve Got You Covered - Sturdy steel design is backed with a 3 Year Manufacturer Warranty and friendly tech support to help with any questions or concerns.', 'VIVO Single Monitor_1.jpg', 'VIVO Single Monitor_2.jpg', 'VIVO Single Monitor_3.jpg', '500', 7, 'VIVO Single Monitor.jpg'),
(19, 2, 'KeiBn', 'Laptop Cooling Pad', '2022 Upgarde Laptop Cooling Pad, KeiBn RGB Lights', 'Color: Blue, Plastic & Metal', '2.57 Pounds', '16.33 x 11.81 x 1.37 inches', 'Efficient Heat Dissipation - Structured with geometry and big hole metal panel, 3 big cooling fans (110mm) and 3 small fans(65mm), the laptop cooler pad will deliver an impressive amount of cooling while still remaining quiet to boot. LCD display screen allows controlling rgb lights, fan speed and modes', 'Full RGB Lights - Design LED light strips in a circle outside the entire laptop cooling pad, with a width of 9mm/0.35\", it\'s very cool and beautiful, an awesome gaming partner with your gaming laptop. 10 modes for you to choose, the rgb lighting can be turned off separately while cooling fans are still running', 'Ergonomic Height Stands - This rgb light cooling pad for a laptop has 7 different height settings, which allows you to adjust a comfortable posture from 16 degrees to 35 degrees, raising your laptop 4.3\" to 7.5\" high. Weighs 2.57 lb, it is lightweight to carry with you. Relieve pain your shoulder and spine, guide you a healthy lifestyle', 'Ergonomic Height Stands - This rgb light cooling pad for a laptop has 7 different height settings, which allows you to adjust a comfortable posture from 16 degrees to 35 degrees, raising your laptop 4.3\" to 7.5\" high. Weighs 2.57 lb, it is lightweight to carry with you. Relieve pain your shoulder and spine, guide you a healthy lifestyle', 'Cooling Pad_1.jpg', 'Cooling Pad_2.jpg', 'Cooling Pad_3.jpg', '400', 2, 'Cooling Pad.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `postalcode` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_user`, `firstname`, `lastname`, `telephone`, `email`, `address`, `city`, `postalcode`, `type`, `password`) VALUES
(2, 'Mehdi', 'gm', '06688486', 'mehdi@gmail.com', 'Tilila,Agadir, morocco', 'Agadir', '80000', 'client', 'ed946f65d2c785d90e827c5ffd879ce3b49c68d4c88013074176a7e73bc58bcf'),
(8, 'Mehdi', 'admin', '06688486', 'admin@market.com', 'Tilila,Agadir, morocco', 'Agadir', '80000', 'admin', '53d6316bd7b9044e6bb5deaa87fe8316c2fde3938b78f8448875b08e551ccc95'),
(10, 'test', 'testing', '484848952', 'test@mail.com', 'Liontel m test', 'tester', '80000', 'client', '7a4d09cc57199ab3a559bb3203ea4ff733b713e098e731237c54f962a321eeae');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `ID_wish` int(10) NOT NULL AUTO_INCREMENT,
  `ID_user` int(10) NOT NULL,
  `reference` int(10) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`ID_wish`),
  KEY `wish_fk` (`ID_user`),
  KEY `wish_fk1` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`ID_wish`, `ID_user`, `reference`, `date_added`) VALUES
(3, 2, 18, '2023-01-15 11:54:43'),
(5, 2, 17, '2023-01-16 23:06:04');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_2` FOREIGN KEY (`ID_cmd`) REFERENCES `orders` (`ID_cmd`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fzff_ff` FOREIGN KEY (`reference`) REFERENCES `product` (`reference`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fzff_fk` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`reference`) REFERENCES `product` (`reference`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fki_c` FOREIGN KEY (`ID_cat`) REFERENCES `categorie` (`ID_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wish_fk` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wish_fk1` FOREIGN KEY (`reference`) REFERENCES `product` (`reference`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
