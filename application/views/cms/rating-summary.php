

<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-9">
        <section class="panel">
          <header class="panel-heading">
          	Summary of <strong><em><?php echo $rateable_name ?></em></strong> 
          	<?php if ($to && $from): ?>
          		from <b><?php echo date('F j, Y', strtotime($from)) ?></b> to <b><?php echo date('F j, Y', strtotime($to)) ?></b>
          	<?php endif ?>
          	<br>
          	<a href="<?php echo base_url('cms/ratings') . "?name=$rateable_name&from=$from&to=$to" ?>">
          		<button class="btn btn-info btn-xs">&laquo; Go back to Ratings</button>
          	</a>
          </header>
          <div class="panel-body">

          	<div class="row">
          		<div class="col-md-3">
          			<i class="fa fa-star" style='font-size:188px; color:#a87aa8'></i>
          			<center><h4>Rating Summary</h4></center>
          		</div>
          		<br> 
          		<div class="col-md-9">
          			
          			<?php
			        foreach ($summary as $value):  ?>
	          				<div class="row"> 
	          						<div class="col-md-2"><?php echo $value->rating ?> ⭐</div>
	          						<div class="col-md-7">
	      								<div class="progress progress-striped active progress-sm">
			            		          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value->p ?>%">
			                    		  </div>
					                    </div>
	          						</div>
	          						<div class="col-md-3"><?php echo $value->county ?> ratings out of <?php echo $total ?></div>
	          				</div>
		          			
		          			 
          			<?php endforeach ?>
          		</div>
          	</div>

          	<div class="row">
          		<div class="col-md-3">
          		</div>	
          		<div class="col-md-4">
 					<h4>Average rating: <?php echo $average ?>⭐</h4>
          		</div>
          		<div class="col-md-4">
 					<h4>Total ratings: <?php echo $total ?> ratings</h4>
          		</div>
          	</div>

       	  </div>
       </section>
	  </div>
	</div>
    <!-- page end-->
  </section>
</section>
<!--main content end-->
