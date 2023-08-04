<?php include("includes/config.php");  $gtpage = "Jobseeker-Edit-Profile"; $gtjqueryui = "Yes"; $gtckeditor = "Yes";

checkuserlogin(); 

unset($_SESSION['myForm']);



if(isset($_POST["rwsformsubmit"]))
{


    

    $_SESSION['myForm'] = $_POST;
    if (empty($_POST['firstname']) )    {   $errors[]="Please fill out the firstname field.";       }   
    if (empty($_POST['lastname']) )     {   $errors[]="Please fill out the lastname field.";        }
    if (empty($_POST['location']) )     {   $errors[]="Please fill out the location field.";        }
    


    if(empty($_POST['mobile']) ) { $errors[]="Please fill out the Mobile field."; } 
    else if(!is_numeric($_POST['mobile'])) { $errors[]="Mobile number should be numeric only."; }
    else if(strlen($_POST['mobile'])!=10) { $errors[]="Mobile Number should be 10 digits."; }
    
    if (empty($_POST['country']) )  {   $errors[]="Please fill out the location field.";        }
    
    $today_date = date("Y-m-d");
    
        
    if (empty($_POST['section']) ) {    $errors[]="Please fill out the Section field.";     }
    /*
    if (empty($_POST['category']) ) {$errors[]="Please fill out the Category field.";}
    if (empty($_POST['city']) )     {   $errors[]="Please fill out the City field.";        }
    if (empty($_POST['state']) )    {   $errors[]="Please fill out the State field.";       }
    if (empty($_POST['pincode']) )  {   $errors[]="Please fill out the Pincode field.";     }
    if (empty($_POST['country']) )  {   $errors[]="Please fill out the Country field.";     }*/

    // Allowed file types. add file extensions WITHOUT the dot.
    $allowtypes=array("jpg", "JPG", "JPEG", "jpeg", "PNG", "png");
    $max_file_size="2048";
    // checks that profile pic condition
    if((!empty($_FILES["image_1"])) && ($_FILES['image_1']['error'] == 0)) {
    // basename -- Returns filename component of path
    $filename = basename($_FILES['image_1']['name']);
    $ext = substr($filename, strrpos($filename, '.') + 1);
    $filesize=$_FILES['image_1']['size'];
    $max_bytes=$max_file_size*1024;
    //Check if the file type uploaded is a valid file type. 

    if (!in_array($ext, $allowtypes)) {
        $errors[]="Profile pic <strong>".$filename."</strong> has been rejected! Only the following corporate logo formats are allowed: .jpg, .JPG, .jpeg, .JPEG and .PNG.";
    // check the size of each file
    } elseif($filesize > $max_bytes) {
        $errors[]= "Profile pic: <strong>".$filename."</strong> is to big. Max file size is ".$max_file_size." kb.";
    }
    } // if !empty FILES
    // checks that profile pic condition
    if((!empty($_FILES["image_2"])) && ($_FILES['image_2']['error'] == 0)) {
    // basename -- Returns filename component of path
    $filename = basename($_FILES['image_2']['name']);
    $ext = substr($filename, strrpos($filename, '.') + 1);
    $filesize=$_FILES['image_2']['size'];
    $max_bytes=$max_file_size*1024; 
    $allowtypes=array("doc", "docx", "pdf");
    //Check if the file type uploaded is a valid file type. 
    if (!in_array($ext, $allowtypes)) {
        $errors[]="Resume <strong>".$filename."</strong> has been rejected! Only the following corporate logo formats are allowed: .doc, .docx, .pdf."; 
    // check the size of each file
    } elseif($filesize > $max_bytes) {
        $errors[]= "Resume: <strong>".$filename."</strong> is to big. Max file size is ".$max_file_size." kb.";
    }
    } // if !empty FILES
    
    // Availability Multiple Blank check
    $start_date             = $_POST["start_date"];
    $end_date               = $_POST["end_date"];
    

    /*

    $i=0;
    if(trim($start_date[0])!="")
    {
        foreach($start_date as $key=>$val)
        {
            if(empty($start_date[$i]))
            {
                $errors[]="Please fill out the ".($i+1)." Availability From Date field.";
            }
            
            if(empty($end_date[$i]))
            {
                $errors[]="Please fill out the ".($i+1)." Availability To Date field.";
            }
            
            $tpdate1 = strtotime($start_date[$i]);
            $tpdate2 = strtotime($today_date);
            $interval2 = $tpdate1 - $tpdate2;
            $tdays = floor($interval2 / 86400);
            
            if($tdays<1)
            {
                $errors[]='The selected '.($i+1).' Availability From Date <em>'.$start_date[$i].'</em> must be a future date compare to <em>'.$today_date.'</em>.';
            }
            
            $tpdate1 = strtotime($end_date[$i]);
            $tpdate2 = strtotime($start_date[$i]);
            $interval2 = $tpdate1 - $tpdate2;
            $tdays = floor($interval2 / 86400);
            
            if($tdays<1)
            {
                $errors[]='The selected '.($i+1).' Availability To Date <em>'.$end_date[$i].'</em> must be a future date compare to <em>'.$start_date[$i].'</em>.';
            }
            
            $i++;
        }
    }  */
    
    if(empty($errors)) 
    {
            $array_rand = array("rad", "dfd","met","axz", "yza", "tst", "tms", "lpg","art","mec","efc","mar","kar","lad","mah");
            $rand1 = mt_rand(100,999);
            $rand2 = mt_rand(100000,999999);
            $rand_keys = array_rand($array_rand, 2);

            $year = date("Y");
            $month = date("m");
            $date = date("d");          

            $yearfolder = "userpics/".$year;
            $monthfolder = 'userpics/'.$year.'/'.$month;
            $datefolder = 'userpics/'.$year.'/'.$month.'/'.$date;
            if (!file_exists($yearfolder)) { mkdir("$yearfolder", 0777); copy('userpics/index.html', $yearfolder.'/index.html'); }
            if (!file_exists($monthfolder)) { mkdir("$monthfolder", 0777); copy('userpics/index.html', $monthfolder.'/index.html'); }
            if (!file_exists($datefolder)) { mkdir("$datefolder", 0777); copy('userpics/index.html', $datefolder.'/index.html'); }

            $uploadfolder = $datefolder;
            $imgurl = 'userpics/'.$year.'/'.$month.'/'.$date.'/';
            
            $yearfolder = "usercvdata/".$year;
            $monthfolder = 'usercvdata/'.$year.'/'.$month;
            $datefolder = 'usercvdata/'.$year.'/'.$month.'/'.$date;
            if (!file_exists($yearfolder)) { mkdir("$yearfolder", 0777); copy('usercvdata/index.html', $yearfolder.'/index.html'); }
            if (!file_exists($monthfolder)) { mkdir("$monthfolder", 0777); copy('usercvdata/index.html', $monthfolder.'/index.html'); }
            if (!file_exists($datefolder)) { mkdir("$datefolder", 0777); copy('usercvdata/index.html', $datefolder.'/index.html'); }

            $uploadfolder_2 = $datefolder;
            $resumeurl = 'usercvdata/'.$year.'/'.$month.'/'.$date.'/';

            for($k=1;$k<=2;$k++)
            {
                if(!empty($_FILES['image_'.$k]['name']))
                {
                    $fileThumbnail = $_FILES['image_'.$k]['tmp_name'];
                    $arrayimage[$k] = $_FILES['image_'.$k]['name'];
                    if($k==1)
                    {
                        $add_thumbnail=$uploadfolder."/".$k."_".$rand2."_".$arrayimage[$k];
                    }
                    else
                    {
                        $add_thumbnail=$uploadfolder_2."/".$k."_".$rand2."_".$arrayimage[$k];
                    }
                    
                    if (is_uploaded_file($fileThumbnail))
                    {
                        move_uploaded_file ($fileThumbnail, $add_thumbnail);
                    }
                    if($k==1)
                    {
                        $imageuploadname[$k] = $imgurl.$k."_".$rand2."_".$arrayimage[$k];   
                    }
                    else
                    {
                        $imageuploadname[$k] = $resumeurl.$k."_".$rand2."_".$arrayimage[$k];    
                    }
                }
                else
                {
                    $imageuploadname[$k]=$_POST['oldimage_'.$k];
                }
            }
            
            $firstname = $_POST['firstname'];   
            $lastname = $_POST['lastname']; 
            $gender = $_POST['gender'];
            $dateofbirth = $_POST['dateofbirth'];
            $mobile = $_POST['mobile'];
            
            $location = $_POST['location'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $pincode = $_POST['pincode'];
            $country = $_POST['country'];

            $rankname = $_POST['rankname'];
            $fieldname = $_POST['fieldname'];
    
            
            $professional_headline = $_POST['professional_headline'];
            $additional_skills = $_POST['additional_skills'];
            $jobstatus = $_POST['jobstatus'];
            $availability_1_from = $_POST['availability_1_from'];
            $availability_1_to = $_POST['availability_1_to'];
            $availability_2_from = $_POST['availability_2_from'];
            $availability_2_to = $_POST['availability_2_to'];
            $availability_3_from = $_POST['availability_3_from'];
            $availability_3_to = $_POST['availability_3_to'];
            
            $client_work_with = $_POST['client_work_with'];
            $short_bio = $_POST['short_bio'];
            $linkedin = $_POST['linkedin'];
            $twitter = $_POST['twitter'];
            $website = $_POST['website'];
            $facebook = $_POST['facebook'];
            $insta = $_POST['insta'];
            
            $section = $_POST['section'];
            
            
            /* Update Data To Database */
            
            $update_query = "UPDATE `ss_jobseekers` SET firstname = '$firstname', lastname = '$lastname', gender = '$gender', dateofbirth = '$dateofbirth', mobile = '$mobile', profile_pic = '".$imageuploadname[1]."', resume = '".$imageuploadname[2]."', location = '$location', address = '$address', city = '$city', state = '$state', pincode = '$pincode', country = '$country', professional_headline = '$professional_headline', additional_skills = '$additional_skills', rankname = '$rankname', fieldname = '$fieldname',  jobstatus = '$jobstatus', availability_1_from = '$availability_1_from', availability_1_to = '$availability_1_to', availability_2_from = '$availability_2_from', availability_2_to = '$availability_2_to', availability_3_from = '$availability_3_from', availability_3_to = '$availability_3_to', client_work_with = '$client_work_with', short_bio = '$short_bio', linkedin = '$linkedin', twitter = '$twitter', website = '$website', facebook = '$facebook', instagram = '$insta' , section = '$section' WHERE `id`=".$_SESSION["USER"]['ID'];

            $update_result = $db->query($update_query); 
            
            $_SESSION["USER"]['Firstname']      =   $firstname;
            $_SESSION["USER"]['Lastname']       =   $lastname;              
            $_SESSION["USER"]['Mobile']         =   $mobile;    
            $_SESSION["USER"]['Picture']        =   $imageuploadname[1];
            $_SESSION["USER"]['Headline']       =   $professional_headline;
            
            $js_id = $_SESSION["USER"]['ID'];
            
            /* Add Availability Date to Database Code Starts */
            
            $db->query("DELETE FROM `ss_jobseekers_availability` WHERE `js_id`='$js_id'");
            
            $start_date             = $_POST["start_date"];
            $end_date               = $_POST["end_date"];
                        
            $i=0;
            foreach($start_date as $key=>$val)
            {
                
                if(!empty($start_date[$i]))
                {
                    $query_insert = "INSERT INTO `ss_jobseekers_availability` SET js_id = '$js_id', start_date = '".tochangedateformat($start_date[$i], "DB")."', end_date = '".tochangedateformat($end_date[$i], "DB")."', sort_order = '0', add_date = '$gtcurrenttime'";

                    $update_result = $db->query($query_insert);
                }
                
                $i++;
            }
            
            /* Add Availability Date to Database Code Ends */
            
            $_SESSION['GTMsgtoUser'] = '<div id="rws-formsuccess">Great! Your profile has been updated.</div>'; 

            echo "<script>document.location.href='".$baseurl."jobseekers-employment-history-add.php'</script>";
            exit;
    }
    else
    {
        if(!empty($errors)) {
        $gt_msgerror = '<div id="rws-formfeedback"><b><font size="4">WHOOPS! Please review the following issues:</font></b><ul>';
        foreach ($errors as $msg) { //prints each error
        $gt_msgerror .= "<li>$msg</li>";
        } // end of foreach
        $gt_msgerror .= '</ul></div>'; }
    }
}


/*
if(empty($_POST)) {
    $select_query = 'SELECT * FROM `ss_jobseekers` WHERE id = "'.$_SESSION["USER"]['ID'].'"';
    $select_result = $db->query($select_query);
    $rowut = $select_result->row;
    
    $_SESSION['myForm']['firstname'] = stripslashes($rowut['firstname']);   
    $_SESSION['myForm']['lastname'] = stripslashes($rowut['lastname']); 
    $_SESSION['myForm']['gender'] = stripslashes($rowut['gender']);
    $_SESSION['myForm']['dateofbirth'] = stripslashes($rowut['dateofbirth']);
    $_SESSION['myForm']['email'] = stripslashes($rowut['email']);
    $_SESSION['myForm']['mobile'] = stripslashes($rowut['mobile']);
    
    $_SESSION['myForm']['profile_pic'] = stripslashes($rowut['profile_pic']);
    $_SESSION['myForm']['resume'] = stripslashes($rowut['resume']);
    $_SESSION['myForm']['location'] = stripslashes($rowut['location']);
    $_SESSION['myForm']['address'] = stripslashes($rowut['address']);
    $_SESSION['myForm']['city'] = stripslashes($rowut['city']);
    $_SESSION['myForm']['state'] = stripslashes($rowut['state']);
    $_SESSION['myForm']['pincode'] = stripslashes($rowut['pincode']);
    $_SESSION['myForm']['country'] = stripslashes($rowut['country']);   
    
    $datearray = explode('-',$_SESSION['myForm']["dateofbirth"]);
    if($_SESSION['myForm']["dobdate"]=="")  { $_SESSION['myForm']["dobdate"] = $datearray[2];   }
    if($_SESSION['myForm']["dobmonth"]=="") { $_SESSION['myForm']["dobmonth"] = $datearray[1];  }
    if($_SESSION['myForm']["dobyear"]=="")  { $_SESSION['myForm']["dobyear"] = $datearray[0];   }
    
    $_SESSION['myForm']['professional_headline'] = stripslashes($rowut['professional_headline']);
    $_SESSION['myForm']['additional_skills'] = stripslashes($rowut['additional_skills']);
    $_SESSION['myForm']['rankname'] = stripslashes($rowut['rankname']);
    $_SESSION['myForm']['fieldname'] = stripslashes($rowut['fieldname']);
    $_SESSION['myForm']['jobstatus'] = stripslashes($rowut['jobstatus']);
    $_SESSION['myForm']['availability_1_from'] = stripslashes($rowut['availability_1_from']);
    $_SESSION['myForm']['availability_1_to'] = stripslashes($rowut['availability_1_to']);
    $_SESSION['myForm']['availability_2_from'] = stripslashes($rowut['availability_2_from']);
    $_SESSION['myForm']['availability_2_to'] = stripslashes($rowut['availability_2_to']);
    $_SESSION['myForm']['availability_3_from'] = stripslashes($rowut['availability_3_from']);
    $_SESSION['myForm']['availability_3_to'] = stripslashes($rowut['availability_3_to']);
    
    $_SESSION['myForm']['client_work_with'] = stripslashes($rowut['client_work_with']);
    $_SESSION['myForm']['short_bio'] = stripslashes($rowut['short_bio']);
    $_SESSION['myForm']['linkedin'] = stripslashes($rowut['linkedin']);
    $_SESSION['myForm']['twitter'] = stripslashes($rowut['twitter']);
    $_SESSION['myForm']['website'] = stripslashes($rowut['website']);
    $_SESSION['myForm']['video'] = stripslashes($rowut['video']);
    

    
    $_SESSION['myForm']['section'] = $rowut['section'];
    $_SESSION['myForm']['category'] = explode(',',$rowut['category']);
    
    // Employment Records

    $select_query = 'SELECT * FROM `ss_jobseekers_availability` WHERE js_id = "'.$_SESSION["USER"]['ID'].'"';
    $select_result = $db->query($select_query);
    $empitems = $select_result->rows;
    $emptotal = $select_result->num_rows;
    
    if($emptotal>0)
    {
        foreach($empitems as $key => $rowemp) { 
            $_SESSION['myForm']['start_date'][]         = tochangedateformat($rowemp["start_date"]);
            $_SESSION['myForm']['end_date'][]           = tochangedateformat($rowemp["end_date"]);
        }
    }
    
}
else
{
     $emptotal = count($_SESSION['myForm']['start_date']);
}   
*/




?>

<!-- RWS Header Starts -->

<!-- RWS Header Starts -->  


<style>


    .list {
            height: 250px !important; 
            overflow-y: auto !important;
            width:100% !important;
        }

    .nice-select { width:100% !important; }

    .mtitle { font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
              font-size: 14px;
              line-height: 1.42857143;
              color: #333;
            }

</style>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
       <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="<?php echo $baseurl;?>images/favicon.png">
<title>Team Thalassophile !</title>        
<link href="<?php echo $baseurl;?>css/global.css" rel="stylesheet">
        <!-- Custom styles for this template -->
<link href="<?php echo $baseurl;?>css/style.css" rel="stylesheet">
<link href="<?php echo $baseurl;?>css/responsiveness.css" rel="stylesheet"> 





<div class="rws-userpages">
    <div class="rws-userpagesinner">
        <div class="container"><h1>My Profile</h1></div>
    </div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">My Profile</a>
            </div>
        </div>
    </div>
</div> 


<!-- RWS Dashboard Starts -->
<div class="rws-maincontentinner">
    <div class="container">
    <div class="row">
        <div class="col-md-4">
            <?php include("app/jobseekers-leftmenu2.php"); ?>            
        </div>
        <!-- Left Section Ends -->
        
        
        <div class="col-md-8">
        <form action="" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">
        
            <div class="rws-module">
                <div class="mtitle">RIGF / DRILLING INFO</div>
                <div class="rws-mcontent">
                    <?php echo $gt_msgerror; if(isset($_SESSION["GTMsgtoUser"])) { echo $_SESSION["GTMsgtoUser"]; unset($_SESSION["GTMsgtoUser"]); }?>
                    
                    <div class="rws-fields">    
                        <?php echo $_SESSION['myForm']['rwsusername']; ?>
                    </div>
                    <!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                            <label class="rws-flabel">Firstname<span>*</span></label>
                            <input type="text" name="firstname" id="firstname" value="<?php echo $_SESSION['myForm']['firstname']; ?>" placeholder="Firstname*" required />
                        </div>                    
                        <div class="col-sm-6">
                            <label class="rws-flabel">Lastname<span>*</span></label>
                            <input type="text" name="lastname" id="lastname" value="<?php echo $_SESSION['myForm']['lastname']; ?>" placeholder="Lastname*" required />
                        </div>        
                    </div>
                    <!-- Row Ends -->
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                            <label class="rws-flabel">Location<span>*</span></label>
                            <input type="text" name="location" id="location" value="<?php echo $_SESSION['myForm']['location']; ?>" placeholder="Location*" required />
                        </div>                    
                        <div class="col-sm-6">
                            <label class="rws-flabel">Mobile<span>*</span></label>
                            <div class="row">
                            <div class="col-xs-7">                            
                            <input type="text" name="mobile" id="mobile" value="<?php echo $_SESSION['myForm']['mobile']; ?>" placeholder="Mobile*" required />
                            </div>
                            </div>
                            
                        </div>        
                    </div>
                    
                    
                    <div class="rws-fields">
                        <label>Select Country</label><br/>

                         <?php
                      
                            $country="select * from ss_countries  where country!='' GROUP BY country order by country ASC";

                            $result = $db->query($country);
                            $rowlist = $result->rows;
                        ?>

                        <select name="country">
                        <option selected >-- Select Country --</option>
                                    
                        <?php
                            foreach($rowlist as $key => $row)
                            {
                                echo "<option  value='". $row['country'] ."'>" .$row['country'] ."</option>"; 
                            }   
                        ?>  
                        </select>                    
                    </div><br><br>
                    
                    
                    <div class="rws-fields row">    
                        <div class="col-sm-6">
                            <label class="rws-flabel"> Picture (Only JPG Allowed)</label>
                            <input type="file" name="image_1" id="image_1" accept="image/jpeg" />
                            <?php if(!empty($_SESSION['myForm']['profile_pic'])) { echo '<p><a href="'.$baseurl.$_SESSION['myForm']['profile_pic'].'" title="View" target="_blank">View Profile Picture</a></p>';} ?>
                            
                        </div>                    
                        <div class="col-sm-6">
                            <label class="rws-flabel">Resume (Only DOC/PDF Allowed)</label>
                            <input type="file" name="image_2" id="image_2" accept="application/msword,application/pdf" />
                            <?php if(!empty($_SESSION['myForm']['resume'])) { echo '<p><a href="'.$baseurl.$_SESSION['myForm']['resume'].'" title="View" target="_blank">Download Resume</a></p>';} ?>
                        </div>        
                    </div>
                    <input type="hidden" name="oldimage_1" value="<?php echo $_SESSION['myForm']['profile_pic']; ?>" />
                    <input type="hidden" name="oldimage_2" value="<?php echo $_SESSION['myForm']['resume']; ?>" />
                    <!-- Row Ends -->
                    
                    <div class="rws-fields">  
                        <label class="rws-flabel">Job Status<span>*</span></label>
                        <input type="radio" name="jobstatus" id="jobstatus_1" value="Active JobSEAker" required  <?php if($_SESSION['myForm']['jobstatus']=="Active JobSEAker") { echo 'checked="checked"'; } else { } ?> /> Active JobSEAker &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="jobstatus" id="jobstatus_2" value="Not Interested in Jobs" required  <?php if($_SESSION['myForm']['jobstatus']=="Not Interested in Jobs") { echo 'checked="checked"'; } else { } ?> /> Not Interested in Jobs &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="jobstatus" id="jobstatus_2" value="Can ConsiderNew Jobs" required  <?php if($_SESSION['myForm']['jobstatus']=="Can ConsiderNew Jobs") { echo 'checked="checked"'; } else { } ?> /> Can Consider New Jobs
                    </div>
                    <!-- Row Ends -->
                    
                    <div class="rws-fields">   
                        <label class="rws-flabel">Your professional headline (i.e. Experienced Manager)<span>*</span></label> 
                        <input type="text" name="professional_headline" id="professional_headline" value="<?php echo $_SESSION['myForm']['professional_headline']; ?>" placeholder="Your professional headline (i.e. Experienced Manager)*" required />
                    </div>
                    <!-- Row Ends -->
                    
                    <div class="rws-fields">   
                         
                        <input type="text" name="additional_skills" id="additional_skills" value="<?php echo $_SESSION['myForm']['additional_skills']; ?>" placeholder="Additional Skills*" required class="taginputsfields"  />
                        <p>Hint: Separate skills with commas or by hitting Enter on your keyboard.</p>
                    </div>
                    <!-- Row Ends -->

                    <div class="rws-fields">
                        <label>Select Rank</label><br/>

                         <?php
                      
                            $rankname="select * from ss_rank  where rankname!='' GROUP BY rankname order by rankname ASC";

                            $result = $db->query($rankname);
                            $rowlist = $result->rows;
                        ?>

                        <select name="rankname">
                        <option selected >-- Select Rank --</option>
                                    
                        <?php
                            foreach($rowlist as $key => $row)
                            {
                                echo "<option  value='". $row['rankname'] ."'>" .$row['rankname'] ."</option>"; 
                            }   
                        ?>  
                        </select>                    
                    </div> <br><br>


                    <div class="rws-fields">
                        <label>Select Oil Field</label><br/>

                         <?php
                      
                            $fieldname="select * from ss_oilfield  where fieldname!='' GROUP BY     fieldname order by  fieldname ASC";

                            $result = $db->query($fieldname);
                            $rowlist = $result->rows;
                        ?>

                        <select name="fieldname">
                        <option selected >-- Select Field --</option>
                                    
                        <?php
                            foreach($rowlist as $key => $row)
                            {
                                echo "<option  value='". $row['fieldname'] ."'>" .$row['fieldname'] ."</option>"; 
                            }   
                        ?>  
                        </select>                    
                    </div>


                    <br><br>

                    
                    <div class="rws-fields">   
                        <h6>Client you worked with</h6> 
                        <input type="text" name="client_work_with" id="client_work_with" value="<?php echo $_SESSION['myForm']['client_work_with']; ?>" placeholder="Client you worked with" required class="taginputsfields"/>
                        <p>Hint: Separate skills with commas or by hitting Enter on your keyboard.</p>
                    </div>



                    <!-- Row Ends -->

                    <!--
                    
                    <div class="rws-fields">   
                        <label class="rws-flabel">Career Summery</label>
                        <textarea name="short_bio" id="short_bio" placeholder="Provide a short Bio"><?php echo $_SESSION['myForm']['professional_headline']; ?></textarea>
                    </div>
                      -->
                    
                    <!--
                    <div class="rws-fields">  
                        <label class="rws-flabel"><span>*</span>Job Interest</label>
                        <input type="radio" name="section" id="section_1" value="Offshore" required  <?php if($_SESSION['myForm']['section']=="Offshore") { echo 'checked="checked"'; } else { } ?> class="rwsjbsection" /> Offshore &nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="section" id="section_2" value="Shore"  class="rwsjbsection" required  <?php if($_SESSION['myForm']['section']=="Shore") { echo 'checked="checked"'; } else { } ?> /> Shore
                    </div>  -->

                    <div class="rws-fields">  
                        <label class="rws-flabel">Job Interest<span>*</span></label> <br>

                        <fieldset>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="section" id="section_1" value="Offshore" required /> Offshore &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <input type="radio" name="section" id="section_2" value="Mainfleet"  required /> Mainfleet  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" name="section" id="section_3" value="Dredger"  required /> Dredger  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" name="section" id="section_4" value="Passenger"  required /> Passenger  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                        </fieldset>

                    </div>
                    <!-- Row Ends -->
                    

                    <!--
                    <div class="rws-fields">  
                        <label class="rws-flabel"><span>*</span>Category</label>
                        <div class="rwscategorylist row"><?php if(!empty($_SESSION['myForm']['section'])) { if($_SESSION['myForm']['section']=="Offshore") { echo todisplaycheckboxcategory($array_category_offshore, 'category[]', $firstoption, $_SESSION['myForm']['category'], $onchange=""); } else { echo todisplaycheckboxcategory($array_category_shore, 'category[]', $firstoption, $_SESSION['myForm']['category'], $onchange=""); } } ?></div>
                    </div>
                      -->
                    
                    <div class="rws-fields row rws-socialinfouser"> 
       
                        <div class="col-sm-6">
                            <label class="rws-flabel">Linkedin ID</label>
                             <input type="text" name="linkedin" id="linkedin" value="<?php echo $_SESSION['myForm']['linkedin']; ?>"/>
                        </div>                    
                        <div class="col-sm-6">
                            <label class="rws-flabel">Twitter ID</label>
                            <input type="text" name="twitter" id="twitter" value="<?php echo $_SESSION['myForm']['twitter']; ?>"/>
                        </div>        
                    </div>
                    <!-- Row Ends -->
                    
                    <div class="rws-fields row  rws-socialinfouser">    
                        <div class="col-sm-6">
                            <label class="rws-flabel">Facebook ID</label>
                             <input type="text" name="facebook" id="website" value="<?php echo $_SESSION['myForm']['website']; ?>"/>
                        </div>                    
                        <div class="col-sm-6">
                            <label class="rws-flabel">Instagram ID</label>
                            <input type="text" name="insta" id="video" value="<?php echo $_SESSION['myForm']['video']; ?>"/>
                        </div>        
                    </div>
                    <!-- Row Ends --> 
            
                </div>
            </div>
            <!-- Box Ends -->
            
            <h3>Add your future availability</h3>
            <?php if($emptotal>0) {
                $ier=0;
                foreach($_SESSION['myForm']["start_date"] as $key_emp=>$val_emp) 
                {
                ?>
                
                <div class="rws-module clonedInput" id="nameinput<?php echo ($ier+1); ?>">
                <div class="rws-mcontent">
                
                    <div class="rws-fields row">
                            <div class="col-sm-6">
                                Availability From Date<br/>
                                <input type="text" name="start_date[]" class="gtavailability" value="<?php echo $_SESSION['myForm']['start_date'][$ier]; ?>" placeholder="From" />
                        </div>
                        <div class="col-sm-6">
                            Availability To Date<br/>
                            <input type="text" name="end_date[]" class="gtavailability" value="<?php echo $_SESSION['myForm']['end_date'][$ier]; ?>"  placeholder="To"/>
                        </div>
                    </div>
                    
                    <!-- Row Ends -->
                    <?php if($ier>0) { ?>
                    <div class="rws-fields rwsdelete1" style="display:block;>
                    <span  margin-right:20px;" ><input type="button" value="Remove Row" class="rwsdeletetraining1 btn btn-danger" /></span></div>
                    <?php } else { ?>
                    <div class="rws-fields rwsdelete1" style="display:none;>
                    <span  margin-right:20px;" ><input type="button" value="Remove Row" class="rwsdeletetraining1 btn btn-danger" /></span></div>
                    <?php } ?>
                    
                </div>
            </div> 
                
            <?php $ier++; } } else { ?>
                
            <div class="rws-module clonedInput" id="nameinput1">
                <div class="rws-mcontent">
                    <div class="rws-fields row">
                        <div class="col-sm-6">
                            Availability From Date<br/>
                            <input type="text" class="gtavailability" name="start_date[]" value="" placeholder="From" />
                        </div>
                        <div class="col-sm-6">
                            Availability To Date<br/>
                            <input type="text" class="gtavailability" name="end_date[]" value=""  placeholder="To"/>
                        </div>
                    </div>
                    <!-- Row Ends -->
                    <?php if($ier>0) { ?>
                    <div class="rws-fields rwsdelete1" style="display:block;>
                    <span  margin-right:20px;" ><input type="button" value="Remove Row" class="rwsdeletetraining1 btn btn-danger" /></span></div>
                    <?php } else { ?>
                    <div class="rws-fields rwsdelete1" style="display:none;>
                    <span  margin-right:20px;" ><input type="button" value="Remove Row" class="rwsdeletetraining1 btn btn-danger" /></span></div>
                    <?php } ?>
                    
                </div>
            </div> 
            <?php } ?>
            <!-- Multiple Row Code -->
            
            <div class="rws-multiplebtnsection">
                <input type="button" name="rwsaddposition" id="rwsaddposition" class="btn btn-success" value="Add New Availability" />
            </div>  
            <!-- Employment History Ends --> 
            
            <div class="rws-fields row">
                <div class="col-sm-4 offset-md-4">    
                    <input type="submit" name="rwsformsubmit" id="rwsformsubmit" value="Submit" class="rwsbutton width_100" />    
                </div>
            </div>
            
            </form>
        </div>
        
    </div>
    
</div>
</div>
<!-- RWS Dashboard Starts -->
<!-- RWS Footer Starts -->

<!-- RWS Footer Starts --> 