
<script>

	function passwordChecking() {
		var password = $('#txt_newpass').val();
		var confirmpassword = $('#txt_repass').val();
		if(confirmpassword != '') {
			if(password == confirmpassword) {
				$('#passwordhelp').css('display', 'none');
			} else {
				$('#passwordhelp').css('display', 'block');
			}
		}
	}

</script>
