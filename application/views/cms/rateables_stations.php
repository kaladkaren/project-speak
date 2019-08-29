
<style>
  .ms-container { width: 100%;  }
  .ms-container .ms-list { height: 440px; }
</style>
<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    

    <?php foreach ($stations as $station): ?>
      

    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <?php echo ucwords($station->station_name); ?>
            <span class="tools pull-right">
              <a href="javascript:;" class="fa fa-chevron-down"></a>
              <a href="javascript:;" class="fa fa-times"></a>
            </span>
          </header>
          <div class="panel-body">
             <form method="post" action="<?php echo base_url('cms/rateables/update-rateables-stations') ?>">
             <div class="form-group">
                <div class="col-md-7">
                  <input type="hidden" name="id" value="<?php echo $station->id ?>">
                    <select multiple="multiple" class="multi-select" name="rateable_ids[]">
                        <?php foreach ($station->stations_rateables as $k => $r): #categ
                        // var_dump($r); 
                         ?>
                        
                        <optgroup label="<?php echo $k ?>">
                          <?php foreach ($r as $key => $ival): # laman 
                            $selected = (in_array($ival['id'], $station->current_rateables));
                           ?>
                            <option <?php echo ($selected)?'selected':''; ?> value="<?php echo $ival['id'] ?>"><?php echo $ival['name'] ?></option>
                          <?php endforeach?>
                        </optgroup>

                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-3" >
                  <button type="submit" class="btn btn-success">
                      <i class="fa fa-check-circle-o"></i> Save - <?php echo ucwords($station->station_name); ?>
                  </button>
                    <?php if ($flash_msg['station_id'] === $station->id):?>
                      <br><h5 style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></h5>
                    <?php endif; ?>
                </div>
            </div>
          </form>
          </div> <!-- / panel body -->
          </section>
        </div>
      </div>


    <?php endforeach # /station forech ?>


      <!-- page end-->
    </section>
  </section>

  <script>
        $('.multi-select').multiSelect({
        selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
        afterInit: function (ms) {
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function (e) {
                    if (e.which === 40) {
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function (e) {
                    if (e.which == 40) {
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function () {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function () {
            this.qs1.cache();
            this.qs2.cache();
        }
    });
  </script>
 

  <script src="<?php echo base_url('public/admin/js/custom/') ?>rateables_stations_management.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>

