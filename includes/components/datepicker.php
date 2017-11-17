<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $( function() {
      $( "#datepicker" ).datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: "-90:+0",
          defaultDate: '01-01-1980',
          dateFormat: 'dd-mm-yy'
      });
  } );
  $( function() {
      $( "#datepicker" ).datepicker();
      $( "#anim" ).on( "change", function() {
          $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
      });
  } );
  </script>
