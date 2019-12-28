<?php

require_once('../../../private/init.php');

if (!isset($_GET['id'])) {
  redirect_to(url_for('/staff/admins/index.php'));
}
$id = $_GET['id'];
$course = Course::find_by_id($id);
if ($course == false) {
  redirect_to(url_for('/staff/courses/index.php'));
}

if (is_post_request()) {

  // Delete bicycle
  $result = $course->delete();

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
    <h1>حذف الكورس</h1>
    <p>هل تريد حذف هذا الكورس؟</p>
    <p class="item"><?php echo h("« " . $course->course_name . " »"); ?></p>


    <form action="<?php echo url_for('/staff/courses/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="حذف الكورس" class="btn-del" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>