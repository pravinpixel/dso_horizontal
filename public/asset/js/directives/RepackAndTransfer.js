app.directive('repackTransferTable', () => {
    return {
        restrict : 'A',
        link: function(scope, element, attribute) {
            element.on('keyup', () => { 
                if(attribute.repackTransferTable == 'REPACK_QUANTITY') {
                    if(scope.RepackTransfer.RepackQuantity != null) {
                        console.log(scope.RepackTransfer)
                        var RemainQuantity                    =   scope.RepackTransfer.total_quantity - scope.RepackTransfer.RepackQuantity
                        scope.RepackTransfer.RemainQuantity   =   RemainQuantity.toFixed(3)
                    } else {
                        scope.RepackTransfer.RemainQuantity = ''
                    }
                }
                if(attribute.repackTransferTable == 'NEW_UNIT_PACKING_VALUE') {
                    var AutoCalQty = scope.RepackTransfer.RepackQuantity / scope.RepackTransfer.new_unit_packing_value
                    if(typeof(AutoCalQty) == NaN || typeof(AutoCalQty) == undefined || typeof(AutoCalQty) == Infinity) {
                        scope.RepackTransfer.AutoCalQty = ''
                    } else {
                        if(typeof(AutoCalQty) != NaN) {
                            scope.RepackTransfer.AutoCalQty = AutoCalQty.toFixed(3)
                        } 
                    }
                }
                scope.$apply()
            })
        }
    };
});