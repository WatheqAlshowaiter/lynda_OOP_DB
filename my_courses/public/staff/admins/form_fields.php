<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if (!isset($admin)) {
  redirect_to(url_for('/staff/admins/index.php'));
}
?>
<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>الاسم الأول</dt>
    <dd><input class="u-full-width rtl" type="text" name="admin[first_name]" value="<?php echo $admin->first_name; ?>" autofocus /></dd>
  </dl>
</div>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>الاسم الثاني</dt>
    <dd><input class="u-full-width rtl" type="text" name="admin[last_name]" value="<?php echo $admin->last_name; ?>" /></dd>
  </dl>
</div>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>البريد الإلكتروني</dt>
    <dd><input class="u-full-width" type="email" name="admin[email]" value="<?php echo $admin->email; ?>" /></dd>
  </dl>
</div>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>اسم المستخدم</dt>
    <dd><input class="u-full-width rtl" type="text" name="admin[username]" value="<?php echo $admin->username; ?>" /></dd>
  </dl>
</div>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>كلمة المرور</dt>
    <dd><input class="u-full-width" type="password" name="admin[password]" value="<?php echo $admin->password; ?>" /></dd>
  </dl>
</div>
<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>تأكيد كلمة المرور</dt>
    <dd><input class="u-full-width" type="password" name="admin[confirm_password]" value="<?php echo $admin->confirm_password; ?>" /></dd>
  </dl>
</div>
