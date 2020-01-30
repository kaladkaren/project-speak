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
<script>
  $('#container').addClass('sidebar-closed')
</script>
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Summary of <strong><em><?php echo $device->device_name ?></em></strong> (<?php echo $station->station_name ?> Station)
            <?php if ($to && $from): ?>
              from <b><?php echo date('F j, Y', strtotime($from)) ?></b> to <b><?php echo date('F j, Y', strtotime($to)) ?></b>
            <?php endif ?>
            <br>
            from <b><?php echo ($from) ? date('F j, Y', strtotime($from)) : 'beginning of time' ?></b> to <b><?php echo ($to) ? date('F j, Y', strtotime($to)): 'present' ?></b>
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