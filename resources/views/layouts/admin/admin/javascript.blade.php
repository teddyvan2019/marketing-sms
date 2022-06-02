<!-- jQuery -->
<script src="{{ URL::asset('template/admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ URL::asset('template/admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('template/admin/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- datepicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>


<!--  pour les dates -->
 <script>

$(function() {
  $( "#datepicker" ).datepicker({
  altField: "#datepicker",
  closeText: 'Fermer',
  prevText: 'Précédent',
  nextText: 'Suivant',
  currentText: 'Aujourd\'hui',
  monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
  monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
  dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
  dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
  dayNamesMin: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
  weekHeader: 'Sem.',
  dateFormat: 'yy-mm-dd'
  });

  } );
  </script>



 <script>
   $(function() {
    $( "#datepicke" ).datepicker({
    altField: "#datepicke",
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    weekHeader: 'Sem.',
    dateFormat: 'yy-mm-dd'
    });
});
  </script>

<!--  pour selectionner les multiple repertoire -->
<script>
   $(document).ready(function(){
            $(".mul-select").select2({
                    placeholder: "selectionnez un repertoire", //placeholder
                    tags: true,
                    tokenSeparators: ['/',',',';'," "] 
                });
            })
    </script>

<script>
  
  $(document).ready(function() {
    $("#tarea").keyup(function() {
        // Récupérer la valeur actuelle de textarea
        var text = $(this).val();
        // Modifier le contenu de div
       // $(".res").text(text);
    });
});
</script>


<script>
  $(function () {

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "language": {
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"

			}
    });
  });
</script>

<!-- AdminLTE App -->
<script src="{{ URL::asset('template/admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ URL::asset('template/admin/laravel.js') }}"></script> 

<!-- Mes scripts -->
<script src="{{ URL::asset('template/admin/dist/js/script/religion.js') }}"></script> 
<script src="{{ URL::asset('template/admin/dist/js/script/repertoire.js') }}"></script> 
<script src="{{ URL::asset('template/admin/dist/js/script/contact.js') }}"></script> 
<script src="{{ URL::asset('template/admin/dist/js/script/ville.js') }}"></script> 
<script src="{{ URL::asset('template/admin/dist/js/script/genre.js') }}"></script> 
<script src="{{ URL::asset('template/admin/dist/js/script/calendrier_pour_date.js') }}"></script> 
