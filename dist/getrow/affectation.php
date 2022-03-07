<script>
    function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/affectation_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.affectation').val(response.id_etape);
      $('.fullname').html(response.titre);
    }
  });
}

</script>
