<?php include("includes/config.php");
$home = 1;
include("app/gtheader.php");
?>

<!--   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>   -->


<style>
	.pagination>li {

		background: #ececec;

		color: #666;

		border: 1px solid #ddd;

		padding: 6px 12px;

		position: relative;

		float: left;

		cursor: pointer;

	}

	.pagination>li:first-child {

		margin-left: 0;

		border-top-left-radius: 4px;

		border-bottom-left-radius: 4px;

	}



	.pagination>li:last-child {

		margin-left: 0;

		border-top-right-radius: 4px;

		border-bottom-right-radius: 4px;

	}



	.pagination>li:hover {
		z-index: 2;

		color: #23527c;

		background-color: #eee;

		border-color: #ddd;

	}


	/* job style */
	.jobdisplay #job-content {
		background-color: #fff;
		padding: 1px;
		box-shadow: 0 5px 25px 0 rgba(41, 128, 185, 0.15);
		-webkit-box-shadow: 0 5px 25px 0 rgba(41, 128, 185, 0.15);
		border-radius: 6px;
		overflow: hidden;
		transition: .7s;
		margin: 12px;
		border-left: 3px solid #1673d3;

	}

	.job {
		margin-top: 20px;
		background-color: #1f86ef;
		color: white;
	}


	/* hide job details  */


	.job-post-confidential {
		color: transparent;
		text-shadow: 0 0 11px #000000;
		cursor: not-allowed;
		-webkit-user-select: none;
	}

	.job-post-confidential-div a i {
		color: black !important;
	}
</style>
<!-- ======================= Start Banner ===================== -->
<div class="main-banner-new" style="padding-top:38px;">
	<div class="container">
		<div class="col-md-12 col-sm-12">

			<div class="caption text-center ">
				<h2 class="them-color" style="font-family: Verdana, Geneva, sans-serif;font-size: 400%;">Get A Job You Deserve</h2>
				<h4 class="them-color" style="font-family: Verdana, Geneva;color:black !important;">
					All Nationality Crew Welcome to Register
					


				</h4>

			</div>

			<style>
				@media only screen and (min-width:700px) {


					#thumbpad {
						padding-left: 0;
						padding-right: 0;
					}

				}

				.thumbnail {
					padding: 0px !important;
				}

				.job {
					padding: 4px 7px !important;
				}

				.job-type-grid {
					bottom: 5px;
					position: absolute;
					left: 22%;
				}
			</style>

			<div class="row" id="thumbnail">

				<div class="col-md-4 col-sm-12" id="thumbpad" align="center">
					<div class="thumbnai">
						<a href="#">
							<img src="images/ship1.jpeg" alt="Lights" style="width:100%">
						</a>
					</div>
				</div>

				<div class="col-md-4 col-sm-12" id="thumbpad">
					<div class="thumbnai">
						<a href="#">
							<img src="images/ship2.jpeg" alt="Nature" style="width:100%">
						</a>
					</div>
				</div>

				<div class="col-md-4 col-sm-12" id="thumbpad">
					<div class="thumbnai">
						<a href="#">
							<img src="images/ship3.jpeg" alt="Fjords" style="width:100%">
						</a>
					</div>
				</div>

			</div>


		</div>
	</div>
</div>
<!-- ======================= End Banner ===================== -->

<!-- ================= Job start ========================= -->

<style>
	.jobs-tabs .nav-tabs.nav-advance>li {
		width: 25%;
	}

	.jobs-tabs .nav.nav-tabs.nav-advance {
		max-width: 100%;
	}

	@media only screen and (max-width: 600px) {
		.jobs-tabs .nav.nav-tabs.nav-advance {
			max-width: 100%;
		}
	}

	.nav-tabs.nav-advance>li>a {
		color: white !important;
	}

	.nav-tabs.nav-advance>li>a:hover {
		color: #151415 !important;
	}

	.nav-tabs.nav-advance>li.active>a {
		color: #151415 !important;
	}
</style>

