<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($course)) {
   redirect_to(url_for('/staff/courses/index.php'));
}
?>

<dl>
  <dt>اسم الكورس</dt>
  <dd><input type="text" name="course_name" value="" /></dd>
</dl>

<dl>
  <dt>المؤسسة</dt>
  <dd ><input class="rtl" type="text" name="organization" value="" /></dd>
</dl>

<dl>
  <dt>مقدم المحتوى</dt>
  <dd><input type="text" name="teacher" value="" /></dd>
</dl>

<dl>
  <dt>المستوى</dt>
  <dd><input type="text" name="level" value="" /></dd>
</dl>

<dl>
  <dt>المادة</dt>
  <dd><input type="text" name="subject" value="" /></dd>
</dl>

<dl>
  <dt>اللغة</dt>
  <dd><input type="text" name="language" value="" /></dd>
</dl>

<dl>
  <dt>الطول بالساعات</dt>
  <dd><input type="text" name="length_in_hours" value="" /></dd>
</dl>

<dl>
  <dt>مكتملة؟</dt>
  <dd><input type="text" name="is_course_complete" value="" /></dd>
</dl>

<dl>
  <dt>التقييم الشخصي</dt>
  <dd><input type="text" name="my_rate" value="" /></dd>
</dl>

<dl>
  <dt>تاريخ الإكمال</dt>
  <dd><input type="text" name="date_of_completion" ></input></dd>
</dl>

<dl>
  <dt>الرابط</dt>
  <dd><input type="text" name="link" ></input></dd>
</dl>

<dl>
  <dt>ملاحظات</dt>
  <dd><textarea cols="30" rows="30" name="notes" ></textarea></dd>
</dl>