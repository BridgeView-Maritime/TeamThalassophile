<?php include("includes/config.php"); 
$home = 1;


$emp_id	=  $_GET["emp_id"];

/* Get Compnay Details */
$query = "SELECT * FROM `ss_employer` WHERE `id`='$emp_id'";
$rs = $db->query($query);
$foundnum = $rs->num_rows;	

if($foundnum>0)
{
	$roweu = $rs->row;
	
	$logo 			= $roweu["logo"];
	$coverpic 		= $roweu["coverpic"];
	$address 		= $roweu["address"];
	$city			= $roweu["city"];
	$state 			= $roweu["state"];
	$pincode 		= $roweu["pincode"];
	$country 		= $roweu["country"];
	$description 	= $roweu["description"];
	
	
?>


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
		<div class="container">
        	<div class="row">
                <div class="col-sm-3">
                    <?php if(!empty($roweu['logo'])) { echo '<img src="'.$baseurl.$roweu['logo'].'" title="" />'; } else {  echo '<img src="'.$baseurl.'images/no-pic-com-logo.jpg" title="" />'; } ?>
                </div>
                <div class="col-sm-9">
                    <h1><?php echo $roweu["company"]; ?></h1>
                    <p class="rwslocation nomargin"><i class="fas fa-map-marker-alt"></i> <?php echo $roweu['address'];?>, <?php echo $roweu['city'];?>, <?php echo $roweu['state'];?>, <?php echo $roweu['pincode'];?>, <?php echo $roweu['country'];?></p>
                    
                </div>
            </div>
        
        
        </div>
	</div>
</div>

<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home  > </a>
                <a href="employer-dashboard.php">Back</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)"><?php echo $roweu["company"]; ?></a>
            </div>
        </div>
    </div>
</div> 

<?php if(!empty($description)) { echo '<div class="container pdt20"><div class="rws-statitics"><h5>Company Profile</h5>'.$description.'</div></div>'; } ?>

