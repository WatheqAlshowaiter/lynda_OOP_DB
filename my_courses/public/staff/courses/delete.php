<?php

require_once('../../../private/init.php');

if(!isset($_GET['id'])) {
  // redirect_to(url_for('/staff/courses/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Delete bicycle

  $_SESSION['message'] = 'The Course was deleted successfully.';
  redirect_to(url_for('/staff/courses/index.php'));

} else {
  // Display form
}

?>

<?php $page_title = 'Delete Course'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/courses/index.php'); ?>"> العودة للقائمة&raquo;</a>

  <div class="course delete">
    <h1>Delete course</h1>
    <p>Are you sure you want to delete this course?</p>
    <p class="item"><?php echo h('course name'); ?></p>

    <form action="<?php echo url_for('/staff/courses/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete course" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
