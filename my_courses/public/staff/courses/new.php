<?php

require_once('../../../private/init.php');
if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['course'];

  $course = new Course($args);
  $result = $course->create(); 


  if ($result == true) {
    $new_id = $course->id;
    $_SESSION['message'] = 'أضيف الكورس بنجاح!.';
    redirect_to(url_for('/staff/courses/show.php?id=' . $new_id));
  } else {
    // show errors
   
  }
} else {
  // display the form
  $course = [];
}

?>

<?php $page_title = 'أضف كورسًا'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/courses/index.php'); ?>">العودة للقائمة &raquo;</a>

  <div class="course new">
    <h1>أضف كورسًا</h1>

    <?php // echo display_errors($errors); 
    ?>

    <form action="<?php echo url_for('/staff/courses/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input class="button button-primary" type="submit" value="أضف الكورس" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>