</div>
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/datepicker.bundle.js"></script>
<script src="assets/bundles/select2.bundle.js"></script>
<script src="assets/bundles/dropify.bundle.js"></script>
<script src="assets/bundles/summernote.bundle.js"></script>
<script src="assets/bundles/dataTables.bundle.js"></script>


<script src="../js/pages/profile.js"></script>
<script>
$(function(){
	/** add active class and stay opened when selected */
	var url = window.location;
  
	// for sidebar menu entirely but not cover treeview
	$('ul.metismenu li a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('li ul.list-unstyled li').filter(function() {
	    return this.href == url;
	}).parentsUntil(".list-unstyled").addClass('active mm-active');

});
</script>


<!-- page js file -->
<script>
    $(document).ready(function () {
        var extensions = {
            "sFilter": "dataTables_filter custom_filter_class"
        }
        $.extend($.fn.dataTableExt.oStdClasses, extensions);
        $('#project_list').dataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 100]]
        });

        // Tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>




<!-- page js file -->
<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="../js/pages/index2.js"></script>

<script>
    $(document).ready(function () {
        $('#employee_List')
        .dataTable({
            responsive: true,
            columnDefs: [
                {
                    orderable: false,
                    targets: [0]
                }
            ]
        });
    });
</script>
<script>
    
</script>
<script>
$(function(){

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });


  $(document).on('click', '.telephone', function(e){
    e.preventDefault();
    $('#telephone').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.valider', function(e){
    e.preventDefault();
    $('#valider').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.addfile', function(e){
    e.preventDefault();
    $('#addfile').modal('show');
    var id = $(this).data('id');
    getRow2(id);
  });

  $(document).on('click', '.phase', function(e){
    e.preventDefault();
    $('#phase').modal('show');
    var id = $(this).data('id');
    getRow2(id);
  });

  $(document).on('click', '.justification', function(e){
    e.preventDefault();
    $('#justification').modal('show');
    var id = $(this).data('id');
    getRow3(id);
  });

  $(document).on('click', '.continue', function(e){
    e.preventDefault();
    $('#continue').modal('show');
    var id = $(this).data('id');
    getRow4(id);
  });

  $(document).on('click', '.archive', function(e){
    e.preventDefault();
    $('#archive').modal('show');
    var id = $(this).data('id');
    getRow5(id);
  });

});

$('.datepicker input').datepicker();

    $(".select2").select2();

    // Dropify
    $(function () {
        $('.dropify').dropify();

        var drEvent = $('#dropify-event').dropify();
        drEvent.on('dropify.beforeClear', function (event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            alert('File deleted');
        });

        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
    });

    $(document).ready(function() {
        $('.summernote').summernote();
        $('.note-editor .note-btn').on('click',function(){
            $(this).next().toggleClass("show");
        });
    });

    











  <?php
  include("js_graphique/home.php");
  ?>





</script>
</body>
</html>