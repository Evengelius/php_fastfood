/**
 * Created by admin on 11/04/2017.
 */

// JavaScript Validation For Login Modal

$('document').ready(function()
{

    // Letter only
    var lettersonlyWithSpace = /^[a-zA-Z\s]*$/i;

    $.validator.addMethod("lettersonlyWithSpace", function( value, element ) {
        return this.optional( element ) // We check if it is optional or not (required or not).
            || lettersonlyWithSpace.test( value ); // If it is required, we check it contains the pattern from the variable : lettersonlyWithSpace
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

    // only_digit
    var only_digit = /^-?[0-9]+$/;

    $.validator.addMethod("only_digit", function( value, element ) {
        return this.optional( element ) // We check if it is optional or not (required or not).
            || only_digit.test( value ); // If it is required, we check it contains the pattern from the variable : only_digit
    });

    $("#login-form").validate({

        rules:
            {
                username: {
                    required: true,
                    lettersonlyWithSpace: true, // from the method
                    nowhitespace: true, // from the method
                    minlength: 2
                },
                password: {
                    required: true,
                    strongPassword: true,
                    minlength: 3,
                    maxlength: 15
                },
                valid_result: {
                    required: true,
                    nowhitespace: true, // from the method
                    only_digit: true // from the method
                }
            },
        messages:
            {
                username : {
                    required: "<em class='aligned-error'>Required field.</em>",
                    nowhitespace: "<em class='aligned-error'>White space is forbidden.</em>",
                    lettersonlyWithSpace: "<em class='aligned-error'>Only letters.</em>",
                    minlength: jQuery.validator.format("<em class='aligned-error'>Please, at least {0} characters are necessary.</em>")
                },
                password:{
                    required: "<em class='aligned-error'>Required field.</em>",
                    strongPassword: "<em class='aligned-error'>At least one digit and one letter.</em>",
                    minlength: jQuery.validator.format("<em class='aligned-error'>Please, at least {0} characters are necessary.</em>")
                },
                valid_result:{
                    required: "<em class='aligned-error'>Required field.</em>",
                    nowhitespace: "<em class='aligned-error'>White space is forbidden.</em>",
                    only_digit: "<em class='aligned-error'>Only digits.</em>"
                }
            },
        errorPlacement : function(error, element) {
            $(element).closest('.md-form').find('.help-block').html(error.html());
            // Display error inside the id #error from the login form. => error.html, close to the class help-block
        },
        highlight : function(element) {
            $(element).closest('.md-form').removeClass('has-success').addClass('has-error');
        },
        /*
         highlight is used for controlling what happens when a message is supposed
         to appear next to an input.
         In this case : remove class has-success from css bootstrap and add class has-error, on the form-group class.
         */
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.md-form').removeClass('has-error');
            $(element).closest('.md-form').find('.help-block').html('');
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
            url: 'actions/ajax/login.php',
            type: 'POST',
            data: $('#login-form').serialize(), // Data  are persist and contain in "data"
            dataType: 'json'
        })
            .done(function(data){

                $('#btn-signin').html('<img src="img/loader/ajax-loader.gif" /> &nbsp; signing in...').prop('disabled', true);
                // Loading gif.
                $('input[type=text],input[type=password]').prop('disabled', true);
                // Disable the input text and password

                setTimeout(function(){

                    if ( data.status==='success' ) {

                        $('#login_result').slideDown('fast', function(){
                            $('#login_result').html('<div class="alert alert-info">'+data.message+'</div>');
                            // Show the $response['message'] from the actions/ajax/login.php file.
                            $("#login-form").trigger('reset');
                            // Reset the form
                            $('input[type=text],input[type=password]').prop('disabled', false);
                            // Enable the input text, email, password
                            $('#btn-signin').html('Submit').prop('disabled', false);
                        }).delay(3000).slideUp('fast');
                        // Hide the Show the $response['message'] after 3 secondes.
                        window.setTimeout(function(){location.reload()},4500);
                        // Reload page after 4.5 seconds.

                    } else {

                        $('#login_result').slideDown('fast', function(){
                            $('#login_result').html('<div class="alert alert-info">'+data.message+'</div>');
                            // Show the $response['message'] from the login.php file.
                            $("#login-form").trigger('reset');
                            // Reset the form
                            $('input[type=text],input[type=password]').prop('disabled', false);
                            // Enable the input text, email, password
                            $('#btn-signin').html('Submit').prop('disabled', false);
                        }).delay(3000).slideUp('fast');
                        // Hide the Show the $response['message'] after 3 secondes.
                    }

                },3000);

            })
            .fail(function(){
                $("#login-form").trigger('reset');
                alert('An unknown error occoured, Please try again Later...');
            });
    }
});

