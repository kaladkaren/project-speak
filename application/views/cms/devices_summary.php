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
          	Summary of <strong><em><?php echo $device->device_name ?></em></strong> (<?php echo $station->station_name ?> Station)
          	<?php if ($to && $from): ?>
          		from <b><?php echo date('F j, Y', strtotime($from)) ?></b> to <b><?php echo date('F j, Y', strtotime($to)) ?></b>
          	<?php endif ?>
            <div class="row hidey">
              <div class="col-md-3">
                
            	<a href="<?php echo base_url('cms/devices') . "?" ?>">
            		<button class="btn btn-info btn-sm" style="margin-top: 14px;">&laquo; Go back to Devices</button>
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
          <?php #var_dump($rateables); die(); ?>
          <div class="panel-body">

            <div class="row">

              <div class="col-md-12">
                <table class="table table-striped">
                  <tr>
                    <th colspan="3" style="text-align: center"><h4>Services</h4></th>
                  </tr>                  <tr>
                    <th>Rateable name</th>
                    <th>Rating</th>
                  </tr>
                  <?php foreach ($services as $value): ?>
                  <tr>
                    <td><?php echo $value->name ?></td>
                    <td>Average rating: <?php echo round($value->ratingy, 2) ?> ⭐</td>
                    <td>Total Ratings: <?php echo $value->total ?></td>
                  </tr>
                  <?php endforeach; ?>

                   
                    <?php foreach ($services_zero as $value):
                    ?>
                  <tr>
                    <td><?php echo $value->name ?></td>
                    <td>Average rating: 0 ⭐</td>
                    <td>Total Ratings: 0</td>
                  </tr>
                  <?php 
                    endforeach;  ?>    


                    <?php if(!$services && !$services_zero): ?>     
                  <tr>
                    <td colspan="2">Empty table data</td>
                  </tr>
                  <?php endif ?>
                </table>
              </div>
              <div class="col-md-12">
                <br>
              </div>

              <div class="col-md-12">
                <table class="table table-striped">
                  <tr>
                    <th colspan="3" style="text-align: center"><h4>People</h4></th>
                  </tr>                  <tr>
                    <th>Rateable name</th>
                    <th>Rating</th>
                  </tr>
                  <?php 
                      foreach ($people as $value):
                    ?>
                  <tr>
                    <td><?php echo $value->name ?></td>
                    <td>Average rating: <?php echo round($value->ratingy, 2) ?> ⭐</td>
                    <td>Total Ratings: <?php echo $value->total ?></td>
                  </tr>
                  <?php 
                    endforeach; ?>

                    <?php foreach ($people_zero as $value):
                    ?>
                  <tr>
                    <td><?php echo $value->name ?></td>
                    <td>Average rating: 0 ⭐</td>
                    <td>Total Ratings: 0</td>
                  </tr>
                  <?php 
                    endforeach; ?>    


                      <?php if (!$people && !$people_zero):  ?>                    
                  <tr>
                    <td colspan="2">Empty table data</td>
                  </tr>
                  <?php endif ?>
                </table>
              </div>

              <div class="col-md-12">
                <br>
              </div>

              <div class="col-md-12">
                <table class="table table-striped">
                  <tr>
                    <th colspan="3" style="text-align: center"><h4>Experience</h4></th>
                  </tr>                  <tr>
                    <th>Rateable name</th>
                    <th>Rating</th>
                  </tr>

                  <?php foreach ($experience as $value): ?>
                  <tr>
                    <td><?php echo $value->name ?></td>
                    <td>Average rating: <?php echo round($value->ratingy, 2) ?> ⭐</td>
                    <td>Total Ratings: <?php echo $value->total ?></td>
                  </tr>
                  <?php  endforeach; ?> 

                  <?php foreach ($experience_zero as $value):
                    ?>
                  <tr>
                    <td><?php echo $value->name ?></td>
                    <td>Average rating: 0 ⭐</td>
                    <td>Total Ratings: 0</td>
                  </tr>
                  <?php  endforeach; ?>    

                    <?php if (!$experience && !$experience_zero):  ?>                    
                  <tr>
                    <td colspan="2">Empty table data</td>
                  </tr>
                  <?php endif; ?>
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