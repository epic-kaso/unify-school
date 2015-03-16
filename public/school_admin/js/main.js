/**
 * Created by Ak on 2/19/2015.
 */
var app = angular.module("SchoolAdminApp",
    [
        'ngSanitize',
        'ui.bootstrap',
        'ui.router',
        'ngUpload',
        'ngAnimate',
        'ngResource',
        'angular-loading-bar',
        'SchoolAdminApp.directives',
        'SchoolAdminApp.controllers',
        'SchoolAdminApp.services',
        'ngCookies'
    ]
);

app.config(['$urlRouterProvider', '$stateProvider',
    function ($urlRouterProvider, $stateProvider) {

        $stateProvider.state('home',
            {
                url: '/',
                templateUrl: 'partials/device_models/dashboard.html',
                controller: ['$scope', 'SchoolDataService', function ($scope, SchoolDataService) {
                    $scope.school = SchoolDataService.school;
                }]
            }
        );

        $urlRouterProvider.otherwise('/');
    }]);

app.factory('sessionInjector', ['$location', function ($location) {
    return {
        request: function (config) {
            config.headers['X-Requested-With'] = 'XMLHttpRequest';
            console.log('Header modified');
            return config;
        },
        responseError: function (response) {
            if (response.status == 401) {
                location.href = '/admin/auth/login';
                return response;
            }
            return response;
        },
        response: function (response) {
            if (response.status == 401) {
                location.href = '/admin/auth/login';
                return response;
            }
            return response;
        }
    };
}]);

app.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.interceptors.push('sessionInjector');
}]);

app.run(['$http', '$rootScope', 'CSRF_TOKEN',
    function ($http, $rootScope, CSRF_TOKEN) {
        $rootScope.CSRF_TOKEN = CSRF_TOKEN;
        $http.defaults.headers.common['csrf_token'] = CSRF_TOKEN;
    }]);



/**
 * Created by Ak on 2/19/2015.
 */
var module = angular.module('SchoolAdminApp.controllers', ['SchoolAdminApp.services']);

