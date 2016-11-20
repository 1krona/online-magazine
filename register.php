<?php
include "header.php";
echo "<div id='register'>";


if(isset($_SESSION['uid'])){

	echo "Du är redan inloggad";
}
else{
?>

<fieldset>

<form method='post' action="parse/register_parse.php">

<label>Förnamn:</label> <input type='text' name='user_firstname' value="<?php if(isset($_POST['user_firstname'])){echo $_POST['user_firstname'];} ?>"/> <br />

<label>Efternamn:</label> <input type='text' name='user_lastname' value="<?php if(isset($_POST['user_lastname'])){echo $_POST['user_lastname'];} ?>"/> <br />

<label>* Användernamn:</label>  <input type='text' name='user_name' value="<?php if(isset($_POST['user_name'])){echo $_POST['user_name'];} ?>"/> <br />

<label>* Lösenord:</label>  <input type='password' name='user_pass' /> <br />

<label>* Upprepa lösenord:</label> <input type='password' name='user_pass_check' /> <br />

<label>* E-mail:</label>  <input type='text' name='user_email' value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];} ?>" /> <br />

<input type='submit' name='submit_info' value='Registrera dig' /><br />
</form>

</fieldset>

<?php
}

echo "</div>";
include "footer.php";
?>