
<div class="row">
    <div class="col-md-3">
        <h3>Admins List <a href="<?php echo URLROOT; ?>/users/adduser"><i style="color:black" class="fa fa-pencil pull-right"></i></a></h3>
        <ul id="userslist" class="list-group">
            <?php if (!empty($data['users'])) { ?>
                <?php foreach ($data['users'] as $user) : ?>
                    <a href="<?php echo URLROOT; ?>/users/displayuser/<?php echo $user->iduser; ?>">
                        <li id="<?php echo $user->iduser; ?>" class="list-group-item">
                            <div class="d-flex">
                                <div>  <img style="margin-right: 9px; width:50px" src="/projects/sms/public/img/<?php echo $user->userImage; ?>" alt="No photo">    </div>
                                <div> <?php echo "<strong>".$user->userName."</strong>". "<br>".$user->userRole;  ?></div>  
                            </div>
                        </li>
                    </a>
                <?php endforeach; ?>
            <?php } else { ?>
               <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> No admins to display</p>
             <?php } ?>
        </ul>
    </div>
    <div class="col-md-3"></div>
    <div  class="col-md-6">
     <h3 class="text-center">Overview</h3>












