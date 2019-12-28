<?php


require_once('../../../private/init.php');

if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['admin'];

  $admin = new Admin($args);
  $result = $admin->save();

  if ($result == true) {
    $new_id = $admin->id;
    $_SESSION['message'] = 'أضيف المدير بنجاح!.';
    redirect_to(url_for('/staff/admins/show.php?id=' . $new_id));
  } else {
    // show errors
   
  }
} else {
  // display the form
  $admin = new Admin;
  
}

?>

<?php $page_title = 'أضف مديرًا'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">العودة للقائمة &raquo;</a>

  <div class="admin new">
    <h1>أضف كورسًا</h1>

    <?php  echo display_errors($admin->errors);  ?>

    <form action="<?php echo url_for('/staff/admins/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input class="button button-primary" type="submit" value="أضف المدير" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>