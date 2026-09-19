$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateCartUI(data) {
        $('#cartCountMobile').text(data.cartCount);
        $('#cartCountDesktop').text(data.cartCount);
        $('#cartCountFloating').text(data.cartCount + ' Items');
        $('#cart-grand-total').text('৳' + data.cartTotal);
        $('#cart-grand-total-floating').text('৳' + data.cartTotal);
        $('#cartItemsContainer').html(data.cartHtml);
    }

    // Product page: local quantity selector (server e jai na)
    $(document).on('click', '.qty-btn', function () {
        let id = $(this).data('id');
        let action = $(this).data('action');
        let qtySpan = $('#qty-' + id);
        let qty = parseInt(qtySpan.text().trim());

        if (action === 'inc') {
            qty++;
        } else if (action === 'dec' && qty > 1) {
            qty--;
        }

        qtySpan.text(qty);
    });

    // Add to Cart / Buy Now
    $(document).on('click', '.add-to-cart-btn', function () {
        let id = $(this).data('id');
        let action = $(this).data('action');
        let qty = parseInt($('#qty-' + id).text().trim()) || 1;

        $.ajax({
            url: '/cart/add/' + id,
            method: 'POST',
            data: { quantity: qty },
            success: function (data) {
                updateCartUI(data);

                if (action === 'checkout') {
                    window.location.href = '/checkout';
                }
            },
            error: function () {
                alert('Something went wrong!');
            }
        });
    });

    // Cart offcanvas: inc/dec
    $(document).on('click', '.cart-qty-btn', function () {
        let id = $(this).data('id');
        let action = $(this).data('action');

        $.ajax({
            url: '/cart/update/' + id,
            method: 'POST',
            data: { action: action },
            success: function (data) {
                updateCartUI(data);
            }
        });
    });

    // Cart offcanvas: remove
    $(document).on('click', '.cart-remove-btn', function () {
        let id = $(this).data('id');

        $.ajax({
            url: '/cart/remove/' + id,
            method: 'POST',
            success: function (data) {
                updateCartUI(data);
            }
        });
    });

});