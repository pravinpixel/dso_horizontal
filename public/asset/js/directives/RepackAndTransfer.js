app.directive('repackTransferTable', () => {
    return {
        restrict : 'A',
        link: function(scope, element, attribute) {
            element.on('keyup', () => { 
                if(attribute.repackTransferTable == 'REPACK_QUANTITY') {
                    if(scope.RepackTransfer.RepackQuantity != null) {
                        var RemainQuantity                    =   scope.RepackTransfer.quantity - scope.RepackTransfer.RepackQuantity
                        scope.RepackTransfer.RemainQuantity   =   RemainQuantity.toFixed(3)
                    } else {
                        scope.RepackTransfer.RemainQuantity = ''
                    }
                }
                if(attribute.repackTransferTable == 'NEW_UNIT_PACKING_VALUE') {
                    var AutoCalQty = scope.RepackTransfer.unit_packing_value * scope.RepackTransfer.RepackQuantity / scope.RepackTransfer.new_unit_packing_value
                    if(AutoCalQty == NaN) {
                        scope.RepackTransfer.AutoCalQty = ''
                    } else {
                        scope.RepackTransfer.AutoCalQty = AutoCalQty
                    } 
                }
                scope.$apply()
            })
        }
    };
});