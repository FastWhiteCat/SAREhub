require([
    'jquery',
    'Fwc_SAREhub/js/events-handler',
    'jquery/jquery-storageapi',
], function($, eventsHandler) {

    var storage = $.initNamespaceStorage('mage-cache-storage').localStorage;

    $(document).on('ajaxComplete', function (event, xhr, settings) {
        if (settings.url.match(/customer\/section\/load/i) && xhr.responseJSON && xhr.responseJSON.cart) {
            var addedItems = {};
            var removedItems = [];
            var modifiedItems = [];
            var qty = 0;
            var isNewCart = false;

            var newCart = xhr.responseJSON.cart;
            var oldCart = storage.get('iwd-old-cart');
            oldCart = (typeof oldCart === 'undefined') ? {'items':[]} : oldCart;

            if (typeof oldCart !== 'undefined' && oldCart.summary_count == 0) {
                isNewCart = true;
            }

            var oldCartItems = {};
            $.each(oldCart.items, function(){
                oldCartItems[this.item_id] = this;
            });

            $.each(newCart.items, function(item){
                var id = this.item_id;
                if (typeof oldCartItems[id] !== 'undefined') {
                    var oldQty = oldCartItems[id].qty;
                    if (oldQty == 0 && oldQty < this.qty) {
                        // this.qty -= oldQty;
                        addedItems = this;
                        qty = this.qty;
                    } else if (oldQty > this.qty && this.qty == 0) {
                        //  this.qty = oldQty - this.qty;
                        removedItems.push(this);
                        qty = oldQty;
                    }

                    if(oldQty > 0 && this.qty > 0 && oldQty != this.qty){
                        modifiedItems.push(this);
                        qty = this.qty;
                    }

                    delete oldCartItems[id];
                } else {
                    addedItems = this;
                    qty = this.qty;
                }
            });

            $.each(oldCartItems, function(id, item){
                removedItems.push(item);
            });

            if (_.size(addedItems) > 0) {
                eventsHandler('_cartadd', {items:addedItems, qty: qty});
                if (isNewCart) {
                    eventsHandler('_cartinitialized');
                }
            }
            if (_.size(removedItems) > 0) {
                eventsHandler('_cartdel', {items:removedItems, qty: qty});
            }
            if (_.size(modifiedItems) > 0) {
                eventsHandler('_cartquantity', {items:modifiedItems, qty: qty});
            }

            storage.set('iwd-old-cart', newCart);
        }
    });
});
