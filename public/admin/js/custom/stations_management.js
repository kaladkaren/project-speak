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

    $('input[name=station_name]').attr('required', 'required') 

    $('form').attr('action', base_url + 'cms/stations/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    if (confirm("Are you sure you want to delete this?")) {
      const id = $(this).data('id')

      invokeForm(base_url + 'cms/stations/delete', {id: id});
    }
  })


})