<br> <br>
<section style="padding-top:10px;padding-bottom:0px;">
	<div class="container jobs-tabs">






		<div class="col-lg-9">


			<!--start---- Nav tabs -->
			<ul class="nav nav-tabs nav-advance theme-bg" role="tablist" style="max-width:100% !important;">

				<li class="nav-item active">
					<a class="nav-link" data-toggle="tab" id="off" href="#Offshore" onclick="job_display('Offshore','1');" role="tab">
						Jobs in Offshore</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" id="off" href="#Mainfleet" onclick="job_display('Mainfleet','1');" role="tab">
						Jobs in Mainfleet</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" id="ar" href="#aramco" onclick="job_display('aramco','1');" role="tab">
						Jobs in Aramco</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" id="ad" href="#adnoc" onclick="job_display('adnoc','1');" role="tab">
						Jobs in Adnoc</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" id="oil" href="#oilngas" onclick="job_display('oilngas','1');" role="tab">
						Jobs in Oil And Gas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" id="on" href="#Onshore" onclick="job_display('Onshore','1');" role="tab">
						Jobs in Onshore</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" id="ot" href="#other" onclick="job_display('other','1');" role="tab">
						More Jobs</a>
				</li>



			</ul>

			<!-----end---- Nav tabs ---->


			<div class="col-lg-12">
				<div class="row jobdisplay">

					<!------job & pagination display here dont write anything---------->

				</div>


			</div>





		</div>

		<!-- companies -->

		<style>
			/*	.companies-sidebar div{
						margin-bottom:10px;

					}    */

			.companies-sidebar img {
				border: 1px solid;
			}

			.companies-sidebar {
				padding: 30px 10px;
			}
		</style>

		<div class="col-lg-3 grid-job-widget companies-sidebar" style="margin:0px !important;">


			<div class="col-lg-12">
				<img src="images/allianz.png" class="card-img-top">
			</div>

			<div class="col-lg-12">
				<img src="images/indus.png" class="card-img-top">
			</div>

			<div class="col-lg-12">
				<img src="images/bmpl.png" class="card-img-top">
			</div>

			<div class="col-lg-12">
				<img src="images/coming.jpg" class="card-img-top">
			</div>

			<div class="col-lg-12">
				<img src="images/coming.jpg" class="card-img-top">
			</div>




		</div>

		<!-- companies end -->






		<div class="col-md-12 mrg-top-40">
			<div class="text-center">
				<a href="<?php echo $baseurl; ?>search-result-jobs.php" class="btn theme-btn btn-m">Browse More Jobs</a>
				<!--		<a href="<?php echo $baseurl; ?>search-result-jobs11.php" class="btn theme-btn btn-m">Browse More Jobs</a>   -->
			</div>
		</div>



	</div>
</section>


<!-- <section style="padding-top:10px;padding-bottom:0px;">
	<div class="container jobs-tabs">
		<div class="col-lg-9">
			<div class="tabbable boxed parentTabs p-4">
				<ul class="nav nav-tabs nav-advance theme-bg">

					<?php

					// fetch_category_tabs($getCat);
					?>

				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active in" id="set1">
						<div class="tabbable">
							<ul class="nav nav-tabs nav-advance theme-bg">
								<li class="active"><a href="#sub11" class="nav-link">PopularAll</a>
								</li>
								<li><a href="#sub12" class="nav-link">UniqueAll</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="sub11">
									<p>pop all content</p>
								</div>
								<div class="tab-pane fade" id="sub12">
									<p>unique all content</p>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="set2">
						<div class="tabbable">
							<ul class="nav nav-tabs nav-advance theme-bg">
								<li class="active"><a href="#sub21" class="nav-link">PopularBrands</a>
								</li>
								<li><a href="#sub22" class="nav-link">UniqueBrands</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="sub21">
									<p>pop brand content</p>
								</div>
								<div class="tab-pane fade" id="sub22">
									<p>unique brand content</p>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="media">
						<div class="tabbable">
							<ul class="nav nav-tabs nav-advance theme-bg">
								<li class="active"><a href="#mediapop" class="nav-link">PopularMedia</a>
								</li>
								<li><a href="#mediauni" class="nav-link">UniqueMedia</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane fade active in" id="mediapop">
									<p>pop media content</p>
								</div>
								<div class="tab-pane fade" id="mediauni">
									<p>unique media content</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->





