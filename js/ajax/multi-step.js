/**
 * Created by admin on 20/05/2017.
 */
$(document).ready(function() {
    if ($('#register-form').find('input[name="current_form_step"]').length == 0) {
        $('#register-form').prepend('<input type="hidden" name="current_form_step" value="1"/>');
       /*
        * If the current_step_step input is empty,
        * We set its value to 1 as an hidden field,
        * And put it first to append first in the form
        */
    }
    const current = $('#register-form').find('input[name="current_form_step"]').val();
    /*
     * The variable current contains the current_form_step with the value 1,
     */
    widget = $(".step");
    btnnext = $(".next");
    btnback = $(".back");
    btnsubmit = $(".submit");

    // Init buttons and UI
    widget.not(':eq(0)').hide();
    /*
     * Cache les "steps" dont l'indice ne vaut pas "0"
     * Soit, il affichera que le premier "step" => Firstname et Lastname
     */
    hideButtons(current);
    setProgress(current);

    // Next button click action
    btnnext.click(function() {
        let current = $('#register-form').find('input[name="current_form_step"]').val();
        if (current < widget.length) {
            // Check validation
            if ($("#register-form").valid()) {
                widget.show();
                widget.not(':eq(' + (current++) + ')').hide();
                setProgress(current);
                $('#register-form').find('input[name="current_form_step"]').val(current);
                /*
                 * The current_form_step set to 1 is increased by 1,
                 * Each time the button next is clicked.
                 * So even if we close the modal and open it again, the iteration,
                 * Will be reset to 1.
                 */
            }
        }
        hideButtons(current);
    });

    // Back button click action
    btnback.click(function() {
        let current = $('#register-form').find('input[name="current_form_step"]').val();
        if (current > 1) {
            current = current - 2;
            if (current < widget.length) {
                widget.show();
                widget.not(':eq(' + (current++) + ')').hide();
                setProgress(current);
                $('#register-form').find('input[name="current_form_step"]').val(current);
            }
        }
        hideButtons(current);
    })

});

// Change progress bar action
setProgress = function(currstep) {
    let percent = parseFloat(100 / widget.length) * currstep;
    /*
     * 100/TheNumberOfWidget * TheCurrentOne
     * If we remove the current one (currstep), the progress bar won't increase.
     */
    percent = percent.toFixed();
    $(".progress-bar").css("width", percent + "%").html(percent + "%");
    // Simply show % in the progress-bar class.
};

// Hide buttons according to the current step
hideButtons = function(current) {
    const limit = parseInt(widget.length);
    /*
     * limit = The number of the widget, and it is a integer value.
     */

    $(".action").hide();
    // Hide the buttons

    if (current < limit) btnnext.show();
    /*
     * If there is at least one widget after the current one :
     * it will show next
     */
    if (current > 1) btnback.show();
    /*
     * If there is at least one widget before the current one :
     * it will show back
     */
    if (current === limit) {
        // Show entered values when we reached to the last widget form.
        $(".display label:not(.control-label)").each(function() {
            console.log($(this).parent().find("label:not(.control-label)").html($("#" + $(this).data("id")).val()));
        });
        btnnext.hide();
        btnsubmit.show();
    }
};