var element_box_delete;

$(function() {
    $('.profile').click(function() {
        $('#perfil').modal();
    });

    $('#delete-item-now').click(function() {
        var id = $(this).attr('id-item');
        var price = $(this).attr('price');

        element_box_delete.remove()
        var total = parseFloat($(".total-in_cart").html()) - parseFloat(price);
        $(".total-in_cart").html(total.toFixed(2));
        $('.total_cart_price').html(total.toFixed(2));

        if (!$('.item-pay').length) {
            $('.table').append('<tr class="item-pay deleted-all-cart"><td></td><td><h3 class="empty-cart-text">Cart Empty</h3></td><td></td><td></td><td></td></tr>');
        }
        $.get("delete/item/" + id);
    });

    $('.delete-element').click(function(event) {
        var id = $(this).parents('.item-pay').attr('id-cart');
        var price = $(this).attr('total-price-product');

        element_box_delete = $(this).parents('.item-pay');

        $('#delete-item-now')
            .attr('id-item', id)
            .attr('price', price);
        $('#ModalDeleteItem').modal();
    });

    $('.delete-element').each(function(index, el) {
        var price = parseFloat($(this).attr('total-price-product'));

        var total = parseFloat($(".total_cart_price").html()) + price;

        $('.total_cart_price').html(total.toFixed(2));
    });
});
