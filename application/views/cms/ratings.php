<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Ratings
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
            <div style='margin-top:8px'>
            </div>

            <form method="GET">

            <div class="row">
                <div class="col-md-2">
                  <select id="select_device" class="form-control" name="device_id">
                    <option value="">Select device</option>
                    <?php foreach ($devices as $value): ?>
                      <option <?php echo ($device_id == $value->id) ? 'selected':''; ?> value="<?php echo $value->id ?>"><?php echo $value->device_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <select id="select_station" class="form-control" name="station_id">
                    <option value="">Select station</option>
                    <?php foreach ($stations as $value): ?>
                      <option <?php echo ($station_id == $value->id) ? 'selected':'';  ?> value="<?php echo $value->id ?>"><?php echo $value->station_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>                
                <div class="col-md-4">
                    <div class="input-group">
                      <input type="date" class="form-control" name="from" value="<?php echo ($from && $to) ? $from :''; ?>">
                      <span class="input-group-addon">To</span>
                      <input type="date" class="form-control" name="to" value="<?php echo ($from && $to) ? $to :'';  ?>">
                  </div>
                </div>              
                <div class="col-md-1">
                   <button type="submit" class="btn btn-info"><i class="fa fa-filter"></i> Filter</button>
                </div>
              </form>

              <div class="col-md-1">
                <form method="GET">
                   <button type="submit" class="btn btn-info"><i class="fa fa-times"></i> Clear</button>
                </form>
              </div>

                <div class="col-md-1">

                    <a href="<?php echo base_url('cms/ratings/export?') . $_SERVER['QUERY_STRING'] ?>">
                      <button type="button" class="btn btn-success "><i class="fa fa-print"></i> Export to CSV</button>
                    </a>

                </div>

            </div> <!-- end row -->
          </header>
          <div class="panel-body">
            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Device</th>
                    <th>Station</th>
                    <th>Rateable</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Rated by</th>
                    <th>Rated at</th>
                    <!-- <th>Actions</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($res) > 0 ): ?>

                    <?php foreach ($res as $key => $value): ?>
                      <tr>
                        <th scope="row"><?php echo $starty++ ?></th>
                        <td><?php echo $value->device_name ?></td>
                        <td><?php echo $value->station_name ?></td>
                        <td><?php echo "$value->rateable_name ($value->rateable_type)" ?></td>
                        <td><?php echo $value->rating_star ?> (<?php echo (float) $value->rating ?>)</td>
                        <td><?php echo $value->comment ?></td>
                        <td><?php echo ($value->internal_member_name)? "$value->internal_member_name (internal)": "$value->external_member_name (external)" ?></td>
                        <td><?php echo $value->rated_at_formatted?></td>
                        <!-- <td> -->
         <!--                  <button type="button"
                          data-payload='<?php echo json_encode(['id' => $value->id, 'station_name' => $value->station_name])?>'
                          class="edit-row btn btn-info btn-xs">Edit</button>
                          <button type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-delete btn-danger btn-xs">Delete</button> -->
                        <!-- </td> -->
                        </tr>
                      <?php endforeach; ?>


                    <?php else: ?>
                      <tr>
                        <td colspan="8" style="text-align:center">Empty table data</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>

                <ul class="pagination">
                  <ul class='pagination'>
                    <?php
                    for ($i=1; $i <= $total_pages; $i++) { ?>
                      <li><a
                        class="<?php echo ($i == $page) ? 'active_lg' : '' ?>"
                        href="<?php echo base_url($this->uri->uri_string())
                        . "?device_id=$device_id&station_id=$station_id&from=$from&to=$to&page=$i";
                        ?>"><?php echo $i ?></a></li>
                      <?php } ?>
                   </ul>
                 </ul>
              </div>
            </div>
          </section>
        </div>
      </div>
      <!-- page end-->
    </section>
  </section>


  <!-- <script src="<?php echo base_url('public/admin/js/custom/') ?>stations_management.js"></script> -->
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
