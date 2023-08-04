<?php
if($_POST["gt_cbemail"]!="")
{

	$name 		= $_POST["gt_cbname"];
	$email 		= $_POST["gt_cbemail"];
	
	if(isUnique("email", $_POST['gt_cbemail'], "ss_subscriber"))
	{
	
	/* Message Code */
	
	$body = '<table width="634" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td height="52" bgcolor="#202020"><font style="font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold; color:#d8aa66;">&nbsp;<span class="style1">JobSEAkers - </span></font><span style="color: #FFFFFF"><strong><font style="font-family:Arial, Helvetica, sans-serif; font-size:24px; color:#d8aa66;">Newsletter form details</font></strong></span></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><table width="633" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="22" colspan="2" align="left" valign="middle"></td>
        </tr>
		<tr>
        <td width="227" height="30" align="left" valign="middle"><span style="color: #FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#333333"> Name:</font></span></td>
        <td width="406" height="30" align="left" valign="middle"><font style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">'.stripslashes($name).'</font></td>
      </tr>
      
      <tr>
        <td height="1" colspan="2" align="left" valign="middle" bgcolor="#e5e5e5"></td>
        </tr>
      <tr>
	  <tr>
        <td width="227" height="30" align="left" valign="middle"><span style="color: #FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#333333"> Email:</font></span></td>
        <td width="406" height="30" align="left" valign="middle"><font style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000000;">'.$email.'</font></td>
      </tr>
     	   <tr>
        <td height="1" colspan="2" align="left" valign="middle" bgcolor="#e5e5e5"></td>
        </tr>  
  <tr>
        <td height="40" colspan="2" align="left" valign="bottom"><font style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000000;">&copy; <a href="https://www.jobseakers.com.au/" title"JobSEAkers">JobSEAkers</a></font></td>
      </tr>
    </table></td>
  </tr>
</table>';
	
	date_default_timezone_set('Asia/Calcutta');
	$gtcurrenttime = date('Y-m-d H:i:s');
		
	$sub = "JobSEAkers - Newsletter Form Details submitted by ".$name." on ".$gtcurrenttime;		
	
	$headers  = 'From: '. $name . '<'.$email.'>' . "\n";
    $headers .= 'MIME-Version: 1.0' ."\n";	
	$headers .= 'Reply-To: '.$email.'' . "\r\n";    
    $headers .= 'Content-Type: text/HTML; charset=ISO-8859-1' ."\n";
    
    
    mail('wdrangnath@gmail.com',$sub,$body,$headers);
	
	/* INSERT Data into Table */
	
	$query_insert = "INSERT INTO `ss_subscriber` SET name = '$name', email = '$email', status = '1', add_date = '$gtcurrenttime'";
			
	$update_result = $db->query($query_insert);	
	
	echo "<script>document.location.href='thank-you.php'</script>";
	}
	
}
?>

<!-- ================= footer start ========================= -->


<style>


.row{font-weight: 500;}

