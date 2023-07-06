<script>
jQuery(window).load(function () {
    $('.dropdown-toggle[data-id="txt_academic"]').parent().remove();
    //$('.bootstrap-select').remove();
    $('select[id="txt_academic"]').removeClass('bs-select-hidden');

});

$('#txt_sponsor1').on('click', function() {
  $('.sponsor_display').css('display', 'flex');
  $('.own_display').css('display', 'none');
  $('.installment_display').css('display', 'none');
  $('.installment_display2').css('display', 'none');
  $('#txt_ansuran_radio1').prop('required', false);
  $('#txt_ansuran_radio1').attr('checked', false);
  $('#txt_ansuran_radio2').attr('checked', false);
  $('#txt_cmpynm').prop('required',true);
  $('#txt_cmpytel').prop('required',true);
  $('#txt_cmpyemail').prop('required',true);
});

$('#txt_sponsor2').on('click', function() {
  $('.sponsor_display').css('display', 'none');
  $('.own_display').css('display', 'flex');
  $('.installment_display').css('display', 'none');
  $('.installment_display2').css('display', 'none');
  $('#txt_ansuran_radio1').prop('required', true);
  $('#txt_ansuran_radio1').attr('checked', false);
  $('#txt_ansuran_radio2').attr('checked', false);
  $('#txt_cmpynm').prop('required',false);
  $('#txt_cmpytel').prop('required',false);
  $('#txt_cmpyemail').prop('required',false);
});

$('#txt_ansuran_radio1').on('click', function() {
  $('.installment_display').css('display', 'none');
  $('.installment_display2').css('display', 'none');
  $('#txt_ansuran_radio2').attr('checked', false);
  $('.fullpayment').css('display', 'flex');
});

$('#txt_ansuran_radio2').on('click', function() {
  $('.installment_display').css('display', 'table');
  $('.installment_display2').css('display', 'flex');
  $('.fullpayment').css('display', 'none');
});

</script>
