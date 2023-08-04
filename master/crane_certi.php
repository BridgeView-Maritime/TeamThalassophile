
<?php include('header.php'); $gtpage = 'crane_certi'; $listjs = 1; 
  
  $certicrane="SELECT * FROM `certificate_crane` ";
  $crane = $db->query($certicrane);	
  $foundnum = $crane->num_rows;
  
  //------------------tanuja code-------------------------//
  
      
  if(isset($_POST['submit']))
  
  {
  
  $name=$_POST['name'];
  
  
      $checkcrane="select * from certificate_crane where crane_certi='".$name."' ";
      $chdcrane = $db->query($checkcrane);	
      $crows = $chdcrane->num_rows;
  
      if($crows>0){
  
          echo "<script>alert('Already Present');window.location.href='crane_certi.php';</script>";
  
      }else{
   
     if(!empty($_GET['edit'])){
  
        
            $update="UPDATE certificate_crane set crane_certi='".$name."' where id='".$_GET['edit']."'";
  
            $updatecrane = $db->query($update);	
  
        if($updatecrane){
  
            echo "<script>alert(' Updated Successfully');window.location.href='crane_certi.php';</script>";
  
                     }
  
        }
      
      
      else{
      
          $insert="Insert into certificate_crane set crane_certi='".$name."' ";
          $insertdc = $db->query($insert);	
          
          if($insertdc){
  
            echo "<script>alert(' Added Successfully');window.location.href='crane_certi.php';</script>";
  
        }else{
  
          echo "<script>alert('Something Went Wrong');window.location.href='crane_certi.php';</script>";
  
        }
  
      }
  
    }
  
  
   }
  
   if(!empty($_GET['edit'])){
  
    $edit="select * FROM certificate_crane where id='".$_GET['edit']."' ";
    $editcrane = $db->query($edit);	
   
    $eres = $editcrane->rows;
  
  
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
  
                 Add Crane Operator License
       <a href="coc_copcerti.php"><button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-plus" aria-hidden="true"></i> COC/COP Certificates</button></a>
  
       <a href="offshore_certi.php"><button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-plus" aria-hidden="true"></i>Offshore Certificates</button></a>
  
       <a href="stcw_certi.php"><button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-plus" aria-hidden="true"></i> STCW Certificates</button></a>
      
       <a href="dc_certi.php"><button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-plus" aria-hidden="true"></i> DC Endorsement</button></a>
  
       <a href="crane_certi.php"><button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-plus" aria-hidden="true"></i> Crane Operator License</button></a>
                      <small></small>
  
                  </h1>
  
                  <ol class="breadcrumb">
  
                      <li><a href="<?php echo $baseurl; ?>master/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
  
                      <li class="active">Add Crane Operator License</li>
  
                  </ol>
  
              </section>
  
  
  
              <!-- Main content -->
  
      <div class="col-lg-12" style="margin-left:200px;width:80%;">
      <form action="" method="post">
              <div class="form-group">
  
                  <h4>Crane Operator License Name </h4>
                    
                  <input type="text" autocomplete="off" value="<?php  foreach($eres as $key => $row1) { echo $row1['crane_certi'];   } ?>" class="form-control" name="name" required>                       
                 
      
              </div>
  
           
              <div class="col-md-6">
                  <div class="box-footer">
                       <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  </div>
              </div>
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
  
                                  <table id="example" class="table table-bordered table-striped">
  
                                      <thead>
  
                                          <tr>
                            
                                              <th>ID</th>
  
                                              <th>Certificate</th>                                 
                                                                           
                                              <th>Action</th>
  
                                          </tr>
  
                                      </thead>
  
                                      <tbody>
  
                                      <?php  
                                                            
                                     $rowlist = $crane->rows;
                                     
  
                                  $i=1;	$j=1; foreach($rowlist as $key => $row) { 
  
                                                             
                                       ?>
  
                                          <tr>
                                 
                                              <td><?php echo $row["id"]; ?></td>
  
                                              <td><?php echo $row["crane_certi"]; ?></td>
                                                                                          
                                              <td align="left" valign="top" class="rws-actionbtns">
                              
                                                                    
                                          
                                          
                                          <a href="?edit=<?php echo $row['id']; ?>"
                                          post_id="<?php  echo $row["id"]; ?>" 
                                          onClick="" class="btn btn-success" title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                          
                                          <a href="javascript:void(0);" 
                                          post_id="<?php  echo $row["id"]; ?>" 
                                          onClick="" class="btn btn-danger cranedelete" title="Delete"><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i></a>&nbsp;
                                          
                                       
                                        </td>
  
                                  
        
                                               </td>
                                          </tr> 
  
                                       <?php  $j++; } ?>                                              
  
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
      $('#example').DataTable();
  } );
  </script>
  
  <script>
  
          $(".cranedelete").click(function(){
  
          var id=$(this).attr('post_id');
        //  alert(id);
          alert('Are You Want to Delete This Record');
  
          var action = "cranedelete";
          $.ajax({
          method :"POST",
          //  url : "vacancy_update.php",
          url : "manage_job_ajax.php",
          data : {
              id:id,action:action
          },
          success : function(data){
          swal(data);
          setInterval(function(){ window.location.reload();}, 1000);
              }
  
          });
          });  
  </script>
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
   
  
  