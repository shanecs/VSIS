-- Create syntax for 'Cases'

CREATE TABLE `Cases` (
  `CaseID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `SurgeryDateTime` datetime NOT NULL,
  `MRN` int(11) unsigned NOT NULL,
  PRIMARY KEY (`CaseID`),
  KEY `MRN` (`MRN`),
  CONSTRAINT `cases_ibfk_1` FOREIGN KEY (`MRN`) REFERENCES `Patients` (`MRN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
