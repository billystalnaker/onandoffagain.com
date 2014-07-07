
<style>
    html{
        height:100%;
    }
    body{
        height:100%;
    }
    #page-wrapper{
        height:100%;
        min-height:initial;
    }
    #wrapper{
        height:100%;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">St. Light Report</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
	<form action="<?php echo current_url(); ?>" method="POST">
	    <div class="form-group">
		<label>How would you like the report?</label>
		<label class="radio-inline">
		    <input type="radio" name="output_type" value="I" checked>View on the screen
		</label>
		<label class="radio-inline">
		    <input type="radio" name="output_type" value="D">Download
		</label>
	    </div>
	    <div class="form-group">
		<input class="btn -btn-primary" type="submit" value="Submit" name="submit_report" />
	    </div>
	</form>
    </div>
</div>