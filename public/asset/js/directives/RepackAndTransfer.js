app.directive('repackTransferTable', () => {
    return {
        restrict : 'A',
        link: function(scope, element, attribute) {
            element.on('keyup', () => { 
                if(attribute.repackTransferTable == 'INPUT_USED_AMOUNT') {
                    if(scope.RepackTransfer.input_used_amount != null) {
                        var remain_amount                    =   scope.RepackTransfer.quantity - scope.RepackTransfer.input_used_amount
                        scope.RepackTransfer.remain_amount   =   remain_amount.toFixed(3)
                    } else {
                        scope.RepackTransfer.remain_amount = ''
                    }
                }
                if(attribute.repackTransferTable == 'INPUT_REPACK_SIZE') { 
                    scope.RepackTransfer.next_total_quantity = scope.RepackTransfer.unit_packing_value * scope.RepackTransfer.input_used_amount / scope.RepackTransfer.repack_size
                }
                scope.$apply()
            })
        }
    };
});