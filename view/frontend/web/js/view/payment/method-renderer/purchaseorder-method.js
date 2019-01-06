define(
    [
        'ko',
        'Magento_Checkout/js/view/payment/default',
        'jquery',
        'mage/validation'
    ],
    function (ko, Component,$) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Magento_AdditionalPayment/payment/purchaseorder-form',
                purchaseOrderNumber: ''
            },

            /** @inheritdoc */
        initObservable: function () {
            this._super()
                .observe('purchaseOrderNumber');

            return this;
        },
            getData: function() {
                return {
                    'method': this.item.method,
                    'po_number': this.purchaseOrderNumber(),
                    'additional_data': {
                        'custom_payment': $('#purchaseorder_custom_payment').val()
                    }
                };
            },
            /**
         * @return {jQuery}
         */
        validate: function () {
            var form = 'form[data-role=purchaseorder-form]';

            return $(form).validation() && $(form).validation('isValid');
        },
            /**
             * Get value of instruction field.
             * @returns {String}
             */
            getInstructions: function () {
                return window.checkoutConfig.payment.purchaseorder.instructions[this.item.method];
            },


            /**
         * Returns send check to info.
         *
         * @return {*}
         */
        getMailingAddress: function () {
            return window.checkoutConfig.payment.purchaseorder.mailingAddress;
        },

        /**
         * Returns payable to info.
         *
         * @return {*}
         */
        getPayableTo: function () {
            return window.checkoutConfig.payment.purchaseorder.payableTo;
        }




        });
    }
);