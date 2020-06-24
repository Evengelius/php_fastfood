/**
 * Created by admin on 23/12/2016.
 */

$(".button-collapse").sideNav();
const el = document.querySelector('.custom-scrollbar');
Ps.initialize(el);
// Initialisation du sideNav.

/* ******************************************************************************* */

/*
 Démarre une animation au scroll (up/down) de la page :
 https://daneden.github.io/animate.css/
 */

new WOW().init();

/* ******************************************************************************* */

// Tooltips Initialization
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

/* ******************************************************************************* */

//Modal register => utile pour l'autofocus sur un input.
$('#modal-register').on('shown.bs.modal', function () {
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
});

// Forbid "enter" key => else it shall send the form
$('#register-form').keypress(function (event) {
    if (event.keyCode === 10 || event.keyCode === 13)
        event.preventDefault();
});

/* ******************************************************************************* */

//Show login modal
$('#modal-login').on('shown.bs.modal', function () {
    $('#myInput').focus()
});

// Reset login modal
$('.modal-login').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
});
/* ******************************************************************************* */

//Edit password | Profile Page
$('#editPassword').click(function () {
    $('#showEditPassword').removeAttr('hidden');
    $('#editPassword').hide();

});

//Add address | Profile Page
$('#addAddress').click(function () {
    $('#showAddAddress').removeAttr('hidden');
    $('#addAddress').hide();
    $('.hideTextAddress').hide();
});

//Edit address | Profile Page
$('#editAddress').click(function () {
    $('#showAddAddress').removeAttr('hidden');
    $('#editAddress').hide();
    $('#edit_address_form').hide();
});


/* ******************************************************************************* */

/*
 Nécessaire pour afficher le select de mdb :
 http://mdbootstrap.com/javascript/material-select/
 */
$(document).ready(function () {
    $('.mdb-select').material_select();
});

/* ******************************************************************************* */

// initialize lightbox
$(function () {
    $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
});

/* ******************************************************************************* */

//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function (e) {
    let qty;
    e.preventDefault();
    fieldName = $(this).attr('data-field');
    type = $(this).attr('data-type');
    const input = $("input[name='" + fieldName + "']");
    const currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if (type === 'minus') {
            if (currentVal > input.attr('min')) {
                qty = currentVal - 1;
            }
            if (parseInt(input.val()) === input.attr('min')) {
                $(this).attr('disabled', true);
            }
        } else if (type === 'plus') {
            if (currentVal < input.attr('max')) {
                qty = currentVal + 1;
            }
            if (parseInt(input.val()) === input.attr('max')) {
                $(this).attr('disabled', true);
            }
        }
    } else {
        qty = 1;
    }

    /* *************************************************************************** */

    // Increment/Decrement product price in product page | Burger
    $.ajax({
        type: 'POST',
        url: 'actions/ajax.php',
        data: {
            action: 'get_burger_price_by_ajax',
            burger_id: $('input[name="idBurger"]').val(),
            qty: qty // We get the quantity from the above script
        },
        dataType: 'json',
        success: function (r) {
            console.log(r);
            if (r['status'] == '1') {
                $('#price-amount').html(r['price']);
                input.val(qty).change();
            } else if (r['status'] == '2') {
                window.location.reload();
            }
        }
    });

    // Increment/Decrement product price in product page | Boisson
    $.ajax({
        type: 'POST',
        url: 'actions/ajax.php',
        data: {
            action: 'get_drink_price_by_ajax',
            drink_id: $('input[name="idDrink"]').val(),
            qty: qty // We get the quantity from the above script
        },
        dataType: 'json',
        success: function (r) {
            console.log(r);
            if (r['status'] == '1') {
                $('#price-amount').html(r['price']);
                input.val(qty).change();
            } else if (r['status'] == '2') {
                window.location.reload();
            }
        }
    });
});

/*
 My personal State  Description (It comes from actions/ajax.php)
 1      The request is sent.
 2      The request is complete.
 */

