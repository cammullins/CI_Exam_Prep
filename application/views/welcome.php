<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="/assets/style.css">
  <title></title>
</head>
<body>
<h1>Welcome!</h1>
<div id='loginreg'>
	<fieldset>
		<legend>Register</legend>
			<form action='/loginReg/register' method='post'>
				<label>Name:</label>
					<input type='text' name='register_name'>
				<label>Alias:</label>
					<input type='text' name='register_alias'>
				<label>Email::</label>
					<input type='email' name='register_email'>
				<label>Password:</label>
					<input type='password' name='register_password'>
				<label>*Password should be at least 8 characters*</label>
				<label>Confirm PW:</label>
					<input type='password' name='register_confirm'>
				<input type='submit' value='Register'>
			</form>
	</fieldset>
<?php
  if ($this->session->flashdata("register_error")) 
    {
      echo "<span class='red'>" . $this->session->flashdata("register_error") . "</span>";
    }
?>
	<fieldset>
		<legend>Login</legend>
		<form action='/loginReg/login' method='post'>
			<label>Email:</label>
				<input type='email' name='login_email'>
			<label>Password:</label>
				<input type='password' name='login_password'>
			<input type='submit' value='Login'>
		</form>
	</fieldset>
<?php
  if ($this->session->flashdata("login_error")) 
    {
      echo "<span class='red'>" . $this->session->flashdata("login_error") . "</span>;
    }
?>
</div>
</body>
</html>
