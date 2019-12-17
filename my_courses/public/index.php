<?php require_once('../private/init.php'); ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>
<div class="main">
    <div class="row menu">
        <div class="item six columns">
            <a class=" button" href="<?= url_for('about.php'); ?>">حول</a>
        </div>
        <div class="item six columns ">
            <a class="button button-primary" href="<?= url_for('courses.php'); ?>">اعرض كورساتي</a>
        </div>

    </div>
</div>
<?php $super_hero_image = "learn.jpg";  ?>
<?php include(SHARED_PATH . '/public_footer.php'); ?>