 
 
 <?php include('header.php'); $gtpage = 'dashboard'; 
 $today = date('Y-m-d');
 
 
//  $notaquery="select * from  ss_jobseekers  where emailid!='' AND DATE(add_date) between DATE' ".$fdate."' AND DATE '".$ldate."' ";
 
 ?> 
 <style>
     .info-box
     {
         background-color: red;
         display: block;
        min-height: 90px;
        background: #fff;
        width: 100%;
        box-shadow: 0 1px 1px rgb(0 0 0 / 10%);
        border-radius: 2px;
        margin-bottom: 15px;
     }   
     .info-box-content
     {
         padding: 5px 10px;
         margin-left: 90px;
     }
     .info-box-icon {
  /*  border-top-left-radius: 2px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 2px;     */
    display: block;
    float: left;
    height: 90px;
    width: 90px;
    text-align: center;
    font-size: 45px;
    line-height: 90px;
    padding: 20px 10px;
   }
   .info-box-number{
    padding: 10px  15px;
   }

</style>
 
 
 
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('sidebar.php'); ?> 
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Dashboard <small>Control panel</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                	<h2 style="margin:0 0 15px;" >Welcome <?php echo $_SESSION['GTadminuserName']; ?> !</h2>
                    
                    <?php if(!empty($_SESSION["AdminErrorMSG"])) { echo $_SESSION["AdminErrorMSG"]; unset($_SESSION["AdminErrorMSG"]); } ?>
                    

                    <!-------------------------tanuja code---------------------------->

              
          
  <a href="jobseekers-list.php">         
      <div class="col-md-3 col-sm-6 col-xs-12">

            <div class="info-box">
              
                <span class="info-box-icon bg-blue"><i class="fa fa-list" aria-hidden="true"></i></span>
                 <div class="info-box-content">


                    <?php
                 /*   $vacancy=mysqli_query($conn,"SELECT COUNT( * ) AS `Rows` FROM jobpost  WHERE YEAR( CURDATE( ) ) = YEAR(  `cdate` ) AND MONTH( CURDATE( ) ) = MONTH(  `cdate` )  ");

                    $result=mysqli_fetch_array($vacancy);  */
                            $jsquery="SELECT * FROM ss_jobseekers where status='1' " ;
                            $jsrs = $db->query($jsquery);	
                            $totaljobseeker = $jsrs->num_rows;

                    ?>

                    <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-blue" style="color:#100000; font-size: 25px;"> <?php echo $totaljobseeker;?> </span></span><br>

            <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Total Register Candidate</span> 
              
                </div>

            </div>
        </div>    
    </a>

 
    <a href="candidate_approve.php">  
        <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

            <span class="info-box-icon bg-red"><i class="fa fa-check" aria-hidden="true"></i></span>
            <div class="info-box-content">


                <?php
                $notaquery="SELECT * FROM ss_jobseekers where admin_approval='0'  " ;
                $notars = $db->query($notaquery);	
                $notapproveuser = $notars->num_rows;
            
            
                ?>

                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-red" style="color:#100000; font-size: 25px;"> <?php echo $notapproveuser;?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Candidate Need Approval</span>


            </div>

        </div>
        </div>
  </a>

  <a href="employer-list.php">  
        <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

            <span class="info-box-icon bg-teal"><i class="fa fa-users" aria-hidden="true"></i></span>
            <div class="info-box-content">


                <?php           
                    $empquery="SELECT * FROM ss_employer where status='1' " ;
                    $emprs = $db->query($empquery);	
                    $totalemp = $emprs->num_rows;
                ?>

                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-teal" style="color:#100000; font-size: 25px;"> <?php echo $totalemp;?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Total Employer</span>


            </div>

        </div>
        </div>
    </a>
   

    <a href="all_employer-job-list11.php">  
        <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

            <span class="info-box-icon bg-purple"><i class="fa fa-tags" aria-hidden="true"></i></span>
            <div class="info-box-content">


                <?php
                   $jobquery="SELECT * FROM ss_employer_jobs where status='1' " ;
                   $jobrs = $db->query($jobquery);	
                   $totaljob = $jobrs->num_rows;
             
              
                ?>

                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-purple" style="color:#100000; font-size: 25px;"> <?php echo $totaljob;?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Total Posted Job</span>


            </div>

        </div>
        </div>
    </a>

 
