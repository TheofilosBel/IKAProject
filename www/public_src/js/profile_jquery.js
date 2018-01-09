$(document).ready(function(){

    /* When hovering */
    $(".info-container").hover(function(){
        if($(this).children(".save").is(":visible") == false){
            $(this).children(".edit").show();
        }
    },
    function(){
        $(this).children(".edit").hide();
    });

    /* When clicking the edit button switch to input */
    $(".edit").click(function(){
        var $span = $(this).siblings("span.info-disp");
        $span.hide().siblings("input").val($span.text()).show();
        $(this).hide().siblings(".save").show();
    });

    /* When clicking .save p send an ajax call to change the data */
    $(".save").mousedown(function(){
        var $this = $(this);
        var text_of_span = $this.siblings("span.info-disp").text();

        /* Hide all the extra functionality */
        $this.siblings(".save").hide();
        $this.siblings(".edit").hide();

        /* Do an ajax call to update the db */
        var $input = $this.siblings("input");
        var key = $input.attr('class');
        var value = $input.val();
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
                text_of_span = $input.val();
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

    /* Switch back to span when we click outside the input */
    $("input").on("blur", function(){
        var $this = $(this);
        var text_of_span = $this.siblings("span.info-disp").text();

        /* Hide all the extra functionality */
        $this.siblings(".save").hide();
        $this.siblings(".edit").hide();

        /* Alwasy hide the input and put the span elemnent back */
        $this.hide().siblings("span.info-disp").text(text_of_span).show();
    });
});
