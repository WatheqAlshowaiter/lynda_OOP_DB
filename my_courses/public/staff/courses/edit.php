<?php

require_once('../../../private/init.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/courses/index.php'));
}
$id = $_GET['id'];
$course =  Course::find_by_id($id);
if( $course == false){
  redirect_to(url_for('/staff/courses/index.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['course'];

  $course->merge_attributes($args);
  $result = $course->save(); 

  if($result == true) { // not === true 
    $_SESSION['message'] = 'The course was updated successfully.';
    redirect_to(url_for('/staff/courses/show.php?id=' . $id));
  } else {
    // show errors
  }

} else {  // is get request

  // display the form
  
}

?>

<?php $page_title = 'عدّل الكورس'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/courses/index.php'); ?>">&laquo; Back to List</a>

  <div class="course edit">
    <h1>تعديل الكورس</h1>

    <?php // echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/courses/edit.php?id=' . h(u($id))); ?>" method="post">

      <?php include('form_fields.php'); ?>
      
      <div id="operations">
        <input type="submit" value="تحديث الكورس" class="button-primary" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
