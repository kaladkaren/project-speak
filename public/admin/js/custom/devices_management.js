$(document).ready(function() {
	$('.select-station').on('change', function(){
		let id = $(this).data('id')
		let station_id = $(this).val();

		$.ajax({
		  url: base_url + 'cms/stations/assign',
		  type: 'POST',
		  data: {id:id, station_id:station_id},
		  success: function (result, textStatus, xhr) {
		    if(xhr.status == 200){
		      alert('Success')
		    }else{
		      alert('Err');
		    }
		  },
		  error: function(err){
		    console.error(err);
		  }
		});
	})
});