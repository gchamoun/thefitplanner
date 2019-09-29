<div class="container">
  <br/>



  <div class="col-md-4">

  <form method="post"  id="multiple_select_form">


    <select name="framework" id="framework" class="custom form-control selectpicker " data-live-search="true" multiple data-selected-text-format="count">
      <option value="Abs">Abs</option>
      <option value="Back">Back</option>
      <option value="Biceps">Biceps</option>
      <option value="Chest">Chest</option>
      <option value="Legs">Legs</option>
      <option value="Shoulders">Shoulders</option>
      <option value="Triceps">Triceps</option>
    </select>
    <br />    <br />
    <input type="hidden" name="hidden_framework" id="hidden_framework"/>
    <input type="submit" name="submit" class="btn btn-info"
    value="Submit"/>


  </form>
  <br/>
</br>
</div></div>

  </body>
</html>
<script>
$(document).ready(function(){
  $('.selectpicker').selectpicker();
  $('#framework').change(function(){
    $('#hidden_framework').val($('#framework').val());

  });
  $('#multiple_select_form').on('submit',function(event){
    event.preventDefault();
    if($('#framework').val()!='')
    {
      var form_data = $(this).serialize();
      $.ajax({
          url:"insertBodyPart",
          method:"POST",
          data:form_data,
          success:function(data)
          {

            $('#hidden_framework').val('');
            $('.selectpicker').selectpicker('val','');
            location.href = "/"
          }
      })
    }
    else{
      alert("Please select body part(s)");
      return false;
    }
});
});

</script>
