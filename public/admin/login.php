<?php
require_once("../../includes/initialize.php");

if ($session->is_logged_in()) {
  redirect_to("index.php");
}

if (isset($_POST['submit'])) {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  $found_user = User::authenticate($username,$password);

  if ($found_user) {
    $session->login($found_user);
    redirect_to("index.php");
  }else {
    $message = "username/password is incorrect.";
  }
}else {
  $username = "";
  $password = "";
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>photo gallery</title>
    <link rel="stylesheet" href="../css/main.css" media="screen" title="no title">
  </head>
  <body>
    <div id="header">
      <h1>photo gallery</h1>
    </div>
    <div id="main">
      <h2>staff login</h2>
      <?php echo output_message($message); ?>

      <form action="login.php" method="post">
        <table>
          <tr>
            <td>username:</td>
            <td>
              <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
            </td>
          </tr>
          <tr>
            <td>Password:</td>
            <td>
              <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($username); ?>" />
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Login" />
            </td>
          </tr>
        </table>
      </form>
    </div>

<?php include '../layouts/admin_footer.php'; ?>
<?php
  if (isset($database)) {
  $database->close_connection();
}
?>
