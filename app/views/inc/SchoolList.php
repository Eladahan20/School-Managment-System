
<div class="row">
    <div class="col-md-3">
        <h3>Students List <a href="<?php echo URLROOT; ?>/students/addstudent"><i style="color:black" class="fa fa-pencil pull-right"></i></a></h3>
        <ul id="studentlist" class="list-group">
            <?php if (!empty($_SESSION['students'])) { ?>
                <?php foreach ($_SESSION['students'] as $student) : ?>
                    <a href="<?php echo URLROOT; ?>/students/displaystudent/<?php echo $student->idStudent; ?>">
                        <li id="s<?php echo $student->idStudent; ?>" class="list-group-item">
                            <div class="d-flex">
                                <div>  <img style="margin-right: 9px; width:50px" src="/projects/sms/public/img/<?php echo $student->StudentImage; ?>" alt="No photo">    </div>
                                <div> <?php echo $student->StudentName; ?></div>  
                            </div>
                        </li>
                    </a>
                <?php endforeach; ?>
            <?php } else { ?>
               <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> No students in school</p>
             <?php } ?>
        </ul>
    </div>
    <div class="col-md-3">
    <h3>Courses List <a href="<?php echo URLROOT; ?>/courses/addcourse"><i style="color:black" class="fa fa-pencil pull-right"></i></a></h3>
        <ul class="list-group">
          <?php if (!empty($_SESSION['courses'])) { ?>
            <?php foreach ($_SESSION['courses'] as $course) : ?>
                 <a href="<?php echo URLROOT; ?>/courses/displayCourse/<?php echo $course->idCourse; ?>"><li class="list-group-item"><?php echo $course->CourseName; ?></li></a>
            <?php endforeach; ?>
            <?php } else { ?>
               <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> No Courses in school</p>
             <?php } ?>
        </ul>
    </div>
    <div  class="col-md-6 frames">
     <h3 class="text-center">Overview</h3>

 