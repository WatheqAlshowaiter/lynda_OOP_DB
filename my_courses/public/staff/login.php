<?php
require_once('../../private/init.php');

$errors = [];
$username = '';
$password = '';

// username to login: watheqwatheq
// password to login: 123!aA

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    $admin = Admin::find_by_username($username);
    // test if admin found and password is correct
    if($admin != false && $admin->verify_password($password)) {
      // Mark admin as logged in
      $session->login($admin);
      redirect_to(url_for('/staff/index.php'));
    } else {
      // username not found or password does not match
      $errors[] = "هناك خطأ في تسجيل الدخول. حاول مرة أخرى";
    }

  }

}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <h1>تسجيل الدخول </h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    :اسم المستخدم<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
    :كلمة المرور<br />
    <input type="password" name="password" value="" /><br />
    <input class="button button-primary" type="submit" name="submit" value="تسجل الدخول"  />
  </form>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
