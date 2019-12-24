<?php require_once('../private/init.php'); ?>

<?php $page_title = "Courses"; ?>


<?php include(SHARED_PATH . '/public_header.php'); ?>

<div>
    <div class="main courses">
        <div class="row">
            <div class="ten columns item-text">
                <h2>هذه جميع الكورسات التي أخذتها</h2>
            </div>
            <div class="two columns item-img">
                <img src="<?= url_for('images/brain-small.jpeg') ?>" alt="feed your brain">
            </div>

        </div>
        <div class="row">
            <div class="twelve columns">
                <table class="rtl courses-table">
                    <thead>
                        <tr>
                            <th>اسم الكورس</th>
                            <th>المؤسسة</th>
                            <th>مقدم المحتوى</th>
                            <th>المستوى</th>
                            <th>المادة</th>
                            <th>الطول بالساعات</th>
                            <th>مكتمل؟</th>
                            <th>تقييمي</th>
                            <th>تاريخ الإكمال</th>
                            <th>الرابط</th>
                            <th>عرض جميع المعلومات للكورس</th>
                        </tr>
                    </thead>

                    <?php
                      $courses = Course::find_all();
                    ?>

                    <?php foreach ($courses as $course) : ?>

                        <tbody>
                            <tr>
                                <td><?= h($course->course_name); ?> </td>
                                <td><?= h($course->organization); ?> </td>
                                <td><?= h($course->teacher); ?> </td>
                                <td><?= h($course->level); ?> </td>
                                <td><?= h($course->subject); ?> </td>
                                <td><?= h($course->length_in_hours); ?> </td>
                                <td><?= h($course->is_course_complete()); ?> </td>
                                <td><?= h($course->my_rate); ?> </td>
                                <td><?= h($course->date_of_completion); ?> </td>
                                <td> <a target="_blank" href=" <?= h($course->link); ?>">الرابط</a> </td>
                                <td><a href="detail.php?id=<?= $course->id?>">عرض</a></td>
                            </tr>
                        </tbody>

                    <?php endforeach; ?>
                </table>

            </div>

        </div>

    </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>