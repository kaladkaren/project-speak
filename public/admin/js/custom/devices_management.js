$(document).ready(function() {
	$('.select-station').on('change', function(){
		let $select_station = $(this);
		let id = $select_station.data('id')
		let station_id = $select_station.val();
		let $neighbour_td = $select_station.parent().closest('td').next();


		$.ajax({
		  url: base_url + 'cms/stations/assign',
		  type: 'POST',
		  data: {id:id, station_id:station_id},
		  success: function (result, textStatus, xhr) {
		      $('.gear-load').remove();
		      $select_station.parent().effect('highlight', {'color':'lightgreen'}, 1000);
		      
		      if (station_id != 0) {
		      	createSummaryButton($neighbour_td, id)
		      } else {
		      	removeSummaryButton($neighbour_td)
		      }
		  },
		  error: function(err){
	          $('.gear-load').remove();
		      $select_station.parent().effect('highlight', {'color':'lightcoral'}, 1000);
		  }
		});

		$select_station.after(gear_loader_img)
	})

	//recreate the button
	function createSummaryButton(el, id) {
		removeSummaryButton(el)
		el.append(createSummaryButtonEl(id))
	}

	// remove the button
	function removeSummaryButton (el) {
		el.empty();
	}

	function createSummaryButtonEl(id){
		return `<a class="btn btn-sm btn-info" 
		href="`+ base_url + `cms/devices/summary/`+id+`">
		<i class="fa fa-book"></i>
		 Device Summary</a>`
	}
});