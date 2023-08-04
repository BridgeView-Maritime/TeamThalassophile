<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->




<?php include('../includes/config.php'); 

//Admin Access by url
$a_id=$_GET['cred1'];
$a_pass=$_GET['cred2'];
//end

if(isset($_COOKIE["GTadminusername"]) && $_COOKIE["GTAdminPassword"]!="")
{
	$rwsusername=$_COOKIE["GTadminusername"];
	$rwspassword=$_COOKIE["GTAdminPassword"];
	$checked="checked";
}
	if(isset($_POST['gtsignin']) || !empty($a_id) )
	{

		$_SESSION['myForm'] = $_POST;
		if (empty($_POST["gtusername"])) {$errors[]='Username field can\'t be blank!';}
		if (empty($_POST["gtpassword"])) {$errors[]='Password field can\'t be blank!';}

		if(empty($errors) || !empty($a_id) ) {
		$gtusername=trim($_POST['gtusername']);
		$gtpassword=md5($_POST['gtpassword']);

	
		if(!empty($a_id)){  //this is for admin access by url
			$gtusername=$a_id;
			$gtpassword=$a_pass;
		}

		$sql="SELECT * FROM `ss_adminuser` WHERE `username`='$gtusername' and `password`='$gtpassword'";
		$query = $db->query($sql);
		$rowl = $query->row;
		$numrows=$query->num_rows;

        
		if ($numrows > 0)
		{
			unset($_SESSION['myForm']);
			
			$_SESSION['GTadminuserID']=$rowl["user_id"];
			$_SESSION['GTadminuserName']=$rowl["firstname"].'&nbsp;'.$rowl["lastname"];
			$_SESSION['GTadminuserPackage']=$rowl["username"];
			$_SESSION['GTadminuserEmail']=$rowl["email"];
			$_SESSION['usergroupid']=$rowl["user_group_id"];
			$_SESSION['GTUserGroupname']=$rowl["user_group_name"];
			
			
			
			$sql2="SELECT permission FROM `ss_adminuser_groups` WHERE `user_group_id`='".$rowl["user_group_id"]."'";
			$query2 = $db->query($sql2);
			$row2 = $query2->row;
			
			$_SESSION['GtAdminuserroles']=explode(',', $row2["permission"]);
						
			$query_login = $db->query("UPDATE  `ss_adminuser` SET  `last_login` =  '$gtcurrenttime' WHERE `user_id` =".$_SESSION['GTadminuserID']);
			
			if(isset($_POST["remember_me"]))
			{
				// generate cooked of username and password
				setcookie("GTadminusername", $gtusername);
				setcookie("GTAdminPassword", $gtpassword);
			}
			else
			{
				setcookie("GTadminusername", "");
				setcookie("GTAdminPassword", "");
			}
           // echo  "<script>window.alert('success');</script>";
			echo "<script>document.location.href='dashboard.php'</script>";
			//header("Location:dashboard.php");
           
		}
		else
		{
			$msg_login="Sorry! Username/Passowrd doesn't matches.";
		}
		}
	}	
?>





<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	
</head>
<style>

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
/*  background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');    */
background-image: url('img/admin_image.jpeg');
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #12deff;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #12deff;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
</style>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
                    <br> <br>
				<h2 align="center" style="color:white">Admin Panel</h2>
				<div class="d-flex justify-content-end social_icon">
	<!--            <span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>     -->
                  
				</div>
			</div>
			<div class="card-body">
				<form action="" method="post" name="gtlogin" id="gtlogin">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="gtusername" id="gtusername"  class="form-control" placeholder="username" 
                        value="<?php (isset( $_SESSION['myForm']['gtusername'])? ( $_SESSION['myForm']['gtusername']):'');?>" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password"  name="gtpassword" id="gtpassword" class="form-control" placeholder="password"  autocomplete="off" required>
					
						<span class="input-group-text" style="background-color:white;border-style: hidden;">
							<a href="#"  title="Show password" onclick="myFunction()" data-toggle="tooltip">    
								<i id="eyeslash" class="fa fa-eye-slash" ></i>  <i id="eye" class="fa fa-eye" aria-hidden="true"></i>						
							</a>
                        </span>
					
					
					</div>
	<!--			<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>          -->
					<div align="center" class="form-group">
						<input type="submit"  name="gtsignin" id="gtsignin" value="Login" class="btn login_btn">
			       </div>
				</form>
			</div>
	<!--		<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="#">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div>           -->
		</div>
	</div>
</div>
</body>
</html>




<script>
   $('#eyeslash').hide();
function myFunction() {
  var x = document.getElementById("gtpassword");
  if (x.type === "password") {
    x.type = "text";
    $('#eye').hide();
    $('#eyeslash').show();

  } else {
    x.type = "password";
    $('#eye').show();
    $('#eyeslash').hide();
  }
}
</script>