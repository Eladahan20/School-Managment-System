
<?php require APPROOT. '/views/inc/header.php'; ?>
<?php require APPROOT. '/views/inc/schoollist.php'; ?>
<h6 class="text-center">Delete Course</h6>


    <form class="mt-5" action="<?php echo URLROOT; ?>/courses/deletecourse/<?php echo $data['id']; ?>" method="POST" enctype="multipart/form-data">
       <h5 class="text-center"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> You are about to delete this course. <br> Are you sure?</h5>
       <div class="row">
            <div class="col">
                    <button class="btn btn-danger btn-block">YES</button>    
            </div>
            <div class="col">
                     <a href="<?php echo URLROOT ?>/courses/displaycourse/<?php echo $data['id']; ?> " class="btn btn-secondary btn-block">NO</a>  
            </div>
       </div>
    </form>


     <?php require APPROOT. '/views/inc/footer.php' ?>
