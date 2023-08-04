<?php

    include("includes/config.php");

    $action=$_POST['action'];

    if($action=="rankrequest"){

        $cat=$_POST['cat'];

       if($cat=='SHORE') {


        $query1="SELECT * FROM `shore_rank`  ";
        $result1 = $db->query($query1);
        $rowlist = $result1->rows;
    
        $output="";

        foreach($rowlist as $key => $row)
        {
            $output .="<option value='".$row['rankname']."'>".$row['rankname']."</option>";
        }


        echo $output;




       }

       else{

        $query="SELECT * FROM `ss_allrank` WHERE category='".$cat."' ";
        $result = $db->query($query);
        $rowlist = $result->rows;
    
        $output="";

        foreach($rowlist as $key => $row)
        {
            $output .="<option value='".$row['rankname']."'>".$row['rankname']."</option>";
        }


        echo $output;

       }

      
    }

    if($action=="country"){

        $cat=$_POST['cat'];

        $query="SELECT * FROM `ss_states` WHERE country_id='".$cat."' ";
        $result = $db->query($query);
        $rowlist = $result->rows;
    
        $output="";

        foreach($rowlist as $key => $row)
        {
            $output .="<option value='".$row['id']."'>".$row['state']."</option>";
        }

        echo $output;      
    }

    if($action=="state"){

        $cat=$_POST['cat'];

        $query="SELECT * FROM `ss_cities` WHERE state_id='".$cat."' ";
        $result = $db->query($query);
        $rowlist = $result->rows;
    
        $output="";

        foreach($rowlist as $key => $row)
        {
            $output .="<option value='".$row['name']."'>".$row['name']."</option>";
        }

        echo $output;      
    }

?>