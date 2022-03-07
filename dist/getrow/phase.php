<script>
    function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/phase_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.phase').val(response.id_phase);
      $('#edit_phase').val(response.designation_phase);
      $('.fullname').html(response.designation_phase);
    }
  });
}
</script>