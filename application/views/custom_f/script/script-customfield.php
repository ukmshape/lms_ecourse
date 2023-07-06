
<script>
jQuery(window).load(function () {
    $('.bootstrap-select').remove();
    $('select').removeClass('bs-select-hidden');

});
</script>

<script>

var arrayTitle = <?php echo $titleVal; ?>;
var values = true;

if(arrayTitle.length > 0) {

  $('#txt_shortname').on('change', function() {
    var shortname = $(this).val();
    var arrayTitle = <?php echo $titleVal; ?>;
    var ifshortname = "";
    values = true;

    for (i = 0; i < arrayTitle.length; ++i) {
      if(shortname == arrayTitle[i]) {
        $('.invalid-feedback').text('Shortname already Exists');
        $(this).addClass('is-invalid');
        values = false;
      }
    }


    if(shortname == 'txt_kpkini' || shortname == 'txt_name' || shortname == 'txt_alamat1' || shortname == 'txt_alamat2' || shortname == 'txt_alamat3' || shortname == 'txt_city' || shortname == 'txt_state' || shortname == 'txt_poscode' || shortname == 'txt_country' || shortname == 'txt_tel' || shortname == 'txt_emel' || shortname == 'txt_academic' || shortname == 'txt_nmacademic' || shortname == 'txt_academicfile' || shortname == 'txt_submit' || shortname == 'txt_sponsor' || shortname == 'txt_unitprice' || shortname == 'txt_ansuran' || shortname == 'txt_deposit' || shortname == 'txt_cmpynm' || shortname == 'txt_cmpytel' || shortname == 'txt_cmpyemail' || shortname == 'txt_label' || shortname == 'txt_shortname' || shortname == 'txt_value' || shortname == 'txt_required' || shortname == 'txt_show' || shortname == 'custom_id') {
      $('.invalid-feedback').text('Shortname already Exists');
      $(this).addClass('is-invalid');
      values = false;
    } else if(shortname.indexOf(' ') >= 0) {
      $('.invalid-feedback').text('Must be unique, not contain space.');
      $(this).addClass('is-invalid');
      values = false;
    }


    if(values) {
      $(this).removeClass('is-invalid');
    }

  });

}

$(document).ready(function() {
  //option A
  $("#form_addfield").submit(function(e){
    // do your validation here ...
    if (values == false) {
      e.preventDefault();
    }
  });
});

</script>
