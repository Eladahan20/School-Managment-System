
<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/adminlist.php'; ?>

<form action="<?php echo URLROOT; ?>/users/adduser" method="post" enctype="multipart/form-data">
<h6 class="text-center">Create New User</h6>
<div class="form-group">
  <label for="name">Name: <sup>*</sup></label>
  <input type="text" name="name" class="form-control form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
  <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
</div>
<div class="form-group">
  <label for="email">Email: <sup>*</sup></label>
  <input type="email" name="email" class="form-control form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
  <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
</div>
<div class="form-group">
  <label for="password">Password: <sup>*</sup></label>
  <input type="password" name="password" class="form-control form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
  <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
</div>
<div class="form-group">
  <label for="confirm_password">Confirm Password: <sup>*</sup></label>
  <input type="password" name="confirm_password" class="form-control form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
  <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
</div>
<div class="form-group">
        <label for="phone">Phone: <sup>*</sup></label>
        <input type="number" name="phone" class="form-control form-control <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
        <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
    </div>
   
      <div class="form-group">
      <?php if ($_SESSION['user_role'] == 'Owner') { ?>
        <label class="custom-control custom-radio">
          <input id="radio1" name="role" value="Manager" type="radio" class="custom-control-input">
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description">Manager</span>
        </label>
    <?php } ?>
  <label class="custom-control custom-radio">
    <input id="radio2" name="role" value="Salesman" type="radio" class="custom-control-input" checked>
    <span class="custom-control-indicator"></span>
    <span class="custom-control-description">Salesman</span>
  </label>
  <span class="invalid-feedback <?php echo (!empty($data['role_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['role_err']; ?>
</div>
<div class="form-group">
        <label for="image">Upload Image: <sup>*</sup></label>
        <input type="file" name="image" class="form-control form-control <?php echo (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>">
        <span class="invalid-feedback"><?php echo $data['image_err']; ?></span>
    </div>
<input type="submit" value="Register User" class="btn btn-success btn-block">

<?php require APPROOT. '/views/inc/footer.php' ?>