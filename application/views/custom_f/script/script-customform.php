
<script>
// script custom/detail_custom
$('#txt_installment2').on('click', function() { //no
  $('input[name="txt_deposit"]').attr('disabled', true);
  $('input[name="txt_ins1"]').attr('disabled', true);
  $('input[name="txt_ins2"]').attr('disabled', true);
  $('input[name="txt_ins3"]').attr('disabled', true);
});

$('#txt_installment1').on('click', function() { //yes
  $('input[name="txt_deposit"]').attr('disabled', false);
  $('input[name="txt_ins1"]').attr('disabled', false);
  $('input[name="txt_ins2"]').attr('disabled', false);
  $('input[name="txt_ins3"]').attr('disabled', false);
});

var arrayCustom = <?php echo $jqcustom_field; ?>

$('#item-add').on('change', 'select[id="txt_label"]', function () {
    var row = $(this).closest('tr');
    var id = '';
    $('td', row).each(function() {
        id = $(this).find('select[id="txt_label"]').val();

        for (i = 0; i < arrayCustom.length; ++i) {
          if(arrayCustom[i]['custom_id'] == id) {
            $(this).find('#txt_form_id').val('');
            $(this).find('#txt_type').val(arrayCustom[i]['type']);
            $(this).find('#txt_shortname').val(arrayCustom[i]['shortname']);
            $(this).find('#txt_value').val(arrayCustom[i]['value']);
            $(this).find('#txt_required').val(arrayCustom[i]['required']);
            $(this).find('#txt_show').val(arrayCustom[i]['show_field']);

          } else if(id == '') {
            $(this).find('#txt_type').val('');
            $(this).find('#txt_shortname').val('');
            $(this).find('#txt_value').val('');
            $(this).find('#txt_required').val('');
            $(this).find('#txt_show').val('');
          }
          //console.log(arrayCustom[i]);
        }


    });
});


</script>

<script>
jQuery(window).load(function () {
    $('.bootstrap-select').remove();
    $('select').removeClass('bs-select-hidden');

});
</script>

<script>
// Pricing add
	function newMenuItem() {
		var newElem = $('tr.list-item').first().clone();
    newElem.find('select[id="txt_label"] option:selected').removeAttr("selected");
		newElem.find('input').val('');
		newElem.appendTo('table#item-add');

    countOrderby();
	}
	if ($("table#item-add").is('*')) {
		$('.add-item').on('click', function (e) {
			e.preventDefault();
			newMenuItem();
		});
		$(document).on("click", "#item-add .delete", function (e) {
			e.preventDefault();
      $.when($(this).parent().parent().parent().parent().parent().remove()).then(countOrderby());
		});
	}

  function countOrderby() {
    var row = $('tr.list-item').closest('tr');
    var count = 0;
    $('td', row).each(function() {
      $(this).find('select[id="txt_order"] option').remove();
      for(var i = 1; i <= row.length; i++) {
        $(this).find('select[id="txt_order"]').append("<option value='"+i+"'>"+i+"</option>");
      }
      $(this).find('select[id="txt_order"]').val(++count);
    });
  }
</script>
