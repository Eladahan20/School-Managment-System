
<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/schoollist.php'; ?>


<form action="<?php echo URLROOT; ?>/Students/addStudent" method="POST" enctype="multipart/form-data">
    <h6 class="text-center">Create New Student</h6>
    <div class="form-group">
        <label for="name">Name: <sup>*</sup></label>
        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="email">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="phone">Phone: <sup>*</sup></label>
        <input type="number" name="phone" class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
        <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
    </div>
    <div class="form-group">
        <label for="image">Upload Image: <sup>*</sup></label>
        <input type="file" name="image" class="form-control form-control-lg <?php echo (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>">
        <span class="invalid-feedback"><?php echo $data['image_err']; ?></span>
    </div>
        <input type="submit" value="Register Student" class="btn btn-success btn-block">
       

  
</form>
        

<?php require APPROOT. '/views/inc/footer.php' ?>

