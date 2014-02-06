/**
 * Created by i.mischenko on 2/3/14.
 */

(function ($) {
    $(document).ready(function () {
        $('.addToCart').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/cart/index/save',
                type: 'POST',
                data: {'productId': $(this).data('id')},
                success: function () {
                    alert('Success! Product was added to cart.');
                    location.reload();

                }
            });
        });

        $('.removeFromCart').on('click', function (e) {
            e.preventDefault();
            if (confirm("Are you sure?")) {
                $.ajax({
                    url: '/cart/index/remove',
                    type: 'POST',
                    data: {'productId': $(this).data('idprodcart'), 'removeAll': $(this).data('removeall')},
                    success: function () {
                        alert('Success! Product was removed from the cart');
                        location.reload();
                    }
                })
            }
        });

    });
})(jQuery);
