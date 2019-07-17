$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=department_name]').removeAttr('required')
    $('input[name=department_name]').val(payload.department_name)

    $('form').attr('action', base_url + 'cms/departments/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=department_name]').attr('required', 'required') 

    $('form').attr('action', base_url + 'cms/departments/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    if (confirm("Are you sure you want to delete this?")) {
      const id = $(this).data('id')

      invokeForm(base_url + 'cms/departments/delete', {id: id});
    }
  })


})
