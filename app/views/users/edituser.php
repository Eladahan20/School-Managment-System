
<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/adminlist.php'; ?>

<h6 class="text-center">Edit User</h6>
    <form action="<?php echo URLROOT; ?>/users/edituser/<?php echo $data['id']; ?>" method="POST" enctype="multipart/form-data">

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
        <input type="number" name="phone" class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone'];?>">
        <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
    </div>
    <div class="form-group">
        <label class="custom-control custom-radio">
            <input id="radio1" name="role" value="Manager" type="radio" class="custom-control-input" <?php if ($data['role'] == 'Manager') { echo "checked"; }?>>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Manager</span>
        </label>
        <label class="custom-control custom-radio">
            <input id="radio2" name="role" value="Salesman" type="radio" class="custom-control-input" <?php if ($data['role'] == 'Salesman') { echo "checked"; } ?>>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Salesman</span>
        </label>
        <span class="invalid-feedback <?php echo (!empty($data['role_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['role_err']; ?>
  </div>
  <input type="submit" value="Submit Changes" class="btn btn-success btn-block">
     
</form>


<?php require APPROOT. '/views/inc/footer.php' ?>