module.controller('NewTicketController', [
    '$scope', 'TicketServ', 'TicketColumns', '$state', '$stateParams', 'DeviceBrands', 'ToastService',
    'GradeDeviceServ', '$cookieStore', 'Networks', 'GadgetEvaluationReward', 'Airtel', 'GradingSystem',
    function ($scope, TicketServ, TicketColumns, $state, $stateParams, DeviceBrands, ToastService,
              GradeDeviceServ, $cookieStore, Networks, GadgetEvaluationReward, Airtel, GradingSystem) {
        $scope.device_brands = DeviceBrands;
        $scope.TicketColumns = TicketColumns;
        $scope.activeStep = 'stepOne';
        $scope.isCreatingTicket = true;
        $scope.creationError = false;
        $scope.ticket = {
            test: {
                deviceBoot: '',
                callUnlock: '',
                wirelessConnection: '',
                icloudConnection: ''
            },
            gradingSystem: GradingSystem
        };
        $scope.selected = {};
        $scope.networks = Networks;
        $scope.brand = {};
        $scope.device = {};
        $scope.activeNextButton = false;
        $scope.airtel = Airtel;
        $scope.portToAirtel = false;

        $scope.$watch('ticket.test', function (newV, oldV) {
            if (!stepThreeActive()) {
                return;
            }
            console.log('test change');
            console.log(newV);
            var ready = checkTestsPassed(newV);
            setViewState(ready);
        }, true);


        $scope.$watch('ticket.gradingSystem', function (newV, oldV) {
            if (!stepFourActive()) {
                return;
            }
            console.log('gradingSystem change');
            console.log(newV);
            $scope.ticket.device_grade = GradeDeviceServ.getGrade(newV);
            console.log('Grade:' + $scope.ticket.device_grade);
        }, true);

        $scope.$watch('brand.selectedIndex', function (newV, oldV) {
            if (!stepTwoActive()) {
                return;
            }
            console.log('brand changed');
            $scope.selected.brand = $scope.device_brands[newV];
            $scope.devices = $scope.selected.brand.gadgets;
            //brand.selected
        });

        $scope.$watch('device.selectedIndex', function (newV, oldV) {
            if (!stepTwoActive()) {
                return;
            }
            console.log('device changed');
            $scope.selected.device = $scope.devices[newV];
            $scope.ticket.gadget_id = $scope.selected.device.id;
        });


        $scope.createTicket = function (ticket) {
            ticket.network_id = parseInt(ticket.network_id);
            ticket.size_id = parseInt(ticket.size_id);

            var ticketSaved = TicketServ.save(ticket);
            ticketSaved.$promise.then(function (ticket) {
                $scope.isCreatingTicket = false;
                if (ticket.hasOwnProperty('id')) {
                    $scope.ticket.savedTicket = ticket;
                    console.log(ticket);
                } else {
                    console.log('error');
                    $scope.creationError = true;
                    ToastService.error("Could not create ticket, please try again later");
                }
            }, function (ticket) {
                alert("failed");
                console.log(ticket);
                $scope.creationError = true;
                ToastService.error("Could not create ticket, please try again later");
            });
        };


        $scope.nextStepOne = function () {
            $scope.activeStep = 'stepOne';
            $state.go('ticket.add.stepOne');
        };

        $scope.nextStepTwo = function () {
            $scope.activeStep = 'stepTwo';
            $state.go('ticket.add.stepTwo');
        };

        $scope.nextStepThree = function () {
            $scope.activeStep = 'stepThree';
            $state.go('ticket.add.stepThree');
        };

        $scope.nextStepFour = function () {
            $scope.activeStep = 'stepFour';
            $state.go('ticket.add.stepFour');
        };

        $scope.nextStepFinal = function () {
            $scope.activeStep = 'stepFinal';
            calculateDeviceReward();
            $state.go('ticket.add.final');
            $scope.createTicket($scope.ticket);
        };

        $scope.nextStepAcceptTerms = function () {
            $scope.activeStep = 'stepAcceptTerms';
            updateTicketsPortToAirtel();
            $state.go('ticket.accept-terms', {id: $scope.ticket.savedTicket.id});
        };

        $scope.goHome = function () {
            $state.go('ticket.menu');
        };

        function calculateDeviceGrade() {
            return $scope.ticket.device_grade;
        }

        function calculateDeviceReward() {
            $scope.selected.grade = calculateDeviceGrade();
            $scope.selected.size = $scope.ticket.size_id;

            angular.forEach($scope.selected.device.sizes, function (value, key) {
                if (value.id == $scope.ticket.size_id) {
                    this.size = value.value;
                }
            }, $scope.selected);

            $scope.ticket.reward = GadgetEvaluationReward.calculate($scope.selected);
        }

        function stepTwoActive() {
            return $scope.activeStep == 'stepTwo';
        }

        function stepThreeActive() {
            return $scope.activeStep == 'stepThree';
        }

        function stepFourActive() {
            return $scope.activeStep == 'stepFour';
        }

        function stepFinalActive() {
            return $scope.activeStep == 'stepFinal';
        }

        function checkTestsPassed(obj) {
            var state = {ready: true};

            angular.forEach(obj, function (value, key) {
                if (value == 'no') {
                    this.ready = false;
                }
            }, state);

            return state.ready;
        }

        function setViewState(ready) {
            $scope.activeNextButton = ready;
            if (ready) {
                $scope.message = "Ok, proceed.";
            } else {
                $scope.message = "Sorry, Device doesn't Qualify to Continue";
            }
        }

        function updateTicketsPortToAirtel() {
            //$scope.ticket.savedTicket.port_to_airtel = $scope.portToAirtel;

            TicketServ.update({id: $scope.ticket.savedTicket.id}, $scope.ticket.savedTicket);
        }
    }]);
/**
 * Created by Ak on 2/19/2015.
 */

var app = angular.module('SchoolAdminApp.directives', []);

app.directive('backButton', function () {
    return {
        'restrict': 'EA',
        'template': '<a class="btn base-resize search-btn back-btn" href=""><span class="fa fa-chevron-left"></span></a>',
        'link': function link(scope, element, attrs) {
            element.bind('click', function (e) {
                window.history.back();
                e.preventDefault();
            })
        }
    }
});


