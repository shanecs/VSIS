-- Create syntax for 'Patients'

CREATE TABLE `Patients` (
  `MRN` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(30) NOT NULL DEFAULT '',
  `MiddleName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) NOT NULL DEFAULT '',
  `DateOfBirth` date NOT NULL,
  PRIMARY KEY (`MRN`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
