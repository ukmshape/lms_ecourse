

<!-- change password -->
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

<script>
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
</script>


<!--<script type="text/javascript">
    var table = $('#example').DataTable( {
        //scrollY:        "300px",
        // scrollX:        true,
        // scrollCollapse: true,
        // //paging:         false,
        // bLengthChange : false,
         pageLength: 25,
        // fixedColumns:   {
        //     leftColumns: 1,
        // }

        scrollY:        "410px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2,
        },

        dom: 'Bfrtip',
          buttons: [
            //'colvis',
              //'copy',
              //'csv',
              'excel'
              //'pdf',
              //'print'
          ]
    } );

</script>-->
