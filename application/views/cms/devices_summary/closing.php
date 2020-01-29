
            </div>
             
          </div>
       <!-- cont -->

</section>
	  </div>
	</div>


  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 comments-o="modal-title">Details</h4>
        </div>
        <div class="modal-body">

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Details</th>
                <th>Scope</th>
                <th>Rating</th>
                <th>Comment<br><sub>(<span style="font-size:12px;font-weight:bold;color:#4f64f9">Suggestion</span> |
                  <span style="font-size:12px;font-weight:bold;color:#09ce09">Compliment</span>)</sub></th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>

          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- modal -->

    <!-- page end-->
  </section>
</section>
<!--main content end-->

<script type="text/javascript">
  $(document).ready(function() {
    $('.comment-btn').on('click', function(){ 
        $('.modal tbody').empty(); //initialize tbody

        let stringy = '';
        let comment_data = $(this).data('comments')

        for(let i = 0; i < comment_data.length; i++) {
          stringy += `<tr>`
          stringy += `<td>`+comment_data[i].name+`</td>`
          stringy += `<td>`+comment_data[i].other_rateable_name+`</td>`
          stringy += `<td>`+comment_data[i].scope+`</td>`
          stringy += `<td>`+comment_data[i].rating+` ⭐</td>`
          if (comment_data[i].comment_type == 'compliment') {
            stringy += `<td><span style="color:#09ce09">`+comment_data[i].comment+`</span></td>`
          } else {
            stringy += `<td><span style="color:#4f64f9">`+comment_data[i].comment+`</span></td>`
          }
          stringy += `</tr>`
        }

        $('.modal tbody').html(stringy)
        $('.modal').modal()
    })
  });
</script>
