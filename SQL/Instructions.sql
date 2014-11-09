-- Create syntax for 'Instructions'

CREATE TABLE `Instructions` (
  `InstructionID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `CaseID` int(11) NOT NULL,
  `Instruction` varchar(32) NOT NULL DEFAULT '',
  `Value` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`InstructionID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
