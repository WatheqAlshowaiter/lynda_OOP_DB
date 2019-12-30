<?php require_once('../../../private/init.php'); ?>
<?php require_login();?> 

<?php

// Find all admins;
$admins = Admin::find_all();

?>
<?php $page_title = 'المديرون'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div>
    <div class="main admins">
        <div class="row">
            <h1>المديرون</h1>
        </div>
        <div class="row">
            <div class="twelve columns">
                <a class="action" href="<?php echo url_for('/staff/admins/new.php'); ?>">أضف مديرًا</a><br>
                <table class="rtl admins-table u-pull-right">
                    <thead>
                        <tr>
                            <th>المعرف</th>
                            <th>الاسم الأول</th>
                            <th>الاسم الأخير </th>
                            <th>البريد الإلكتروني</th>
                            <th>اسم المستخدم</th>
                            <th>عرض</th>
                            <th>تعديل</th>
                            <th>حذف</th>

                        </tr>
                    </thead>


                    <?php foreach ($admins as $admin) : ?>

                        <tbody>
                            <tr>
                                <td><?= h($admin->id); ?> </td>
                                <td><?= h($admin->first_name); ?> </td>
                                <td><?= h($admin->last_name); ?> </td>
                                <td><?= h($admin->email); ?> </td>
                                <td><?= h($admin->username); ?> </td>

                                <td><a class="action" href="<?php echo url_for('/staff/admins/show.php?id=' . h(u($admin->id))); ?>">عرض</a></td>
                                <td><a class="action" href="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($admin->id))); ?>">تعديل</a></td>
                                <td><a class="action" href="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin->id))); ?>">حذف</a></td>
                            </tr>
                        </tbody>

                    <?php endforeach; ?>
                </table>

            </div>

        </div>

    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>