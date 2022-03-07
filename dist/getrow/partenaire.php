<script>
    function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/partenaire_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.partenaire').val(response.id_partenaire);
      $('#edit_partenaire').val(response.partenaire);
      $('#edit_email').val(response.email_partenaire);
      $('.fullname').html(response.partenaire);
    }
  });
}
</script>