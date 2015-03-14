/**
 * Created by kaso on 11/6/2014.
 */

var app = angular.module('UnifySchoolApp.directives', []);


app.directive('toast', function ($animate, $timeout) {
    return {
        'restrict': 'EA',
        'template': '<div class="toast alert alert-{{ type }} text-center" ><ul><li ng-repeat="message in messages"> {{ message }}</li></ul></div>',
        scope: {
            type: '=type',
            messages: '=messages',
            show: '=show'
        },
        'link': function link(scope, element, attrs) {
            function showToast() {
                //$animate.addClass(element,'toast-alert');
                element.css({opacity: 1});
                $timeout(hideToast, 10000);
            }

            function hideToast() {
                element.css({opacity: 0});
                //$animate.removeClass(element,'toast-alert');
            }

            showToast();
            scope.$watch(function () {
                return scope.show;
            }, function (newV, oldV) {
                if (newV == true) {
                    showToast();
                } else {
                    hideToast();
                }
            })
        }
    }
});
