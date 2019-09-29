<?php if (empty($workouts)):?>
  <div class="container">
<?php else: foreach ($workouts as $workout):
?>

<script>
var newYork    = moment.tz("2014-06-01 12:00", "America/New_York");
var losAngeles = newYork.clone().tz("America/Los_Angeles");
var london     = newYork.clone().tz("Europe/London");

newYork.format();    // 2014-06-01T12:00:00-04:00
losAngeles.format(); // 2014-06-01T09:00:00-07:00
london.format();     // 2014-06-01T17:00:00+01:00

</script>

<?php
$datetime1 = new DateTime($workout->date);
$datetime2 = new DateTime(date("Y/m/d"));
$dateString= (string) $datetime1->format('m/d/Y g:i:s a') ;
// 6/29/2011 4:52:48 PM
$interval = $datetime1->diff($datetime2);
$daysFrom = (int)$interval->format('%a');
if ($daysFrom == 0) {
    $dateText = "Today";
} else {
    $dateText = $workout->date;
}
?>


</br>
<div class="container">
  <div class="row">
    <div class="col-sm">

      <div class="card" style="margin-bottom:15px;">
        <div class="card-body">
          <h5 class="card-title"><?php echo  $workout->body_parts ?></h5>
          <h6 class="card-subtitle mb-2 text-muted"><?php echo $dateText ?> at <?php echo date('h:m', strtotime($workout->date)); ?></h6>
            <a href="workouts/addlifts/<?php echo  $workout->id ?>">Add/View Lifts |</a>
          <a href="workouts/deleteWorkout/<?php echo  $workout->id ?>" class="card-link">Delete</a>
        </div>
      </div>

  </div>
  <script type="text/javascript">
  var zone = new Date().toLocaleTimeString('en-us',{timeZoneName:'short'}).split(' ')[2]
  console.log(zone)
  // var date = new Date('6/29/2011 4:52:48 PM ' + zone);
  var date = new Date('<?php echo $dateString ?>' + ' ' + zone);
  var newDate = date.toString(); // "Wed Jun 29 2011 09:52:48 GMT-0700 (PDT)"
  console.log(newDate);


  </script>
<?php
endforeach;
endif;
?>




<a href="workouts/add"  class="btn btn-primary btn-lg btn-block">Add workout</a>

</div>
