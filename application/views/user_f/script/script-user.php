
<script>
jQuery(window).load(function () {
    $('.bootstrap-select').remove();
    $('select').removeClass('bs-select-hidden');

});
</script>

<script>

	function passwordChecking() {
		var password = $('#txt_password').val();
		var confirmpassword = $('#txt_password_confirm').val();
		if(confirmpassword != '') {
			if(password == confirmpassword) {
				$('#passwordhelp').css('display', 'none');
        $('button[name="btn_signup"]').prop('disabled',false);
			} else {
				$('#passwordhelp').css('display', 'block');
        $('button[name="btn_signup"]').prop('disabled',true);
			}
		}
	}

</script>
