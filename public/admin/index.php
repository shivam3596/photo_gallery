<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()) {
  //redirect_to('login.php');
}

?>

<?php include '../layouts/admin_header.php'; ?>
<?php echo output_message($message); ?>
  <h2>Menu</h2>
  <ul>
    <li><a href="list_photos.php">list photos</a></li>
    <li><a href="logout.php"></a>Logout</li>
  </ul>
  </div>
<?php include '../layouts/admin_footer.php'; ?>
