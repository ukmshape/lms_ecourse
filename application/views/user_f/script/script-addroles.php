
<script>
jQuery(window).load(function () {
    $('.bootstrap-select').remove();
    $('select').removeClass('bs-select-hidden');

});
</script>

<script>

  var userData = [];

	$('#txt_faculty').on('change', function () {
    var faculty = $(this).val();

    $.ajax({
        type: 'post',
        url: '<?=base_url("/user/ajax_getuserbyfaculty");?>',
        data: {
          faculty: faculty
        },
        dataType: 'json',
        success: function (data) {
          $('#txt_fullname option').remove();
          $('#txt_fullname').append("<option value=''>Select</option>");
          if(data) {
            userData = new Array(data);
            $.each(data, function(key, value) {
              $('#txt_fullname').append("<option value='"+value.id+"'>"+value.fullname+"</option>");
            });
          }
        }
    });
  });

  $('.usertype').on('change', function() {

  });

</script>
