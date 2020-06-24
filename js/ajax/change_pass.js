/**
 * Created by admin on 12/04/2017.
 */

// JavaScript Validation For Login Modal

$('document').ready(function()
{

    // Letter only
    var lettersonly = /^[a-z]+$/i;

    $.validator.addMethod("lettersonly", function( value, element ) {
        return this.optional( element ) // We check if it is optional or not (required or not).
            || lettersonly.test( value ); // If it is required, we check it contains the pattern from the variable : nameregex
    });

    // No white space
    var nospace_regex = /^\S+$/;
    $.validator.addMethod( "nowhitespace", function( value, element ) {
        return this.optional( element )
            || nospace_regex.test( value );
    });

    // strong password
    var at_least_one_digit = /\d/;
    var at_least_one_char = /[a-zA-Z]/; //lower or uppercase
    $.validator.addMethod( "strongPassword", function( value, element ) {
        return this.optional( element )
            || at_least_one_digit.test( value )
            && at_least_one_char.test( value );

    });

    $("#change_pass").validate({

        rules:
            {
                old_password: {
                    required: true,
                    strongPassword: true,
                    minlength: 3,
                    maxlength: 15
                },
                new_password: {
                    required: true,
                    strongPassword: true,
                    minlength: 3,
                    maxlength: 15
                },
                con_newpassword: {
                    required: true,
                    equalTo: '#new_password'
                }
            },
        messages:
            {
                old_password:{
                    required: "<em>Required field.</em>",
                    strongPassword: "<em>At least one digit and one letter.</em>",
                    minlength: jQuery.validator.format("<em>Please, at least {0} characters are necessary.</em>")
                },
                new_password:{
                    required: "<em>Required field.</em>",
                    strongPassword: "<em>At least one digit and one letter.</em>",
                    minlength: jQuery.validator.format("<em class='aligned-error'>Please, at least {0} characters are necessary.</em>")
                },
                con_newpassword:{
                    required: "<em>Retype your password.</em>",
                    equalTo: "<em>Password does not match !</em>"
                }
            },
        errorPlacement : function(error, element) {
            $(element).closest('.md-form-password').find('.help-block').html(error.html());
            // Display error inside the id #error from the login form. => error.html, close to the class help-block
        },
        highlight : function(element) {
            $(element).closest('.md-form-password').removeClass('has-success').addClass('has-error');
        },
        /*
         highlight is used for controlling what happens when a message is supposed
         to appear next to an input.
         In this case : remove class has-success from css bootstrap and add class has-error, on the form-group class.
         */
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.md-form-password').removeClass('has-error');
            $(element).closest('.md-form-password').find('.help-block').html('');
        },
        submitHandler: submitForm
        // submitHandler => Required for validate() => check that all fields are fully working with validate() then submit the form.
    });

    /*
     unhighlight is used for controlling what happens when a message is supposed
     to appear next to an input.
     In this case : remove class has-error from css bootstrap and fill the help-block class with nothing inside.
     */

    function submitForm(){

        $.ajax({
            url: 'actions/ajax/change_pass.php',
            type: 'POST',
            data: $('#change_pass').serialize(), // Data  are persist and contain in "data"
            dataType: 'json'
        })
            .done(function(data){

                $('#btn-change_pass').html('<img src="img/loader/ajax-loader.gif" /> &nbsp; disconnecting...').prop('disabled', true);
                // Loading gif.
                $('input[type=password]').prop('disabled', true);
                // Disable the input text and password

                setTimeout(function(){

                    if ( data.status==='success' ) {

                        $.get("actions/ajax/login.php");
                        window.setTimeout(function() {
                            window.location = "index.php?page=home";
                        },2000);
                        return false;
                    } else {

                        $('.error_change_pass').slideDown('fast', function(){
                            $('.error_change_pass').html('<div class="alert alert-info">'+data.message+'</div>');
                            // Show the $response['message'] from the actions/ajax/login.php file.
                            $("#change_pass").trigger('reset');
                            // Reset the form
                            $('input[type=password]').prop('disabled', false);
                            // Enable the input text, email, password
                            $('#btn-change_pass').html('Submit').prop('disabled', false);
                        }).delay(2000).slideUp('fast');
                        // Hide the Show the $response['message'] after 10 secondes.
                    }

                },3000);

            })
            .fail(function(){
                $("#change_pass").trigger('reset');
                alert('An unknown error occoured, Please try again Later...');
            });
    }
});