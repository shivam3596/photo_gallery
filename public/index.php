<?php
require_once("../includes/initialize.php");
?>

<?php
  //the current page number ($current_page)
  $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

  // records per page ($per_page)
  $per_page = 3;

  // total record count ($total_count)
  $total_count = Photograph::count_all();

  //Pagination
  $pagination = new Pagination($page, $per_page, $total_count);

  $sql = "SELECT * FROM photographs ";
  $sql .= "LIMIT {$per_page} ";
  $sql .= "OFFSET {$pagination->offset()}";
  $photos = Photograph::find_by_sql($sql);

?>

<?php //$photos = Photograph::find_all(); ?>

<?php include 'layouts/header.php'; ?>
  <h2>Menu</h2>
<?php foreach($photos as $photo): ?>
  <a href="photo.php?id=<?php echo $photo->id; ?>" ><img src="images/<?php echo $photo->filename; ?>" height ="200" width="200" /></a>
<?php endforeach; ?>

<div id="pagination" style="clear: both;">
<?php
  if ($pagination->total_pages() > 1) {

    if ($pagination->has_previous_page()) {
      echo "<a href=\"index.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> ";
    }

    for ($i=1; $i <= $pagination->total_pages(); $i++) {
      echo "<a href=\"index.php?page={$i}\">{$i}</a> ";
    }

    if ($pagination->has_next_page()) {
      echo "<a href=\"index.php?page=";
      echo $pagination->next_page();
      echo "\">Next &raquo;</a> ";
    }
  }
?>
</div>

</div>
<?php include 'layouts/footer.php'; ?>
