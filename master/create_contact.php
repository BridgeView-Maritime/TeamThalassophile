
<?php include('header.php'); $gtpage = 'create_conatct'; $listjs = 1; 

   
$contactus="SELECT * FROM `contactus`  ";
$contact = $db->query($contactus);	
$foundnum = $contact->num_rows;



if(isset($_POST['submit']))

{

    $address = $_POST["address"];

    $phone = $_POST["phone"];
   
    $mob = $_POST["mob"];
   
    $emailid = $_POST["emailid"];
   
    $status = $_POST["status"];




    $insert="INSERT INTO contactus(address,phone,mob,emailid, status) VALUES ('$address','$phone','$mob','$emailid','$status')";
    $result = $db->query($insert);	
   
   
    if(($result))

        {

        echo "<script>alert('INSERTED SUCCESSFULLY');</script>";
        
        }
        
        else
        
         {
        
         echo "<script>alert('FAILED TO INSERT');</script>";
        
         }
        

   }



    else

    {

    if(isset($_GET['id']))

    {

    $id=$_GET['id'];

    $delete="delete from contactus where id ='$id'";	

        $result1 = $db->query($delete);	

        if(($result1))

    {

    echo "<script>alert('Deleted SUCCESSFULLY');</script>";

    }

    else

    {

    echo "<script>alert('FAILED TO INSERT');</script>";

    }

    }

    }


 



?>



    <div class="wrapper row-offcanvas row-offcanvas-left">

        <!-- Left side column. contains the logo and sidebar -->

        <?php include('sidebar.php'); ?>



        <!-- Right side column. Contains the navbar and content of the page -->

        <aside class="right-side">

            <!-- Content Header (Page header) -->

            <section class="content-header">

                <h1>

                Update Contact Address

                    <small></small>

                </h1>

                <ol class="breadcrumb">

                    <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>

                    <li class="active">Update Contact Address</li>

                </ol>

            </section>



            <!-- Main content -->

    <div class="col-lg-12" style="margin-left:200px;width:80%;">
    <form action="" method="post">
            
  </form>
     </div>

      
        <section class="content">

                <div class="row">

                    <div class="col-xs-12"><!-- /.box -->

                        <?php if(!empty($msg)) { ?>

                          <div id="gt-formsuccess">                                

                              <?php echo $msg; ?>

                          </div>

                          <?php } ?>

                        <form action="" method="get" name="form4" id="form4">

                        <br><br>        <div class="box"><!-- /.box-header -->

                     <div class="box-body table-responsive" style="margin-left:200px;width:80%;">
                             
                                               
                                <?php if($foundnum>0) { ?>

                                    <table id="example1" class="table table-bordered table-striped">

                                        <thead>

                                        <tr>

                                        <th>Office Address</th>

                                        <th>Phone No</th>

                                        <th>Mobile No</th>

                                        <th>Email Address</th>

                                        <th>Status</th>
                                   
                                        <th>Option</th>

                                       
                                        </tr>

                                        </thead>

                                        <tbody>

                                        <?php

                                $rowlist = $contact->rows;

                                $i=1;	 foreach($rowlist as $key => $row) { 

                                        

                                        ?>

                                        <tr>

                                        <td><?php echo $row['address'];?></td>

                                            <td><?php echo $row['phone'];?></td>

                                            <td><?php echo $row['mob'];?></td>

                                                <td><?php echo $row['emailid'];?></td>

                                        <td>

                                        <?php

                                        if($row['status']==1)

                                        {

                                            echo "Active";

                                        }

                                        elseif($row['status']==0)

                                        {

                                            echo "Deactive";

                                        }

                                        ?>

                                        

                                        

                                        </td>

                                        

                                                                        

                                        <td><a href="update_contact.php?edit=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>

                                        
                                      
                                        

                                        </td>

                                        </tr>

                                        <?php

                                        }

                                        ?>









                                        </tbody>



</table>

                            

                          

                                <?php } ?>                            

                            

                          </div><!-- /.box-body -->

                      </div><!-- /.box -->

                      </form>

                  </div>

                </div>



            </section><!-- /.content -->

          

          <footer>

                  <?php include('footer-copyright.php'); ?>

          </footer>

        </aside><!-- /.right-side -->

    </div><!-- ./wrapper -->        

<?php include('footer.php'); ?>

<script>
$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


