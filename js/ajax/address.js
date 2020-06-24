/**
 * Created by admin on 12/04/2017.
 */

// JavaScript Validation For Adding Billing Address

$('document').ready(function()
{


    // digitAndletter
    var at_least_one_digit = /\d/;
    var at_least_one_char = /[a-zA-Z]/; //lower or uppercase
    $.validator.addMethod( "digitAndletter", function( value, element ) {
        return this.optional( element )
            || at_least_one_digit.test( value )
            && at_least_one_char.test( value );

    });

    // No white space
    var nospace_regex = /^\S+$/;
    $.validator.addMethod( "nowhitespace", function( value, element ) {
        return this.optional( element )
            || nospace_regex.test( value );
    });


    // Letter only
    var lettersonlyWithSpace = /^[a-zA-Z\s]*$/i;

    $.validator.addMethod("lettersonlyWithSpace", function( value, element ) {
        return this.optional( element ) // We check if it is optional or not (required or not).
            || lettersonlyWithSpace.test( value ); // If it is required, we check it contains the pattern from the variable : lettersonlyWithSpace
    });

    // only_digit
    var only_digit = /^[0-9]+$/;

    $.validator.addMethod("only_digit", function( value, element ) {
        return this.optional( element ) // We check if it is optional or not (required or not).
            || only_digit.test( value ); // If it is required, we check it contains the pattern from the variable : only_digit
    });


    $("#billing_address").validate({

        rules:
            {
                address: {
                    required: true,
                    digitAndletter: true // from the method
                },
                postalCode: {
                    required: true,
                    nowhitespace: true, // from the method
                    only_digit: true, // from the method
                    minlength: 4
                },
                city: {
                    required: true,
                    lettersonlyWithSpace: true // from the method
                }
            },
        messages:
            {
                address : {
                    required: "<em>Required field.</em>",
                    digitAndletter: "<em>At least one digit and one letter. Example : Street n.2</em>"
                },
                postalCode : {
                    required: "<em>Required field.</em>",
                    nowhitespace: "<em>White space is forbidden.</em>",
                    only_digit: "<em>Only digits.</em>",
                    minlength: jQuery.validator.format("<em>Please, at least {0} digits are necessary.</em>")
                },
                city : {
                    required: "<em>Required field.</em>",
                    lettersonlyWithSpace: "<em>Only letters.</em>"
                }
            },
        errorPlacement : function(error, element) {
            $(element).closest('.md-form-address').find('.help-block').html(error.html());
            // Display error inside the id #error from the login form. => error.html, close to the class help-block
        },
        highlight : function(element) {
            $(element).closest('.md-form-address').removeClass('has-success').addClass('has-error');
        },
        /*
         highlight is used for controlling what happens when a message is supposed
         to appear next to an input.
         In this case : remove class has-success from css bootstrap and add class has-error, on the form-group class.
         */
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.md-form-address').removeClass('has-error');
            $(element).closest('.md-form-address').find('.help-block').html('');
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
            url: 'actions/ajax/address.php',
            type: 'POST',
            data: $('#billing_address').serialize(), // Data  are persist and contain in "data"
            dataType: 'json'
        })
            .done(function(data){

                $('#btn-address').html('<img src="img/loader/ajax-loader.gif" /> &nbsp; loading...').prop('disabled', true);
                // Loading gif.
                $('input[type=text],input[type=number]').prop('disabled', true);
                // Disable the input text and number

                setTimeout(function(){

                    if ( data.status==='success' ) {

                        location.reload(true);

                    } else {

                        $('.error_add_address').slideDown('fast', function(){

                            $('.error_add_address').html('<div class="alert alert-info">'+data.message+'</div>');
                            // Show the $response['message'] from the actions/ajax/address.php file.
                            $("#billing_address").trigger('reset');
                            // Reset the form
                            $('input[type=text],input[type=number]').prop('disabled', false);
                            // Enable the input text, number
                            $('#btn-address').html('Submit').prop('disabled', false);
                        }).delay(2000).slideUp('fast');
                        // Hide the Show the $response['message'] after 10 secondes.

                    }

                },3000);

            })
            .fail(function(){
                $("#billing_address").trigger('reset');
                alert('An unknown error occoured, Please try again Later...');
            });
    }
});