/* ******************************************************************************* */

/* Add to Card | Burger */
function addToBurgerCart(subject) {
    const idBurger = $('#idBurger').val();
    const quantity = $('#qty').val();

    $.ajax({
        type: "POST",
        url: 'actions/ajax/addToBurgerCart.php',
        data: 'subject='+subject+'&idBurger='+idBurger+'&quantity='+quantity,
        beforeSend: function () {
            if (subject === "cart") {
                $('#cart').html('<img class="email-loading hidden-sm-down" src="img/loader/ajax-loader.gif" /> &nbsp; Adding..').prop('disabled', true);
            }
        },
        success: function (data) {
            window.setTimeout(function () {
                var obj = jQuery.parseJSON(data);
                $('#result_burger').show();
                if (obj['status'] === 'success') {
                    $('#result_burger').slideDown('fast', function () {
                        $('#result_burger').html('<div class="alert alert-info">' + obj['message'] + '</div>');

                        if (subject === "cart") {
                            $('#cart').html('<i class="fa fa-cart-plus" aria-hidden="true"></i><span class="hidden-sm-down">&nbsp;&nbsp;&nbsp;CART</span>').prop('disabled', false);

                            $('#cart_count').html(obj['count']);
                        }

                    }).delay(3000).slideUp('fast');
                } else {

                    $('#result_burger').html('<div class="alert alert-info">' + obj['message'] + '</div>');

                    $('#result_burger').slideDown('fast', function () {

                        $('#result_burger').html('<div class="alert alert-info">' + obj['message'] + '</div>');

                        if (subject == "cart") {
                            $('#cart').html('<i class="fa fa-cart-plus" aria-hidden="true"></i><span class="hidden-sm-down">&nbsp;&nbsp;&nbsp;CART</span>').prop('disabled', false);
                        }

                    }).delay(3000).slideUp('fast');
                    // Hide the Show the $response['message'] after 3 secondes
                }
            }, 1500);
        }
    });
    return false;
}

/* Add to Card | Boisson */
function addToDrinkCart(subject) {
    const idDrink = $('#idDrink').val();
    const quantity = $('#qty').val();

    $.ajax({
        type: "POST",
        url: 'actions/ajax/addToDrinkCart.php',
        data: 'subject='+subject+'&idDrink='+idDrink+'&quantity='+quantity,
        beforeSend: function () {
            if (subject === "cart") {
                $('#cart').html('<img class="email-loading hidden-sm-down" src="img/loader/ajax-loader.gif" /> &nbsp; Adding..').prop('disabled', true);
            }
        },
        success: function (data) {
            window.setTimeout(function () {
                var obj = jQuery.parseJSON(data);
                $('#result_drink').show();
                if (obj['status'] === 'success') {
                    $('#result_drink').slideDown('fast', function () {
                        $('#result_drink').html('<div class="alert alert-info">' + obj['message'] + '</div>');

                        if (subject === "cart") {
                            $('#cart').html('<i class="fa fa-cart-plus" aria-hidden="true"></i><span class="hidden-sm-down">&nbsp;&nbsp;&nbsp;CART</span>').prop('disabled', false);

                            $('#cart_count').html(obj['count']);
                        }

                    }).delay(3000).slideUp('fast');
                } else {

                    $('#result_drink').html('<div class="alert alert-info">' + obj['message'] + '</div>');

                    $('#result_drink').slideDown('fast', function () {

                        $('#result_drink').html('<div class="alert alert-info">' + obj['message'] + '</div>');

                        if (subject == "cart") {
                            $('#cart').html('<i class="fa fa-cart-plus" aria-hidden="true"></i><span class="hidden-sm-down">&nbsp;&nbsp;&nbsp;CART</span>').prop('disabled', false);
                        }

                    }).delay(3000).slideUp('fast');
                    // Hide the Show the $response['message'] after 3 secondes
                }
            }, 1500);
        }
    });
    return false;
}