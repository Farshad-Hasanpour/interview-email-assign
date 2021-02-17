
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignemail`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `user_firstname` varchar(63) NOT NULL,
  `user_lastname` varchar(63) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_firstname`, `user_lastname`) VALUES
(9, 'farshad.workplace@gmail.com', 'فرشاد', 'حسن پور'),
(8, 'sdfd@dsff.com', 'فرشاد', 'فرشاد'),
(24, 'sdfsdf@szdff.com', 'sdfdsf', 'sdffdf'),
(21, 'sfddg@sdff.com', 'sdfdgfk', 'kkkksdfsdf'),
(12, 'fdg@sdf.cin', 'fdfg', 'sdfsdf'),
(22, 'sdafsdf@dsff.com', 'DDDDD', 'DDDD'),
(16, 'farshad.hasanpour@yahoo.com', 'فرشاد', 'حسن پور'),
(26, 'dsfsdf@sdff.com', 'dddddddd', 'ddddddd'),
(30, 'sdf@llll.comfg', 'dfsgdfg', 'dfgdffg'),
(31, 'testtesftsssddssssss@testtest.com', 'szdfsdfsdf', 'sdfsdfsdf'),
(32, 'sdfsdf@sadff.com', 'sdfvfiii', 'dfsf'),
(33, 'test@test.comddd', 'sdafasdf', 'sadfsadf');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
