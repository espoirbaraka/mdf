<script>
    function getRow3(id){
  $.ajax({
    type: 'POST',
    url: 'operation/justification_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.justification').val(response.id_projet);
    }
  });
}

</script>
<script>
    function getRow4(id){
  $.ajax({
    type: 'POST',
    url: 'operation/justification_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.continue').val(response.id_projet);
    }
  });
}

</script>
<script>
    function getRow5(id){
  $.ajax({
    type: 'POST',
    url: 'operation/justification_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.archive').val(response.id_projet);
    }
  });
}

</script>
