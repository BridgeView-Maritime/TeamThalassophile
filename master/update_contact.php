<?php
//session_start();
include('header.php');
  
?>



<?php
$Name=$_GET['Name'];

/*

if(!empty($_GET['edit'])){

    $edit=$_GET['edit'];
    $qur="select * from contactus where id='$edit'";
    $exe = $db->query($qur);	      
    $row2 = $exe->rows;
     
  
  }   */

if(isset($_GET['edit']))
{
      $edit=$_GET['edit'];
        $qur="select * from contactus where id='$edit'";
        $exe = $db->query($qur);	      
        $row = $exe->rows;
}	




if (isset($_POST['update']))
{
     $address = $_POST["address"];
      $phone = $_POST["phone"];
	 $mob = $_POST["mob"];
     $emailid = $_POST["emailid"];
 $status = $_POST["status"];

$sql = "update contactus set address='$address',phone='$phone',mob='$mob',emailid='$emailid', status='$status' where id ='$edit'";
     
        $result = $db->query($sql);	 
	
		if(($result))
 {

      echo "<script> alert('Updated SUCCESSFULLY');window. location.href='create_contact.php'; </script>";
echo "<script>alert('Updated SUCCESSFULLY');</script>";
}
else
 {
 echo "<script>alert('FAILED TO INSERT');</script>";
 }

 }
		

?>

<!DOCTYPE html>
<html>

 
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Update Contact Address
        </h1>
     </section>

    <!-- Main content -->
    <section class="content">

       <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <!--<h3 class="box-title">Quick Example</h3>-->
            <!-- /.box-header -->
            <!-- form start -->

            <?php  

          //      $rowlist = $vessel->rows;
           
             foreach($row as $key => $row2) { 

                                        
                ?>
			
            <form action="" method="post" >
              <div class="box-body">
                 <div class="col-md-8">
                
                  <label for="exampleInputPassword1">Office Address</label>
               
                  <input type="text" class="form-control" name="address" id="address" value="<?php echo $row2['address'];?>" placeholder="Office Address">
                </div>
                 <div class="col-md-8">
                  <label for="exampleInputPassword1">Phone No.</label>
                  <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $row2['phone'];?>" placeholder="Phone No.">
                </div>
                 <div class="col-md-8">
                  <label for="exampleInputPassword1">Mobile Number</label>
                  <input type="text" class="form-control" name="mob" id="mob" value="<?php echo $row2['mob'];?>" placeholder="Mobile Number">
                </div>
                
                <div class="col-md-8">
                  <label for="exampleInputPassword1">Email Address</label>
                  <input type="text" class="form-control" name="emailid" id="emailid" value="<?php echo $row2['emailid'];?>" placeholder="Email Address">
                </div>
				 <div class="col-md-8">
                  <label>Select status</label>
                  <select class="form-control" name="status">
				   <option value="<?php echo $row2['status'];?>">--- Select Status---</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                   </select>
                
                </div>
			 <!-- /.box-body -->
              <div class="col-md-6">
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
              <button class="btn btn-primary">  <a href="create_contact.php" style="color:white;">  Back</a> </button>
				
              </div>
			  </div>
			   </div>
              
              
               <?php    }  ?>


	     </form>
	
          <!-- /.box -->
           
    
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
     
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
       </div>
    </section>
    <!-- /.content -->
	
   
	
	
	
	 
	
  </div>


<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
