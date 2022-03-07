<script>
    function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/employe_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.employe').val(response.id_agent);
      $('#edit_nom').val(response.nom_agent);
      $('#edit_postnom').val(response.postnom_agent);
      $('#edit_prenom').val(response.prenom_agent);
      $('#edit_adresse').val(response.adresse_agent);
      $('#edit_mail').val(response.email_agent);
      $('.fullname').html(response.nom_agent+' '+response.postnom_agent+' '+response.prenom_agent);
    }
  });
}
</script>