b,strong{color:black !important;}
</style>



		<footer class="footer">
			<div class="container">
				
				<!-- Row Start -->
				<div class="row">
				
					<div class="col-md-12 col-sm-3">
						<div class="row">

							<div class="col-md-4 col-sm-12" \>
								<h4>Home</h4>
								<p style="text-align: justify;"> <a href="https://www.teamthalassophile.com/" style="color:blue !important;"> www.teamthalassophile.com</a>  is a web based  job portal for seafarers and non seafarers who love to work in ocean and sea .
								This job portal offers variety of job available in the Marine market . The aim is to provide user friendly experience in recruitment process.
								As per industry feedback , the portal will offer jobs opportunities based on arena as many seafarers prefer working in particular area of sea . On the other hand , vessel owner / manager too look for crew who has experience in particular geographical area of sea .</p>
							</div>


							<div class="col-md-4 col-sm-12">
								<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Useful Links  </h4>

								<ul>
                                    <li><a href="<?php echo $baseurl;?>privacy-policy.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> Privacy Policy </b> </a></li>

                              <!--      <li><a href="<?php echo $baseurl;?>terms-and-conditions.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> Terms and Conditons </b> </a></li>  -->

                                    <li><a href="<?php echo $baseurl;?>information-for-employers.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> Information for Employers </b> </a></li>

                                    <li><a href="<?php echo $baseurl;?>information-for-jobseekers.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> Information for Job Seekers </b>  </a></li>

                                    <li><a href="<?php echo $baseurl;?>contact-us.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <b> Contact Us </b> </a></li>

                            <!--        <li><a href="<?php echo $baseurl;?>sitemap.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    	<b> Sitemap </b> </a></li>    --->            
								</ul>
							</div>

							<div class="col-md-4 col-sm-12">
								<h4> Contact Us </h4>
								<strong> Please contact us on Email : </strong> admin@teamthalassophile.com <br>
                						All queries will be answered within 24 – 48 hrs . <br><br>

                   				<strong>  Registered Office Address : </strong><br>
                        				  Global Select Hire and Travel LLp <br>
                        				  B-602,The Great Eastern Summit    <br>
                        				  Sector-15,CBD Belapur             <br>
                        				  Navi Mumbai 400614                <br>
                        				  India
							</div>
						</div>
					</div>
					
					<!--
					<div class="col-md-4 col-sm-4">
						<h4>Signup for Newsletter</h4>

                        <form name="gt-newsletter" id="gt-newsletter" method="post" action="" enctype="multipart/form-data">
						<div class="input-group">
							<input type="email" class="form-control" name="gt_cbemail" id="gt_cbemail" placeholder="Enter Email" required="required">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default" name="gtsubmitcb" id="gtsubmitcb"><i class="fa fa-location-arrow font-20"></i></button>
							</span>
						</div>
						</form>
                        

						<div class="f-social-box">
							<ul>
								<li><a href="#"><i class="fa fa-facebook facebook-cl"></i></a></li>
								<li><a href="#"><i class="fa fa-google google-plus-cl"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter twitter-cl"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest pinterest-cl"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram instagram-cl"></i></a></li>
							</ul>
						</div> -->
						
						<!-- App Links -->
						<!--<div class="f-app-box">
							<ul>
								<li><a href="#"><i class="fa fa-apple"></i>App Store</a></li>
								<li><a href="#"><i class="fa fa-android"></i>Play Store</a></li>
							</ul>
						</div>-->
						
					</div>
					
				</div>
				
				<!-- Row Start -->
				<div class="row">
					<div class="col-md-12">
						<div class="copyright text-center">
							<p> @ All rights reserved M/S Global Select Hire And Travel LLP , India </p>
						</div>
					</div>
				</div>
				
			</div>
		</footer>
		
		<!-- Login Window Code -->
		<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" id="myModalLabel1">
					<div class="modal-body">
                    
                    <div class="text-center"><img src="<?php echo $baseurl;?>/images/logo-teamthalassophile.png" alt="JobSEAkers" class="img-responsive" /></div>
                    
						<!-- Nav tabs -->
						<ul class="nav nav-tabs nav-advance theme-bg" role="tablist">
							<li class="nav-item active">
								<a class="nav-link" data-toggle="tab" href="#employer" role="tab">
								<i class="ti-user"></i> Employer</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#candidate" role="tab">
								<i class="ti-user"></i> Candidate</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#agent" role="tab">
								<i class="ti-user"></i> Agent</a>
							</li>
						</ul>
						<!-- Nav tabs -->
							
						<!-- Tab panels -->
						<div class="tab-content">
						
							<!-- Employer Panel 1-->
							<div class="tab-pane fade in show active" id="employer" role="tabpanel">
								<form action="<?php echo $baseurl; ?>employer-login.php" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">						
									<div class="form-group">
										<label>User Name</label>
										<input type="email" name="rwsusername" id="rwsusername" class="form-control" required="required" placeholder="User Name">
									</div>
									
									<div class="form-group">
										<label>Password</label>
                                        <input type="password" name="rwspassword" id="rwspassword" value="<?php echo $_SESSION['myForm']['rwspassword']; ?>" placeholder="*Password" required  class="form-control"/>
									</div>
									
									<div class="form-group">
										<!--<span class="custom-checkbox">
											<input type="checkbox" id="4">
											<label for="4"></label>Remember me
										</span>-->
										<a href="<?php echo $baseurl; ?>employer-forget-password.php" title="Forget" class="fl-right">Forgot Password?</a>
									</div>
									<div class="form-group text-center">
										<button type="submit" name="rwsformsubmit" id="rwsformsubmit" class="btn theme-btn full-width btn-m">LogIn </button>
									</div>
									
								</form>
								
								<!--<div class="log-option"><span>OR</span></div>
								
								<div class="row mrg-bot-20">
									<div class="col-md-6">
										<a href="#" title="" class="fb-log-btn log-btn"><i class="fa fa-facebook"></i>Sign In With Facebook</a>
									</div>
									<div class="col-md-6">
										<a href="#" title="" class="gplus-log-btn log-btn"><i class="fa fa-google-plus"></i>Sign In With Google+</a>
									</div>
								</div>-->
					
							</div>
							<!--/.Panel 1-->
							
							<!-- Candidate Panel 2-->
							<div class="tab-pane fade" id="candidate" role="tabpanel">
								<form action="<?php echo $baseurl; ?>jobseekers-login.php" method="post"  name="gtregisterforms" id="gtregisterforms">
									<div class="form-group">
										<label>User Name</label>
										<input type="email" name="rwsusername" id="rwsusername" class="form-control" required="required" placeholder="User Name">
									</div>
									
									<div class="form-group">
										<label>Password</label>
                                        <input type="password" name="rwspassword" id="rwspassword" value="<?php echo $_SESSION['myForm']['rwspassword']; ?>" placeholder="*Password" required  class="form-control"/>
									</div>
									
									<div class="form-group">
										<!--<span class="custom-checkbox">
											<input type="checkbox" id="44">
											<label for="44"></label>Remember me
										</span>-->
										<a href="<?php echo $baseurl; ?>jobseekers-forget-password.php" title="Forget" class="fl-right">Forgot Password?</a>
									</div>
									<div class="form-group text-center">
										<button type="submit" name="rwsformsubmit" id="rwsformsubmit" class="btn theme-btn full-width btn-m">LogIn </button>
									</div>
									
								</form>
								
								<!--<div class="log-option"><span>OR</span></div>
								
								<div class="row mrg-bot-20">
									<div class="col-md-6">
										<a href="#" title="" class="fb-log-btn log-btn"><i class="fa fa-facebook"></i>Sign In With Facebook</a>
									</div>
									<div class="col-md-6">
										<a href="#" title="" class="gplus-log-btn log-btn"><i class="fa fa-google-plus"></i>Sign In With Google+</a>
									</div>
								</div>
								-->
							</div>
							<!--/.Panel 2-->

							<!-- Agent Panel 3-->
							<div class="tab-pane fade " id="agent" role="tabpanel">
								<form action="<?php echo $baseurl; ?>agent-login.php" method="post" enctype="multipart/form-data" name="gtregisterforms" id="gtregisterforms">						
									<div class="form-group">
										<label>User Name</label>
										<input type="email" name="rwsusername" id="rwsusername" class="form-control" required="required" placeholder="User Name">
									</div>
									
									<div class="form-group">
										<label>Password</label>
                                        <input type="password" name="rwspassword" id="rwspassword" value="<?php echo $_SESSION['myForm']['rwspassword']; ?>" placeholder="*Password" required  class="form-control"/>
									</div>
									
									<div class="form-group">
										<!--<span class="custom-checkbox">
											<input type="checkbox" id="4">
											<label for="4"></label>Remember me
										</span>-->
										<a href="<?php echo $baseurl; ?>agent-forget-password.php" title="Forget" class="fl-right">Forgot Password?</a>
									</div>
									<div class="form-group text-center">
										<button type="submit" name="rwsformsubmit" id="rwsformsubmit" class="btn theme-btn full-width btn-m">LogIn </button>
									</div>
									
								</form>
								
								<!--<div class="log-option"><span>OR</span></div>
								
								<div class="row mrg-bot-20">
									<div class="col-md-6">
										<a href="#" title="" class="fb-log-btn log-btn"><i class="fa fa-facebook"></i>Sign In With Facebook</a>
									</div>
									<div class="col-md-6">
										<a href="#" title="" class="gplus-log-btn log-btn"><i class="fa fa-google-plus"></i>Sign In With Google+</a>
									</div>
								</div>-->
					
							</div>
							<!--/.Panel 3-->
							
						</div>
						<!-- Tab panels -->
					</div>
				</div>
			</div>
		</div>   
		<!-- Login Up Window -->
        
        
        <!-- Signup Window Code -->
		<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" id="myModalLabel1">
					<div class="modal-body">
                    	<div class="text-center"><img src="<?php echo $baseurl;?>/images/logo-jobseakers.png" alt="JobSEAkers" class="img-responsive" /></div>
                        
                    	<div class="row">
                        	<div class="col-sm-4">
                            	<p><a href="<?php echo $baseurl; ?>employer-register.php" class="btn theme-btn full-width btn-m">Sign up as Employer</a></p>
                            </div>
                            <div class="col-sm-4">
                            	<p><a href="<?php echo $baseurl; ?>jobseekers-register.php" class="btn theme-btn full-width btn-m">Sign up as Jobseeker</a></p>
                            </div>
							<div class="col-sm-4">
                            	<p><a href="<?php echo $baseurl; ?>agent-register.php" class="btn theme-btn full-width btn-m">Sign up as Agent</a></p>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>   
		<!-- End Sign Up Window -->
    
    <input type="hidden" name="gtbaseurl" id="gtbaseurl" value="<?php echo $baseurl; ?>" placeholder="" >
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo $baseurl; ?>js/global.js"></script>
    <?php if($gtjqueryui == "Yes") { ?>
        <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="<?php echo $baseurl; ?>js/taginput.js"></script>
        <script type="text/javascript">
		 	$(function() {
				$("#travel_date").datepicker({ minDate: "-6M", maxDate: "+12M +10D", changeMonth: true, dateFormat: 'yy-mm-dd', changeYear: true});
				$(".gtdatedropdown").datepicker({yearRange: "-100:+0", changeMonth: true, dateFormat: 'dd-mm-yy', changeYear: true});
				$("#transaction_date").datepicker({ minDate: "-6M", maxDate: "+12M +10D", changeMonth: true, dateFormat: 'yy-mm-dd', changeYear: true});
				$(".gtavailability").datepicker({ minDate: "+1D", maxDate: "+24M +10D", changeMonth: true, dateFormat: 'dd-mm-yy', changeYear: true});
				
				$(".gtexpirycertificate").datepicker({yearRange: "-0:+40", minDate: "+1D", maxDate: "+40Y", changeMonth: true, dateFormat: 'dd-mm-yy', changeYear: true});
				
				$("#start_date").datepicker({ minDate: "+0D", maxDate: "+1M", changeMonth: true, dateFormat: 'dd-mm-yy', changeYear: true});
				$("#end_date").datepicker({ minDate: "+1D", maxDate: "+6M", changeMonth: true, dateFormat: 'dd-mm-yy', changeYear: true});
			});
			
			jQuery(document).on('click', '.gtopensubitem', function(){
				
			});
				
		</script>	
    <?php } ?>
    <script src="<?php echo $baseurl; ?>js/custom.js"></script>
    
     <?php if($gtckeditor == "Yes") { ?>
     <script src="<?php echo $baseurl; ?>js/ckeditor/ckeditor.js"></script>
     <script type="text/javascript">
	 $(function() {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace('short_bio');
		//bootstrap WYSIHTML5 - text editor
		CKEDITOR.replace('description');
		//bootstrap WYSIHTML5 - text editor
		CKEDITOR.replace('cusines');
		//bootstrap WYSIHTML5 - text editor
	});
	 </script>
     <?php } ?>
    
    
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5ec7da0e9ea8120012d82665&product=inline-share-buttons&cms=sop' async='async'></script>
    <script>
	jQuery(document).ready(function ($) {
  //hide the subtle gradient layer (.pricing-list > li::after) when pricing table has been scrolled to the end (mobile version only)
  checkScrolling($(".pricing-body"));
  $(window).on("resize", function () {
    window.requestAnimationFrame(function () {
      checkScrolling($(".pricing-body"));
    });
  });
  $(".pricing-body").on("scroll", function () {
    var selected = $(this);
    window.requestAnimationFrame(function () {
      checkScrolling(selected);
    });
  });

  function checkScrolling(tables) {
    tables.each(function () {
      var table = $(this),
        totalTableWidth = parseInt(table.children(".pricing-features").width()),
        tableViewport = parseInt(table.width());
      if (table.scrollLeft() >= totalTableWidth - tableViewport - 1) {
        table.parent("li").addClass("is-ended");
      } else {
        table.parent("li").removeClass("is-ended");
      }
    });
  }

  //switch from monthly to annual pricing tables
  bouncy_filter($(".pricing-container"));

  function bouncy_filter(container) {
    container.each(function () {
      var pricing_table = $(this);
      var filter_list_container = pricing_table.children(".pricing-switcher"),
        filter_radios = filter_list_container.find('input[type="radio"]'),
        pricing_table_wrapper = pricing_table.find(".pricing-wrapper");

      //store pricing table items
      var table_elements = {};
      filter_radios.each(function () {
        var filter_type = $(this).val();
        table_elements[filter_type] = pricing_table_wrapper.find(
          'li[data-type="' + filter_type + '"]'
        );
      });

      //detect input change event
      filter_radios.on("change", function (event) {
        event.preventDefault();
        //detect which radio input item was checked
        var selected_filter = $(event.target).val();

        //give higher z-index to the pricing table items selected by the radio input
        show_selected_items(table_elements[selected_filter]);

        //rotate each pricing-wrapper
        //at the end of the animation hide the not-selected pricing tables and rotate back the .pricing-wrapper

        if (!Modernizr.cssanimations) {
          hide_not_selected_items(table_elements, selected_filter);
          pricing_table_wrapper.removeClass("is-switched");
        } else {
          pricing_table_wrapper
            .addClass("is-switched")
            .eq(0)
            .one(
              "webkitAnimationEnd oanimationend msAnimationEnd animationend",
              function () {
                hide_not_selected_items(table_elements, selected_filter);
                pricing_table_wrapper.removeClass("is-switched");
                //change rotation direction if .pricing-list has the .bounce-invert class
                if (
                  pricing_table.find(".pricing-list").hasClass("bounce-invert")
                )
                  pricing_table_wrapper.toggleClass("reverse-animation");
              }
            );
        }
      });
    });
  }
  function show_selected_items(selected_elements) {
    selected_elements.addClass("is-selected");
  }

  function hide_not_selected_items(table_containers, filter) {
    $.each(table_containers, function (key, value) {
      if (key != filter) {
        $(this).removeClass("is-visible is-selected").addClass("is-hidden");
      } else {
        $(this).addClass("is-visible").removeClass("is-hidden is-selected");
      }
    });
  }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>