<?php require_once("../../includes/initialize.php"); ?>
<?php
  if (!$session->is_logged_in()) {
  //redirect_to('login.php');
}
?>

<?php
  $photos = Photograph::find_all();
?>
<?php include '../layouts/admin_header.php'; ?>

<h2>Photographs</h2>
<?php echo output_message($message); ?>
<table class="bordered">
  <tr>
    <th>image</th>
    <th>filename</th>
    <th>caption</th>
    <th>size</th>
    <th>type</th>
    <th>&nbsp;</th>
  </tr>
  <?php foreach($photos as $photo): ?>
    <tr>
      <td><img src="../../public/images/<?php echo $photo->filename; ?>" width="100" /></td>
      <td><?php echo $photo->filename; ?></td>
      <td><?php echo $photo->caption; ?></td>
      <td><?php echo $photo->size_as_text(); ?></td>
      <td><?php echo $photo->type; ?></td>
      <td><a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
</table>
<br>
<a href="photo_upload.php">upload new photo</a>
<?php include '../layouts/admin_footer.php'; ?>
