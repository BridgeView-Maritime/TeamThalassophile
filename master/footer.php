<!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="<?php echo $baseurl; ?>js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo $baseurl; ?>js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $baseurl; ?>js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="<?php echo $baseurl; ?>js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo $baseurl; ?>js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo $baseurl; ?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $baseurl; ?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?php echo $baseurl; ?>js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo $baseurl; ?>js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo $baseurl; ?>js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo $baseurl; ?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo $baseurl; ?>js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

		<!---start----for pagination------->
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
		<!---end----for pagination--------->

        
        <!-- AdminLTE App -->
      <?php  
	  $listjs = (!empty( $listjs)? ( $listjs):''); 
	    $rwseditor = (!empty( $rwseditor)? ( $rwseditor):''); 
	  ?>       
        <!-- CK Editor -->
        <script src="<?php echo $baseurl; ?>js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        
        <script type="text/javascript">
		
		function printDiv() 
		{
		
		  var divToPrint=document.getElementById('rwsprintdivcontent');
		
		  var newWin=window.open('','Print-Window');
		
		  newWin.document.open();
		
		  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
		
		  newWin.document.close();
		
		  setTimeout(function(){newWin.close();},10);
		
		}

		<?php if($rwseditor==1) { ?>
			$(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('rwscontenteditor');
                //bootstrap WYSIHTML5 - text editor
				CKEDITOR.replace('other_facilities');
                //bootstrap WYSIHTML5 - text editor
				CKEDITOR.replace('cusines');
                //bootstrap WYSIHTML5 - text editor
            });
		<?php } ?>
		
		function togetcollegecourselist(college_id)
		{		
			$.ajax({
			type: "POST",
			url: "<?php echo $baseurl ;?>ajaxdata/admin-course-list-get.php?user=1",
			data: 	"college_id=" + college_id,							
			success: function(json){
						var obj = jQuery.parseJSON(json);
					if(obj.proceed==0)
					{
						$(".gt-courselist").html(obj.info);
					}
					else
					{
						$(".gt-courselist").html(obj.info);
					}
			}
			});
			return false;
		}
		
		function togetcollegecourselistnew(college_id)
		{		
			
			$(".gt-ajaxdcourselist").html('<div style="text-align:center; min-height:37px;">Please Wait!</div>');
			
			$.ajax({
			type: "POST",
			url: "<?php echo $baseurl ;?>ajaxdata/admin-course-list-get.php?user=1",
			data: 	"college_id=" + college_id +	
					"&requestfrom=frontend",							
			success: function(json){
					var obj = jQuery.parseJSON(json);
					if(obj.proceed==0) { $(".gt-ajaxdcourselist").html(obj.info); } else { $(".gt-ajaxdcourselist").html(obj.info); }
			}
			});
			return false;
		}
		
		function togetcollegecoursebranchlist(course_id)
		{		
			$(".gt-ajaxdbranchlist").html('<div style="text-align:center; min-height:37px;">Please Wait! </div>');
			$.ajax({
			type: "POST",
			url: "<?php echo $baseurl ;?>ajaxdata/admin-course-list-get.php?user=2",
			data: 	"course_id=" + course_id +
					"&requestfrom=frontend",							
			success: function(json){
						var obj = jQuery.parseJSON(json);
					if(obj.proceed==0) { $(".gt-ajaxdbranchlist").html(obj.info); } else { $(".gt-ajaxdbranchlist").html(obj.info); }
			}
			});
			return false;
		}
		
		<?php if($listjs==1) {?>
			function selectAllChk() 
			{
				
				var formObj=document.form4;
			   if(formObj.chkSelectAll.checked)
			   {
					checked=true;
			   }
			   else
			   {
					checked=false;
			   }
				for (var i=0;i < formObj.length;i++) 
			
				{
			
					fldObj = formObj.elements[i];
			
					if (fldObj.type == 'checkbox')
			
					{
			
						fldObj.checked = checked;
			
					}	
			
				}
			
			}
			function deleteRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item to delete");
				}
				else if(confirm("Are your sure want to delete selected items?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Delete';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Delete";
					formobj.submit();
				}
			}
			
			function activeRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for active mode");
				}
				else if(confirm("Are you sure you want to change as active mode?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Active';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Active";
					formobj.submit();
				}
			
			}
			function inactiveRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for inactive mode");
				}
				else if(confirm("Are you sure you want to change?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Inactive';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Inactive";
					formobj.submit();
				}
			}
			
			function invalidateRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for invalidate mode");
				}
				else if(confirm("Are you sure you want to change?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Invalidate';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Invalidate";
					formobj.submit();
				}
			}
			
			function validateRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for validate mode");
				}
				else if(confirm("Are you sure you want to change?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Validate';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Validate";
					formobj.submit();
				}
			}
			
			function verifyRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for active mode");
				}
				else if(confirm("Are you sure you want to change as verified mode?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Verify';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Verify";
					formobj.submit();
				}
			
			}
			
			function donotverifyRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for active mode");
				}
				else if(confirm("Are you sure you want to change as not to be verified mode?"))
				{
					//formObj.submit();
					document.getElementById("action").value='DoNotVerify';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=DoNotVerify";
					formobj.submit();
				}
			
			}
			
			function payactiveRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for active mode");
				}
				else if(formObj.totaldays.value=="")
				{
					alert("Please insert the total days.!");
					document.getElementById("totaldays").focus();
					return false;
				}
				else if(isNaN(formObj.totaldays.value))
				{
					alert("Total Days should be numeric value.!");
					document.getElementById("totaldays").focus();
					return false;
				}
				else if(confirm("Are you sure you want to change as active mode?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Activepay';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Activepay";
					formobj.submit();
				}
			
			}
			function payinactiveRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for inactive mode");
				}	
				else if(confirm("Are you sure you want to change?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Inactivepay';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Inactivepay";
					formobj.submit();
				}
			}
			
			function featuredRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for active mode");
				}
				else if(confirm("Are you sure you want to change as active mode?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Featured';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Active";
					formobj.submit();
				}
			
			}
			
			function unfeaturedRecord() 
			{
			formObj=document.form4;
				var flag=0;
				for (var i=0;i < formObj.length;i++)
				{
					fldObj = formObj.elements[i];
					if (fldObj.type == 'checkbox')
					{
						if(fldObj.checked)
						{
							flag=1;
						}
					}
				}
				if(flag==0)
				{
					alert("Please select at least one item for active mode");
				}
				else if(confirm("Are you sure you want to change as active mode?"))
				{
					//formObj.submit();
					document.getElementById("action").value='Active';
					var formobj=document.form4;
					formobj.action="<?php echo $urltoshow; ?>&action=Unfeatured";
					formobj.submit();
				}
			
			}
			
			function SearchRecord() 
			{
				document.getElementById("action").value='search';
				var formobj=document.form4;
				formobj.action="<?php echo $urltoshow; ?>&action=search";
				formobj.submit();
			}
			<?php } ?>
		</script>
        <?php  
	//  $listjs = (!empty( $listjs)? ( $listjs):''); 
	    $gtdateopt = (!empty( $gtdateopt)? ( $gtdateopt):''); 
	  ?>
      
         <?php if($gtdateopt == "on") { ?>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript">
		 	$(function() {
				$("#travel_date").datepicker({ minDate: "-6M", maxDate: "+12M +10D", changeMonth: true, dateFormat: 'yy-mm-dd', changeYear: true});
				$(".gtdatedropdown").datepicker({ minDate: "-5Y", maxDate: "+6M", changeMonth: true, dateFormat: 'yy-mm-dd', changeYear: true});
				$("#transaction_date").datepicker({ minDate: "-6M", maxDate: "+12M +10D", changeMonth: true, dateFormat: 'yy-mm-dd', changeYear: true});
				$(".gtavailability").datepicker({ minDate: "-6M", maxDate: "+12M +10D", changeMonth: true, dateFormat: 'yy-mm-dd', changeYear: true});
			});	
			
			$(".rwsdatecal").datepicker({ dateFormat: 'yy-mm-dd', minDate: "today", maxDate: "+30 Days" });
			
			 $( function() {
				var availableTags = [	
				  "Delhi",	
				  "Almora",	
				  "Bageshwar",	
				  "Reema",				  
				  "Lucknow"	
				];	
				$( ".rwscityicon" ).autocomplete({	
				  source: availableTags	
				});	
			  } );
			
			$('input[name=\'path\']').autocomplete({
				delay: 500,			
				source: function(request, response) {				
					$.ajax({			
						url: 'parent-sscategory.php?filter_name=' +  encodeURIComponent(request.term),			
						dataType: 'json',			
						success: function(json) {			
							json.unshift({			
								'category_id':  0,			
								'name':  ' --- None --- '			
							});	
			
							response($.map(json, function(item) {			
								return {			
									label: item.name,			
									value: item.category_id			
								}			
							}));			
						}			
					});			
				},
				select: function(event, ui) {			
					$('input[name=\'path\']').val(ui.item.label);			
					$('input[name=\'parent_id\']').val(ui.item.value);
					return false;			
				},			
				focus: function(event, ui) {			
					return false;			
				}			
			});	
			
			$('input[name=\'service_provider\']').autocomplete({
				delay: 500,			
				source: function(request, response) {				
					$.ajax({			
						url: 'parent-sprovicer.php?filter_name=' +  encodeURIComponent(request.term),			
						dataType: 'json',			
						success: function(json) {			
							json.unshift({			
								'category_id':  0,			
								'name':  ' --- None --- '			
							});	
			
							response($.map(json, function(item) {			
								return {			
									label: item.name,			
									value: item.category_id			
								}			
							}));			
						}			
					});			
				},
				select: function(event, ui) {			
					$('input[name=\'service_provider\']').val(ui.item.label);			
					$('input[name=\'service_provider_id\']').val(ui.item.value);
					return false;			
				},			
				focus: function(event, ui) {			
					return false;			
				}			
			});
			
			$('input[name=\'category\']').autocomplete({

	delay: 500,

	source: function(request, response) {

		$.ajax({
			url: 'parent-sscategory-package.php?filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.category_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product-category' + ui.item.value).remove();	

			$('#product-category').append('<div id="product-category' + ui.item.value + '">' + ui.item.label + '&nbsp;&nbsp;<img src="img/delete.png" alt="" style="cursor:pointer;" /><input type="hidden" name="product_category[]" value="' + ui.item.value + '" /></div>');
	
			$('#product-category div:odd').attr('class', 'odd');
			$('#product-category div:even').attr('class', 'even');			
	
			return false;
		},
		focus: function(event, ui) {
		  return false;
	   }
	});
	
	/*
	$('#product-category div img').live('click', function() {
		alert("asdf");
		$(this).parent().remove();
		$('#product-category div:odd').attr('class', 'odd');
		$('#product-category div:even').attr('class', 'even');	
	});*/
	
	$(document).on('click', '#product-category div img', function() {
		$(this).parent().remove();
		$('#product-category div:odd').attr('class', 'odd');
		$('#product-category div:even').attr('class', 'even');	
	});

		</script>

		
        <?php } ?>

		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>