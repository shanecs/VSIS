-- Create syntax for 'GetInstructions'

DELIMITER ;;
CREATE DEFINER=`sselig`@`localhost` PROCEDURE `GetInstructions`(CaseID INT(11))
SELECT
	InstructionID,
	Instruction,
	`Value`
	
FROM Instructions
WHERE Instructions.CaseID = CaseID
ORDER BY Instruction;;
DELIMITER ;
