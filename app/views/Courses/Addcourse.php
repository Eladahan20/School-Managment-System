
<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/SchoolList.php'; ?>

<form action="<?php echo URLROOT; ?>/courses/addCourse" method="POST" enctype="multipart/form-data">
    <h6 class="text-center">Create New Course</h6>
    <div class="form-group">
        <label for="name">Name: <sup>*</sup></label>
        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="description">Description: <sup>*</sup></label>
        <textarea name="description" rows="5" class="form-control <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['description']; ?>"></textarea>
        <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
    </div>

    <div class="form-group">
    <label for="image">Upload Image: <sup>*</sup></label>
    <input type="file" name="image" class="form-control form-control-lg <?php echo (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>">
    <span class="invalid-feedback"><?php echo $data['image_err']; ?></span>
</div>
       
  
        <input type="submit" value="Create Course" class="btn btn-success btn-block">
       

  
</form>
        
    


<?php require APPROOT. '/views/inc/footer.php' ?>

