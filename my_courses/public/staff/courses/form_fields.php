<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if (!isset($course)) {
  redirect_to(url_for('/staff/courses/index.php'));
}
?>
<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>اسم الكورس</dt>
    <dd><input class="u-full-width" type="text" name="course_name" value="<?php echo $course->course_name; ?>" autofocus /></dd>
  </dl>
</div>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>المؤسسة</dt>
    <dd><input class="u-full-width rtl" type="text" name="organization" value="<?php echo $course->organization; ?>" /></dd>
  </dl>
</div>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>مقدم المحتوى</dt>
    <dd><input class="u-full-width rtl" type="text" name="teacher" value="<?php echo $course->teacher; ?>" /></dd>
  </dl>
</div>

<div class="row">
  <dl class="three columns u-pull-right">
    <dt>المستوى</dt>
    <dd>
      <select class="u-full-width rtl" name="level">
        <?php foreach (Course::LEVELS_OPTIONS as $level_id => $levels) : ?>
          <option value="<?php echo $level_id; ?>" <?php if ($course->level == $level_id) :
                                                      echo " selected";
                                                    endif; ?>><?php echo $levels; ?></option>
        <?php endforeach; ?>
      </select>
    </dd>
  </dl>
</div>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>المادة</dt>
    <dd><input class="u-full-width" type="text" name="subject" value="<?php echo $course->subject; ?>" /></dd>
  </dl>
</div>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>اللغة</dt>
    <dd>
      <select name="language">
        <?php foreach (Course::LANGUAGES as $langs) : ?>
          <option value="<?php echo $langs; ?>" <?php if ($course->language == $langs) {
                                                  echo "selected";
                                                } ?>><?php echo $langs; ?></option>
        <?php endforeach; ?>
      </select>
    </dd>
  </dl>
</div>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>الطول بالساعات</dt>
    <dd class=>ساعة / ساعات <input class="lngth-hrs" type="number" name="length_in_hours" value="<?php echo $course->length_in_hours; ?>" /></dd>
  </dl>
</div>

<div class="row">
  <dl class="three columns u-pull-right">
    <dt>مكتملة؟</dt>
    <dd class="">
      <label for="no_radio" class="u-full-width six columns">
        <input type="radio" name="is_course_complete" value="0" id="no_radio" <?php if ($course->is_course_complete == false) {
                                                                                echo "checked";
                                                                              } ?> />&nbsp; لا
      </label>
      <label for="yes_radio" class="u-full-width six columns">
        <input type="radio" name="is_course_complete" value="1" id="yes_radio" <?php if ($course->is_course_complete == true) {
                                                                                  echo "checked";
                                                                                } ?> />&nbsp;نعم
      </label>

    </dd>
  </dl>

</div>

<dl>
  <dt> التقييم الشخصي من 10</dt>
  <dd>
    <select name="my_rate" id="">
      <?php for ($i = 1; $i <= 10; $i++) : ?>
        <?php echo "<option value='$i'";
        if ($course->my_rate == $i) {
          echo " selected";
        }
        echo ">$i</option>"; ?>
      <?php endfor; ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>تاريخ الإكمال</dt>
  <dd><input type="date" name="date_of_completion" value="<?php echo $course->date_of_completion; ?>"></input></dd>
</dl>

<div class="row">
  <dl class="eight columns u-pull-right">
    <dt>الرابط</dt>
    <dd><input class="u-full-width" type="url" name="link" value="<?= $course->link; ?>"></input></dd>
  </dl>
</div>

<div class="row">
<dl class="eight columns u-pull-right">
  <dt>ملاحظات</dt>
  <dd><textarea  class="u-full-width notes rtl" cols="30" rows="50" name="notes"><?= $course->notes; ?></textarea></dd>
</dl>
</div>
