$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=station_name]').removeAttr('required')
    $('input[name=station_name]').val(payload.station_name)

    $('form').attr('action', base_url + 'cms/stations/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=name]').attr('required', 'required') 
    $('textarea[name=description]').attr('required', 'required') 
    $('input[name=image_file]').attr('required', 'required') 

    $('form').attr('action', base_url + 'cms/rateables/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    if (confirm("Are you sure you want to delete this?")) {
      const id = $(this).data('id')
      const type = $(this).data('type')

      invokeForm(base_url + 'cms/rateables/delete', {id: id, type: type});
    }
  })


})
