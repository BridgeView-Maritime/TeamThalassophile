<div class="rws-sfsection">
    <div class="rws-userimgpic">
    	<?php if(!empty($_SESSION["EMP"]['Picture'])) { echo '<img src="'.$baseurl.$_SESSION["EMP"]['Picture'].'" title="" />'; } else {  echo '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" title="" />'; } ?>
    </div>    
    <?php if(!empty($_SESSION["EMP"]['Company'])) { echo '<p class="rws-pheadlineemp text-center">'.$_SESSION["EMP"]['Company'].'</p>'; }?>
    </h4>
    
    <ul class="rws-userplinks">
    
    	<?php if($_SESSION["EMP"]['SubType']=="SuperAdmin") { ?>
        <li><a href="<?php echo $baseurl; ?>employer-dashboard.php"><i class="fa fa-columns"></i> Dashboard</a></li>
        <li><a href="<?php echo $baseurl; ?>employer-edit-profile.php"><i class="fa fa-user"></i> Employer Profile</a></li>
      <!--     <li><a href="<?php echo $baseurl; ?>employer-details.php?emp_id=<?php echo $_SESSION["EMP"]['ID']; ?>"><i class="fa fa-user"></i> View Company Profile</a></li>    -->
     <!--       <li><a href="javascript:void(0);" data-toggle="modal" data-target="#postjoblinks"><i class="fa fa-plus-square"></i> Post a Job</a></li>    -->
        <li><a href="<?php echo $baseurl; ?>employer-post-marine-job.php"><i class="fa fa-plus-square"></i> Post a Job</a></li>
        <li><a href="<?php echo $baseurl; ?>employer-job-list.php"><i class="fa fa-list-alt"></i> Manage Posted Jobs</a></li>
        <li><a href="<?php echo $baseurl; ?>employer-applicant-list.php"><i class="fa fa-list-alt"></i> Manage Job Applicants</a></li>
    <!--    <li><a href="<?php echo $baseurl; ?>employer-team-list.php"><i class="fa fa-users"></i> Manage Team</a></li>  -->
        <li><a href="<?php echo $baseurl; ?>employer-change-password.php"><i class="fa fa-lock"></i> Change Password</a></li>
        <!-- <li><a href="<?php echo $baseurl; ?>employer-setting-delete-account.php"><i class="fa fa-cog"></i> Delete Account</a></li>  -->
        <?php } ?>
        
        <?php if($_SESSION["EMP"]['SubType']=="Admin") { ?>
        <li><a href="<?php echo $baseurl; ?>employer-dashboard.php"><i class="fa fa-columns"></i> Dashboard</a></li>      
  <!--      <li><a href="javascript:void(0);" data-toggle="modal" data-target="#postjoblinks"><i class="fa fa-plus-square"></i> Post a Job</a></li>    -->
        <li><a href="<?php echo $baseurl; ?>employer-post-marine-job.php"><i class="fa fa-plus-square"></i> Post a Job</a></li>
        <li><a href="<?php echo $baseurl; ?>employer-job-list.php"><i class="fa fa-list-alt"></i> Manage Posted Jobs</a></li>
        <li><a href="<?php echo $baseurl; ?>employer-applicant-list.php"><i class="fa fa-list-alt"></i> Manage Job Applicants</a></li> 
        <?php } ?>
        
        <?php if($_SESSION["EMP"]['SubType']=="Standard") { ?>
        <li><a href="<?php echo $baseurl; ?>employer-dashboard.php"><i class="fa fa-columns"></i> Dashboard</a></li>        
        <li><a href="<?php echo $baseurl; ?>employer-job-list.php"><i class="fa fa-list-alt"></i> Manage Posted Jobs</a></li>
        <li><a href="<?php echo $baseurl; ?>employer-applicant-list.php"><i class="fa fa-list-alt"></i> Manage Job Applicants</a></li> 
        <?php } ?>
        
        <li><a href="<?php echo $baseurl; ?>logout.php"><i class="fa fa-sign-out" ></i> Logout</a></li>
    </ul>
</div>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<!-- Modal -->
<div class="modal fade" id="postjoblinks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Post A New Job</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <a href="employer-post-shore-jobs.php" title="Post Shore Jobs" class="btn btn-primary btn100">Post Onshore Jobs</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="employer-post-offshore-jobs.php" title="Post Offshore Jobs" class="btn btn-primary btn100">Post Offshore Jobs</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="employer-post-marine-job.php" title="Post Offshore Jobs" class="btn btn-primary btn100">Post Marine Jobs</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>