app.directive('webCamera', function (ScriptCam) {
    return {
        'restrict': 'EA',
        'scope': {
            imageSrc: '=',
            imageEncoded: '=',
            showCamera: '='
        },
        'template': '<div style="width: 320px;height: 300px;margin-right: auto;margin-left: auto">' +
        '<div>' +
        '<div>' +
        '<div id="webcamFrame"><div id="webcam"></div></div>' +
        '<div style="margin-bottom: 10px;text-align: center;">' +
        '<button class="btn btn-default btn-capture">Capture</button>' +
        '<button class="btn btn-default goto-cam"><span class="fa fa-chevron-left"></span></button>' +
        '<button class="btn btn-default goto-img"><span class="fa fa-chevron-right"></span></button>' +
        '<button class="btn btn-primary save-img"><span class="fa fa-save"></span></button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="preview">' +
        '<img ng-src="{{ imageSrc }}" class="img-responsive preview-img" alt=""/>' +
        '</div>' +
        '<div>' +
        '</div></div>'
        ,
        'link': function link(scope, element, attrs) {
            var webcam = element.find('#webcam');
            var webcamFrame = element.find('#webcamFrame');
            var previewImg = element.find('img.preview-img');
            var gotoCameraBtn = element.find('.btn.goto-cam');
            var gotoImgBtn = element.find('.btn.goto-img');
            var saveImgBtn = element.find('.btn.save-img');
            var captureImgBtn = element.find('.btn-capture');

            webcam.scriptcam({
                path: ScriptCam.path,
                showMicrophoneErrors: false,
                onError: onError,
                cornerColor: 'eee',
                uploadImage: ScriptCam.path + 'upload.gif',
                onPictureAsBase: captureImage
            });

            captureImgBtn.on('click', function () {
                captureImage();
            });

            gotoCameraBtn.click(function () {
                scope.showCamera = true;
                scope.$apply();
            });

            gotoImgBtn.click(function () {
                scope.showCamera = false;
                scope.$apply();
            });

            scope.$watch('showCamera', function (newV, oldV) {
                if (newV == true) {
                    webcamFrame.show();
                    previewImg.hide();

                    captureImgBtn.show();
                    if (!angular.isDefined(scope.imageSrc) && scope.imageSrc != '') {
                        gotoImgBtn.show();
                    }
                    gotoCameraBtn.hide();
                    saveImgBtn.hide();

                } else {
                    webcamFrame.hide();
                    captureImgBtn.hide();

                    previewImg.show();
                    gotoImgBtn.hide();
                    gotoCameraBtn.show();
                    saveImgBtn.show();
                }
            });

            function captureImage() {
                scope.imageSrc = base64_toimage();
                scope.imageEncoded = base64_tofield();
                scope.showCamera = false;
                scope.$apply();
            }

            function base64_tofield() {
                return $.scriptcam.getFrameAsBase64();
            }

            function base64_toimage() {
                return "data:image/png;base64," + $.scriptcam.getFrameAsBase64();
            }

            function onError(errorId, errorMsg) {
                element.find('btn-capture').attr("disabled", true);
            }
        }
    }
});

app.directive('fileButton', function () {
    return {
        'restrict': 'EA',
        'scope': {
            'name': '@name',
            'label': '@'
        },
        'template': '<div class="input-group"><div class="input-group-btn"><span class="btn btn-info btn-file">Browse.. <input type="file" name="{{ name }}"/> </span></div><input class="form-control file-select-label" value="{{ label }}" placeholder="Select a file" name="file-name" type="text"/></div>',
        'link': function link(scope, element, attrs) {
            var fileInput = element.find('.btn-file input[type=file]');
            //var fileLabel = element.find('input[type=text].file-select-label');
            element.find('.btn.btn-file').css({
                position: 'relative',
                overflow: 'hidden',
                width: '70px',
                height: '34px'
            });

            fileInput.css({
                top: '0',
                right: '0',
                position: 'absolute',
                'min-width': 'inherit',
                'width': 'inherit',
                'min-height': 'inherit',
                'height': 'inherit',
                'font-size': '100px',
                'text-align': 'right',
                'filter': 'alpha(opacity=0)',
                'opacity': '0',
                'outline': 'none',
                'backgound': 'white',
                'cursor': 'inherit',
                'display': 'block'
            });

            fileInput.on('change', function () {
                console.log("file input change event");
                var input = $(this), numFiles = input.get(0).files ? input.get(0).files.length : 1;
                scope.label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                console.log(scope.label);
                scope.$apply();
            });
        }
    }
});


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


