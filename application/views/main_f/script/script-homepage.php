<script>

$(".cours-search").submit(function(e) {
  e.preventDefault();
  var search = $('#search').val();
  window.location.href = "<?=base_url('/main/index/');?>"+search;
});

</script>
