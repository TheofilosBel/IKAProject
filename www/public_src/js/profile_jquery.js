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
        $span.hide().siblings("input").val($span.text()).show().focus();
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

        /* Check AMKA and AFM before ajax */
        if ((key == 'AMKA') && ((value.length != 11) || !(/^\d+$/.test(value)))) {
            alert("Το ΑΜΚΑ πρέπει να είναι 11 ψηφία")
            $this.hide().siblings("span.info-disp").text(text_of_span).show();
        } else if (key == 'AFM' && ((value.length != 9) || !(/^\d+$/.test(value)))) {
            alert("Το ΑΦΜ πρέπει να είναι 9 ψηφία")
            $this.hide().siblings("span.info-disp").text(text_of_span).show();
        } else if (key == 'telephone' && ((value.length != 10) || !(/^\d+$/.test(value)))) {
            alert("Το τηλέφωνο πρέπει να είναι 10 ψηφία")
            $this.hide().siblings("span.info-disp").text(text_of_span).show();
        }
        else {
            $.ajax({
                    url: "./update_handler.php",
                    type: "POST",
                    data: { [key] : value }
            })
            .done(function(data, textStatus, jqXHR){
                /* Check the response */
                if(data != "OK") {
                    /* In case of an error alert the user */
                    alert("Κάτι πήγε στραβά, επικοινωνήστε με DIT-IKA-TEAM");
                } else {
                    /* Else change the text of span to the new value */
                    text_of_span = $input.val();
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                /* In case of failure give an error */
                alert("Κάτι πήγε στραβά, επικοινωνάστε με DIT-IKA-TEAM.\nRequest failed: " + textStatus );
            })
            .always(function() {
                /* Alwasy hide the input and put the span elemnent back */
                $this.hide().siblings("span.info-disp").text(text_of_span).show();
            });
        }
    });

    /* Switch back to span when we click outside the input */
    $("input").on("blur", function(){
        var $this = $(this);
        var text_of_span = $this.siblings("span.info-disp").text();

        /* Hide all the extra functionality */
        $this.siblings(".save").hide();
        $this.siblings(".edit").hide();

        /* Always hide the input and put the span elemnent back */
        $this.hide().siblings("span.info-disp").text(text_of_span).show();
    });
});