app.directive('formItemUpdate', function ($timeout) {
    return {
        'restrict': 'A',
        'scope': {
            'status': '='
        },
        'link': function link(scope, element, attrs) {
            function showLoadingTick() {
                //element.remove('.loader-item');
                element.find('.input-form-item')
                    .html('<span class="loader-item" style="margin-left: 20px"><span class="fa fa-spin fa-spinner"></span></span>');

                $timeout(clear, 3000);
            }

            function showErrorTick() {
                //element.remove('.loader-item');
                element.find('.input-form-item')
                    .html('<span class="loader-item" style="margin-left: 20px;color: red;"><span class="fa fa-close"></span></span>');

                $timeout(clear, 3000);
            }

            function showGreenTick() {
                // element.remove('.loader-item');
                element.find('.input-form-item')
                    .html('<span class="loader-item" style="margin-left: 20px;color: green;"><span class="fa fa-check"></span></span>')
            }

            function clear() {
                element.find('.input-form-item')
                    .html('');
            }

            scope.$watch('status', function (newV, oldV) {
                if (newV == 'success') {
                    showGreenTick();
                } else if (newV == 'failure') {
                    showErrorTick();
                } else if (newV == 'loading') {
                    showLoadingTick();
                } else {
                    clear();
                }
            })
        }
    }
});
/**
 * Created by Ak on 2/19/2015.
 */

/**
 * Created by Ak on 2/19/2015.
 */

var app = angular.module('SchoolAdminApp.services', []);

