<div class="row dynamic_st_light_defect ">
    <label class="col-md-3">Defects:</label>
    <div class="col-md-12">
        <div class="table-responsive" style="max-height: 160px; overflow:auto;">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <th>Name</th>
                <th>Has Defect?</th>
                <th>Comment</th>
                </thead>
                <tbody>
                    <?php foreach($defects as $defect){ ?>
                        <tr>
                            <td>
                                <?php echo $defect['name']; ?>
                            </td>
                            <td>
                                <input type="hidden" name="update[<?php echo $defect['id']; ?>][id]" value="<?php echo $defect['id']; ?>"/>
                                <?php
//			// Define form input values.
//			$current_status	 = (in_array($defect['id'], $st_light_defects))?1:0;
//			$new_status		 = (in_array($defect['id'], $st_light_defects))?'checked="checked"':NULL;
                                ?>
                                <input class="update_st_light_defect_current_status" type="hidden" name="update[<?php echo $defect['id']; ?>][current_status]" value="0"/><!--value = current_status-->
                                <input type="hidden" name="update[<?php echo $defect['id']; ?>][new_status]" value="0"/>
                                <input class="update_st_light_defect_new_status" type="checkbox" name="update[<?php echo $defect['id']; ?>][new_status]" value="1" /><!--echo $new_status -->
                            </td>
                            <td><textarea class="update_st_light_defect_comment" name="update[<?php echo $defect['id']; ?>][comment]"></textarea></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>