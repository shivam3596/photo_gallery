<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()) {
  //redirect_to('login.php');
}
?>

<?php
  $max_file_size = 1048576;
  $message = "";
  if (isset($_POST['submit'])) {
    $photo = new Photograph();
    $photo->caption = $_POST['caption'];
    $photo->attach_file($_FILES['file_upload']);
    if ($photo->save()) {
      $session->message("photo uploaded successfully.");
      redirect_to('list_photos.php');
    }else {
      $message = join("<br>", $photo->errors);
    }
  }
?>

<?php include '../layouts/admin_header.php'; ?>

<h2>Photo upload</h2>
<?php echo output_message($message); ?>
<form action="photo_upload.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="MAX__FILE_SIZE" value="1000000">
  <p>
    <input type="file" name="file_upload" />
  </p>
  <p>
    Caption: <input type="text" name="caption" value="" />
  </p>
  <input type="submit" name="submit" value="upload" />
</form>
</div>

<?php include '../layouts/admin_footer.php'; ?>
