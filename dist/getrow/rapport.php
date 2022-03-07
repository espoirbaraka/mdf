<script>
    function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/rapport_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.rapport').val(response.id_rapport);
      $('#edit_text').val(response.textInfo);
    }
  });
}
</script>