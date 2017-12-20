<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/schoollist.php'; ?>
<h6 class="text-center">Display Course</h6>

<div class="displayForm ml-4 row">
        <div class="col-md-8 mt-3 mb-3">
            <p><strong>Name: </strong><?php echo $data['course']->CourseName; ?></p>
            <p><strong>Description: <br></strong><?php echo $data['course']->CourseDescription; ?></p>
            <p><strong>Students: </strong><?php echo $data['course_amount']; ?></p>
        </div>
        <div class="col-md-4 mt-3 mb-3 ">
            <img style="width:125px; height:105px;" src="<?php echo URLROOT; ?> /public/img/<?php echo $data['course']->CourseImage; ?>" alt="No photo">
        </div>

        <div class="mb-3">
            <h5>Students taking the course:</h5>
            <ul class="list-group">
                <?php if (!empty($data['courseStudents'])) { ?>
                    <?php foreach($data['courseStudents'] as $student) : ?>
                        <li class="list-group-item"><?php echo $student ?></li>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> No student is taking this course.</p>
             <?php } ?>

        </div>
        <a href="<?php echo URLROOT ?>/courses/editcourse/<?php echo $data['course']->idCourse ?>" class="btn btn-secondary btn-block">Edit Course</a>
        <a href="<?php echo URLROOT ?>/courses/deletecourse/<?php echo $data['course']->idCourse ?>" class="btn btn-danger btn-block">Delete Course</a>
        </div>

     <?php require APPROOT. '/views/inc/footer.php' ?>
