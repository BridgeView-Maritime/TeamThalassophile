<div class="rws-searchfilters">

	<div class="rws-sfsection">
    	<h6>Job Interest</h6>
        <div class="rws-sfscontent">
        	<?php echo todisplaycheckboxfilter($array_job_section, "section", "categorysc", $_GET["section"], $onchange=""); ?>
        </div>
    </div>
	
    <div class="rws-sfsection">
    	<h6>Shore Category</h6>
        <div class="rws-sfscontent">
        	<?php echo todisplaycheckboxfilter($array_category_shore, "categorysc", "categorysc", $_GET["categorysc"], $onchange=""); ?>
        </div>
    </div>
    
    <div class="widget-boxed padd-bot-0">
        <div class="widget-boxed-header br-0">
            <h4>Offshore Category <a href="#designation" data-toggle="collapse"><i class="pull-right ti-plus" aria-hidden="true"></i></a></h4>
        </div>
        <div class="widget-boxed-body collapse" id="designation">
            <div class="side-listss no-border">
                <?php echo todisplaycheckboxfilter($array_category_offshore, "categorysc", "categorysc", $_GET["categorysc"], $onchange=""); ?>
            </div>
        </div>
    </div>
    
</div>