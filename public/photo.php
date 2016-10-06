<?php
require_once("../includes/initialize.php");
?>

<?php include 'layouts/header.php'; ?>
  <h2>Photo view</h2>
  <a href="index.php">  << Back </a>
<?php $id = $_GET['id'] ?>

<?php $photo = Photograph::find_by_id($id); ?>
<?php echo output_message($message); ?>
<img src="images/<?php echo $photo->filename; ?>"/>


<?php
  if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::make($photo->id, $author, $body);
    if ($new_comment && $new_comment->save()) {
      // comment saved
      redirect_to("photo.php?id={$photo->id}");
    }else {
      //failed
      $message = "Error";
    }
  }else {
    $author = "";
    $body = "";
  }

  $comments = Comment::find_comments_on($photo->id);

?>
<hr>
<div id="comments">
  <?php foreach($comments as $comment): ?>
    <div class="comment" style="margin-bottom:2em;">
      <div class="author">
        <strong><em><p>
        <?php echo htmlentities($comment->author); ?> wrote:
        </p></em></strong>
      </div>
      <div class="body">
        <?php echo strip_tags($comment->body);?>
      </div>
      <div class="meta-info" style="font-size: 0.8em;">
        <?php echo datetime_to_text($comment->created); ?>
      </div>
    </div>
  <?php endforeach; ?>
<?php
  if (empty($comments)) {
    echo "No comments.";
  }
?>
</div>

<hr>
<div id="comment-form">
  <h3>New comment</h3>
  <?php echo output_message($message); ?>
  <form class="" action="photo.php?id=<?php echo $photo->id; ?>" method="post">
      <table>
        <tr>
          <td>Your name:</td>
          <td><input type="text" name="author" value="<?php echo $author; ?>"></td>
        </tr>
        <tr>
          <td>Your comment:</td>
          <td><textarea name="body" rows="8" cols="40"><?php echo $body; ?></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="submit" value="Submit comment"></td>
        </tr>
      </table>
  </form>
</div>
</div>
<?php include 'layouts/footer.php'; ?>
