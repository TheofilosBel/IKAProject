$(document).ready(function(){

    /* When clicking the edit button switch to input */
    $(".edit").click(function(){
        var $span = $(this).siblings("span.info-disp");
        $span.hide().siblings("input").val($span.text()).show();
    });

    /* Switch back to span when we click outside the input */
    $("input").on("blur", function(){
        var $this = $(this);
        $this.hide().siblings("span.info-disp").text($this.val()).show();
    });

    /* Do an ajax call */


});
