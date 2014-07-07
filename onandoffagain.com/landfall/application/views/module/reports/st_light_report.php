
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
	    <div class="form-group row">
		<label class="col-md-3">How would you like the report?</label>
		<div class="input-group col-md-9">
		    <label class="radio-inline">
			<input type="radio" name="output_type" value="I" checked>View on the screen
		    </label>
		    <label class="radio-inline">
			<input type="radio" name="output_type" value="D">Download
		    </label>
		</div>
	    </div>
	    <div class="form-group row">
		<label class="col-md-3">Which defects would you like to display on the report?</label>
		<div class="input-group col-md-9">
		    <?php
		    echo form_dropdown('show_defects[]', $defects, set_value('show_defects'), " id='show_defects' class='form-control' multiple");
		    ?>
		    <span style="margin:10px" class="btn btn-primary de-select" data-selector="#show_defects">De-Select All Defects</span>
		</div>
	    </div>
	    <!--	    <div class="form-group row">
			    <label class="col-md-3">Which defect types would you like to display on the report?</label>
			    <div class="input-group col-md-9">
	    <?php
	    echo form_dropdown('show_defect_types[]', $defect_types, set_value('show_defect_types'), "id='show_defect_types' class='form-control' multiple");
	    ?>
				<span style="margin:10px" class="btn btn-primary de-select" data-selector="#show_defect_types">De-Select All Defect Types</span>
			    </div>
			</div>-->
	    <div class="form-group row">
		<input class="btn -btn-primary" type="submit" value="Submit" name="submit_report" />
	    </div>
	</form>
    </div>
</div>
<script type="text/javascript">
    $(function() {
	$('.de-select').on('click', function() {
	    var select = $(this).data('selector');
	    console.log(select);
	    $(select + ' >option').attr('selected', false);
	});
    });
</script>