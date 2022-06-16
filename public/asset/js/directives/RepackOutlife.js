app.directive('repackTable', () => {
    return {
        restrict : 'A',
        link: function(scope, element, attribute) {
            element.on('click', () => {
                if(attribute.repackTable == "IN") {
                    scope.repack.draw_in.time_stamp = moment().format('MMMM Do YYYY, h:mm:ss a')
                    scope.$apply()
                }
                if(attribute.repackTable == "OUT") {
                    scope.repack.draw_out.time_stamp = moment().format('MMMM Do YYYY, h:mm:ss a')
                    var startDate   =   moment(scope.repack.draw_in.time_stamp, "MMMM Do YYYY, h:mm:ss a");
                    var endDate     =   moment(scope.repack.draw_out.time_stamp, "MMMM Do YYYY, h:mm:ss a"); 
                    var diff        =   moment(endDate).diff(startDate, 'milliseconds');
                    var duration    =   moment.duration(diff);

                    const Years     =   duration._data.years != 0 ? duration._data.years  + ' Years': ''
                    const days      =   duration._data.days != 0 ? duration._data.days + ' days' : ''
                    const minutes   =   duration._data.minutes != 0 ? duration._data.minutes + ' minutes' : ''
                    const seconds   =   duration._data.seconds != 0 ? duration._data.seconds + ' seconds' : ''

                    scope.repack.remaining_days = `${Years} ${days} ${minutes} ${seconds}`

                    scope.$apply();
                }
            })
            element.on('keyup', () => { 
                if(attribute.repackTable == "REPACK_INPUT") {
                    scope.repack.repack_amount === null ? scope.repack.balance_amount = null :
                    scope.repack.balance_amount = (scope.repack.initial_amount - scope.repack.repack_amount)
                    scope.$apply()
                }
            })
        }
    };
});