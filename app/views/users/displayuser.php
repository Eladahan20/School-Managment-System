
<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/adminlist.php'; ?>
<h6 class="text-center">Display Admin</h6>
    <div class="displayForm ml-4 row">
        <div class="col-md-6 mt-3 mb-3">
            <p><strong>Name: </strong><?php echo $data['user']->userName; ?></p>
            <p><strong>Email: </strong><?php echo $data['user']->userEmail; ?></p>
            <p><strong>Phone: </strong><?php echo $data['user']->userPhone; ?></p>
            <p><strong>Role: </strong><?php echo $data['user']->userRole; ?></p>
        </div>
        <div class="col-md-3 mt-3 mb-3">
            <img style="width:165px; height:160px;" src="<?php echo URLROOT; ?> /public/img/<?php echo $data['user']->userImage; ?>" alt="No photo">
        </div>

             <a href="<?php echo URLROOT ?>/users/edituser/<?php echo $data['user']->iduser ?>" class="btn btn-secondary btn-block">Edit User</a>
             <a href="<?php echo URLROOT ?>/users/deleteuser/<?php echo $data['user']->iduser ?>" class="btn btn-danger btn-block">Delete User</a>
    </div>
    <?php require APPROOT. '/views/inc/footer.php' ?>
