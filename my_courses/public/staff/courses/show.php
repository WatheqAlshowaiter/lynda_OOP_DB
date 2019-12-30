<?php require_once('../../../private/init.php'); ?>
<?php require_login();?> 

<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$course = Course::find_by_id($id);

?>

<?php $page_title = 'Show Course: ' . h($course->name()); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>

  <a class="back-link" href="<?php echo url_for('/staff/courses/index.php'); ?>"> العودة لقائمة الكورسات &raquo;</a>

  <div class="course show rtl">

    <h1>الكورس: <?php echo h($course->name()); ?></h1>


  </div>
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
        <?php
        foreach (Course::LEVELS_OPTIONS as $level_id => $levels) :
          if ($course->level == $level_id) : ?>
            <dd><?php echo h($levels); ?></dd>
          <?php endif; ?>
        <?php endforeach; ?>
      </dl>
      <dl>
        <dt>المادة</dt>
        <dd><?php echo h($course->subject); ?></dd>
      </dl>
      <dl>
        <dt>اللغة</dt>
        <dd><?php echo h($course->language); ?></dd>
      </dl>
      <dl class="rtl">
        <dt>الطول بالساعات</dt>
        <dd><?php echo h($course->length_in_hours)  . " ساعة تقريبًا";  ?></dd>
      </dl>
      <dl>
        <dt>مكتملة؟</dt>
        <dd><?php echo h($course->is_course_complete()); ?></dd>
      </dl>
      <dl>
        <dt>التقييم الشخصي</dt>
        <dd><?php echo  "10 / " . h($course->my_rate)  ?></dd>
      </dl>
      <dl>
        <dt>تاريخ الإكمال</dt>
        <dd><?php echo h($course->date_of_completion); ?></dd>
      </dl>
      <dl>
        <dt>الرابط</dt>

        <?php
        if ($course->link) : ?>
          <dd><a target="_blank" href="<?= h($course->link); ?>">رابط الكورس على الويب</a> </dd>
        <?php else : ?>
          <dd> لا يوجد رابط </dd>
        <?php endif; ?>

      </dl>
      <dl>
        <dt>ملاحظات</dt>
        <dd><?php echo h($course->notes); ?></dd>
      </dl>
    </div>

  </div>


</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>