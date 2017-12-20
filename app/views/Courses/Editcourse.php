
<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/schoollist.php'; ?>

<h6 class="text-center">Edit Course</h6>
    <form  action="<?php echo URLROOT; ?>/Courses/editCourse/<?php echo $data['id']; ?>" method="POST" enctype="multipart/form-data">
               
                <div class="form-group">
                    <label for="name">Name: <sup>*</sup></label>
                    <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="description">Description: <sup>*</sup></label>
                    <textarea name="description" rows="5" class="form-control <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" ><?php echo $data['description']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                </div>
                <div class="ml-4 form-group">
                    <?php foreach ($_SESSION['students'] as $student) { ?>
                        <?php if (!empty($data['courseStudents']) && in_array($student->StudentName, $data['courseStudents'])) { ?>
                                <input name="<?php echo $student->idStudent;?>" type="checkbox" class="form-check-input" checked><?php echo $student->StudentName; ?><br>
                    <?php } else { ?>
                        <input name="<?php echo $student->idStudent;?>" type="checkbox" class="form-check-input"><?php echo $student->StudentName; ?><br>
                <?php } ?>
                <?php } ?>
                
                </div>
                        <input type="submit" value="Submit Changes" class="btn btn-success btn-block">
                        
        </form>

     <?php require APPROOT. '/views/inc/footer.php' ?>