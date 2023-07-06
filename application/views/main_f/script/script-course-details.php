
<script>

  //before submitted
$('#myform').submit(function(event) {
  event.preventDefault(); //this will prevent the default submit
  // your code here (But not asynchronous code such as Ajax because it does not wait for a response and move to the next line.)
  if(getsessionlogin() == true) {
    $(this).unbind('submit').submit(); // continue the submit unbind preventDefault
  }
});

$('#subscribemodal').on('show.bs.modal', function (e) {
  //getsessionlogin();
});

function getsessionlogin() {
  var studentID = "<?php echo $this->session->userdata('session_student'); ?>";
  if(studentID.length === 0) {
    window.location.href = "<?=base_url('/main/signin');?>";
    return false;
  } else {
    return true;
  }
}
</script>
