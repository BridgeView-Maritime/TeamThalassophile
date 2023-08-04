<?php include("includes/config.php"); 
$home = 2;
include("app/gtheader.php");


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





<div class="rws-searchbox rws-searchinnerpage">
	<div class="rws-searchboxinn">
    <div class="container">
    <form action="<?php echo $baseurl;?>search-result-jobs.php" method="get" enctype="multipart/form-data" name="gtsearchjobform" id="gtsearchjobform">
						<fieldset class="home-form-1">
						
							<div class="col-md-4 col-sm-4 padd-0">
								<input type="text" class="form-control br-1" name="keywords" id="keywords" value="<?php echo $_GET["keywords"]; ?>" placeholder="Skills, Designation, Companies" />
							</div>
								
							<div class="col-md-3 col-sm-3 padd-0">
								<?php echo todisplaymultiplewithgroupname($array_aus_location, $array_newze_location, "", "", "", "", "Australia, New Zealand", 'location', "All Location", $_GET["location"], $onchange=""); ?>
							</div>
								
							<div class="col-md-3 col-sm-3 padd-0">
								<?php echo todisplaymultiplewithgroupname($array_category_shore, $array_category_offshore, "", "", "", "", "Shore Categories, Offshore Categories", 'category', "All Category", $_GET["category"], $onchange=""); ?>
							</div>
								
							<div class="col-md-2 col-sm-2 padd-0 m-clear">
								<button type="submit" name="rws_formsubmit" class="btn theme-btn cl-white seub-btn rws-searchbtn">FIND JOB</button>
							</div>
								
						</fieldset>
					</form>
         </div>
    </div>
</div>
<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home  >  </a>
                <a href="jobseekers-dashboard.php">Back</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Search Result </a>
            </div>
        </div>
    </div>
</div>

<div class="rws-featuredcompany">
	<div class="container rwsmobilepadding">
        <form action="<?php echo $baseurl;?>search-result-jobs.php" enctype="multipart/form-data" method="get" id="gtfilterform" name="gtfilterform" class="row">
        <input type="hidden" name="keywords" id="keywords_2" value="<?php echo $_GET["keywords"];?>">
        <input type="hidden" name="location" id="location_2" value="<?php echo $_GET["location"];?>">
        <!--<input type="hidden" name="PageNo" value="<?php echo $_GET["PageNo"]; ?>"/>-->
        
            <div class="row" style="width:100%;">
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
                        
                	$queryjobs = "SELECT t1.*, t2.firstname, t2.lastname, t2.email, t2.mobile, t2.company, t2.website, t2.logo, t2.coverpic FROM `ss_employer_jobs` as t1 INNER JOIN `ss_employer` as t2 ON t1.emp_id=t2.id WHERE t1.status='1' AND MONTH(t1.add_date)>=MONTH(CURRENT_DATE()) $nquery ";

					
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
                        	<div class="col-xs-5">
                            	<?php echo $foundnum; ?> Results
                            </div>
                            <div class="col-xs-7 text-right">
                            	<em><?php echo 'Showing  '.($start+1).' to '.($start+$per_page).' of '.$foundnum.''; ?></em>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rws-joblistsection">
                    	<div class="row">
                    		<?php echo togetlistofjobsearch($result_query); ?>
                        </div>
                    </div>
                    
                    <div class="rws-statitics rws-pagination">
                    	<?php echo generate_pagination_new($urltopage, $max_pages, $pagenum, $foundnum, $per_page, $pageshow, $start); ?>
                    </div>
                    <?php } else { echo '<div id="rws-formfeedback">There is no jobs found with your search criteria. Please try once again.</div>'; } ?>
                    
                </div>
                <!-- Right Section Ends -->
            </div>
        </form>	
    </div>
</div>  
<?php include("app/gtfooter.php"); ?>