app.factory('TicketServ', ['$resource', 'URLServ', function ($resource, URLServ) {
    return $resource('/resources/ticket/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });//URLServ.getResourceUrlFor("ticket"));
}]);

//TicketConfigServ
app.factory('TicketConfigServ', ['$resource', 'URLServ', function ($resource, URLServ) {
    return $resource('/resources/ticket-config/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });//URLServ.getResourceUrlFor("ticket"));
}]);

app.factory('DeviceBrandsServ', ['$resource', 'URLServ', function ($resource, URLServ) {
    return $resource('/resources/device_makers/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });//URLServ.getResourceUrlFor("ticket"));
}]);

app.factory('AdvisersServ', ['$resource', 'URLServ', function ($resource, URLServ) {
    return $resource('/resources/advisers/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });//URLServ.getResourceUrlFor("ticket"));
}]);

app.factory('DevicesServ', ['$resource', 'URLServ', function ($resource, URLServ) {
    return $resource('/resources/devices/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });//URLServ.getResourceUrlFor("ticket"));
}]);

app.factory('GradingSystemServ', ['$resource', 'URLServ', function ($resource, URLServ) {
    return $resource('/resources/grading-system-config/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });//URLServ.getResourceUrlFor("ticket"));
}]);


app.factory('MailServ', ['$resource', function ($resource) {
    return $resource('/resources/mail', null);//URLServ.getResourceUrlFor("ticket"));
}]);


app.factory('NetworksServ', ['$resource', 'URLServ', function ($resource, URLServ) {
    return $resource('/resources/networks/:id', {id: '@id'}, {
        'update': {method: 'PUT'}
    });//URLServ.getResourceUrlFor("ticket"));
}]);


app.factory('URLServ', ['$rootScope', function ($rootScope) {
    return {
        "getResourceUrlFor": function (name) {
            return $rootScope.data.resources[name];
        }
    }
}]);

app.factory('GadgetEvaluationReward', ['NetworksServ', '$cookieStore', function (NetworksServ, $cookieStore) {
    var reward = {result: ''};

    function getBaseLinePrice(device, size) {
        var baseLinePrice = 0;

        console.log('Device --reward');
        console.log(device);
        console.log(size);

        if (device.base_line_prices.length == 1) {
            baseLinePrice = parseInt(device.base_line_prices[0].value);
        } else {

            angular.forEach(device.base_line_prices, function (v, k) {
                if (v.size == size) {
                    baseLinePrice = parseInt(v.value);
                }
            });
        }

        return baseLinePrice;
    }

    function calculatePriceFromGrade(device, grade, baseLinePrice) {
        console.log(baseLinePrice);
        console.log(device.brand.normal_condition);
        console.log(device.brand);
        console.log(grade);

        switch (grade) {
            case 'A':
                return parseFloat(parseInt(device.brand.normal_condition) / 100.0) * baseLinePrice;
            case 'B':
                return parseFloat(parseInt(device.brand.scratched_condition) / 100.0) * baseLinePrice;
            case 'C':
                return parseFloat(parseInt(device.brand.bad_condition) / 100.0) * baseLinePrice;
        }
    }

    return {
        "calculate": function (model) {
            reward.result = calculatePriceFromGrade(model, model.grade, getBaseLinePrice(model.device, model.size));
            console.log(reward.result);
            $cookieStore.put('last-reward', reward.result);
            return reward.result;
        },
        "getLastReward": function () {
            return $cookieStore.get('last-reward');
        },
        fetchAirtelBonus: function () {
            var network = NetworksServ.get({q: 'airtel'});
            return network;
        }
    }
}]);

app.factory('GradeDeviceServ', ['$rootScope', function ($rootScope) {

    var threshold = {
        'A': 8.1,
        'B': 5.85
    };

    function generateGradePoint(device) {
        var result = {gradePoint: 0};

        angular.forEach(device, function (value, key) {
            if (angular.isDefined(value.rating) && value.rating != '') {
                console.log(value.rating + " -- " + value.weight);
                this.gradePoint += parseInt(value.rating) * value.weight;
                console.log(this.gradePoint);
            }
        }, result);

        return result.gradePoint;
    }

    function generateGradeLetter(gradePoint) {
        var value = parseFloat(gradePoint);

        if (value >= threshold.A) {
            return 'A';
        } else if (value >= threshold.B) {
            return 'B';
        } else {
            return 'C';
        }
    }

    return {
        "getGrade": function (device) {
            var gradePoint = generateGradePoint(device);
            return generateGradeLetter(gradePoint);
        }
    }
}]);

app.factory('PreloadTemplates', ['$templateCache', '$http', 'PRELOAD_UI_LIST', function ($templateCache, $http, PRELOAD_UI_LIST) {
    var templates = PRELOAD_UI_LIST.get();
    return {
        run: function () {
            templates.forEach(function (currentItem) {
                $http.get(currentItem, {cache: $templateCache});
            });
        }
    }
}]);


app.factory('ImageFetcher', ['$http', '$q', function ($http, $q) {
    var searchUrl = "https://www.googleapis.com/customsearch/v1?key=AIzaSyAJ_8QtWECvWTcrukqvfLmRWdARJ2bI2rk&cx=011505858740112002603:dap5yb7naau&q=";

    return {
        fetch: function (query) {
            var images = [];
            var deferred = $q.defer();
            $http.get(searchUrl + encodeURI(query)).then(function (response) {
                console.log(response.data);
                response.data.items.forEach(function (currentValue) {
                    if (angular.isDefined(currentValue.pagemap)) {
                        var temp = currentValue.pagemap.cse_image;//cse_thumbnail;
                        if (angular.isDefined(temp) && angular.isArray(temp)) {
                            temp.forEach(function (cValue) {
                                images.push(cValue);
//                                if (cValue.height > cValue.width) {
//                                    images.push(cValue);
//                                }
                            });
                        } else if (angular.isDefined(temp) && angular.isObject(temp)) {
                            images.push(temp);
                        }
                    }
                });
                console.log(images);
                deferred.resolve(images);
            }, function (response) {
                console.log(response);
                deferred.reject(response);
            });

            return deferred.promise;
        }
    }

}]);


app.factory('ToastService', ['$rootScope', function ($rootScope) {

    if (angular.isUndefined($rootScope.toast)) {
        $rootScope.toast = {messages: [], show: false, type: 'info'};
    }

    return {
        error: function (message) {
            $rootScope.toast = {messages: [message], show: true, type: 'danger'};
        },
        info: function (message) {
            $rootScope.toast = {messages: [message], show: true, type: 'info'};
        },
        success: function (message) {
            $rootScope.toast = {messages: [message], show: true, type: 'success'};
        }
    }
}]);
//# sourceMappingURL=main.js.map