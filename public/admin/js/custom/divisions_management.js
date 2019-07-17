$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=division_name]').removeAttr('required')
    $('input[name=division_name]').val(payload.division_name)

    $('form').attr('action', base_url + 'cms/divisions/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=division_name]').attr('required', 'required') 

    $('form').attr('action', base_url + 'cms/divisions/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    if (confirm("Are you sure you want to delete this?")) {
      const id = $(this).data('id')

      invokeForm(base_url + 'cms/divisions/delete', {id: id});
    }
  })


})
