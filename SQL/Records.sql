-- Create syntax for 'Records'

CREATE TABLE `Records` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `MRN` int(10) unsigned NOT NULL,
  `InstructionID` int(1) unsigned NOT NULL,
  `DateTime` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Value` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `InstructionID` (`InstructionID`),
  KEY `MRN` (`MRN`),
  CONSTRAINT `records_ibfk_2` FOREIGN KEY (`MRN`) REFERENCES `Patients` (`MRN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `records_ibfk_1` FOREIGN KEY (`InstructionID`) REFERENCES `Instructions` (`InstructionID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
