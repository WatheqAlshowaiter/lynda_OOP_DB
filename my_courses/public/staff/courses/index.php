<?php require_once('../../../private/init.php'); ?>

<?php

// Find all Courses;
$courses = Course::find_all();

?>
<?php $page_title = 'الكورسات'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <div class="main courses">
        <div class="row">
            <h1>الكورسات</h1>
        </div>
        <div class="row">
            <div class="twelve columns">
                <a class="action" href="<?php echo url_for('/staff/courses/new.php'); ?>">أضف كورسًا</a>
                <table class="rtl courses-table">
                    <thead>
                        <tr>
                            <th>اسم الكورس</th>
                            <th>المؤسسة</th>
                            <th>مقدم المحتوى</th>
                            <th>المستوى</th>
                            <th>المادة</th>

                            <th>الطول بالساعات</th>
                            <th>مكتملة؟</th>
                            <th>تقييمي</th>
                            <th>تاريخ الإكمال</th>
                            <th>الرابط</th>
                            <th>عرض كافة معلومات الكورس</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                    </thead>


                    <?php foreach ($courses as $course) : ?>

                        <tbody>
                            <tr>
                                <td><?= h($course->course_name); ?> </td>
                                <td><?= h($course->organization); ?> </td>
                                <td><?= h($course->teacher); ?> </td>                                
                                <td><?= h($course->level()); ?> </td>
                                <td><?= h($course->subject); ?> </td>

                                <td><?= h($course->length_in_hours); ?> </td>
                                <td><?= h($course->is_course_complete()); ?> </td>
                                <td><?= h($course->my_rate); ?> </td>
                                <td><?= h($course->date_of_completion); ?> </td>
                                <td> <a target="_blank" href=" <?= h($course->link); ?>">الرابط</a> </td>
                                <td><a class="action" href="<?php echo url_for('/staff/courses/show.php?id=' . h(u($course->id))); ?>">عرض</a></td>
                                <td><a class="action" href="<?php echo url_for('/staff/courses/edit.php?id=' . h(u($course->id))); ?>">تعديل</a></td>
                                <td><a class="action" href="<?php echo url_for('/staff/courses/delete.php?id=' . h(u($course->id))); ?>">حذف</a></td>
                            </tr>
                        </tbody>

                    <?php endforeach; ?>
                </table>

            </div>

        </div>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>