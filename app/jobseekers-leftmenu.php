<div class="rws-sfsection">
	<div class="rws-userimgpic">
    	<?php if(!empty($_SESSION["USER"]['Picture'])) { echo '<img src="'.$baseurl.$_SESSION["USER"]['Picture'].'" title="" />'; } else {  echo '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" title="" />'; } ?>
    </div>
    <h4 class="mtitle text-center"><?php echo $_SESSION["USER"]['Fullname']; ?> 
    <?php if(!empty($_SESSION["USER"]['Headline'])) { echo '<p class="rws-pheadline">'.$_SESSION["USER"]['Headline'].'</p>'; }?>
    </h4>
    

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

/*
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

*/ 

  .sidenav a, .dropdown-btn {
    padding: 1px;   
    text-decoration: none;
    font-size: 15px;
    color: black;
    display: block;
    border: none;     
   
    background: none;
    width:100%;
    text-align: left;
    cursor: pointer;
    outline: none;
  }

  .dropdown-container {
  display: none;
   padding-left: 20px;  
}

.fa-caret-down { 
  padding-left: 25px;
}


</style>



    <ul class="rws-userplinks">
    <!--    <li><a href="<?php echo $baseurl; ?>jobseekers-dashboard.php"><i class="fa fa-columns"></i> Dashboard</a></li>   -->
    <li><a href="<?php echo $baseurl; ?>index.php"><i class="fa fa-columns"></i> Apply For New Job</a></li>  
     <!-- <span class="blink_text"> New</span>   -->
       
        <li><a href="<?php echo $baseurl; ?>search-result-jobs.php"><i class="fa fa-search"></i> Search Jobs</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-applied-jobs.php"><i class="fa fa-tasks"></i> Manage Applied Jobs</a></li>
        
        
        
        
       <button class="dropdown-btn" title="Edit Your Information">  <i class="fa fa-pencil-square-o" style="color:#1aa4dd;"></i> My Resume
    <i class="fa fa-caret-down" style="font-size:15px;"></i>
  </button> 

<!--  <li><a class="dropdown-btn" href="" ><i class="fa fa-caret-down"></i> My Resume</a></li>   -->
  <div class="dropdown-container">
        
        <li><a href="<?php echo $baseurl; ?>jobseekers-edit-profile.php"><i class="fa fa-user"></i> Personal Information</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-employment-history-add.php"><i class="fa fa-history"></i> Employment History</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-education-add.php"><i class="fa fa-list-alt"></i> Educational Details</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-passport.php"><i class="fa fa-vcard"></i> Passport</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-visa.php"><i class="fa fa-id-card-o"></i> Visa</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-cdc.php"><i class="fa fa-file"></i>  CDC</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-certificate-add.php"><i class="fa fa-certificate"></i> Certificate COC</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-certioffshore-add.php"><i class="fa fa-file-text-o"></i> Certificates Offshore</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-certiothers-add.php"><i class="fa fa-file-o "></i> Certificates Other</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-certistcw-add.php"><i class="fa fa-file-text"></i> Certificates STCW</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-nokdetails-add.php"><i class="fa fa-address-book-o "></i>Nok Details</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-bankdetails-add.php"><i class="fa fa-money"></i>Bank Details</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-covidedetails.php"><i class="fa fa-plus"></i>Covide Vaccine Details</a></li>
        <li><a href="<?php echo $baseurl; ?>jobseekers-generate-cv.php"><i class="fa fa-file"></i> Review &amp; Generate CV</a></li> 
        </div>  
    

  
       <!--      <li><a href="<?php echo $baseurl; ?>master/show_thalla_resume11.php"><i class="fa fa-file"></i> Review &amp; Generate CV</a></li>    -->
       
        <li><a href="<?php echo $baseurl; ?>jobseekers-change-password.php"><i class="fa fa-lock"></i> Change Password</a></li>
        <!--<li><a href="<?php echo $baseurl; ?>jobseekers-setting-job-alerts.php"><i class="fa fa-cog"></i> Job Alert Settings</a></li>  -->
   <!--     <li><a href="<?php echo $baseurl; ?>jobseekers-setting-privacy.php"><i class="fa fa-cog"></i> Privacy Setting</a></li>   -->
        <!-- <li><a href="<?php echo $baseurl; ?>jobseekers-setting-delete-account.php"><i class="fa fa-cog"></i> Delete Account</a></li> -->
        
        <li><a href="<?php echo $baseurl; ?>logout.php"><i class="fa fa-sign-out" ></i> Logout</a></li>
    </ul>
    
</div>

<script>
  var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>