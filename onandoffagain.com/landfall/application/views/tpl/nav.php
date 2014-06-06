<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
	    <?php if($is_logged){?>
    	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    		<span class="sr-only">Toggle navigation</span>
    		<span class="icon-bar"></span>
    		<span class="icon-bar"></span>
    		<span class="icon-bar"></span>
    	    </button>
    	    <a class="navbar-brand" href="#">Landfall</a>
    	    <a class="navbar-brand fa fa-sign-out fa-3x navbar-line-height-fix sign-out" href="#" data-alt="<?php echo site_url('account/logout');?>"></a>
	    <?php }?>
        </div>
	<?php if($is_logged){?>
    	<div class="collapse navbar-collapse">
    	    <ul class="nav navbar-nav">
    		<li class="active"><a href="<?php echo site_url('home');?>">Home</a></li>
    		<li><a href="#about">About</a></li>
    		<li><a href="#contact">Contact</a></li>
    	    </ul>
    	</div><!--/.nav-collapse -->
	<?php }?>
    </div>
</div>