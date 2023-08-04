<?php include("includes/config.php"); 
$home = 2;
include("app/gtheader.php"); 
?>
<div class="rws-searchbox rws-searchinnerpage">
	<div class="rws-searchboxinn">
    <form action="<?php echo $baseurl;?>search-result-jobseekers.php" method="get" enctype="multipart/form-data" name="gtsearchjobform" id="gtsearchjobform">
    	<div class="container">        	
            <div class="rwsformelements">
                <div class="row">
                    <div class="col-sm-9 pdr-0 mpdr-15"><input type="text" class="form-control br-1" name="keywords" id="keywords" value="<?php echo $_GET["keywords"];?>" autocomplete="off" placeholder="Keywords"></div>
                    <!--<div class="col-sm-5 pdr-0 pdl-0"><?php echo todisplaymultiplewithgroupname($array_aus_location, $array_newze_location, "", "", "", "", "Australia, New Zealand", 'location', "All Location (Recomended for Offshore jobs)", $_GET["location"], $onchange=""); ?></div>-->
                    <div class="col-sm-3 pdl-0 mpdl-15"><input type="submit" name="rws_formsubmit" id="rws_formsubmit" class="btn theme-btn cl-white seub-btn rws-searchbtn" value="Search"></div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
<div class="rws-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a href="<?php echo $baseurl;?>">Home</a>
                <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                <a href="javascript:void(0)">Search Result Jobseekers</a>
            </div>
        </div>
    </div>
</div>

<div style="width:100%;">
<div class="rws-featuredcompany">
	<div class="container rwsmobilepadding">
        <form action="<?php echo $baseurl;?>search-result-jobseekers.php" enctype="multipart/form-data" method="get" id="gtfilterform" name="gtfilterform" class="row">
        <input type="hidden" name="keywords" id="keywords_2" value="<?php echo $_GET["keywords"];?>">
        <input type="hidden" name="location" id="location_2" value="<?php echo $_GET["location"];?>">
        <!--<input type="hidden" name="PageNo" value="<?php echo $_GET["PageNo"]; ?>"/>-->
        
            <div class="row" style="width:100%;">
               <!-- <div class="col-md-3">
                	<?php include("app/search-jobseekers-filter.php"); ?>
                </div>  -->
                <!-- Sidebar Ends -->
                
                <?php
					/* Page URL Settings Starts */
					$urlconditions = "";
					
					if(!empty($_GET["keywords"])) { $urlconditions .="&keywords=".$_GET["keywords"]; }
					/*if(!empty($_GET["location"])) { $urlconditions .="&location=".$_GET["location"]; $nquery .= " AND t1.`location`='".$_GET["location"]."' "; }*/
					if(count($_GET["categorysc"])>0) 
					{ 
						$catconditon = "";
						$i=1;
						foreach($_GET["categorysc"] as $key=>$val)
						{
							$urlconditions .="&categorysc[]=".$val;
							
							if($i==1) { $catconditon .=" FIND_IN_SET($val, category) "; } else { $catconditon .=" OR FIND_IN_SET($val, category)  "; }
							$i++; 
						}
						
						$nquery .= " AND ($catconditon) ";
					
					}
					
					if(count($_GET["section"])>0) 
					{ 
						$sectionconditon = "";
						$i=1;
						foreach($_GET["section"] as $key=>$val)
						{
							$urlconditions .="&section[]=".$val;
							
							if($i==1) { $sectionconditon .=" `section`='$val' "; } else { $sectionconditon .=" OR `section`='$val' "; }
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
							$nquery .= " AND (firstname LIKE '%$search_txt%' OR lastname LIKE '%$search_txt%' OR location LIKE '%$search_txt%'  OR address LIKE '%$search_txt%' OR city LIKE '%$search_txt%' OR state LIKE '%$search_txt%' OR pincode LIKE '%$search_txt%' OR country LIKE '%$search_txt%' OR professional_headline LIKE '%$search_txt%' OR additional_skills LIKE '%$search_txt%' OR section LIKE '%$search_txt%') ";				
						else				
							$nquery .= " AND (firstname LIKE '%$search_txt%' OR lastname LIKE '%$search_txt%' OR location LIKE '%$search_txt%'  OR address LIKE '%$search_txt%' OR city LIKE '%$search_txt%' OR state LIKE '%$search_txt%' OR pincode LIKE '%$search_txt%' OR country LIKE '%$search_txt%' OR professional_headline LIKE '%$search_txt%' OR additional_skills LIKE '%$search_txt%' OR section LIKE '%$search_txt%') ";				
						}					
					}
                        
                	$queryjobs = "SELECT * FROM `ss_jobseekers` WHERE status='1' AND validate='1' $nquery ";
					
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
						$urltoshow = $baseurl."search-result-jobseekers.php?page=jbs&PageNo=".$pagenum."&field=".$orderfield."&order=".$orderby.$urlconditions;				
						$urltopage = "search-result-jobseekers.php?page=jbs&field=".$orderfield."&order=".$orderby.'&search='.$search_txt.$urlconditions;				
					}				
					else 				
					{				
						$urltoshow = "search-result-jobseekers.php?page=jbs&PageNo=".$pagenum.$urlconditions; 				
						$urltopage = "search-result-jobseekers.php?page=jbs".$urlconditions; 				
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
                    	<?php echo togetlistofjobseekers($result_query); ?>
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

</div>

<?php include("app/gtfooter.php"); ?>