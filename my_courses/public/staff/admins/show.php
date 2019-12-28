<?php require_once('../../../private/init.php'); ?>

<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

if (!$id) {
  redirect_to(url_for('/staff/admins/index.php'));
}

$admin  = Admin::find_by_id($id);

?>

<?php $page_title = 'عرض المدير: ' . h($admin->full_name()); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>"> العودة لقائمة المديرين &raquo;</a>

  <div class="admin show rtl">
    <h1>المدير: <?php echo h($admin->full_name()); ?></h1>
  </div>
  <div id="page">
    <div class="detail">
      <dl>
        <dt>المعرف</dt>
        <dd><?php echo h($admin->id); ?></dd>
      </dl>
      <dl>
        <dt>الاسم الأول</dt>
        <dd><?php echo h($admin->first_name); ?></dd>
      </dl>
      <dl>
        <dلاt>الاسم الأخير </dلاt>
        <dd><?php echo h($admin->last_name); ?></dd>
      </dl>
      <dl>
        <dt>البريد الإلكتروني</dt>
        <dd><?php echo h($admin->email); ?></dd>
      </dl>
      <dl>
        <dt>اسم المستخدم</dt>
        <dd><?php echo h($admin->username); ?></dd>
      </dl>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>