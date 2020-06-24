// JavaScript Validation For Registration Modal

$('document').ready(function () {

    // Letter only
    var lettersonlyWithSpace = /^[a-zA-Z\s]*$/i;

    $.validator.addMethod("lettersonlyWithSpace", function (value, element) {
        return this.optional(element) // We check if it is optional or not (required or not).
            || lettersonlyWithSpace.test(value); // If it is required, we check it contains the pattern from the variable : lettersonlyWithSpace
    });

    // No white space
    var nospace_regex = /^\S+$/;
    $.validator.addMethod("nowhitespace", function (value, element) {
        return this.optional(element)
            || nospace_regex.test(value);
    });

    // strong password
    var at_least_one_digit = /\d/;
    var at_least_one_char = /[a-zA-Z]/; //lower or uppercase
    $.validator.addMethod("strongPassword", function (value, element) {
        return this.optional(element)
            || at_least_one_digit.test(value)
            && at_least_one_char.test(value);

    });

    // Email pattern
    var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    $.validator.addMethod("validemail", function (value, element) {
        return this.optional(element) // We check if it is optional or not (required or not).
            || eregex.test(value); // If it is required, we check it contains the pattern from the variable : eregex
    });

    // only_digit
    var only_digit = /^-?[0-9]+$/;

    $.validator.addMethod("only_digit", function (value, element) {
        return this.optional(element) // We check if it is optional or not (required or not).
            || only_digit.test(value); // If it is required, we check it contains the pattern from the variable : only_digit
    });

    $("#register-form").validate({

        rules: {
            firstname: {
                required: true,
                lettersonlyWithSpace: true, // from the method
                nowhitespace: true, // from the method
                minlength: 2
            },
            lastname: {
                required: true,
                lettersonlyWithSpace: true, // from the method
                nowhitespace: true, // from the method
                minlength: 2
            },
            username: {
                required: true,
                lettersonlyWithSpace: true, // from the method
                nowhitespace: true, // from the method
                minlength: 5,
                remote: {
                    url: "actions/check-data.php",
                    type: "post",
                    data: {
                        username: function () {
                            return $("#username").val();
                        }
                    }
                }
            },
            email: {
                required: true,
                nowhitespace: true, // from the method
                validemail: true, // from the method
                remote: {
                    url: "actions/check-data.php",
                    type: "post",
                    data: {
                        email: function () {
                            return $("#email").val();
                        }
                    }
                }
            },
            password: {
                required: true,
                strongPassword: true,
                minlength: 3,
                maxlength: 15
            },
            cpassword: {
                required: true,
                equalTo: '#password'
            },
            valid_result: {
                required: true,
                nowhitespace: true, // from the method
                only_digit: true // from the method
            }
        },
        messages: {
            firstname: {
                required: "<em class='aligned-error'>Required field.</em>",
                lettersonlyWithSpace: "<em class='aligned-error'>Only letters.</em>",
                nowhitespace: "<em class='aligned-error'>White space is forbidden.</em>",
                minlength: jQuery.validator.format("<em class='aligned-error'>Please, at least {0} characters are necessary.</em>")
            },
            lastname: {
                required: "<em class='aligned-error'>Required field.</em>",
                lettersonlyWithSpace: "<em class='aligned-error'>Only letters.</em>",
                nowhitespace: "<em class='aligned-error'>White space is forbidden.</em>",
                minlength: jQuery.validator.format("<em class='aligned-error'>Please, at least {0} characters are necessary.</em>")
            },
            username: {
                required: "<em class='aligned-error'>Required field.</em>",
                lettersonlyWithSpace: "<em class='aligned-error'>Only letters.</em>",
                nowhitespace: "<em class='aligned-error'>White space is forbidden.</em>",
                minlength: jQuery.validator.format("<em class='aligned-error'>Please, at least {0} characters are necessary.</em>"),
                remote: "<em class='aligned-error'>This username already exists.</em>"
            },
            email: {
                required: "<em class='aligned-error'>Required field.</em>",
                nowhitespace: "<em class='aligned-error'>White space is forbidden.</em>",
                validemail: "<em class='aligned-error'>Please enter a valid email address.</em>",
                remote: "<em class='aligned-error'>This email already exists.</em>"
            },
            password: {
                required: "<em class='aligned-error'>Required field.</em>",
                strongPassword: "<em class='aligned-error'>At least one digit and one letter.</em>",
                minlength: jQuery.validator.format("<em class='aligned-error'>Please, at least {0} characters are necessary.</em>")
            },
            cpassword: {
                required: "<em class='aligned-error'>Retype your password.</em>",
                equalTo: "<em class='aligned-error'>Password does not match !</em>"
            },
            valid_result: {
                required: "<em class='aligned-error'>Required field.</em>",
                nowhitespace: "<em class='aligned-error'>White space is forbidden.</em>",
                only_digit: "<em class='aligned-error'>Only digits.</em>"
            }
        },
        errorPlacement: function (error, element) {
            $(element).closest('.md-form').find('.help-block').html(error.html());
            // Display error inside the id #error from the register form. => error.html, close to the class help-block
        },
        highlight: function (element) {
            $(element).closest('.md-form').removeClass('has-success').addClass('has-error');
        },
        /*
         highlight is used for controlling what happens when a message is supposed
         to appear next to an input.
         In this case : remove class has-success from css bootstrap and add class has-error, on the form-group class.
         */
        unhighlight: function (element, errorClass, validClass) {
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

    function submitForm() {

        $.ajax({
            url: 'actions/ajax/register.php',
            type: 'POST',
            data: $('#register-form').serialize(), // Data  are persist and contain in "data"
            dataType: 'json'
        })
            .done(function (data) {

                $('#btn-signup').html('<img src="img/loader/ajax-loader.gif" /> &nbsp; signing up...').prop('disabled', true);
                // Loading gif.
                $('input[type=text],input[type=password]').prop('disabled', true);
                // Disable the input text, email and password

                setTimeout(function () {

                    if (data.status === 'success') {

                        $('#register_result').slideDown('fast', function () {
                            $('#register_result').html('<div class="alert alert-info">' + data.message + '</div>');
                            // Show the $response['message'] from the actions/ajax/register.php file.
                            $("#register-form").trigger('reset');
                            // Reset the form
                            $('input[type=text],input[type=password]').prop('disabled', false);
                            // Enable the input text, email, password
                            $('#btn-signup').html('Submit').prop('disabled', false);
                        }).delay(5000).slideUp('fast');
                        // Hide the $response['message'] after 10 secondes.
                        window.setTimeout(function () {
                            location.reload()
                        }, 6500);
                        // Reload page after a certain delay.


                    } else {

                        $('#register_result').slideDown('fast', function () {
                            $('#register_result').html('<div class="alert alert-danger">' + data.message + '</div>');
                            const current = 1;
                            const widget = $(".step");
                            $("#register-form").trigger('reset');
                            widget.show();
                            widget.not(':eq(0)').hide();
                            widget.find('#error').each(function () {
                                $(this).html('');
                            });
                            $('#register-form').find('input[name="current_form_step"]').val(1);
                            setProgress(current);
                            hideButtons(current);
                            $('input[type=text],input[type=password]').prop('disabled', false);
                            $('#btn-signup').html('Submit').prop('disabled', false);
                        }).delay(3000).slideUp('fast');
                    }

                }, 3000);

            })
            .fail(function () {
                alert('An error occured, please contact the admin for further support.');
                const current = 1;
                const widget = $(".step");
                $("#register-form").trigger('reset');
                widget.show();
                widget.not(':eq(0)').hide();
                widget.find('#error').each(function() {
                    $(this).html('');
                });
                $('#register-form').find('input[name="current_form_step"]').val(1);
                setProgress(current);
                hideButtons(current);
            });
    }
});