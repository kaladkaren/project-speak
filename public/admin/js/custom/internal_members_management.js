$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=full_name]').removeAttr('required')
    $('input[name=full_name]').val(payload.full_name)

    $('select[name=division_id]').removeAttr('required')
    $('select[name=division_id]').val(payload.division_id).change()

    $('form').attr('action', base_url + 'cms/internal_members/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=full_name]').attr('required', 'required') 
    $('select[name=division_id]').attr('required', 'required') 

    $('form').attr('action', base_url + 'cms/internal_members/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    if (confirm("Are you sure you want to delete this?")) {
      const id = $(this).data('id')

      invokeForm(base_url + 'cms/internal_members/delete', {id: id});
    }
  })


})
