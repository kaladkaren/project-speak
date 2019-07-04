$(document).ready(function() {
	$('.select-station').on('change', function(){
		let $select_station = $(this);
		let id = $select_station.data('id')
		let station_id = $select_station.val();

		$.ajax({
		  url: base_url + 'cms/stations/assign',
		  type: 'POST',
		  data: {id:id, station_id:station_id},
		  success: function (result, textStatus, xhr) {
		      $('.gear-load').remove();
		      $select_station.parent().effect('highlight', {'color':'lightgreen'}, 1000);
		  },
		  error: function(err){
	          $('.gear-load').remove();
		      $select_station.parent().effect('highlight', {'color':'lightcoral'}, 1000);
		  }
		});

		$select_station.after(gear_loader_img)
	})
});