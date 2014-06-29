
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View St. Lights</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php if(!empty($message)){ ?>
    <div id="message">
        <?php echo $message; ?>
    </div>
<?php } ?>

<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo site_url('module/st_lights/add') ?>" >Add a st. light...</a>
        <div class="panel panel-default">
            <div class="panel-heading">
                St. Lights
            </div>
            <!-- /.panel-heading -->
            <form action="<?php echo current_url(); ?>" method="POST" >
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Defect</th>
                                    <th>Active</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <?php if(!empty($st_lights)){
                                ?>
                                <tbody>
                                    <?php foreach($st_lights as $st_light){ ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo site_url("module/st_lights/edit/".$st_light['id']); ?>">
                                                    <?php echo $st_light['location']; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $st_light['description']; ?>
                                            </td>
                                            <td>
                                                <?php echo $st_light['defect_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo ($st_light['active'] === 'y')?"Yes":"No"; ?>
                                            </td>
                                            <td class="align_ctr">
                                                <?php if($this->flexi_auth->is_privileged('Delete Users')){ ?>
                                                    <input type="checkbox" name="delete_st_light[<?php echo $st_light['id']; ?>]" value="1"/>
                                                <?php }else{ ?>
                                                    <input type="checkbox" disabled="disabled"/>
                                                    <small>Not Privileged</small>
                                                    <input type="hidden" name="delete_st_light[<?php echo $st_light['id']; ?>]" value="0"/>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Update St. Lights" name="update_st_lights"/>
                </div>
            </form>
        </div>
    </div>
</div>