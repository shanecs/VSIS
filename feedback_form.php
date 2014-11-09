<?php include 'scripts/functions.php';?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'elements/header.php';?>
</head>

<body>
    <div id="wrapper">
		<?php include 'elements/navigation.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Feedback Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manual Entry Form
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Patient</label>
                                            <select id="patient" class="form-control" name="MRN" required>
												<option disabled>Select a Case</option>
												<?php
													// Open Connection
													include 'scripts/open_connection.php';
													
													// Execute Query
													$sql = "CALL GetCases(1)";
													$result = $conn->query($sql);

													// Process Data
													while($row = $result->fetch_assoc()) {
														echo "<option value=" . $row["CaseID"] . ">" . $row["ValueString"] . "</option>";
													}
													
													// Close Connection
													$conn->close();
												?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Instruction</label>
                                            <select id="instruction" class="form-control" name="InstructionID" required disabled>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Value</label>
                                            <input id="value" class="form-control" name="Value" required disabled>
                                            <p class="help-block">Enter a value to be recorded.</p>
                                        </div>
                                        <button type="submit" class="btn btn-default" formaction="scripts/submit_instructions.php" formmethod="post">Submit Button</button>
                                        <button id="reset" type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <form role="form">
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <!-- Form JS -->
    <script src="js/feedback_form.js"></script>
</body>
</html>