<div class="rws-featuredcompany rws-bgwhite">
	<div class="container">
		<p class="rws-subtitle">Browse Jobs By Popular Category</p>
		<h2>Popular Category Jobs</h2>



		<div class="classic-tabs">

			<!-- Nav tabs -->
			<div class="tabs-wrapper">
				<ul class="nav tabs-cyan" role="tablist">
					<li class="nav-item">
						<a class="nav-link waves-light waves-effect waves-light active" data-toggle="tab" href="#panel36" role="tab" aria-selected="true" style="color:black!important;"><b>Marine Jobs</b></a>
					</li>
					<li class="nav-item">
						<a class="nav-link waves-light waves-effect waves-light" data-toggle="tab" href="#panel37" role="tab" aria-selected="false" style="color:black!important;"><b>Rigs/Drillings Rigs Jobs</b></a>
					</li>
					<li class="nav-item">
						<a class="nav-link waves-light waves-effect waves-light" data-toggle="tab" href="#panel37" role="tab" aria-selected="false" style="color:black!important;"><b>Onshore Jobs</b></a>
					</li>
				</ul>
			</div>
			<!-- Tab panels -->
			<div class="tab-content card">
				<!--Panel 1-->
				<div class="tab-pane fade in active show" id="panel36" role="tabpanel">
					<?php

					$country = "select * from ss_employer_jobs  group by jobtitle  order by id desc limit 50  ";
					$result = $db->query($country);
					$rowlist = $result->rows;

					//print_r($rowlist);

					echo togetlistofcategorylinks($rowlist, "Marine");

					//  echo togetlistofcategorylinks($array_category_offshore, "Offshore"); 
					?>
				</div>
				<!--/.Panel 1-->
				<!--Panel 2-->
				<div class="tab-pane fade" id="panel37" role="tabpanel">
					<?php
					echo "No Records Found...!!!";
					// echo togetlistofcategorylinks($array_category_shore, "Shore"); 
					?>
				</div>
				<!--/.Panel 2-->
			</div>

		</div>



	</div>
</div>




<?php include("app/gtfooter.php"); ?>

<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script>
	var cat = "<?php echo $_GET['category_3']; ?>";
	var rank = "<?php echo $_GET['prank']; ?>";

	// alert("cat - "+cat +" " +rank);
	// alert(cat +" "+ rank);
	function load_filter(cat, rank) {
		// alert(cat+ " " +rank);
		var action = "rankrequest";


		$.ajax({
			method: "POST",
			data: {
				action: action,
				cat: cat,
				rank: rank
			},
			url: "search_result_jobs_ajax.php",
			success: function(result) {

				$("#prank").html(result);
				// console.log(result);
			}
		});
	}


	load_filter(cat, rank);
</script>

<script>
	$("ul.nav-tabs a").click(function(e) {
		e.preventDefault();
		$(this).tab('show');
	});
</script>



<script>
	/*     ajax for display job index page */



	//default job show
	job_display("Offshore", "1");


	//job show according pagination (click on mumber)
	function job_display(action, page) {

		$.ajax({

			method: "POST",

			data: {
				action: action,
				page: page
			},

			url: "job_display_ajax.php",

			success: function(data) {


				$(".jobdisplay").html(data);

			}

		});


	}

	/*     ajax for display pagination index page */

	$(document).on('click', '.nextpage', function() {

		var action = $(this).attr('action');
		var page = $(this).attr('id');

		job_display(action, page);

	});
</script>


<script>
	var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?1088';
	var s = document.createElement('script');
	s.type = 'text/javascript';
	s.async = true;
	s.src = url;
	var options = {
		"enabled": true,
		"chatButtonSetting": {
			"backgroundColor": "#4dc247",
			"ctaText": "How may i help you?",
			"borderRadius": "25",
			"marginLeft": "0",
			"marginBottom": "50",
			"marginRight": "50",
			"position": "right"
		},
		"brandSetting": {
			"brandName": "Teamthalassophile",
			"brandSubTitle": "Typically replies within 10 minute",
			"brandImg": "https://shipmanagementjobs.com/bridgeviewmaritime/images/companyicon.png",
			"welcomeText": "Hi, I am AVA.\n Your virtual assistant. \nHow may  I help you today.",

			"messageText": "Hello, I need help regarding job/other.",
			"backgroundColor": "#0a5f54",
			"ctaText": "Start Chat",
			"borderRadius": "25",
			"autoShow": false,
			"phoneNumber": "919769958111"
		}
	};
	s.onload = function() {
		CreateWhatsappChatWidget(options);
	};
	var x = document.getElementsByTagName('script')[0];
	x.parentNode.insertBefore(s, x);
</script>