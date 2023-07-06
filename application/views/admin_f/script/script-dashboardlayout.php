<script>
/*
$(document).ready(function(){

 function load_unseen_notification(view = '')
 {

  $.ajax({
   url: "<?php echo base_url('/');?>ajax/fetch",
   method: "POST",
   data: { view:view },
   dataType: "json",
   success: function(data)
   {
     console.log('in');
    $('.notification-menu').html(data.notification);
    if(data.unseen_notification > 0) {
      $('.count').css('display', 'block');
      $('.count').html(data.unseen_notification);
    } else {
      $('.count').css('display', 'none');
    }

   }
  });

 }

 load_unseen_notification();

 setInterval(function(){
  load_unseen_notification();;
 }, 5000);

});
*/
</script>
