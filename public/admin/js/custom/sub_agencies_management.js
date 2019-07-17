$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=agency_name]').removeAttr('required')
    $('input[name=agency_name]').val(payload.agency_name)

    $('select[name=department_id]').removeAttr('required')
    $('select[name=department_id]').val(payload.department_id).change()

    $('form').attr('action', base_url + 'cms/sub_agencies/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=agency_name]').attr('required', 'required') 
    $('select[name=department_id]').attr('required', 'required') 

    $('form').attr('action', base_url + 'cms/sub_agencies/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    if (confirm("Are you sure you want to delete this?")) {
      const id = $(this).data('id')

      invokeForm(base_url + 'cms/sub_agencies/delete', {id: id});
    }
  })


})