<div class="rws-featuredcompany">
	<div class="container rwsmobilebothpadding">
        <form action="<?php echo $baseurl;?>employer-details.php" enctype="multipart/form-data" method="get" id="gtfilterform" name="gtfilterform" class="row">
        <input type="hidden" name="keywords" id="keywords_2" value="<?php echo $_GET["keywords"];?>">
        <input type="hidden" name="location" id="location_2" value="<?php echo $_GET["location"];?>">
        <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $_GET["emp_id"];?>">
        <!--<input type="hidden" name="PageNo" value="<?php echo $_GET["PageNo"]; ?>"/>-->
        
            <div class="row">
                <div class="col-md-3">
                	<?php include("app/search-job-filter.php"); ?>
                </div>
                <!-- Sidebar Ends -->
                
                <?php
					/* Page URL Settings Starts */
					$urlconditions = "";
					
					if(!empty($_GET["keywords"])) { $urlconditions .="&keywords=".$_GET["keywords"]; }
					if(!empty($_GET["location"])) { $urlconditions .="&location=".$_GET["location"]; $nquery .= " AND t1.`location`='".$_GET["location"]."' "; }
					if(count($_GET["categorysc"])>0) 
					{ 
						$catconditon = "";
						$i=1;
						foreach($_GET["categorysc"] as $key=>$val)
						{
							$urlconditions .="&categorysc[]=".$val;
							
							if($i==1) { $catconditon .=" t1.`category`='$val' "; } else { $catconditon .=" OR t1.`category`='$val' "; }
							$i++; 
						}
						
						$nquery .= " AND ($catconditon) ";
					
					}
					
					if(count($_GET["job_type"])>0) 
					{ 
						$jobconditon = "";
						$i=1;
						foreach($_GET["job_type"] as $key=>$val)
						{
							$urlconditions .="&job_type[]=".$val;
							
							if($i==1) { $jobconditon .=" t1.`job_type`='$val' "; } else { $jobconditon .=" OR t1.`job_type`='$val' "; }
							$i++; 
						}
						
						$nquery .= " AND ($jobconditon) ";
					
					}
					
					if(count($_GET["section"])>0) 
					{ 
						$sectionconditon = "";
						$i=1;
						foreach($_GET["section"] as $key=>$val)
						{
							$urlconditions .="&section[]=".$val;
							
							if($i==1) { $sectionconditon .=" t1.`section`='$val' "; } else { $sectionconditon .=" OR t1.`section`='$val' "; }
							$i++; 
						}
						
						$nquery .= " AND ($sectionconditon) ";
					
					}
					
					/* Page URL Settings Starts */
					
					/* Search Query Settings */
					$todaydate = date("Y-m-d");					
					$search_txt = trim($_GET["keywords"]);

					if($search_txt!="")				
					{				
						$search_exploded = explode (" ", $search_txt);				
						foreach($search_exploded as $search_txt){				
						$x++;				
						if($x==1)				
							$nquery .= " AND (t1.section LIKE '%$search_txt%' OR t1.jobtitle LIKE '%$search_txt%'  OR t1.country LIKE '%$search_txt%'  OR t1.description LIKE '%$search_txt%'  OR t1.benefits LIKE '%$search_txt%'  OR t1.swing_length LIKE '%$search_txt%'  OR t1.area_of_operation LIKE '%$search_txt%'  OR t1.salary_terms LIKE '%$search_txt%' OR t2.company LIKE '%$search_txt%' OR t2.website LIKE '%$search_txt%') ";				
						else				
							$nquery .= " AND (t1.section LIKE '%$search_txt%' OR t1.jobtitle LIKE '%$search_txt%'  OR t1.country LIKE '%$search_txt%'  OR t1.description LIKE '%$search_txt%'  OR t1.benefits LIKE '%$search_txt%'  OR t1.swing_length LIKE '%$search_txt%'  OR t1.area_of_operation LIKE '%$search_txt%'  OR t1.salary_terms LIKE '%$search_txt%' OR t2.company LIKE '%$search_txt%' OR t2.website LIKE '%$search_txt%') ";				
						}					
					}
                       
					   
					if(!empty($emp_id)) { $nquery .= " AND t1.emp_id='$emp_id' "; $urlconditions .="&emp_id=$emp_id"; } 
					    
                	$queryjobs = "SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' AND t1.start_date<='$todaydate' AND t1.end_date>='$todaydate' $nquery ";
					
					$rs = $db->query($queryjobs);	

					$foundnum = $rs->num_rows;	
				
					$per_page = 10;
				
					$max_pages = ceil($foundnum / $per_page);	
				
					$pagenum = trim($_GET['PageNo']);	
				
					$max_pages = ceil($foundnum / $per_page);	
				
					$pagenum = trim($_GET['PageNo']);
				
					if(is_numeric($pagenum))				
					{				
						if($pagenum >= $max_pages) { $pageshow = $max_pages; }				
						elseif($pagenum < $max_pages && $pagenum > 0) { $pageshow = $pagenum; } 				
						elseif($pagenum <= 0) { $pageshow = '1'; }				
						else { $pageshow = '1';	 }				
					}				
					else				
					{				
						$pageshow = '1';				
					}
				
					if($pageshow==0) { $begin = $pageshow; } else { $begin = $pageshow - 1; }				
					$start = $begin * $per_page;				
					if(!$start)				
					$start=0;
				
					/*echo $queryjobs." ORDER BY $orderfield $orderby LIMIT $start, $per_page";
				
					echo "<br>";
				
					echo $queryjobs." ORDER BY t1.add_date DESC LIMIT $start, $per_page";*/
				
					if($orderfield !="") { $result_query = $queryjobs." ORDER BY $orderfield $orderby LIMIT $start, $per_page"; }
				
					else { $result_query = $queryjobs." ORDER BY add_date DESC LIMIT $start, $per_page"; }
					
					if($orderfield !="") 
					{ 				
						$urltoshow = $baseurl."search-result-jobs.php?page=jbs&PageNo=".$pagenum."&field=".$orderfield."&order=".$orderby.$urlconditions;				
						$urltopage = "search-result-jobs.php?page=jbs&field=".$orderfield."&order=".$orderby.'&search='.$search_txt.$urlconditions;				
					}				
					else 				
					{				
						$urltoshow = "search-result-jobs.php?page=jbs&PageNo=".$pagenum.$urlconditions; 				
						$urltopage = "search-result-jobs.php?page=jbs".$urlconditions; 				
					}
					
				?>
                
                <div class="col-md-9">
                    <?php if($foundnum>0) { ?>
                    <div class="rws-statitics">
                    	<div class="row">
                        	<div class="col-xs-4">
                            	<?php echo $foundnum; ?> Results
                            </div>
                            <div class="col-xs-8 text-right">
                            	<em><?php echo 'Showing  '.($start+1).' to '.($start+$per_page).' of '.$foundnum.''; ?></em>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rws-joblistsection">
                    	<?php echo togetlistofjobs($result_query); ?>
                    </div>
                    
                    <div class="rws-statitics rws-pagination">
                    	<?php echo generate_pagination_new($urltopage, $max_pages, $pagenum, $foundnum, $per_page, $pageshow, $start); ?>
                    </div>
                    <?php } else { echo '<div id="rws-formfeedback">There is no jobs found.</div>'; } ?>
                    
                </div>
                <!-- Right Section Ends -->
            </div>
        </form>	
    </div>
</div>  

<?php

 } else { echo '<div id="rws-formfeedback">The page that you are looking for doesn\'t exsist.</div>'; }

 ?>