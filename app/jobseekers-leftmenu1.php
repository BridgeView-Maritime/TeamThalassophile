<div class="rws-sfsection">
    <div class="rws-userimgpic">
        <?php if(!empty($_SESSION["USER"]['Picture'])) { echo '<img src="'.$baseurl.$_SESSION["USER"]['Picture'].'" title="" />'; } else {  echo '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" title="" />'; } ?>
    </div>
    <h4 class="mtitle text-center"><?php echo $_SESSION["USER"]['Firstname']; ?> <?php echo $_SESSION["USER"]['Lastname']; ?>
    <?php if(!empty($_SESSION["USER"]['Headline'])) { echo '<p class="rws-pheadline">'.$_SESSION["USER"]['Headline'].'</p>'; }?>
    </h4>
    

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>


.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>



    <ul class="rws-userplinks">
        <li><a href="<?php echo $baseurl; ?>jobseekers-dashboard.php"><i class="fa fa-columns"></i> Dashboard</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-edit-profile.php"><i class="fa fa-user"></i> My Profile</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-employment-history-add.php"><i class="fa fa-history"></i> Employment History</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-education-add.php"><i class="fa fa-list-alt"></i> Educational Details</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-passport.php"><i class="fa fa-vcard"></i> Passport</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-passport.php"><i class="fa fa-id-card-o"></i> Visa</a></li>
        <li>
            <div class="dropdown">
                <i class="fa fa-file" style="color:#337ab7;"></i> &nbsp;&nbsp; CDC 
                <div class="dropdown-content">
                    <a href="<?php echo $baseurl; ?>jobseekers-passport.php"><i class="fa fa-file"></i> Doc 1</a>
                    <a href="<?php echo $baseurl; ?>jobseekers-passport.php"><i class="fa fa-file"></i> Doc 2</a>
                </div>
            </div>

        </li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-certificate-add.php"><i class="fa fa-certificate"></i> Certificates</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-generate-cv.php"><i class="fa fa-file"></i> Review &amp; Generate CV</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-applied-jobs.php"><i class="fa fa-tasks"></i> Manage Applied Jobs</a></li>
        <li><a href="<?php echo $baseurl; ?>search-result-jobs.php"><i class="fa fa-search"></i> Search Jobs</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-change-password.php"><i class="fa fa-lock"></i> Change Password</a></li>
        <!--<li><a href="<?php echo $baseurl; ?>jobseekers-setting-job-alerts.php"><i class="fa fa-cog"></i> Job Alert Settings</a></li>  -->
        <li><a href="<?php echo $baseurl; ?>jobseekers-setting-privacy.php"><i class="fa fa-cog"></i> Privacy Setting</a></li>
        <!-- <li><a href="<?php echo $baseurl; ?>jobseekers-setting-delete-account.php"><i class="fa fa-cog"></i> Delete Account</a></li> -->
        
        <li><a href="<?php echo $baseurl; ?>logout.php"><i class="fa fa-sign-out" ></i> Logout</a></li>
    </ul>
    
</div>

