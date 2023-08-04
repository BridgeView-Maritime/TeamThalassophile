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
include("../common_modal.php");

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

                Manage Posted Jobs

                    <small></small>

                </h1>

                <ol class="breadcrumb">

                    <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

                    <li class="active">Manage Posted Jobs</li>

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
  // Candidates to assign jobs
  $(document).on('click', '#applicant', function() {
    var action = "agent_candidate";
    var job_id = $(this).attr('job_id');
    var emp_id = $(this).attr('emp_id');
    console.log(job_id);
    $('#main_data').html("<p>Please Wait Loading..</p>");

    $.ajax({
      url: 'agent_job_list_ajax.php',
      method: 'POST',
      data: {
        job_id: job_id,
        emp_id: emp_id,
        action: action
      },
      success: function(result) {
        // console.log(result);
        $('#main_data').html(result);
      },
      error: function(result) {
        window.alert('Something went wrong');
      }
    });

  });

// Candidates assigned by agents
  $(document).on('click','#agentApplicants',function(){
  var action = "agent_candidate";
    var jobid=$(this).attr('job_id');
	var canid=$(this).attr('can_id');
	console.log(jobid);
    $('#main_data').html("<p>Please Wait Loading..</p>");

    $.ajax({
      url:'agent_candidate_list_ajax.php',
      method:'POST',
      data:{jobid:jobid, canid:canid, action:action},
      success:function(result){
		console.log(result);
        $('#main_data').html(result);
      },error:function(result){
        window.alert('Something went wrong');
      }
    });

});
</script>

    <script>
   
   
   /*  start pagination code    */

  load_data();

function load_data(page){

  $.ajax({

    method:"POST",

    data:{page:page},

    url:"agent_vacancy_list_ajax.php",

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

    <script>
  //----for activate all emp -----------//

  $(document).on("click",".assignagent",function(){
    
    if($("#example1 .agent_job_list_ajax td [type='checkbox']:checked").length == 0){
  
        swal('Please select atleast one candidate to approve');
        // alert('Please select atleast one candidate to approve');
  
    }else{
      
     var selected=[];
     var agnid;  
  
       $("#example1 .agent_job_list_ajax td input[type=checkbox]:checked").each(function(){

         var checkid=$(this).attr('id');
         selected.push(checkid);
         agnid=""+selected;
         
       });
       var job_id = $(this).attr('id');
       var emp_id = $(this).attr('emp_id');
        //  alert (agnid);
      var action="assignagent";
  
      $.ajax({
          method  :'POST',
          data    :{agnid:agnid,job_id:job_id,emp_id:emp_id,action:action},
          url     :'candidate_approve_ajax.php',
          success:function(result){
            setTimeout(function(){ location.reload(true); }, 1000);
            swal("Good job! ", result, "success");
            }
    });
  
    }
     
   });

</script>

<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->


