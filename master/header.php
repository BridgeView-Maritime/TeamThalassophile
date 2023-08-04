<?php include('../includes/config.php');
checkadminlogin();  ?>
<?php
if (isset($_SESSION['usergroupid']) &&  $_SESSION['usergroupid'] != 1) {
    $sql = "SELECT * FROM `ss_adminuser_groups` WHERE user_group_id=" . $_SESSION['usergroupid'];
    $rs = mysql_query($sql);
    $row = mysql_fetch_assoc($rs);
    $_SESSION['userroles'] = explode(',', $row['permission']);
}

$baseurl = 'https://www.teamthalassophile.com/master/'

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $admin_title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo $baseurl; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo $baseurl; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo $baseurl; ?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo $baseurl; ?>css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo $baseurl; ?>css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <link href="<?php echo $baseurl; ?>css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo $baseurl; ?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo $baseurl; ?>css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?php echo $baseurl; ?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Jquery UI style -->
    <link href="<?php echo $baseurl; ?>css/jquery-ui.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $baseurl; ?>css/style.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo $baseurl; ?>../css/style.css" rel="stylesheet" type="text/css" /> -->

    <style>
        .nav>li>a {
            padding: 10px 10px !important;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>

<body class="skin-blue">
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="<?php echo $baseurl; ?>dashboard.php" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            <?php echo $_SESSION['GTadminuserName']; ?>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar" role="navigation">

            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span><?php echo $_SESSION['GTadminuserName']; ?> <i class="caret"></i></span>
                        </a>

                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="img/avatar5.png" class="img-circle" alt="User Image" />
                                <p>
                                    <?php echo $_SESSION['GTadminuserName']; ?> - <?php echo $_SESSION['GTUserGroupname']; ?>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left" style="display:none;">
                                    <a href="<?php echo $baseurl; ?>edit-profile.php" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">

                                    <a href="<?php echo $baseurl; ?>logout.php" class="btn btn-default btn-flat" onclick="return confirm('Are you sure you want to signout')" ;>Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>


    </header>
    <div class="row">
        <div class="col-md-12 gt-mainmenu">
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-center">
                        <li <?php if ($gtpage == "dashboard") {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $baseurl; ?>dashboard.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>


                        <?php if (isset($_SESSION['usergroupid']) && in_array('services', $_SESSION['GtAdminuserroles'])) { ?>
                            <li <?php if ($gtpage == "services-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-list"></i> <span> Candidate</span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li <?php if ($gtpage == "ca-order-list") {
                                            echo 'class="active"';
                                        } ?>>
                                        <a href="<?php echo $baseurl; ?>candidate_approve.php">
                                            <i class="fa fa-pagelines"></i> <span>Candidate Approval</span>
                                        </a>
                                    </li>
                                    <li <?php if ($gtpage == "ca-order-list") {
                                            echo 'class="active"';
                                        } ?>>
                                        <a href="<?php echo $baseurl; ?>jobseekers-list.php">
                                            <i class="fa fa-pagelines"></i> <span>View All Jobseekers</span>
                                        </a>
                                    </li>
                                    <li <?php if ($gtpage == "ca-order-list") {
                                            echo 'class="active"';
                                        } ?>>
                                        <a href="<?php echo $baseurl; ?>all_employer-applicant-list11.php">
                                            <i class="fa fa-pagelines"></i> <span>Manage Job Applicant</span>
                                        </a>
                                    </li>
                                    <li <?php if ($gtpage == "event-list") {
                                            echo 'class="active"';
                                        } ?>>
                                        <a href="<?php echo $baseurl; ?>addcrewcv.php">
                                            <i class="fa fa-pagelines"></i> <span>Add CV</span>
                                        </a>
                                    <li <?php if ($gtpage == "admin-user-list") {
                                            echo 'class="active"';
                                        } ?>>
                                        <a href="<?php echo $baseurl; ?>contactus.php">
                                            <i class="fa fa-pagelines"></i> <span>View Candidate List Whoes Contact Us</span>
                                        </a>
                                    </li>
                                    <li <?php if ($gtpage == "ca-order-list") {
                                            echo 'class="active"';
                                        } ?>>
                                        <a href="<?php echo $baseurl; ?>deactivatedcv.php">
                                            <i class="fa fa-pagelines"></i> <span>Deactivated CV</span>
                                        </a>
                                    </li>
                            </li>
                    </ul>
                    </li>
                <?php
                        }
                ?>

                <?php if (isset($_SESSION['usergroupid']) && in_array('services', $_SESSION['GtAdminuserroles'])) { ?>
                    <li <?php if ($gtpage == "services-list") {
                            echo 'class="active"';
                        } ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i> <span> Agent</span>
                        </a>

                        <ul class="dropdown-menu">
                            <li <?php if ($gtpage == "agent-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>agent-list.php">
                                    <i class="fa fa-pagelines"></i> <span>Manage Agent</span>
                                </a>
                            </li>
                            <li <?php if ($gtpage == "agent-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>agent_job_list.php">
                                    <i class="fa fa-pagelines"></i> <span>Vacancy List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>

                <?php if (isset($_SESSION['usergroupid']) && in_array('services', $_SESSION['GtAdminuserroles'])) { ?>
                    <li <?php if ($gtpage == "services-list") {
                            echo 'class="active"';
                        } ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i> <span> Employer</span>
                        </a>

                        <ul class="dropdown-menu">
                            <li <?php if ($gtpage == "employer-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>employer-list.php">
                                    <i class="fa fa-pagelines"></i> <span>Manage Employer</span>
                                </a>
                            </li>
                            <li <?php if ($gtpage == "ca-order-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>all_employer-job-list11.php">
                                    <i class="fa fa-pagelines"></i> <span>Manage Posted Job</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                <?php
                }
                ?>

                <!-- <?php if (isset($_SESSION['usergroupid']) && in_array('reports', $_SESSION['GtAdminuserroles'])) { ?>
                    <li <?php if ($gtpage == "export-order" or $gtpage == "export-frentor") {
                                echo 'class="active"';
                            } ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i> <span>Reports</span>
                        </a>
                        <ul class="dropdown-menu">

                            
                        </ul>
                    </li>
                <?php
                        }
                ?> -->


                <!----------------start------------tanuja code----------------------------->

                <?php if (isset($_SESSION['usergroupid']) && in_array('order', $_SESSION['GtAdminuserroles'])) { ?>
                    <li <?php if ($gtpage == "order-list") {
                            echo 'class="active"';
                        } ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i> <span> Management</span>
                        </a>

                        <ul class="dropdown-menu">

                            <li <?php if ($gtpage == "ca-order-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>create_rank1.php">
                                    <i class="fa fa-pagelines"></i> <span>Manage Rank</span>
                                </a>
                            </li>

                            <li <?php if ($gtpage == "ca-order-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>create_vessel.php">
                                    <i class="fa fa-pagelines"></i> <span>Manage Vessel</span>
                                </a>
                            </li>

                            <li <?php if ($gtpage == "ca-order-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>create_shiptype.php">
                                    <i class="fa fa-pagelines"></i> <span>Manage Ship Type</span>
                                </a>
                            </li>


                            <li <?php if ($gtpage == "export-jobseeker") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>create_areaop.php">
                                    <i class="fa fa-pagelines"></i> <span>Manage Area of operation</span>
                                </a>
                            </li>

                            <li <?php if ($gtpage == "export-jobseeker") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>coc_copcerti.php">
                                    <i class="fa fa-pagelines"></i> <span>Manage Certificates</span>
                                </a>
                            </li>
                        </ul>

                    </li>
                <?php
                }
                ?>

                <!----------------end------------tanuja code------------------------------->              

                <?php if (isset($_SESSION['usergroupid']) && in_array('admin_users', $_SESSION['GtAdminuserroles'])) { ?>
                    <li <?php if ($gtpage == "admin-user-list") {
                            echo 'class="active"';
                        } ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i> <span>Admin Users</span>
                        </a>

                        <ul class="dropdown-menu">
                            <li <?php if ($gtpage == "admin-user-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>admin-user-list.php">
                                    <i class="fa fa-pagelines"></i> <span>Admin User List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>

                <?php if (isset($_SESSION['usergroupid']) && in_array('admin_users', $_SESSION['GtAdminuserroles'])) { ?>
                    <li <?php if ($gtpage == "admin-user-list") {
                            echo 'class="active"';
                        } ?>>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i> <span>General Settings</span>
                        </a>

                        <ul class="dropdown-menu">

                        <li <?php if ($gtpage == "export-jobseeker") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>export-jobseekers.php">
                                    <i class="fa fa-pagelines"></i> <span>Export Jobseekers</span>
                                </a>
                            </li>
                            <li <?php if ($gtpage == "export-employer") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>export-employers.php">
                                    <i class="fa fa-pagelines"></i> <span>Export Employer</span>
                                </a>
                            </li>

                            <li <?php if ($gtpage == "ca-order-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>contact.php">
                                    <!--       <a href="<?php echo $baseurl; ?>create_contact.php">    -->
                                    <i class="fa fa-pagelines"></i> <span>Contact Us Details</span>
                                </a>
                            </li>

                            <li <?php if ($gtpage == "ca-order-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>aboutus.php">
                                    <!--    <a href="<?php echo $baseurl; ?>create_aboutus.php">    -->
                                    <i class="fa fa-pagelines"></i> <span>About Us Details</span>
                                </a>
                            </li>

                            <li <?php if ($gtpage == "ca-order-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>terms.php">
                                    <!--         <a href="<?php echo $baseurl; ?>create_termasncondition.php">    -->
                                    <i class="fa fa-pagelines"></i> <span>Terms & Condition</span>
                                </a>
                            </li>

                            <li <?php if ($gtpage == "ca-order-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>privacy.php">
                                    <i class="fa fa-pagelines"></i> <span>Privacy Policy</span>
                                </a>
                            </li>
                            <li <?php if ($gtpage == "export-employer") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>info-employers.php">
                                    <i class="fa fa-pagelines"></i> <span>Information Employer</span>
                                </a>
                            </li>
                            <li <?php if ($gtpage == "export-jobseeker") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>info-jobseekers.php">
                                    <i class="fa fa-pagelines"></i> <span>Information Jobseekers</span>
                                </a>
                            </li>
                            <li <?php if ($gtpage == "admin-user-list") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>settings.php">
                                    <i class="fa fa-pagelines"></i> <span>Global Website Settings</span>
                                </a>
                            </li>

                            <li <?php if ($gtpage == "change-password") {
                                    echo 'class="active"';
                                } ?>>
                                <a href="<?php echo $baseurl; ?>change-password.php">
                                    <i class="fa fa-sign-out"></i> <span>Change Password</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                <?php
                }
                ?>

                </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>