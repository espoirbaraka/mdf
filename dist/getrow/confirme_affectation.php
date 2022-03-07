<script>
    function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/confrime_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.confirme').val(response.id_affectation);
    }
  });
}
</script>
<script>
  function getRow2(id){
  $.ajax({
    type: 'POST',
    url: 'operation/projet_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.projet').val(response.id_projet);
      $('.fullname').html(response.titre);
    }
  });
}
</script>