<?php


include("includes/config.php");

$action=$_POST['action'];

if($action=="rankrequest"){

    $cat=$_POST['cat'];

    $query="SELECT * FROM `ss_allrank` WHERE category='".$cat."' ";
    $result = $db->query($query);
    $rowlist = $result->rows;
  

   // $query=mysqli_query($conn,"SELECT s.state from states as s join countries as c on(s.country_id=c.id) where c.country='".$country."' order by s.state asc");

    $output="";

  /*  $output .=' 
    <label class="rws-flabel"><span>*</span>Rank</label>    <br> 
           
           <select  name="jobtitle" id="jobtitle"  >   
                               
                <option value="">--Select Rank--</option>  ';    */



    foreach($rowlist as $key => $row)
    {
        $output .="<option value='".$row['rankname']."'>".$row['rankname']."</option>";
    }


  //  $output .=' </select> ';

    echo $output;
}


?>