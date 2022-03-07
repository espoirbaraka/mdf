<script>
    function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/fonction_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.fonction').val(response.id_fonction);
      $('#edit_fonction').val(response.designation_fonction);
      
    }
  });
}
</script>