<a href="create_vessel.php">  

        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">

            <span class="info-box-icon bg-olive"><i class="fa fa-road" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <?php
                   $vesseltype="SELECT * FROM vessel_type " ;
                   $vessel = $db->query($vesseltype);	
                   $totalvessel = $vessel->num_rows;                      
                ?>
                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-olive" style="color:#100000; font-size: 25px;"> <?php echo $totalvessel;?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Total Vessel</span>

            </div>

        </div>
        </div>
    </a>


  <a href="create_shiptype.php">  
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">

            <span class="info-box-icon bg-aqua"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <?php
                   $shiptype="SELECT * FROM shiptype " ;
                   $ship = $db->query($shiptype);	
                   $totalship = $ship->num_rows;                      
                ?>
                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-aqua" style="color:#100000; font-size: 25px;"> <?php echo $totalship; ?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Total Ship Type</span>

            </div>

        </div>
        </div>
   </a>
     

   <a href="create_areaop.php">  
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">

            <span class="info-box-icon bg-maroon"><i class="fa fa-plane" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <?php
                   $areaop="SELECT * FROM area_of_operation " ;
                   $area = $db->query($areaop);	
                   $totalareaop = $area->num_rows;                      
                ?>
                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-maroon" style="color:#100000; font-size: 25px;"> <?php echo $totalareaop; ?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Total Area of Operation</span>

            </div>

        </div>
        </div>
   </a>          
   
   
   <a href="shore_candidate_approve.php">  
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">

            <span class="info-box-icon bg-red"><i class="fa fa-check" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <?php
                   $areaop="SELECT * FROM ss_jobseekers where admin_approval='0'  And cv_category='Shore' " ;
                   $area = $db->query($areaop);	
                   $totalareaop = $area->num_rows;                      
                ?>
                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-maroon" style="color:#100000; font-size: 25px;"> <?php echo $totalareaop; ?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Shore Candidate Need approval</span>

            </div>

        </div>
        </div>
   </a>  

   <a href="#">  
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">

            <span class="info-box-icon bg-blue"><i class="fa fa-list" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <?php
                   $areaop="SELECT * FROM ss_jobseekers where status='1'  And cv_category='Shore' " ;
                   $area = $db->query($areaop);	
                   $totalareaop = $area->num_rows;                      
                ?>
                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-maroon" style="color:#100000; font-size: 25px;"> <?php echo $totalareaop; ?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Total Shore Candidate</span>

            </div>

        </div>
        </div>
   </a> 
  
   <a href="candidate_approve.php">  
        <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

            <span class="info-box-icon bg-red"><i class="fa fa-check" aria-hidden="true"></i></span>
            <div class="info-box-content">


               
                <?php

                // Get the first date of the current month
// $fdate = date('Y-m-01');

// Get the last date of the current month
// $ldate = date('Y-m-t');
//  $date = date('Y-m-d');
$date = date('Y-m-d');

// $notaquery="SELECT COUNT( * ) AS `Rows` FROM ss_jobseekers WHERE add_date like '% $date  %'";
$jsquery = "SELECT COUNT( * ) AS `Rows` FROM ss_jobseekers  WHERE add_date like '%" . $date . "%' ";
 
// $notaquery = "SELECT * FROM ss_jobseekers WHERE DATE(add_date) BETWEEN DATE '" . $fdate . "' AND DATE '" . $ldate . "'";

                // $fdate = date('Y-m-01', strtotime('-1 month'));

                // Get the last date of last month
                // $ldate = date('Y-m-t', strtotime('-1 month'));
                // $notaquery="select * from ss_jobseekers where DATE(add_date) between DATE' ".$fdate."' AND DATE '".$ldate."' ";
                // $notaquery="select COUNT(*) from  ss_jobseekers  where emailid!='' AND DATE(add_date) between DATE' ".$fdate."' AND DATE '".$ldate."' ";
               
               
                // $date = date('Y-m-d');
                $jsquery="SELECT * FROM ss_jobseekers where add_date like '%" . $date . "%' ";
                $jsrs = $db->query($jsquery);	
                $totaljobseeker = $jsrs->num_rows;
                
               
                ?>
                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-red" style="color:#100000; font-size: 25px;"> <?php echo $totaljobseeker;?> </span></span><br>

