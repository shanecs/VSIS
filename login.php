<!DOCTYPE html>
<html lang="en">

<head>
	<?php include_once 'elements/header.php';?>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign In</h3>
					</div>
					<?php
						if(isset($_GET['Code'])) {
							echo '<div class="panel-error">';
							echo '<h3 class="panel-title">';
							switch($_GET['Code']) {
								case '0':	echo 'Invalid Username and/or Password';	break;
								case '2':	echo 'Access Denied';						break;
								case '3':	echo 'Logout Successful';					break;
								default:	echo 'An Unknown Error has Occured';		break;
							}
							echo '</h3>';
							echo '</div>';
						}
					?>
					<div class="panel-body">
						<form role="form">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="VUnetID" name="VUnetID" type="username" autofocus required>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Password" name="Password" type="password" required>
								</div>
								<div class="checkbox">
									<label>
										<input name="remember" type="checkbox" value="Remember Me">Remember Me
									</label>
								</div>
								<!-- Change this to a button or input when using this as a form -->
								<button type="submit" class="btn btn-lg btn-success btn-block" formaction="scripts/security/login.php" formmethod="post">Login</button>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="js/plugins/metisMenu/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="js/sb-admin-2.js"></script>

</body>

</html>
