
<?php //include('header.php'); 

include('../includes/config.php');


$action=$_POST['action'];
$cdate=date("Y-m-d H:i:s");



//-----------------for delate marine rank--------------//
  if($action == "rankdelete"){

  $id = $_POST['id'];
    
   $query=" DELETE FROM `ss_marinerank` WHERE `id`='$id' ";
   $rs = $db->query($query);
  
  
 if($rs){
      echo "record deleted succssfully";
   
   }else{
      echo "something went wrong";
   }   
   
   }



   
//-----------------for delate offshore rank--------------//
 else if($action == "offrankdelete"){

   $id = $_POST['id'];
     
    $query2=" DELETE FROM `ss_offshorerank` WHERE `id`='$id' ";
    $rs2 = $db->query($query2);
   
   
  if($rs2){
       echo "record deleted succssfully";
    
    }else{
       echo "something went wrong";
    }   
    
    }


   
//-----------------for delate rigs rank--------------//
else if($action == "rigsrdelete"){

   $id = $_POST['id'];
     
    $query3 =" DELETE FROM `ss_rigsrank` WHERE `id`='$id' ";
    $rs3 = $db->query($query3);
   
   
  if($rs3){
       echo "record deleted succssfully";
    
    }else{
       echo "something went wrong";
    }   
    
    }


    //-----------------for delate shore rank--------------//
      else if($action == "shorerankdelete"){

         $id = $_POST['id'];
         
         $query11=" DELETE FROM `shore_rank` WHERE `id`='$id' ";
         $rs11 = $db->query($query11);
         
         
      if($rs11){
            echo "record deleted succssfully";
         
         }else{
            echo "something went wrong";
         }   
         
         }



   //-----------------for  delete vessel type-------------//
   else if($action == "vesseldelete"){

    $id = $_POST['id'];
      
     $query1=" DELETE FROM `vessel_type` WHERE `id`='$id' ";
     $rs1 = $db->query($query1);
    
    
   if($rs1){
        echo "record deleted succssfully";
     
     }else{
        echo "something went wrong";
     }   
     
     }

  
     //-----------------for  delete ship type-------------//
   else if($action == "shipdelete"){

      $id = $_POST['id'];
        
       $query4=" DELETE FROM `shiptype` WHERE `id`='$id' ";
       $rs4 = $db->query($query4);
      
      
     if($rs4){
          echo "record deleted succssfully";
       
       }else{
          echo "something went wrong";
       }   
       
       }


       
     //-----------------for  delete area of operation------------//
   else if($action == "areaopdelete"){

      $id = $_POST['id'];
        
       $query5=" DELETE FROM `area_of_operation` WHERE `id`='$id' ";
       $rs5 = $db->query($query5);
      
      
     if($rs5){
          echo "record deleted succssfully";
       
       }else{
          echo "something went wrong";
       }   
       
       }


        //-----------------for  delete coc certificate------------//
   else if($action == "cocdelete"){

      $id = $_POST['id'];
        
       $query6=" DELETE FROM `certificatecoc` WHERE `id`='$id' ";
       $rs6 = $db->query($query6);
      
      
     if($rs6){
          echo "record deleted succssfully";
       
       }else{
          echo "something went wrong";
       }   
       
       }


       //-----------------for  delete offshore certificate------------//
   else if($action == "offdelete"){

      $id = $_POST['id'];
        
       $query7=" DELETE FROM `offcertificate` WHERE `id`='$id' ";
       $rs7 = $db->query($query7);
      
      
     if($rs7){
          echo "record deleted succssfully";
       
       }else{
          echo "something went wrong";
       }   
       
       }


         //-----------------for  delete offshore certificate------------//
   else if($action == "stcwdelete"){

      $id = $_POST['id'];
        
       $query8=" DELETE FROM `certificate` WHERE `id`='$id' ";
       $rs8 = $db->query($query8);
      
      
     if($rs8){
          echo "record deleted succssfully";
       
       }else{
          echo "something went wrong";
       }   
       
       }


       //-----------------for  delete offshore certificate------------//
   else if($action == "dcdelete"){

      $id = $_POST['id'];
        
       $query9=" DELETE FROM `certificate_dc` WHERE `id`='$id' ";
       $rs9 = $db->query($query9);
      
      
     if($rs9){
          echo "record deleted succssfully";
       
       }else{
          echo "something went wrong";
       }   
       
       }


      
       //-----------------for  delete crane license certificate------------//
   else if($action == "cranedelete"){

      $id = $_POST['id'];
        
       $query10=" DELETE FROM `certificate_crane` WHERE `id`='$id' ";
       $rs10 = $db->query($query10);
      
      
     if($rs10){
          echo "record deleted succssfully";
       
       }else{
          echo "something went wrong";
       }   
       
       }
  

?>