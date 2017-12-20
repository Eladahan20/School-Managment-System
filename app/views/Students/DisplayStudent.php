
<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/schoollist.php'; ?>
<h6 class="text-center">Display Student</h6>
    <div class="displayForm ml-4 row">
        <div class="col-md-6 mt-3 mb-3">
            <p><strong>Name: </strong><?php echo $data['student']->StudentName; ?></p>
            <p><strong>Email: </strong><?php echo $data['student']->StudentEmail; ?></p>
            <p><strong>Phone: </strong><?php echo $data['student']->StudentPhone; ?></p>
        </div>
        <div class="col-md-3 mt-3 mb-3">
            <img style="width:165px; height:160px;" src="<?php echo URLROOT; ?> /public/img/<?php echo $data['student']->StudentImage; ?>" alt="No photo">
        </div>
        <div class="mb-3">
            <h5>Takes the following courses:</h5>
            <ul class="list-group">
                <?php if (!empty($data['studentCourses'])) { ?>
                    <?php foreach($data['studentCourses'] as $course) : ?>
                        <li class="list-group-item"><?php echo $course ?></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> This student is not assign to any course yet.</p>
             <?php } ?>
             </div>
             <a href="<?php echo URLROOT ?>/students/editstudent/<?php echo $data['student']->idStudent ?>" class="btn btn-secondary btn-block">Edit Student</a>
             <a href="<?php echo URLROOT ?>/students/deletestudent/<?php echo $data['student']->idStudent ?>" class="btn btn-danger btn-block">Delete Student</a>
    </div>
    <?php require APPROOT. '/views/inc/footer.php' ?>
