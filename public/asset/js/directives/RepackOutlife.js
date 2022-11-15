app.directive('repackTable', () => {
    return {
        restrict : 'A',
        link: function(scope, element, attribute) {
            element.on('click', () => {
                if(attribute.repackTable == "OUT") { 
                    scope.repack.draw_in.time_stamp = moment().format('MMMM Do YYYY, h:mm:ss a')
                    scope.$apply()
                }
                if(attribute.repackTable == "IN") { 
                    scope.repack.draw_out.time_stamp = moment().format('MMMM Do YYYY, h:mm:ss a')
                    var startDate   =   moment(scope.repack.draw_in.time_stamp, "MMMM Do YYYY, h:mm:ss a");
                    var endDate     =   moment(scope.repack.draw_out.time_stamp, "MMMM Do YYYY, h:mm:ss a"); 
                    var diff        =   moment(endDate).diff(startDate, 'milliseconds');
                    var duration    =   moment.duration(diff);

                    const Years     =   duration._data.years != 0 ? duration._data.years  + ' Years': ''
                    const days      =   duration._data.days != 0 ? duration._data.days + ' days' : ''
                    const minutes   =   duration._data.minutes != 0 ? duration._data.minutes + ' minutes' : ''
                    const seconds   =   duration._data.seconds != 0 ? duration._data.seconds + ' seconds' : ''

                    localStorage.setItem('repack_outlife_id', scope.repack.id) 

                    scope.repack.remaining_days = `${Years} ${days} ${minutes} ${seconds}`
                    console.log(scope.repack.remaining_days)
                    console.log(diff)
                    scope.repack.remaining_days_seconds = diff
                    scope.$apply(); 
                }
            })
            element.on('keyup', () => { 
                if(attribute.repackTable == "REPACK_INPUT") {
                    localStorage.setItem('repack_outlife_id', scope.repack.id) 
                    scope.repack.repack_amount === null ? scope.repack.balance_amount = null :
                    // scope.repack.total_quantity = Number(scope.repack.initial_amount) * Number(scope.repack.quantity)
                    scope.repack.balance_amount = Number(scope.repack.total_quantity) - Number(scope.repack.repack_amount) 
                    scope.$apply()
                }
                if(attribute.repackTable == "REPACK_SIZE") {
                    var quantity            = Number(Number(scope.repack.repack_amount) / Number(scope.repack.repack_size)).toFixed(3)
                    scope.repack.quantity    = Number(quantity);
                    scope.$apply()
                }
            })
        }
    };
});