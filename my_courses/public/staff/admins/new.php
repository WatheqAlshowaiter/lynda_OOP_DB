<?php


require_once('../../../private/init.php');
require_login();

if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['admin'];
  // var_dump($args);
  $admin = new Admin($args);
  // var_dump($admin);
  $result = $admin->save();
  // var_dump("resut: ", $result);

  if ($result == true) {
    $new_id = $admin->id;
    
    $session->message('أضيف المدير بنجاح');
    redirect_to(url_for('/staff/admins/show.php?id=' . $new_id));
  } else {
    // show errors
    // echo "result is not true";
  }
} else {
  // display the form
  $admin = [];
}

?>

<?php $page_title = 'أضف مديرًا'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">العودة للقائمة &raquo;</a>

  <div class="admin new">
    <h1>أضف كورسًا</h1>

    <?php echo display_errors($admin->errors);  ?>

    <form action="<?php echo url_for('/staff/admins/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input class="button button-primary" type="submit" value="أضف المدير" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>