
<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/schoollist.php'; ?>

<h6 class="text-center">Edit Student</h6>
    <form action="<?php echo URLROOT; ?>/Students/editStudent/<?php echo $data['id']; ?>" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="name">Name: <sup>*</sup></label>
        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']?>">
        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="email">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="phone">Phone: <sup>*</sup></label>
        <input type="number" name="phone" class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']  ;?>">
        <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
    </div>

    <div class="ml-4 form-group">
 
    <?php foreach ($_SESSION['courses'] as $course) { ?>
        <?php if (!empty($data['studentCourses']) && in_array($course->CourseName, $data['studentCourses'])) { ?>
                <input name="<?php echo $course->idCourse;?>" type="checkbox" class="form-check-input" checked><?php echo $course->CourseName; ?><br>
       <?php } else { ?>
        <input name="<?php echo $course->idCourse;?>" type="checkbox" class="form-check-input"><?php echo $course->CourseName; ?><br>
   
   <?php } ?>
   <?php } ?>
   
  </div>
        <input type="submit" value="Submit Changes" class="btn btn-success btn-block">
     
</form>


     <?php require APPROOT. '/views/inc/footer.php' ?>
