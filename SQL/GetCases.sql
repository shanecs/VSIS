-- Create syntax for 'GetCases'

DELIMITER ;;
CREATE DEFINER=`sselig`@`localhost` PROCEDURE `GetCases`(CaseRange INT)
SELECT
	Cases.CaseID,
	CONCAT(Cases.MRN, ' - ', Patients.LastName, ', ', Patients.FirstName, IF((Patients.MiddleName IS NOT NULL), ' ', ''), Patients.MiddleName, ' - ', Cases.SurgeryDateTime, ' - ', Patients.DateOfBirth) AS ValueString
	
FROM
	Cases
	
	LEFT JOIN Patients ON
		Patients.MRN = Cases.MRN
		
WHERE
	(CaseRange = 0) OR
	(CaseRange = 1 AND CAST(cases.SurgeryDateTime AS DATE) BETWEEN (CURDATE() + INTERVAL -(14) DAY) AND (CURDATE() + INTERVAL 14 DAY)) OR
	(CaseRange = 2 AND CAST(cases.SurgeryDateTime AS DATE) <= CURDATE()) OR
	(CaseRange = 3 AND CAST(cases.SurgeryDateTime AS DATE) = CURDATE())
	
ORDER BY
	Cases.SurgeryDateTime,
	Patients.LastName,
	Patients.FirstName,
	Patients.MiddleName;;
DELIMITER ;
