

<?php



    //$to = $email;
    $to = "patilvrishabh12pv@gmail.com";
			
         //   $subject = "Hello ".$fullname.", Your Account has been created successfully on ".$sitename;

            $subject = "Hello vrushabh, Your Account has been created successfully on teathallasophile";

				$message ='<tr>
			
					<td style="padding:10px;margin:0;line-height:1px;font-size:1px;font-family:\'Helvetica Neue Light\',Helvetica,Arial,sans-serif;color:#66757f;font-size:14px;font-weight:300;line-height:23px;text-align:left">
			
					Hello '.$fullname.',<br /><br />

					Thank you for registering to '.$sitename.'. Your password is <strong>'.$sendpass.'</strong><br/><br/>
					Be sure to <a href="'.$activeurl.'">validate your profile</a> in order to make applying to jobs even easier!<br/><br/>

          *********this is testing mail*******
						Best Regards <br/>
						TeamThalassophile <br/><br/><br/>
				
					</td>
		  			
		  			</tr>';

		  		// Always set content-type when sending HTML email

				$headers = "MIME-Version: 1.0" . "\r\n";

				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				$headers .= 'From: <admin@teamthalassophil.com>' . "\r\n";
				
			$mailtest =	mail($to,$subject,$message,$headers);
    
            if($mailtest){
                echo "mailsent";
            }
            else
            {
                echo " not mailsent";
            }

    ?>