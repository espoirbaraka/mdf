<script>
    function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/validation_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.validation').val(response.id_projet);
      $('.fullname').html(response.titre+' de '+response.bailleur);
    }
  });
}
</script>