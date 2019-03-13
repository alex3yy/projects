<?php
// Include config file
include("conectare.php");
include("page_top.php");
include("meniu.php");
require_once "conectare_user.php";
// Define variables and initialize with empty values
$username = $password = $confirm_password = $email= "";
$username_err = $password_err = $confirm_password_err= $email_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 // Validate username
 if(empty(trim($_POST["username"]))){
 $username_err = "Please enter a username.";
 } else{
 // Prepare a select statement
 $sql = "SELECT id FROM user WHERE username = ?";

 if($stmt = $mysqli->prepare($sql)){
 // Bind variables to the prepared statement as parameters
 $stmt->bind_param("s", $param_username);

 // Set parameters
 $param_username = trim($_POST["username"]);

 // Attempt to execute the prepared statement
 if($stmt->execute()){
 // store result
 $stmt->store_result();

 if($stmt->num_rows == 1){
 $username_err = "This username is already taken.";
 } else{
 $username = trim($_POST["username"]);
 }
 } else{
 echo "Oops! Something went wrong. Please try again later.";
 }
  // Close statement
 $stmt->close();
 }
 }

 // Validate password
 if(empty(trim($_POST["password"]))){
 $password_err = "Please enter a password.";
 } elseif(strlen(trim($_POST["password"])) < 6){
 $password_err = "Password must have at least 6 characters.";
 } else{
 $password = trim($_POST["password"]);
 }

 // Validate confirm password
 if(empty(trim($_POST["confirm_password"]))){
 $confirm_password_err = "Please confirm password.";
 } else{
 $confirm_password = trim($_POST["confirm_password"]);
 if(empty($password_err) && ($password != $confirm_password)){
 $confirm_password_err = "Password did not match.";
 }
 }
 // Validate email
 if(empty(trim($_POST["email"]))){
 $email_err = "Please enter an email.";
 } else{
 $email = trim($_POST["email"]);
 }

 // Check input errors before inserting in database
 if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)){

 // Prepare an insert statement
 $sql = "INSERT INTO user (username, password, email) VALUES (?, ?, ?)";

 if($stmt = $mysqli->prepare($sql)){
 // Bind variables to the prepared statement as parameters
 $stmt->bind_param("sss", $param_username, $param_password, $param_email);

 // Set parameters
 $param_username = $username;
 $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password
 $param_email = $email;

 // Attempt to execute the prepared statement
 if($stmt->execute()){
 //Send confirmation
 $emailserver = "alexandruioan.zaharia@gmail.com";
 $subject = "Un nou contact s-a inregistrat";
 $headers = "From: $emailserver\n";
 $headers.= "MIME-Version: 1.0" . "\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\n";
 $message = "A visitor to your site has sent the following email address
to be added to your mailing list.\n Un utilizator cu mail-ul $email s-a inregistrat cu succes.\n ";
 $message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Username</th>
<th>Email</th>
<th>Password</th>
</tr>
<tr>
<td>$username</td>
<td>$email</td>
<td>$password</td>
</tr>
</table>
</body>
</html>\n";
mail($emailserver,$subject,$message,$headers);
// aici e ce primeste user-ul
 $usersubject = "Thank you for subscription";
$userheaders = "From: alexandruioan.zaharia@gmail.com(Server vezi Doamne)\n";
//$userheaders .= "Content-type: X-Mailer: php\r\n";
$userheaders.= "MIME-Version: 1.0" . "\n";
$userheaders .= "Content-type:text/html;charset=UTF-8" . "\n";
$usermessage = "Thank you for subscribing to our mailing list.";
$usermessage = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Username</th>
<th>Email</th>
<th>Password</th>
</tr>
<tr>
<td>$username</td>
<td>$email</td>
<td>$password</td>
</tr>
</table>
</body>
</html>
";
mail($email,$usersubject,$usermessage,$userheaders);
 // Redirect to login page
 header("location: login.php");
 
 } else{
 echo "Something went wrong. Please try again later.";
 }
 // Close statement
 $stmt->close();
 }

 
 }

 // Close connection
 $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Sign Up</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
 <style type="text/css">
 body{ font: 14px sans-serif; }
 .wrapper{ width: 350px; padding: 20px; }
 </style>
</head>
<body>
<td valign="top">
 <div class="wrapper">
 <h2>Sign Up</h2>
 <p>Please fill this form to create an account.</p>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
 <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
 <label>Username</label>
 <input type="text" name="username" class="form-control" value="<?php echo $username;
?>">
 <span class="help-block"><?php echo $username_err; ?></span>
 </div>
 <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
 <label>Password</label>
 <input type="password" name="password" class="form-control" value="<?php echo
$password; ?>">
 <span class="help-block"><?php echo $password_err; ?></span>
 </div>
 <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
 <label>Confirm Password</label>
 <input type="password" name="confirm_password" class="form-control" value="<?php echo
$confirm_password; ?>">
 <span class="help-block"><?php echo $confirm_password_err; ?></span>
 </div>
 <div class="form-group <?php echo (!empty($mail_err)) ? 'has-error' : ''; ?>">
 <label>E-mail</label>
 <input type="email" name="email" class="form-control" value="<?php echo
$email; ?>">
</div>
 <div class="form-group">
 <input type="submit" class="btn btn-primary" value="Submit">
 <input type="reset" class="btn btn-default" value="Reset">
 </div>
 <p>Already have an account? <a href="login.php">Login here</a>.</p>
 </form>
 </div>
</body>
</html>