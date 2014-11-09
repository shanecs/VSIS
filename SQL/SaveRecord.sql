-- Create syntax for 'SaveRecord'

DELIMITER ;;
CREATE DEFINER=`sselig`@`localhost` PROCEDURE `SaveRecord`(MRN INT, InstructionID INT, `Value` VARCHAR(32))
INSERT INTO Records (MRN, InstructionID, `DateTime`, `Value`)
VALUES (MRN, InstructionID, NOW(), `VALUE`);;
DELIMITER ;
