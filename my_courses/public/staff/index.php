<?php require_once('../../private/init.php'); ?>

<?php $page_title = 'قائمة الموظفين'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div class="main rtl">
  <div class="row menu">
    <h2>القائمة الرئيسية</h2>
    <ul>
      <li> <a href="<?php echo url_for('/staff/courses/index.php'); ?>">كورساتي</a></li>
    </ul>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
