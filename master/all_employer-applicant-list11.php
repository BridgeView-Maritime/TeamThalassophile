<style>

   /*   pagination style   */
        
    .pagination>li { 

    background: #ececec;

    color: #666;

    border: 1px solid #ddd;

    padding: 6px 12px;

    position: relative;

    float: left;

    cursor:pointer;

    }

    .pagination>li:first-child{

    margin-left: 0;

    border-top-left-radius: 4px;

    border-bottom-left-radius: 4px;

    }



    .pagination>li:last-child{

    margin-left: 0;

    border-top-right-radius: 4px;

    border-bottom-right-radius: 4px;

    }



    .pagination>li:hover{   z-index: 2;

    color: #23527c;

    background-color: #eee;

    border-color: #ddd;

    }


</style>



<?php include('header.php'); $gtpage = 'all_employer-job-list11'; $listjs = 1; 

    $_SESSION["Viewrcturl"] = $urltoshow;

?>



    <div class="wrapper row-offcanvas row-offcanvas-left">

        <!-- Left side column. contains the logo and sidebar -->

        <?php include('sidebar.php'); ?>



        <!-- Right side column. Contains the navbar and content of the page -->

        <aside class="right-side">

            <!-- Content Header (Page header) -->

            <section class="content-header">

                <h1>

                Manage Applicant List 

                    <small></small>

                </h1>

                <ol class="breadcrumb">

                    <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

                    <li class="active">Manage Applicant List </li>

                </ol>

            </section>



            <!-- Main content -->

            <section class="content">

                <div class="row" id="jobdisplay">
                   
                        
                   


   <!-------  job   display   here-------------------------->


                        


                </div>



            </section><!-- /.content -->

          

          <footer>

                  <?php include('footer-copyright.php'); ?>

          </footer>

        </aside><!-- /.right-side -->

    </div><!-- ./wrapper -->        

<?php include('footer.php'); ?>

    <script>


  load_data();



function load_data(page){

    // for show applicant list count page
    var job_id = "<?php echo $_GET['job_id']; ?>";

     
  $.ajax({

    method:"POST",

    data:{page:page,job_id:job_id},

    url:"all_employer-applicant-list11_ajax.php",

    success:function(response){

   
        $('#jobdisplay').html(response);

      // $('.row').html(response);

    },error:function(response){

        window.alert('Sorry Something went wrong');

    }

    
  });



 }



    $(document).on('click','.nextpage',function(){

        var page=$(this).attr('id');      

        load_data(page);


    });


 /*  end  pagination code    */


   
    </script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


