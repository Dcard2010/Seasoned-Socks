<?php
    set_include_path('phpFiles');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script type="text/javascript">
            
    $("#note-contents").bind('input propertychange', function() {
        $.ajax ({
           method: "POST",
           url: "/phpFiles/update.php",
           data: { content: $("#note-contents").val() }
       })

       .done(function( msg ) {
           alert("Stuff is happening" + msg);
       });

    });
            
</script>