$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=name]').removeAttr('required')
    $('input[name=name]').val(payload.name)

    $('textarea[name=description]').removeAttr('required')
    $('textarea[name=description]').val(payload.description)

    $('input[name=image_file]').removeAttr('required')
    $('.modal-img').attr('src', payload.image_url)
    $('.modal-img').show()

    $('form').attr('action', base_url + 'cms/rateables/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=name]').attr('required', 'required') 
    $('textarea[name=description]').attr('required', 'required') 
    $('input[name=image_file]').attr('required', 'required') 
    $('.modal-img').hide();

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
