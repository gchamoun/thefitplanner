

</br>

<div class="container">
  <?php if (empty($lifts)):?>

  <?php else:
  foreach ($lifts as $lift):
  ?>

  <div class="card" style="margin-bottom:15px;">
    <div class="card-body">
     <h5 class="card-title"><?php echo  $lift->name ?></h5>
     <p><?php echo  $lift->date ?></p>
     <p><?php echo  $lift->reps ?> reps | <?php echo  $lift->weight ?>lb</p>
     <a href="<?php echo base_url()?>workouts/deletelift/<?php echo  $lift->id ?>" class="card-link">Delete</a>
  </div>
  </div>
  <?php
  endforeach;
  endif;
  ?>
    <form id="lifts-form">
    </br>
  </br>
<div class="row">
    <div class="col">
        <input name="lift" class="form-control" placeholder="Lift name" value="">
    </div>
    <div class="col-3">
        <input name="reps" class="form-control" type="number"  placeholder="reps" value="" id="reps">
        </div>
        <div class="col-3">
          <input name="weight" class="form-control" type="number" placeholder="weight" value="" id="reps">
        </div>
      </div>
    </br>        </br>


<button type="submit" class="btn btn-success">Add Lift <span class="fa fa-arrow-right"></span></button>
<button onclick="myFunction();" type="button" class="btn btn-primary">Done</button>

</form
</div>


<script>

function myFunction() {
  location.replace("<?php echo base_url(); ?>")
}

$(function(){
    $("#lifts-form").submit(function(){
        dataString = $("#lifts-form").serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>workouts/insertLift/<?php echo $workoutID; ?>",
            data: dataString,
            success: function(data){
              if(data != "1"){
                location.reload();
              }
              else {
                alert('Successfully Submitted!');
                location.reload();
              }
            }
        });
        return false;  //stop the actual form post !important!
    });
});



var uri = window.location.toString();
if (uri.indexOf("?") > 0) {
  var clean_uri = uri.substring(0, uri.indexOf("?"));
  window.history.replaceState({}, document.title, clean_uri);
}
    </script>



  </body>

</html>
