<?php require_once('../private/init.php'); ?>

<?php

  // Get requested ID
  $id = $_GET['id']?? false;

  if ( !$id ){ // ! isset($id) // WILL NOT WORK CORRECTLY 
    redirect_to('courses.php');
  }
  // Find bicycle using ID
  $course = Course::find_by_id($id);

?>

<?php $page_title = 'Detail- '?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

<a href="courses.php">عودة إلى صفحة الكورسات &raquo;</a>

  <div id="page">

    <div class="detail">
      <dl>
        <dt>اسم الكورس</dt>
        <dd><?php echo h($course->course_name); ?></dd>
      </dl>
      <dl>
        <dt>المؤسسة</dt>
        <dd><?php echo h($course->organization); ?></dd>
      </dl>
      <dl>
        <dt>مقدم المحتوى</dt>
        <dd><?php echo h($course->teacher); ?></dd>
      </dl>
      <dl>
        <dt>المستوى</dt>
        <dd><?php echo h($course->level); ?></dd>
      </dl>
      <dl>
        <dt>المادة</dt>
        <dd><?php echo h($course->subject); ?></dd>
      </dl>
      <dl>
        <dt>اللغة</dt>
        <dd><?php echo h($course->language); ?></dd>
      </dl>
      <dl>
        <dt>الطول بالساعات</dt>
        <dd><?php echo h($course->length_in_hours)?></dd>
      </dl>
      <dl>
        <dt>مكتملة؟</dt>
        <dd><?php echo h($course->is_course_complete()); ?></dd>
      </dl>
      <dl>
        <dt>التقييم الشخصي</dt>
        <dd><?php echo h($course->my_rate); ?></dd>
      </dl>
      <dl>
        <dt>تاريخ الإكمال</dt>
        <dd><?php echo h($course->date_of_completion); ?></dd>
      </dl>
      <dl>
        <dt>الرابط</dt>
        <dd><a target="_blank" href="<?= h($course->link); ?>">رابط الكورس على الويب</a> </dd>
      </dl>
      <dl>
        <dt>ملاحظات</dt>
        <dd><?php echo h($course->notes); ?></dd>
      </dl>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
