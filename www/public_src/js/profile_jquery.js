$(document).ready(function(){

    /* When clicking the edit button switch to input */
    $(".edit").click(function(){
        var $span = $(this).siblings("span.info-disp");
        $span.hide().siblings("input").val($span.text()).show();
    });

    /* Switch back to span when we click outside the input */
    $("input").on("blur", function(){
        var $this = $(this);
        var text_of_span = $this.siblings("span.info-disp").text();

        /* Do an ajax call to update the db */
        var key = $this.attr('class');
        var value = $this.val();
        $.ajax({
                url: "./update_handler.php",
                type: "POST",
                data: { [key] : value }
        })
        .done(function(data, textStatus, jqXHR){
            /* Check the response */
            if(data != "OK") {
                /* In case of an error alert the user */
                alert("Κατι πηγε στραβα, επικοινωνιστε με DIT-IKA-TEAM");
            } else {
                /* Else change the text of span to the new value */
                text_of_span = $this.val();
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            /* In case of failure give an error */
            alert( "Κατι πηγε στραβα, επικοινωνιστε με DIT-IKA-TEAM.\nRequest failed: " + textStatus );
        })
        .always(function() {
            /* Alwasy hide the input and put the span elemnent back */
            $this.hide().siblings("span.info-disp").text(text_of_span).show();
        });
    });
});
