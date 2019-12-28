<?php

require_once('../../../private/init.php');

if (!isset($_GET['id'])) {
  redirect_to(url_for('/staff/admins/index.php'));
}
$id = $_GET['id'];
$admin = Admin::find_by_id($id);
if ($admin == false) {
  redirect_to(url_for('/staff/admins/index.php'));
}

if (is_post_request()) {

  // Delete bicycle
  $result = $admin->delete();

  $_SESSION['message'] = 'The admin was deleted successfully.';
  redirect_to(url_for('/staff/admins/index.php'));
} else {
  // Display form
}

?>

<?php $page_title = 'حذف المدير'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>"> العودة للقائمة &raquo;</a>

  <div class="admin delete">
    <h1>حذف المدير</h1>
    <p>هل تريد حذف هذا المدير؟</p>
    <p class="item"><?php echo h("« " . $admin->full_name() . " »"); ?></p>


    <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="حذف المدير" class="btn-del" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>