<style>
  .hide-b4 {
    display: none;
  }

  @media print{
    .header, #sidebar, .hidey {
      display: none;
    }
    .showwy {
      display: block;
    }
    #main-content, .wrapper {
      margin-left:0px;
    }

  }

</style>
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-11">
        <section class="panel">
          <header class="panel-heading">
          	Summary of <strong><em><?php echo $rateable_name ?></em></strong> from <?php echo $division_name ?>
          	<?php if ($to && $from): ?>
          		from <b><?php echo date('F j, Y', strtotime($from)) ?></b> to <b><?php echo date('F j, Y', strtotime($to)) ?></b>
          	<?php endif ?>
            <div class="row hidey">
              <div class="col-md-3">
                
            	<a href="<?php echo base_url('cms/ratings') . "?" ?>">
            		<button class="btn btn-info btn-xs">&laquo; Go back to Ratings</button>
            	</a>           
             <br>
              <a href="<?php echo base_url('cms/ratings') . "?name=$rateable_name&from=$from&to=$to" ?>">
                <button class="btn btn-info btn-xs">&laquo; Go back to Ratings (retain filters)</button>
              </a>
              </div>

           <form method="GET">
  
            <div class="col-md-6" style="margin-top:12px">
                <div class="input-group">
                  <input type="date" class="form-control" name="from" value="<?php echo ($from && $to) ? $from :''; ?>">
                  <span class="input-group-addon">To</span>
                  <input type="date" class="form-control" name="to" value="<?php echo ($from && $to) ? $to :'';  ?>">
              </div>
            </div>
            <div class="col-md-1" style="margin-top:12px" >
               <button type="submit" class="btn btn-info"><i class="fa fa-filter"></i> Filter</button>
            </div>   
            <div class="col-md-1" style="margin-top:12px" >
               <button type="button" class="btn btn-warning" onclick="window.print()"><i class="fa fa-print"></i> Print/PDF</button>
            </div>   
         </form>
            </div>

          </header>
          <div class="panel-body">

          	<div class="row">
          		<div class="col-md-3 hidey">
          			<i class="fa fa-star" style='font-size:188px; color:#a87aa8'></i>
          			<center><h4>Rating Summary</h4></center>
          		</div>
          		<br class="hidey"> 
          		<div class="col-md-9">
          			
          			<?php
			        foreach ($summary as $value):  ?>
	          				<div class="row hidey"> 
	          						<div class="col-md-2"><?php echo $value->rating ?> ⭐</div>
	          						<div class="col-md-7">
	      								<div class="progress progress-striped active progress-sm">
			            		          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $value->p ?>%">
			                    		  </div>
					                    </div>
	          						</div>
	          						<div class="col-md-3"><?php echo $value->county ?> ratings out of <?php echo $total ?></div>
	          				</div>
                  <div class="hide-b4 showwy"><?php echo $value->rating ?> ⭐ <?php echo $value->county ?> ratings out of <?php echo $total ?></div>
          			<?php endforeach ?>
          		</div>
          	</div>

          	<div class="row">
          		<div class="col-md-3">
 					<h5 style="font-weight:bold">Average rating: <?php echo $average ?>⭐</h5>
          		</div>
          		<div class="col-md-3">
 					<h5 style="font-weight:bold">Total ratings: <?php echo $total ?> ratings</h5>
          		</div>
          		<div class="col-md-3">
          <h5 style="font-weight:bold">Total suggestions: <?php echo $total_suggestions ?></h5>
          		</div>	
              <div class="col-md-3">
          <h5 style="font-weight:bold">Total compliments: <?php echo $total_compliments ?></h5>
              </div>  
          	</div>

            <div class="row">
              <div class="col-md-12">
                <table class="table">
                  <tr>
                    <th>Comment</th>
                    <th>
                      <?php if ($rateable_name == 'Others'): ?>
                        Other rateable name
                      <?php endif ?>
                    </th>
                    <th>Commenter</th>
                    <th>Group</th>
                    <th>Rated At</th>
                  </tr>
                  <?php if ($comments): 
                      foreach ($comments as $value):
                    ?>
                  <tr>
                  <td><span style="color:<?php echo $value->comment_color ?>;font-weight: bold"><?php echo $value->comment ?></span></td>
                  <td><?php echo ucwords($value->other_rateable_name) ?></td>
                        <td><?php echo ($value->internal_member_name)? "$value->internal_member_name (internal)": "$value->external_member_name (external)" ?></td>
                        <td><?php echo ($value->internal_member_name) ? $value->division_name . " (division)" : $value->department_name . " (department) - " . $value->agency_name . " (sub-agency)" ?></td>
                    <td><?php echo $value->rated_at_formatted ?></td>
                  </tr>
                  <?php 
                    endforeach;
                      else: ?>                    
                  <tr>
                    <td colspan="4">No comments</td>
                  </tr>
                  <?php endif ?>
                </table>
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