<span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Candidate Registed a Today</span>

               


            </div>

        </div>
        </div>
  </a>

  <a href="registerd _team.php">  
        <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

            <span class="info-box-icon bg-red"><i class="fa fa-check" aria-hidden="true"></i></span>
            <div class="info-box-content">


                <?php
                $date = date('Y-m-d', strtotime("-1 days"));
                $jsquery="SELECT * FROM ss_jobseekers where add_date like '%" . $date . "%' ";
                $jsrs = $db->query($jsquery);	
                $totaljobseeker = $jsrs->num_rows;
            
                ?>

                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-red" style="color:#100000; font-size: 25px;"> <?php echo $totaljobseeker;?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Candidate Registed a Yesterday</span>


            </div>

        </div>
        </div>
  </a>

  <a href="registerd_team.php">  
        <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">

            <span class="info-box-icon bg-red"><i class="fa fa-check" aria-hidden="true"></i></span>
            <div class="info-box-content">


                <?php
               $today = date('Y-m-d'); // Current date

               // Get the first date of last month
               $fdate = date('Y-m-01');
               
               // Get the last date of last month
               $ldate = date('Y-m-t');

                 $notaquery = "SELECT * FROM ss_jobseekers WHERE admin_approval = '0' AND DATE(add_date) BETWEEN '$fdate' AND '$ldate'";
                //  $jsquery="SELECT * from ss_jobseekers where DATE(add_date) between DATE' ".$fdate."' AND DATE '".$ldate."' ";
                //  $jsquery= "SELECT * FROM ss_jobseekers  WHERE  YEAR( '$today' ) = YEAR(  `add_date` ) AND MONTH( '$today' ) = MONTH(  `add_date` )  ";
                // $notaquery="SELECT * FROM ss_jobseekers where admin_approval='0'  " ;
                $notars = $db->query($notaquery);	
                $notapproveuser = $notars->num_rows;
                        
                ?>

                <span class="info-box-number" style="padding-left:30px;"><span class="blink3 text-red" style="color:#100000; font-size: 25px;"><?php echo $notapproveuser ;?> </span></span><br>

                <span class="info-box-text" style="color:#000000; font-size: 12px;" align="center">Candidate Registed a Month</span>


            </div>

        </div>
        </div>
  </a>

  <!-------------------------------------------------------------------------------->                  
                    
                    
                    <div class="box box-danger" style="display:none;">
                                <div class="box-header" style="cursor: move;">
                                    <h3 class="box-title">Member's Statistics</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                        	<th>Total Number Of Consumers</th>
                                            <th>Total Number Of Frentors</th>
                                            <th>Total Number Of Both Type User</th>
                                            <th>Total Users</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo togetuserlistcriteria('C'); ?> Consumers</td>
                                            <td><?php echo togetuserlistcriteria('S'); ?> Frentors</td>
                                            <td><?php echo togetuserlistcriteria('B'); ?> Consumers &amp; Frentors</td>
                                            <td><?php echo togetuserlistcriteria(''); ?> Members</td>
                                        </tr>                                        
                                    </tbody></table>
                                </div><!-- /.box-footer -->
                            </div>	
                            
                            <!-- SECTION ENDS -->
                            
                            <div class="box box-success" style="display:none;">
                                <div class="box-header" style="cursor: move;">
                                    <h3 class="box-title">Order Statistics</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                        	<th>Pending Orders</th>
                                            <th>Successful Orders</th>
                                            <th>Complted Orders</th>
                                            <th>Failed Orders</th>
                                            <th>Assigned Orders</th>
                                            <th>Not Assigned Orders</th>
                                            <th>Pending Orders(Frentor)</th>
                                            <th>Accepted Orders(Frentor)</th>
                                            <th>Complted Orders(Frentor)</th>
                                            <th>Total Orders</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo togetorderlistcriteria(" WHERE order_status='0' "); ?> Order(s)</td>
                                            <td><?php echo togetorderlistcriteria(" WHERE order_status='1' OR order_status='2' "); ?> Order(s)</td>
                                            <td><?php echo togetorderlistcriteria(" WHERE order_status='2' "); ?> Order(s)</td>
                                            <td><?php echo togetorderlistcriteria(" WHERE order_status>2 "); ?> Order(s)</td>
                                            <td><?php echo togetorderlistcriteria(" WHERE service_provider_id>0 "); ?> Order(s)</td>
                                            <td><?php echo togetorderlistcriteria(" WHERE service_provider_id='0' "); ?> Order(s)</td>
                                            <td><?php echo togetorderlistcriteria(" WHERE order_acceped='0' "); ?> Order(s)</td>
                                            <td><?php echo togetorderlistcriteria(" WHERE order_acceped='1' OR order_acceped='2' "); ?> Order(s)</td>
                                            <td><?php echo togetorderlistcriteria(" WHERE order_acceped='2' "); ?> Order(s)</td>
                                            <td><?php echo togetorderlistcriteria(""); ?> Order(s)</td>
                                        </tr>                                        
                                    </tbody></table>
                                </div><!-- /.box-footer -->
                            </div>	
                            
                            <!-- SECTION ENDS -->

              </section><!-- /.content --> <br><br><br><br><br><br>


              


              <footer>


              		<?php include('footer-copyright.php'); ?>


              </footer>


            </aside><!-- /.right-side -->


        </div><!-- ./wrapper -->        


<?php include('footer.php'); ?>