/*!
 *
 * SchoolAdminApp - Bootstrap Admin App + AngularJS
 *
 * Author: @themicon_co
 * Website: http://themicon.co
 * License: http://support.wrapbootstrap.com/knowledge_base/topics/usage-licenses
 *
 */

if (typeof $ === 'undefined') {
    throw new Error('This application\'s JavaScript requires jQuery');
}

// APP START
// -----------------------------------

var App = angular.module('SchoolAdminApp', [
    'ngRoute',
    'ngAnimate',
    'ngStorage',
    'ngCookies',
    'pascalprecht.translate',
    'ui.bootstrap',
    'ui.router',
    'oc.lazyLoad',
    'cfp.loadingBar',
    'ngSanitize',
    'ngResource',
    'ui.utils'
]);

App.run(
    ["$rootScope", "$state", "$stateParams", '$window', '$templateCache', 'SchoolDataService',
        function ($rootScope, $state, $stateParams, $window, $templateCache, SchoolDataService) {
            // Set reference to access them from any scope
            $rootScope.$state = $state;
            $rootScope.$stateParams = $stateParams;
            $rootScope.$storage = $window.localStorage;

            // Uncomment this to disable template cache
            /*$rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams) {
             if (typeof(toState) !== 'undefined'){
             $templateCache.remove(toState.templateUrl);
             }
             });*/

            // Scope Globals
            // -----------------------------------
            $rootScope.app = {
                name: 'SchoolAdminApp',
                description: 'UnifySchools Admin App',
                year: ((new Date()).getFullYear()),
                layout: {
                    isFixed: true,
                    isCollapsed: false,
                    isBoxed: false,
                    isRTL: false,
                    horizontal: false,
                    isFloat: false,
                    asideHover: false,
                    theme: null
                },
                useFullLayout: false,
                hiddenFooter: false,
                viewAnimation: 'ng-fadeInUp'
            };
            $rootScope.user = SchoolDataService.adminUser;

        }]);

/**=========================================================
 * Module: config.js
 * App routes and resources configuration
 =========================================================*/

App.constant('ViewBaseURL', '/admin/dashboard/partial');
App.constant('AssetsBaseURL', '/framework');

App.config(['$ocLazyLoadProvider', 'APP_REQUIRES', function ($ocLazyLoadProvider, APP_REQUIRES) {
    'use strict';

    // Lazy Load modules configuration
    $ocLazyLoadProvider.config({
        debug: false,
        events: true,
        modules: APP_REQUIRES.modules
    });

}]).config(['$controllerProvider', '$compileProvider', '$filterProvider', '$provide',
    function ($controllerProvider, $compileProvider, $filterProvider, $provide) {
        'use strict';
        // registering components after bootstrap
        App.controller = $controllerProvider.register;
        App.directive = $compileProvider.directive;
        App.filter = $filterProvider.register;
        App.factory = $provide.factory;
        App.service = $provide.service;
        App.constant = $provide.constant;
        App.value = $provide.value;

    }]).config(['$translateProvider', function ($translateProvider) {

    $translateProvider.useStaticFilesLoader({
        prefix: '/framework/app/i18n/',
        suffix: '.json'
    });
    $translateProvider.preferredLanguage('en');
    $translateProvider.useLocalStorage();
    $translateProvider.usePostCompiling(true);

}]).config(['cfpLoadingBarProvider', function (cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeBar = true;
    cfpLoadingBarProvider.includeSpinner = false;
    cfpLoadingBarProvider.latencyThreshold = 500;
    cfpLoadingBarProvider.parentSelector = '.wrapper > section';
}]).config(['$tooltipProvider', function ($tooltipProvider) {

    $tooltipProvider.options({appendToBody: true});

}])
;

/**=========================================================
 * Module: constants.js
 * Define constants to inject across the application
 =========================================================*/
App
    .constant('APP_COLORS', {
        'primary': '#5d9cec',
        'success': '#27c24c',
        'info': '#23b7e5',
        'warning': '#ff902b',
        'danger': '#f05050',
        'inverse': '#131e26',
        'green': '#37bc9b',
        'pink': '#f532e5',
        'purple': '#7266ba',
        'dark': '#3a3f51',
        'yellow': '#fad732',
        'gray-darker': '#232735',
        'gray-dark': '#3a3f51',
        'gray': '#dde6e9',
        'gray-light': '#e4eaec',
        'gray-lighter': '#edf1f2'
    })
    .constant('APP_MEDIAQUERY', {
        'desktopLG': 1200,
        'desktop': 992,
        'tablet': 768,
        'mobile': 480
    })
    .constant('APP_REQUIRES', {
        // jQuery based and standalone scripts
        scripts: {
            'slimscroll': ['/framework/vendor/slimScroll/jquery.slimscroll.min.js'],
            'taginput': ['/framework/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css',
                '/framework/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'],
            'filestyle': ['/framework/vendor/bootstrap-filestyle/src/bootstrap-filestyle.js'],
            'modernizr': ['/framework/vendor/modernizr/modernizr.js'],
            'icons': ['/framework/vendor/fontawesome/css/font-awesome.min.css',
                '/framework/vendor/simple-line-icons/css/simple-line-icons.css'],
            'inputmask': ['/framework/vendor/jquery.inputmask/dist/jquery.inputmask.bundle.min.js'],
            'parsley':            ['/framework/vendor/parsleyjs/dist/parsley.min.js']
        },
        // Angular based script (use the right module name)
        modules: [
            {
                name: 'ngDialog',
                files: ['/framework/vendor/ngDialog/js/ngDialog.min.js',
                        '/framework/vendor/ngDialog/css/ngDialog.min.css',
                        '/framework/vendor/ngDialog/css/ngDialog-theme-default.min.css'
                        ] 
            },
            {
                name: 'ngUpload',
                files: ['/framework/vendor/ngUpload/ng-upload.min.js']
            },
            {
                name: 'toaster',
                files: ['/framework/vendor/angularjs-toaster/toaster.js', '/framework/vendor/angularjs-toaster/toaster.css']
            },
            {
                name: 'ngTable', files: ['/framework/vendor/ng-table/dist/ng-table.min.js',
                '/framework/vendor/ng-table/dist/ng-table.min.css']
            },
            {name: 'ngTableExport', files: ['/framework/vendor/ng-table-export/ng-table-export.js']},
            {
                name: 'xeditable', files: ['/framework/vendor/angular-xeditable/dist/js/xeditable.js',
                '/framework/vendor/angular-xeditable/dist/css/xeditable.css']
            },
        ]

    })
;
/**=========================================================
 * Module: main.js
 * Main Application Controller
 =========================================================*/

App.controller('AppController',
    ['$rootScope', '$scope', '$state', '$translate', '$window', '$localStorage', '$timeout', 'toggleStateService', 'colors', 'browser', 'cfpLoadingBar',
        function ($rootScope, $scope, $state, $translate, $window, $localStorage, $timeout, toggle, colors, browser, cfpLoadingBar) {
            "use strict";

            // Setup the layout mode
            $rootScope.app.layout.horizontal = ( $rootScope.$stateParams.layout == 'app-h');

            // Loading bar transition
            // -----------------------------------
            var thBar;
            $rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {
                if ($('.wrapper > section').length) // check if bar container exists
                    thBar = $timeout(function () {
                        cfpLoadingBar.start();
                    }, 0); // sets a latency Threshold
            });
            $rootScope.$on('$stateChangeSuccess', function (event, toState, toParams, fromState, fromParams) {
                event.targetScope.$watch("$viewContentLoaded", function () {
                    $timeout.cancel(thBar);
                    cfpLoadingBar.complete();
                });
            });


            // Hook not found
            $rootScope.$on('$stateNotFound',
                function (event, unfoundState, fromState, fromParams) {
                    console.log(unfoundState.to); // "lazy.state"
                    console.log(unfoundState.toParams); // {a:1, b:2}
                    console.log(unfoundState.options); // {inherit:false} + default options
                });
            // Hook error
            $rootScope.$on('$stateChangeError',
                function (event, toState, toParams, fromState, fromParams, error) {
                    console.log(error);
                });
            // Hook success
            $rootScope.$on('$stateChangeSuccess',
                function (event, toState, toParams, fromState, fromParams) {
                    // display new view from top
                    $window.scrollTo(0, 0);
                    // Save the route title
                    $rootScope.currTitle = $state.current.title;
                });

            $rootScope.currTitle = $state.current.title;
            $rootScope.pageTitle = function () {
                var title = $rootScope.app.name + ' - ' + ($rootScope.currTitle || $rootScope.app.description);
                document.title = title;
                return title;
            };

            // iPad may presents ghost click issues
            // if( ! browser.ipad )
            // FastClick.attach(document.body);

            // Close submenu when sidebar change from collapsed to normal
            $rootScope.$watch('app.layout.isCollapsed', function (newValue, oldValue) {
                if (newValue === false)
                    $rootScope.$broadcast('closeSidebarMenu');
            });

            // Restore layout settings
            if (angular.isDefined($localStorage.layout))
                $scope.app.layout = $localStorage.layout;
            else
                $localStorage.layout = $scope.app.layout;

            $rootScope.$watch("app.layout", function () {
                $localStorage.layout = $scope.app.layout;
            }, true);


            // Allows to use branding color with interpolation
            // {{ colorByName('primary') }}
            $scope.colorByName = colors.byName;

            // Internationalization
            // ----------------------

            $scope.language = {
                // Handles language dropdown
                listIsOpen: false,
                // list of available languages
                available: {
                    'en': 'English',
                    'es_AR': 'Espa�ol'
                },
                // display always the current ui language
                init: function () {
                    var proposedLanguage = $translate.proposedLanguage() || $translate.use();
                    var preferredLanguage = $translate.preferredLanguage(); // we know we have set a preferred one in app.config
                    $scope.language.selected = $scope.language.available[(proposedLanguage || preferredLanguage)];
                },
                set: function (localeId, ev) {
                    // Set the new idiom
                    $translate.use(localeId);
                    // save a reference for the current language
                    $scope.language.selected = $scope.language.available[localeId];
                    // finally toggle dropdown
                    $scope.language.listIsOpen = !$scope.language.listIsOpen;
                }
            };

            $scope.language.init();

            // Restore application classes state
            toggle.restoreState($(document.body));

            // cancel click event easily
            $rootScope.cancel = function ($event) {
                $event.stopPropagation();
            };

        }]);

/**=========================================================
 * Module: sidebar-menu.js
 * Handle sidebar collapsible elements
 =========================================================*/

App.controller('SidebarController', ['$rootScope', '$scope', '$state', '$http', '$timeout', 'Utils', 'SchoolDataService',
    function ($rootScope, $scope, $state, $http, $timeout, Utils, SchoolDataService) {

        var collapseList = [];
        var modules = SchoolDataService.school.loaded_modules;

        // demo: when switch from collapse to hover, close all items
        $rootScope.$watch('app.layout.asideHover', function (oldVal, newVal) {
            if (newVal === false && oldVal === true) {
                closeAllBut(-1);
            }
        });

        $rootScope.$on('selectedSchoolCategoryChanged', function (event, obj) {
            console.log('event selectedSchoolCat received');

            if (angular.isDefined($scope.menuItems)) {
                angular.forEach($scope.menuItems, function (value, key) {
                    if (value.text == 'Classes') {
                        value.submenu = prepareSubmenuItems(obj.value.school_category_arms);
                    }
                });
            }
        });

        function prepareSubmenuItems(school_cat_arms) {
            var response = [];

            angular.forEach(school_cat_arms, function (value, key) {
                var item = {};
                item.text = value.display_name;
                item.sref = 'app.viewClassArm';
                item.params = {id: value.id};

                this.push(item);
            }, response);

            return response;
        }

        // Check item and children active state
        var isActive = function (item) {

            if (!item) return;

            if (!item.sref || item.sref == '#') {
                var foundActive = false;
                angular.forEach(item.submenu, function (value, key) {
                    if (isActive(value)) foundActive = true;
                });
                return foundActive;
            }
            else
                return $state.is(item.sref) || $state.includes(item.sref);
        };

        // Load menu from json file
        // -----------------------------------

        $scope.getMenuItemPropClasses = function (item) {
            return (item.heading ? 'nav-heading' : '') +
                (isActive(item) ? ' active' : '');
        };

        $scope.loadSidebarMenu = function () {
            $scope.menuItems = [
                {
                    "text": "Main Navigation",
                    "heading": "true"
                }
            ];

            angular.forEach(modules,function(value,key){
                var temp = {
                    "text": value.name,
                    "sref": "#",
                    "icon": "fa fa-"+value.name,
                    'disable': !SchoolDataService.school.setup_complete,
                    "submenu": []
                };

                angular.forEach(value.menu,function(item,key){
                    temp.submenu.push({
                        "text": item.name,
                        "sref": "app."+value.name+"."+item.route,
                        'disable': !SchoolDataService.school.setup_complete
                    });
                });

                this.push(temp);
            },$scope.menuItems);

            $scope.menuItems.push( {
                "text": "Settings",
                "sref": "app.settings",
                "icon": "fa fa-gears"
            });

        };

        $scope.loadSidebarMenu();

        $scope.$on('refreshSchoolDataComplete',function(){
            modules = SchoolDataService.school.loaded_modules;
            $scope.loadSidebarMenu();
        });

        // Handle sidebar collapse items
        // -----------------------------------

        $scope.addCollapse = function ($index, item) {
            collapseList[$index] = $rootScope.app.layout.asideHover ? true : !isActive(item);
        };

        $scope.isCollapse = function ($index) {
            return (collapseList[$index]);
        };

        $scope.toggleCollapse = function ($index, isParentItem) {


            // collapsed sidebar doesn't toggle drodopwn
            if (Utils.isSidebarCollapsed() || $rootScope.app.layout.asideHover) return true;

            // make sure the item index exists
            if (angular.isDefined(collapseList[$index])) {
                if (!$scope.lastEventFromChild) {
                    collapseList[$index] = !collapseList[$index];
                    closeAllBut($index);
                }
            }
            else if (isParentItem) {
                closeAllBut(-1);
            }

            $scope.lastEventFromChild = isChild($index);

            return true;

        };

        function closeAllBut(index) {
            index += '';
            for (var i in collapseList) {
                if (index < 0 || index.indexOf(i) < 0)
                    collapseList[i] = true;
            }
        }

        function isChild($index) {
            return (typeof $index === 'string') && !($index.indexOf('-') < 0);
        }

    }]);

/**=========================================================
 * Module: navbar-search.js
 * Navbar search toggler * Auto dismiss on ESC key
 =========================================================*/

App.directive('searchOpen', ['navSearch', function (navSearch) {
    'use strict';

    return {
        restrict: 'A',
        controller: ["$scope", "$element", function ($scope, $element) {
            $element
                .on('click', function (e) {
                    e.stopPropagation();
                })
                .on('click', navSearch.toggle);
        }]
    };

}]).directive('searchDismiss', ['navSearch', function (navSearch) {
    'use strict';

    var inputSelector = '.navbar-form input[type="text"]';

    return {
        restrict: 'A',
        controller: ["$scope", "$element", function ($scope, $element) {

            $(inputSelector)
                .on('click', function (e) {
                    e.stopPropagation();
                })
                .on('keyup', function (e) {
                    if (e.keyCode == 27) // ESC
                        navSearch.dismiss();
                });

            // click anywhere closes the search
            $(document).on('click', navSearch.dismiss);
            // dismissable options
            $element
                .on('click', function (e) {
                    e.stopPropagation();
                })
                .on('click', navSearch.dismiss);
        }]
    };

}]);


/**=========================================================
 * Module: sidebar.js
 * Wraps the sidebar and handles collapsed state
 =========================================================*/

App.directive('sidebar', ['$rootScope', '$window', 'Utils', function ($rootScope, $window, Utils) {

    var $win = $($window);
    var $body = $('body');
    var $scope;
    var $sidebar;
    var currentState = $rootScope.$state.current.name;

    return {
        restrict: 'EA',
        template: '<nav class="sidebar" ng-transclude></nav>',
        transclude: true,
        replace: true,
        link: function (scope, element, attrs) {

            $scope = scope;
            $sidebar = element;

            var eventName = Utils.isTouch() ? 'click' : 'mouseenter';
            var subNav = $();
            $sidebar.on(eventName, '.nav > li', function () {

                if (Utils.isSidebarCollapsed() || $rootScope.app.layout.asideHover) {

                    subNav.trigger('mouseleave');
                    subNav = toggleMenuItem($(this));

                    // Used to detect click and touch events outside the sidebar
                    sidebarAddBackdrop();

                }

            });

            scope.$on('closeSidebarMenu', function () {
                removeFloatingNav();
            });

            // Normalize state when resize to mobile
            $win.on('resize', function () {
                if (!Utils.isMobile())
                    $body.removeClass('aside-toggled');
            });

            // Adjustment on route changes
            $rootScope.$on('$stateChangeStart', function (event, toState, toParams, fromState, fromParams) {
                currentState = toState.name;
                // Hide sidebar automatically on mobile
                $('body.aside-toggled').removeClass('aside-toggled');

                $rootScope.$broadcast('closeSidebarMenu');
            });

        }
    };

    function sidebarAddBackdrop() {
        var $backdrop = $('<div/>', {'class': 'dropdown-backdrop'});
        $backdrop.insertAfter('.aside-inner').on("click mouseenter", function () {
            removeFloatingNav();
        });
    }

    // Open the collapse sidebar submenu items when on touch devices
    // - desktop only opens on hover
    function toggleTouchItem($element) {
        $element
            .siblings('li')
            .removeClass('open')
            .end()
            .toggleClass('open');
    }

    // Handles hover to open items under collapsed menu
    // -----------------------------------
    function toggleMenuItem($listItem) {

        removeFloatingNav();

        var ul = $listItem.children('ul');

        if (!ul.length) return $();
        if ($listItem.hasClass('open')) {
            toggleTouchItem($listItem);
            return $();
        }

        var $aside = $('.aside');
        var $asideInner = $('.aside-inner'); // for top offset calculation
        // float aside uses extra padding on aside
        var mar = parseInt($asideInner.css('padding-top'), 0) + parseInt($aside.css('padding-top'), 0);
        var subNav = ul.clone().appendTo($aside);

        toggleTouchItem($listItem);

        var itemTop = ($listItem.position().top + mar) - $sidebar.scrollTop();
        var vwHeight = $win.height();

        subNav
            .addClass('nav-floating')
            .css({
                position: $scope.app.layout.isFixed ? 'fixed' : 'absolute',
                top: itemTop,
                bottom: (subNav.outerHeight(true) + itemTop > vwHeight) ? 0 : 'auto'
            });

        subNav.on('mouseleave', function () {
            toggleTouchItem($listItem);
            subNav.remove();
        });

        return subNav;
    }

    function removeFloatingNav() {
        $('.dropdown-backdrop').remove();
        $('.sidebar-subnav.nav-floating').remove();
        $('.sidebar li.open').removeClass('open');
    }

}]);
/**=========================================================
 * Module: toggle-state.js
 * Toggle a classname from the BODY Useful to change a state that
 * affects globally the entire layout or more than one item
 * Targeted elements must have [toggle-state="CLASS-NAME-TO-TOGGLE"]
 * User no-persist to avoid saving the sate in browser storage
 =========================================================*/

App.directive('toggleState', ['toggleStateService', function (toggle) {
    'use strict';

    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            var $body = $('body');

            $(element)
                .on('click', function (e) {
                    e.preventDefault();
                    var classname = attrs.toggleState;

                    if (classname) {
                        if ($body.hasClass(classname)) {
                            $body.removeClass(classname);
                            if (!attrs.noPersist)
                                toggle.removeState(classname);
                        }
                        else {
                            $body.addClass(classname);
                            if (!attrs.noPersist)
                                toggle.addState(classname);
                        }

                    }

                });
        }
    };

}]);

/**=========================================================
 * Module: browser.js
 * Browser detection
 =========================================================*/

App.service('browser', function () {
    "use strict";

    var matched, browser;

    var uaMatch = function (ua) {
        ua = ua.toLowerCase();

        var match = /(opr)[\/]([\w.]+)/.exec(ua) ||
            /(chrome)[ \/]([\w.]+)/.exec(ua) ||
            /(version)[ \/]([\w.]+).*(safari)[ \/]([\w.]+)/.exec(ua) ||
            /(webkit)[ \/]([\w.]+)/.exec(ua) ||
            /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
            /(msie) ([\w.]+)/.exec(ua) ||
            ua.indexOf("trident") >= 0 && /(rv)(?::| )([\w.]+)/.exec(ua) ||
            ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) ||
            [];

        var platform_match = /(ipad)/.exec(ua) ||
            /(iphone)/.exec(ua) ||
            /(android)/.exec(ua) ||
            /(windows phone)/.exec(ua) ||
            /(win)/.exec(ua) ||
            /(mac)/.exec(ua) ||
            /(linux)/.exec(ua) ||
            /(cros)/i.exec(ua) ||
            [];

        return {
            browser: match[3] || match[1] || "",
            version: match[2] || "0",
            platform: platform_match[0] || ""
        };
    };

    matched = uaMatch(window.navigator.userAgent);
    browser = {};

    if (matched.browser) {
        browser[matched.browser] = true;
        browser.version = matched.version;
        browser.versionNumber = parseInt(matched.version);
    }

    if (matched.platform) {
        browser[matched.platform] = true;
    }

    // These are all considered mobile platforms, meaning they run a mobile browser
    if (browser.android || browser.ipad || browser.iphone || browser["windows phone"]) {
        browser.mobile = true;
    }

    // These are all considered desktop platforms, meaning they run a desktop browser
    if (browser.cros || browser.mac || browser.linux || browser.win) {
        browser.desktop = true;
    }

    // Chrome, Opera 15+ and Safari are webkit based browsers
    if (browser.chrome || browser.opr || browser.safari) {
        browser.webkit = true;
    }

    // IE11 has a new token so we will assign it msie to avoid breaking changes
    if (browser.rv) {
        var ie = "msie";

        matched.browser = ie;
        browser[ie] = true;
    }

    // Opera 15+ are identified as opr
    if (browser.opr) {
        var opera = "opera";

        matched.browser = opera;
        browser[opera] = true;
    }

    // Stock Android browsers are marked as Safari on Android.
    if (browser.safari && browser.android) {
        var android = "android";

        matched.browser = android;
        browser[android] = true;
    }

    // Assign the name and platform variable
    browser.name = matched.browser;
    browser.platform = matched.platform;


    return browser;

});
/**=========================================================
 * Module: colors.js
 * Services to retrieve global colors
 =========================================================*/

App.factory('colors', ['APP_COLORS', function (colors) {

    return {
        byName: function (name) {
            return (colors[name] || '#fff');
        }
    };

}]);

/**=========================================================
 * Module: nav-search.js
 * Services to share navbar search functions
 =========================================================*/

App.service('navSearch', function () {
    var navbarFormSelector = 'form.navbar-form';
    return {
        toggle: function () {

            var navbarForm = $(navbarFormSelector);

            navbarForm.toggleClass('open');

            var isOpen = navbarForm.hasClass('open');

            navbarForm.find('input')[isOpen ? 'focus' : 'blur']();

        },

        dismiss: function () {
            $(navbarFormSelector)
                .removeClass('open')      // Close control
                .find('input[type="text"]').blur() // remove focus
                .val('')                    // Empty input
            ;
        }
    };

});
/**=========================================================
 * Module: helpers.js
 * Provides helper functions for routes definition
 =========================================================*/

App.provider('RouteHelpers', ['APP_REQUIRES', function (appRequires) {
    "use strict";

    // Set here the base of the relative path
    // for all app views
    this.basepath = function (uri) {
        return '/framework/app/views/' + uri;
    };

    // Generates a resolve object by passing script names
    // previously configured in constant.APP_REQUIRES
    this.resolveFor = function () {
        var _args = arguments;
        return {
            deps: ['$ocLazyLoad', '$q', function ($ocLL, $q) {
                // Creates a promise chain for each argument
                var promise = $q.when(1); // empty promise
                for (var i = 0, len = _args.length; i < len; i++) {
                    promise = andThen(_args[i]);
                }
                return promise;

                // creates promise to chain dynamically
                function andThen(_arg) {
                    // also support a function that returns a promise
                    if (typeof _arg == 'function')
                        return promise.then(_arg);
                    else
                        return promise.then(function () {
                            // if is a module, pass the name. If not, pass the array
                            var whatToLoad = getRequired(_arg);
                            // simple error check
                            if (!whatToLoad) return $.error('Route resolve: Bad resource name [' + _arg + ']');
                            // finally, return a promise
                            return $ocLL.load(whatToLoad);
                        });
                }

                // check and returns required data
                // analyze module items with the form [name: '', files: []]
                // and also simple array of script files (for not angular js)
                function getRequired(name) {
                    if (appRequires.modules)
                        for (var m in appRequires.modules)
                            if (appRequires.modules[m].name && appRequires.modules[m].name === name)
                                return appRequires.modules[m];
                    return appRequires.scripts && appRequires.scripts[name];
                }

            }]
        };
    }; // resolveFor

    // not necessary, only used in config block for routes
    this.$get = function () {
    };

}]);


/**=========================================================
 * Module: toggle-state.js
 * Services to share toggle state functionality
 =========================================================*/

App.service('toggleStateService', ['$rootScope', function ($rootScope) {

    var storageKeyName = 'toggleState';

    // Helper object to check for words in a phrase //
    var WordChecker = {
        hasWord: function (phrase, word) {
            return new RegExp('(^|\\s)' + word + '(\\s|$)').test(phrase);
        },
        addWord: function (phrase, word) {
            if (!this.hasWord(phrase, word)) {
                return (phrase + (phrase ? ' ' : '') + word);
            }
        },
        removeWord: function (phrase, word) {
            if (this.hasWord(phrase, word)) {
                return phrase.replace(new RegExp('(^|\\s)*' + word + '(\\s|$)*', 'g'), '');
            }
        }
    };

    // Return service public methods
    return {
        // Add a state to the browser storage to be restored later
        addState: function (classname) {
            var data = angular.fromJson($rootScope.$storage[storageKeyName]);

            if (!data) {
                data = classname;
            }
            else {
                data = WordChecker.addWord(data, classname);
            }

            $rootScope.$storage[storageKeyName] = angular.toJson(data);
        },

        // Remove a state from the browser storage
        removeState: function (classname) {
            var data = $rootScope.$storage[storageKeyName];
            // nothing to remove
            if (!data) return;

            data = WordChecker.removeWord(data, classname);

            $rootScope.$storage[storageKeyName] = angular.toJson(data);
        },

        // Load the state string and restore the classlist
        restoreState: function ($elem) {
            var data = angular.fromJson($rootScope.$storage[storageKeyName]);

            // nothing to restore
            if (!data) return;
            $elem.addClass(data);
        }

    };

}]);
/**=========================================================
 * Module: utils.js
 * Utility library to use across the theme
 =========================================================*/

App.service('Utils', ["$window", "APP_MEDIAQUERY", function ($window, APP_MEDIAQUERY) {
    'use strict';

    var $html = angular.element("html"),
        $win = angular.element($window),
        $body = angular.element('body');

    return {
        // DETECTION
        support: {
            transition: (function () {
                var transitionEnd = (function () {

                    var element = document.body || document.documentElement,
                        transEndEventNames = {
                            WebkitTransition: 'webkitTransitionEnd',
                            MozTransition: 'transitionend',
                            OTransition: 'oTransitionEnd otransitionend',
                            transition: 'transitionend'
                        }, name;

                    for (name in transEndEventNames) {
                        if (element.style[name] !== undefined) return transEndEventNames[name];
                    }
                }());

                return transitionEnd && {end: transitionEnd};
            })(),
            animation: (function () {

                var animationEnd = (function () {

                    var element = document.body || document.documentElement,
                        animEndEventNames = {
                            WebkitAnimation: 'webkitAnimationEnd',
                            MozAnimation: 'animationend',
                            OAnimation: 'oAnimationEnd oanimationend',
                            animation: 'animationend'
                        }, name;

                    for (name in animEndEventNames) {
                        if (element.style[name] !== undefined) return animEndEventNames[name];
                    }
                }());

                return animationEnd && {end: animationEnd};
            })(),
            requestAnimationFrame: window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            function (callback) {
                window.setTimeout(callback, 1000 / 60);
            },
            touch: (
            ('ontouchstart' in window && navigator.userAgent.toLowerCase().match(/mobile|tablet/)) ||
            (window.DocumentTouch && document instanceof window.DocumentTouch) ||
            (window.navigator['msPointerEnabled'] && window.navigator['msMaxTouchPoints'] > 0) || //IE 10
            (window.navigator['pointerEnabled'] && window.navigator['maxTouchPoints'] > 0) || //IE >=11
            false
            ),
            mutationobserver: (window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver || null)
        },
        // UTILITIES
        isInView: function (element, options) {

            var $element = $(element);

            if (!$element.is(':visible')) {
                return false;
            }

            var window_left = $win.scrollLeft(),
                window_top = $win.scrollTop(),
                offset = $element.offset(),
                left = offset.left,
                top = offset.top;

            options = $.extend({topoffset: 0, leftoffset: 0}, options);

            if (top + $element.height() >= window_top && top - options.topoffset <= window_top + $win.height() &&
                left + $element.width() >= window_left && left - options.leftoffset <= window_left + $win.width()) {
                return true;
            } else {
                return false;
            }
        },
        langdirection: $html.attr("dir") == "rtl" ? "right" : "left",
        isTouch: function () {
            return $html.hasClass('touch');
        },
        isSidebarCollapsed: function () {
            return $body.hasClass('aside-collapsed');
        },
        isSidebarToggled: function () {
            return $body.hasClass('aside-toggled');
        },
        isMobile: function () {
            return $win.width() < APP_MEDIAQUERY.tablet;
        }
    };
}]);
// To run this code, edit file
// index.html or index.jade and change
// html data-ng-app attribute from
// SchoolAdminApp to myAppName
// -----------------------------------

var myAppRoutes = angular.module('SchoolAdminApp');

myAppRoutes.config(['$stateProvider', '$locationProvider', '$urlRouterProvider', 'RouteHelpersProvider', 'ViewBaseURL',
    function ($stateProvider, $locationProvider, $urlRouterProvider, helper, ViewBaseURL) {
        'use strict';

        // Set the following to true to enable the HTML5 Mode
        // You may have to set <base> tag in index and a routing configuration in your server
        $locationProvider.html5Mode(false);

        // default route
        $urlRouterProvider.otherwise('/app/home');

        //
        // Application Routes
        // -----------------------------------

        $stateProvider
            .state('app', {
                url: '/app',
                abstract: true,
                templateUrl: ViewBaseURL + '/ui/app',
                controller: 'AppController',
                resolve: helper.resolveFor('modernizr', 'icons','toaster','ngDialog','parsley')
            })
            .state('app.home',
            {
                url: '/home',
                templateUrl: ViewBaseURL + '/home',
                resolve: helper.resolveFor('toaster','slimscroll'),
                title: 'School Dashboard',
                controller: 'HomeController'
            })
            .state('app.viewClassArm',
            {
                url: '/class/:id',
                templateUrl: ViewBaseURL + '/pages/school_class',
                title: 'Class Dashboard',
                controller: ['$scope',
                    function ($scope) {
                    }
                ]
            })
            .state('app.settings',
            {
                url: '/settings',
                templateUrl: ViewBaseURL + '/settings/index',
                title: 'Settings',
                resolve: helper.resolveFor('xeditable','toaster','inputmask','taginput','filestyle','slimscroll'),
                controller: ['$scope','editableOptions', 'editableThemes',
                    function ($scope,editableOptions, editableThemes) {
                        //template start
                        editableOptions.theme = 'bs3';
                        editableThemes.bs3.inputClass = 'input-xs';
                        editableThemes.bs3.buttonsClass = 'btn-sm';
                        editableThemes.bs3.submitTpl = '<button type="submit" class="btn btn-success"><span class="fa fa-check"></span></button>';
                        editableThemes.bs3.cancelTpl = '<button type="button" class="btn btn-default" ng-click="$form.$cancel()">' +
                        '<span class="fa fa-times text-muted"></span>' +
                        '</button>';
                    }
                ]
            })
            .state('app.settings.session_term',
            {
                url: '/session_term',
                templateUrl: ViewBaseURL + '/settings/session_term',
                title: 'Session & Term Settings',
                controller: 'SettingsSessionTermController'
            })
            .state('app.settings.students',
            {
                url: '/students',
                templateUrl: ViewBaseURL + '/settings/students',
                title: 'Students Settings',
                controller: 'SettingsStudentsController'
            })
            .state('app.settings.school',
            {
                url: '/school',
                templateUrl: ViewBaseURL + '/settings/school',
                title: 'School Settings',
                controller: 'SettingsSchoolController'
            })
            .state('app.settings.staff',
            {
                url: '/staff',
                templateUrl: ViewBaseURL + '/settings/staff',
                title: 'Staff Settings',
                controller: 'SettingsStaffController'
            })
            .state('app.settings.classes',
            {
                url: '/classes',
                templateUrl: ViewBaseURL + '/settings/class',
                title: 'Classes Settings',
                controller: 'SettingsClassesController'
            })
            .state('app.settings.courses',
            {
                url: '/courses',
                templateUrl: ViewBaseURL + '/settings/courses',
                title: 'Courses Settings',
                controller: 'SettingsCoursesController'
            })
            .state('app.settings.academics',
            {
                url: '/academics',
                templateUrl: ViewBaseURL + '/settings/academics',
                title: 'Academics Settings',
                controller: 'SettingsAcademicsController'
            })
            .state('app.settings.reports',
            {
                url: '/reports',
                templateUrl: ViewBaseURL + '/settings/reports',
                title: 'Reports Settings',
                controller: 'SettingsReportController'
            })
            .state('app.settings.financials',
            {
                url: '/financial',
                templateUrl: ViewBaseURL + '/settings/financials',
                title: 'Financial Settings',
                controller: 'SettingsFinancialController'
            })
            .state('app.settings.notifications',
            {
                url: '/notifications',
                templateUrl: ViewBaseURL + '/settings/notifications',
                title: 'Notification Settings',
                controller: 'SettingsNotificationController'
            })
            .state('app.settings.administrators',
            {
                url: '/administrators',
                templateUrl: ViewBaseURL + '/settings/administrators',
                title: 'Administrators Settings',
                controller: 'SettingsAdministratorsController'
            });
}]);
App.factory('SchoolService', ['$resource', function ($resource) {
    return $resource('/admin/resources/school/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'updateFirstTimeLoginState': {method: 'PUT', params: {'action': 'update_first_time_login_state'}}
    });
}]);

App.factory('SchoolProfileService', ['$resource', function ($resource) {
    return $resource('/admin/resources/school-profile/:id', {id: '@id'});
}]);



//
App.factory('CategoryClassSettingsService', ['$resource', function ($resource) {
    return $resource('/admin/resources/category-class-settings/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'addCategory': {method: 'POST',params: {'action': 'school_category'}},
        'updateCategory': {method: 'PUT',params: {'action': 'school_category'}},
        'addCategoryArm': {method: 'POST',params: {'action': 'school_category_arms'}},
        'updateCategoryArm': {method: 'PUT',params: {'action': 'school_category_arms'}},
        'addCategoryArmSubDivision': {method: 'POST',params: {'action': 'school_category_arm_subarms'}},
        'updateCategoryArmSubDivision': {method: 'PUT',params: {'action': 'school_category_arm_subarms'}},
        'removeCategory': {method: 'DELETE',params: {'action': 'school_category'}},
        'removeCategoryArm': {method: 'DELETE',params: {'action': 'school_category_arms'}},
        'removeCategoryArmSubDivision': {method: 'DELETE',params: {'action': 'school_category_arm_subarms'}},
        'removeAllCategoryArmSubDivisions': {method: 'DELETE',params: {'action': 'remove_all_school_category_arm_subarms'}},
        'getAssignedGradingSystem': {method: 'GET',params: {'action': 'assignGradingSystem'}}
    });
}]);

App.factory('GradingSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/grading-systems/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'assignGradingSystem': {method: 'POST',params: {'action': 'assignGradingSystem'}},
        'assignGradingSystemToClass': {method: 'PUT',params: {'action': 'assignGradingSystemToClass'}},
        'getAssignedGradingSystem': {method: 'GET',params: {'action': 'assignGradingSystem'}}
    });
}]);

//
App.factory('CoursesSettingsService', ['$resource', function ($resource) {
    return $resource('/admin/resources/courses-settings/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'assignCourse': {method: 'PUT',params: {'action': 'assign_course'}},
        'getCourseCategory': {method: 'GET',params: {'action': 'add_course_category'},'isArray': true},
        'addCourseCategory': {method: 'POST',params: {'action': 'add_course_category'}},
        'removeCourseCategory': {method: 'DELETE',params: {'action': 'add_course_category'}}
    });
}]);

App.factory('StaffService', ['$resource', function ($resource) {
    return $resource('/admin/resources/staff-settings/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'assign_courses': {method: 'PUT',params: {'action': 'action_assign_course'}},
        'assign_classes': {method: 'PUT',params: {'action': 'action_assign_class'}}
    });
}]);


App.factory('GradeAssessmentSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/grade-assessment-systems/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'assignGradeAssessmentSystem': {method: 'POST',params: {'action': 'assignGradeAssessmentSystem'}},
        'assignGradeAssessmentSystemToClass': {method: 'PUT',params: {'action': 'assignGradeAssessmentSystemToClass'}},
        'getAssignedGradeAssessmentSystem': {method: 'GET',params: {'action': 'assignGradeAssessmentSystem'}}
    });
}]);

App.factory('BehaviourSkillSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/behaviour-skill-systems/:id',
        {id: '@id'}, {
            'update': {method: 'PUT'},
            'getAssignedBehaviourSkillSystem': {method: 'GET',params: {'action': 'assignBehaviourSkillSystem'}},
            'assignBehaviourSkillSystemToClass': {method: 'PUT',params: {'action': 'assignBehaviourSkillSystemToClass'}},
            'assignBehaviourSkillSystem': {method: 'POST',params: {'action': 'assignBehaviourSkillSystem'}}
        });
}]);

App.factory('BehaviourAssessmentSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/behaviour-skill-system/:behaviourSkillSystemId/behaviour-assessment-systems/:id',
                {id: '@id',behaviourSkillSystemId: '@scoped_behaviour_skill_system_id'}, {
        'update': {method: 'PUT'}
    });
}]);

App.factory('SkillAssessmentSystemService', ['$resource', function ($resource) {
    return $resource('/admin/resources/behaviour-skill-system/:behaviourSkillSystemId/skill-assessment-systems/:id',
                {id: '@id',behaviourSkillSystemId: '@scoped_behaviour_skill_system_id'}, {
        'update': {method: 'PUT'}
    });
}]);

App.factory('SessionTermsSettingsService', ['$resource', function ($resource) {
    return $resource('/admin/resources/sessions-terms-settings/:id', {id: '@id'}, {
        'update': {method: 'PUT'},
        'saveSubSessionDates': {method: 'POST',params: {'action': 'sub_session_start_and_end_dates'}},
        'addSubSession': {method: 'POST',params: {'action': 'add_sub_session'}},
        'removeSubSession': {method: 'DELETE',params: {'action': 'add_sub_session'}}
    });
}]);

App.service('TableDataService', ['SchoolDataService', function (SchoolDataService) {

    var TableData = {
        cache: SchoolDataService.schools,
        getData: function ($defer, params) {

            filterdata($defer, params);

            function filterdata($defer, params) {
                var from = (params.page() - 1) * params.count();
                var to = params.page() * params.count();
                var filteredData = TableData.cache.slice(from, to);

                params.total(TableData.cache.length);
                $defer.resolve(filteredData);
            }

        }
    };

    return TableData;

}]);

App.factory('SchoolContextService', ['$rootScope', function ($rootScope) {
    var context = {
        'school_category': 'all',
        'category_level': 'all',
        'level_class': 'all'
    };

    return {
        setContext: function(newContext){
            context = newContext;
            $rootScope.$broadcast('SCHOOL_CONTEXT_CHANGED',newContext);
        },
        getContext: function(){
            return context;
        }
    }
}]);
/**
 * Created by Ak on 4/28/2015.
 */


App.controller('AddSessionDialogController',['$scope','SessionTermsSettingsService','toaster',
    function ($scope,SessionTermsSettingsService,toaster) {
        var last_year = 2014;
        var next_year = 2015;

        $scope.current = {
            loading: false,
            saving: false,
            current_session: ""+ last_year+ "/" +next_year
        };

        $scope.nextSession = function (current) {
            current.current_session = calculateNextSession();
        };

        $scope.lastSession = function (current) {
            current.current_session = calculateLastSession();
        };


        var calculateNextSession = function () {
            last_year += 1;
            next_year += 1;

            return ""+ last_year+ "/" +next_year;
        };

        var calculateLastSession = function () {
            last_year -= 1;
            next_year -= 1;

            return ""+ last_year+ "/" +next_year;
        };


        $scope.saveCurrentSessionTerm = function (current,callback) {
            current.saving = true;
            SessionTermsSettingsService.save(current, function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "Current Session & Term", "Changes Saved Succesfully");
                current.saving = false;
                $scope.$emit('refreshSchoolData');
                callback();
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "Current Session & Term", "Failed to save changes, Try Again");
                current.saving = false;
            });
        };
    }]
);
/* global App */
/**
 * Created by Ak on 4/7/2015.
 */

App.controller('HomeController',['$scope','SchoolDataService','$window','$rootScope','SchoolService','toaster',
    function ($scope,SchoolDataService,$window,$rootScope,SchoolService,toaster) {
        $scope.school = SchoolDataService.school;
        $scope.updatingFirstTimeLogin = false;
        console.log($scope.school);

        $rootScope.$on('SCHOOL_CONTEXT_CHANGED',function(event,obj){
            console.log('I hear ya @ HomeController');
        });
        
        $scope.updateFirstTimeLoginState = function(){
            $scope.updatingFirstTimeLogin = true;
            SchoolService.updateFirstTimeLoginState({id: $scope.school.id},{}).$promise.then(function(){
                $scope.$emit('refreshSchoolData'); 
            },function(){
                toaster.pop('error', "School Status Update", "Failed Saving changes");
                $scope.updatingFirstTimeLogin = false;
            });
        };

        $scope.$on('refreshSchoolDataComplete',function(){
            $scope.school = SchoolDataService.school;
        });
    }]
);


/// <reference path="../../../../../typings/angularjs/angular.d.ts"/>
var app = angular.module('SchoolAdminApp');
/**
 * Controllers
 *
 */

app.controller('NavBarController', [
        '$scope', '$rootScope', 'SchoolDataService','SchoolContextService','$parse',
        function ($scope, $rootScope, SchoolDataService,SchoolContextService,$parse) {
            var context = {
                'school_category': 'all',
                'category_level': 'all',
                'level_class': 'all'
            };

            var allSchoolCategories =  {display_name: 'All',name: 'all',id: null};
            var tempSchoolCategories =  JSON.parse(JSON.stringify(SchoolDataService.school.school_type.school_categories));
            tempSchoolCategories.push(allSchoolCategories);
            
            $scope.schoolCategories =  tempSchoolCategories;
            $scope.selectedSchoolCategory = allSchoolCategories; //$scope.schoolCategories[0];
            $scope.classItems = {
                submenu: $scope.selectedSchoolCategory.school_category_arms
                //,selected: $scope.selectedSchoolCategory.school_category_arms[0]
            };

            $scope.prepareAllSchoolCategory = function ($event){
                    $scope.selectedSchoolCategory = null;
                    $event.preventDefault();
            };

            $scope.prepareSchoolCategory = function ($event, category) {
                $scope.selectedSchoolCategory = category;
                $event.preventDefault();
            };

            $scope.prepareSchoolLevel = function ($event, level) {
                $scope.classItems.selected = level;
                $event.preventDefault();
            };


            $scope.$watch('selectedSchoolCategory', function (newV, oldV) {
                console.log('selectedSchoolCategoryChanged event');
                $rootScope.$broadcast('selectedSchoolCategoryChanged', {value: newV});
                console.log('selectedSchoolCategoryChanged raised');
            });


            $rootScope.$on('selectedSchoolCategoryChanged', function (event, obj) {
                console.log('event selectedSchoolCat received');

                if (angular.isDefined($scope.classItems) && angular.isDefined(obj.value) && obj.value !== null) {
                    $scope.classItems.submenu = obj.value.school_category_arms;
                    //$scope.classItems.selected = obj.value.school_category_arms[0];
                    context.school_category = obj.value;
                    //context.category_level = obj.value.school_category_arms[0];
                    SchoolContextService.setContext(context);
                }else{
                    SchoolContextService.setContext(null);
                }
            });
        }]
);


/**-------------------------------------------------------------------------------
 * Settings Controllers Start
 * -----------------------------------------------------------------------------
 */

/**
 * Session and Term Settings Controller
 */
app.controller('SettingsSessionTermController', ['$scope', 'SchoolDataService','SessionTermsSettingsService','toaster',
    function ($scope, SchoolDataService,SessionTermsSettingsService,toaster) {
        $scope.sessions = getSessionsFrom(SchoolDataService);
        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.current = {loading: true,saving: false};

        SessionTermsSettingsService.get({},function(response){
            $scope.current = response;
            $scope.loading = false;
            $scope.saving = false;

        },function(error){
                $scope.loading = false;
                toaster.pop('error', "Current Session & Term", "Failed to Load Current Session & Term, Try Again");
        });


        $scope.saveCurrentSessionTerm = function(current){
            current.saving = true;
            SessionTermsSettingsService.save(current,function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "Current Session & Term", "Changes Saved Succesfully");
                current.saving = false;
                $scope.$emit('refreshSchoolData');
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "Current Session & Term", "Failed to save changes, Try Again");
                current.saving = false;
            });
        };

        $scope.saveSubSessionsDate = function(subSessions){
            subSessions.saving = true;
            SessionTermsSettingsService.saveSubSessionDates({'sub_sessions': subSessions}).$promise.then(function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "Term Start & End Date", "Changes Saved Succesfully");
                subSessions.saving = false;
                $scope.$emit('refreshSchoolData');
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "Term Start & End Date", "Failed to save changes, Try Again");
                subSessions.saving = false;
            });
        };


        $scope.addNewTerm = function(term){
            var callback  = function(){
                $scope.onAddTerm = false;
                $scope.term.name = null;
            };

            term.saving = true;
            //addSubSession
            SessionTermsSettingsService.addSubSession(term).$promise.then(function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "Manage Term", "Saved Succesfully");
                term.saving = false;
                $scope.sub_sessions = response.all;
                callback();
                $scope.$emit('refreshSchoolData');
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "Manage Term", "Failed to save, Try Again");
                term.saving = false;
            });
        };

        $scope.removeTerm = function(term){
            term.saving = true;
            SessionTermsSettingsService.removeSubSession({id: term.id}, term).$promise.then(function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "Manage Term", "Removed Succesfully");
                term.saving = false;
                $scope.sub_sessions = response.all;
                $scope.$emit('refreshSchoolData');
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "Manage Term", "Failed to remove, Try Again");
                term.saving = false;
            });
        };


        $scope.$on('refreshSchoolDataComplete',function(){
            $scope.sessions = getSessionsFrom(SchoolDataService);
            $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        });

        function getSessionsFrom(SchoolDataService) {
            return SchoolDataService.school.sessions.sort(function (a, b) {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        };

        $scope.openStartDate = function($event,sub_session){
            $event.stopPropagation();
            $event.preventDefault();
            sub_session.startDateOpened = true;
        };

        $scope.openEndDate = function($event,sub_session){
            $event.stopPropagation();
            $event.preventDefault();
            sub_session.endDateOpened = true;
        };
    }
]);

/**
 * Students Settings Controller
 */

app.controller('SettingsStudentsController', ['$scope', 'SchoolDataService',
    function ($scope, SchoolDataService) {
        $scope.sessions = getSessionsFrom(SchoolDataService);
        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.form = {
            school_category: null
        };


        function getSessionsFrom(SchoolDataService) {
            return SchoolDataService.school.sessions.sort(function (a, b) {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        }
    }
]);

/**
 * School Settings Controller
 *
 */

app.controller('SettingsSchoolController', ['$scope', 'SchoolDataService','SchoolProfileService','toaster',
    function ($scope, SchoolDataService, SchoolProfileService,toaster) {

        $scope.school = SchoolDataService.school;
        $scope.school.school_profile = $scope.school.school_profile || {};
        $scope.school.school_profile.name = $scope.school.name;

        if(angular.isUndefined($scope.school.school_profile.logo) || $scope.school.school_profile.logo === null){
            $scope.school.school_profile.logo = {dataURL: '/img/placeholder.jpg'};
        }

        $scope.saveSchoolProfile = function(school) {
            school.saving = true;
            SchoolProfileService.save(school,function(data){
                console.log('success');
                school.saving = false;
                toaster.pop('success', "School Profile", "Changes Saved Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(data){
                school.saving = false;
                console.log('failure');
                toaster.pop('error', "School Profile", "Failed Saving Changes");
            });
        };


        $scope.$on('refreshSchoolDataComplete',function(event){
            $scope.school = SchoolDataService.school;
            $scope.school.school_profile = $scope.school.school_profile || {};
            $scope.school.school_profile.name = $scope.school.name;
        });
    }
]);

/**
 * Staff Settings Controller
 */


app.controller('SettingsStaffController', [
    '$scope', 'SchoolDataService','StaffService','toaster','CoursesSettingsService',
    function ($scope, SchoolDataService,StaffService,toaster,CoursesSettingsService) {
        $scope.classes = SchoolDataService.school.school_type.classes;
        $scope.classes.selected = $scope.classes[0];

        $scope.staffs = {loading: true};

        StaffService.query({},function(response){
            $scope.staffs.loading = true;
            $scope.staffs = response;

        },function(data){
            $scope.staffs.loading = false;
        });

        $scope.courses = {loading: true};

        CoursesSettingsService.query({},function(response){

            $scope.courses.loading = false;
            $scope.courses = response;
            $scope.courses.selected = response[0];

        },function(err){
            $scope.courses.loading = false;
        });

        $scope.currentStaff = null;

        $scope.selectCourse = function(event,course,courses){
            courses.selected = course;
            event.preventDefault();
        };

        $scope.selectClass = function(event,arm,classes){
            classes.selected = arm;
            event.preventDefault();
        };

        $scope.setCurrentStaff = function($event,staff){
            $scope.currentStaff = staff;
            $scope.currentStaff.assigned_courses = $scope.currentStaff.assigned_courses || [];
            $scope.currentStaff.assigned_classes = $scope.currentStaff.assigned_classes || [];
            $event.stopPropagation();
            $event.preventDefault();
        };

        $scope.saveStaff = function (staff) {
            console.log(staff);
            StaffService.save(staff,function(response){
                toaster.pop('success', "Add Staff", "Changes Saved Succesfully");
            },function(error){
                toaster.pop('error', "Add Staff", "failed to Save Changes");
            });
        };

        $scope.assignCourses = function (staff,courses){
            staff.saving  = true;
            StaffService.assign_courses({id: staff.id},{assigned_courses: courses}).$promise.then(function(response){
                staff.saving = false;
                staff  = response;
                toaster.pop('success', "Add Staff", "Changes Saved Succesfully");
            },function(error){
                staff.saving = false;
                toaster.pop('error', "Add Staff", "failed to Save Changes");
            });
        };

        $scope.assignClasses = function (staff,classes){
            staff.saving  = true;
            StaffService.assign_classes({id: staff.id},{assigned_classes: classes}).$promise.then(function(response){
                staff.saving = false;
                staff  = response;
                toaster.pop('success', "Add Staff", "Changes Saved Succesfully");
            },function(error){
                staff.saving = false;
                toaster.pop('error', "Add Staff", "failed to Save Changes");
            });
        };
    }
]);

/**
 * Classes Settings Controller
 */

app.controller('SettingsClassesController', ['$scope', 'SchoolDataService','CategoryClassSettingsService','toaster','editableThemes','editableOptions',
    function ($scope, SchoolDataService,CategoryClassSettingsService,toaster,editableThemes,editableOptions) {

        //template start
        editableOptions.theme = 'bs3';
        editableThemes.bs3.inputClass = 'input-xs';
        editableThemes.bs3.buttonsClass = 'btn-xs';
        editableThemes.bs3.submitTpl = '<button type="submit" class="btn btn-success" ng-click="updateSubArmName($data,arm)"><span class="fa fa-check"></span></button>';
        editableThemes.bs3.cancelTpl = '<button type="button" class="btn btn-default" ng-click="$form.$cancel()">' +
        '<span class="fa fa-times text-muted"></span>' +
        '</button>';

        $scope.school = SchoolDataService.school;

        $scope.removeSchoolCategory = function (school_type, indexToRemove) {
            var parcel =  school_type.school_categories[indexToRemove];
            console.log(school_type);
            parcel.saving = true;

            CategoryClassSettingsService.removeCategory({id: parcel.id}).$promise.then(function (response) {

                console.log('Saved Changes');
                parcel.saving = false;
                school_type.school_categories.splice(indexToRemove, 1);
                toaster.pop('success', "School Category", "Changes Saved Succesfully");
                $scope.$emit('refreshSchoolData');

            }, function (data) {

                console.log('could not save changes');
                parcel.saving = false;
                toaster.pop('error', "School Category", "Failed to save changes, Try Again");

            });

        };

        $scope.addSchoolCategory = function (school_type, school_category) {
            console.log(school_type);

            var parcel = {
                'school_type_id': school_type.id,
                'name': school_category.name
            };

            school_category.saving = true;

            CategoryClassSettingsService.addCategory(parcel).$promise.then(function (response) {

                console.log('Saved Changes');
                school_type.school_categories.splice(0,0,response.model);
                school_category.saving = false;
                school_category.name = '';
                toaster.pop('success', "School Category", "Changes Saved Succesfully");
                $scope.$emit('refreshSchoolData');

            }, function (data) {

                console.log('could not save changes');
                school_category.saving = false;
                toaster.pop('error', "School Category", "Failed to save changes, Try Again");

            });
        };

        $scope.createArmSubdivision = function(baseName, school_arm) {

            school_arm.school_category_arm_subdivisions = school_arm.school_category_arm_subdivisions || [];

            if(school_arm.school_category_arm_subdivisions.length === 1){
                school_arm.school_category_arm_subdivisions[0] = {
                    'name': baseName + '_' + indexToChar(1),
                    'display_name': baseName + ' ' + indexToChar(1)
                };
            }

            school_arm.school_category_arm_subdivisions.push({
                    'name': baseName + '_' + indexToChar(school_arm.school_category_arm_subdivisions.length + 1),
                    'display_name': baseName + ' ' + indexToChar(school_arm.school_category_arm_subdivisions.length + 1)
                }
            );

            //Ready to save newly added arms
            school_arm.can_save_subdivision_state = true;

            console.log($scope.school.school_type);
        };

        $scope.saveArmSubDivision = function(school_arm,index){
            var parcel = {
                'school_category_arm': school_arm
            };

            CategoryClassSettingsService.addCategoryArmSubDivision(parcel).$promise.then(function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "School Category", "Changes Saved Succesfully");
                $scope.$emit('refreshSchoolData');

                //Ready to save newly added arms
                school_arm.can_save_subdivision_state = false;
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "School Category", "Failed to save changes, Try Again");
            });
        };

        $scope.updateSubArmName  = function ($data,arm){
            arm.saving = true;
            var backup_previous_display_name = arm.display_name;

            arm.display_name = $data;

            CategoryClassSettingsService.updateCategoryArmSubDivision({id: arm.id},arm).$promise.then(function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "School Sub-Arm", "Changes Saved Succesfully");
                $scope.$emit('refreshSchoolData');

                arm.saving = false;

            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "School Sub-Arm", "Failed to save changes, Try Again");
                arm.saving = false;

                arm.display_name = backup_previous_display_name;

            });

            console.log($data);
            console.log(arm);
        };


        $scope.removeArmSubDivision = function (school_category_arm_subdivisions,index,arm){
            var parcel = school_category_arm_subdivisions[index];

            if(school_category_arm_subdivisions.length > 2) {
                CategoryClassSettingsService.removeCategoryArmSubDivision(parcel).$promise.then(function (response) {
                    console.log('Saved Changes');
                    school_category_arm_subdivisions.splice(index, 1);
                    toaster.pop('success', "School Category Arm Subdivision", "Changes Saved Succesfully");
                    $scope.$emit('refreshSchoolData');
                }, function (data) {
                    console.log('could not save changes');
                    toaster.pop('error', "School Category Arm Subdivision", "Failed to save changes, Try Again");
                });
            }else{
                CategoryClassSettingsService.removeAllCategoryArmSubDivisions({id: parcel.scoped_school_category_arm_id}).$promise.then(function (response) {
                    console.log('Saved Changes');
                    school_category_arm_subdivisions.splice(0, 2);
                    arm.has_subdivisions = false;
                    toaster.pop('success', "School Category Arm Subdivision", "Changes Saved Succesfully");
                }, function (data) {
                    console.log('could not save changes');
                    toaster.pop('error', "School Category Arm Subdivision", "Failed to save changes, Try Again");
                });
            }
        };

        $scope.removeArm = function (school_category_arms, index) {
            var parcel = school_category_arms[index];

            CategoryClassSettingsService.removeCategoryArm({id: parcel.id}).$promise.then(function (response) {
                console.log('Saved Changes');
                school_category_arms.splice(index, 1);
                toaster.pop('success', "School Category Arm", "Changes Saved Succesfully");
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "School Category Arm", "Failed to save changes, Try Again");
            });

        };

        $scope.addArm = function (school_category, school_category_name) {
            var parcel = {
                'school_category_id': school_category.id,
                'name': school_category_name
            };

            CategoryClassSettingsService.addCategoryArm(parcel).$promise.then(function (response) {
                console.log('Saved Changes');
                school_category.school_category_arms.push(response.model);
                toaster.pop('success', "School Category Arm", "Changes Saved Succesfully");
                $scope.$emit('refreshSchoolData');
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "School Category Arm", "Failed to save changes, Try Again");
            });
        };

        $scope.saveSchoolCategoryEditMode = function ($event, school_arm) {
            school_arm.edit = false;
            school_arm.updating = true;

            CategoryClassSettingsService.updateCategoryArm({id: school_arm.id},school_arm).$promise.then(function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "School Category Arm", "Changes Saved Successfully");
                $scope.$emit('refreshSchoolData');
                school_arm.updating = false;
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "School Category Arm", "Failed to save changes, Try Again");
                school_arm.updating = false;
            });

            $event.preventDefault();
            $event.stopProgation();
        };
        
        function indexToChar(index){
            var chars = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
            return chars[index-1];
        }

        $scope.$on('refreshSchoolDataComplete',function(event){
            $scope.school = SchoolDataService.school;
        });

    }
]);

/**

 Courses Settings Controller
 */

app.controller('SettingsCoursesController', ['$scope', 'SchoolDataService','CoursesSettingsService','toaster',
    function ($scope, SchoolDataService,CoursesSettingsService,toaster) {
        $scope.school_categories = SchoolDataService.getCourseCategories();
        $scope.courses = CoursesSettingsService.query();
        $scope.course_categories = CoursesSettingsService.getCourseCategory();

        $scope.unAssignCourses = function(school_category_id, assigned_courses,courses_to_unassign){
            console.log('unAssign Courses Called');
            var stateChanged = false;

            console.log(assigned_courses);

            angular.forEach(courses_to_unassign,function(value,key){
                console.log(value);
                if(inArray(assigned_courses,value)){
                    assigned_courses.pop(value);
                    stateChanged = true;
                }
            });

            if(stateChanged) {
                CoursesSettingsService.assignCourse(
                    {id: school_category_id},
                    {'assigned_courses': assigned_courses}).$promise.then(
                    function (response) {
                        toaster.pop('success', 'Course UnAssignment', 'UnAssigned Successfully');
                        $scope.$emit('refreshSchoolData');
                    }, function (response) {
                        toaster.pop('error', 'Course UnAssignment', 'Failed to UnAssign');
                    }
                );
            }


        };

        $scope.assignCourses = function(school_category_id, assigned_courses,courses_to_assign){
            console.log('Assign Courses Called');
            var stateChanged = false;
            assigned_courses = assigned_courses || [];

            console.log(assigned_courses);

            angular.forEach(courses_to_assign,function(value,key){
                console.log(value);
                if(!inArray(assigned_courses,value)){
                    assigned_courses.push(value);
                    stateChanged = true;
                }
            });

            if(stateChanged) {
                CoursesSettingsService.assignCourse(
                    {id: school_category_id},
                    {'assigned_courses': assigned_courses}).$promise.then(
                    function (response) {
                        toaster.pop('success', 'Course Assignment', 'Assigned Successfully');
                        $scope.$emit('refreshSchoolData');
                    }, function (response) {
                        toaster.pop('error', 'Course Assignment', 'Failed to Assign');
                    }
                );
            }


        };

        $scope.createCourseCategory = function(school_category_id,courseCategory){
            var parcel = {
                'name': courseCategory.name,
                'school_category_id': school_category_id
            };

            courseCategory.saving = true;

            CoursesSettingsService.addCourseCategory(parcel).$promise.then(function(response){
                courseCategory.saving = false;
                toaster.pop('success', 'Course Category','Added Successfully');
                $scope.$emit('refreshSchoolData');

                $scope.course_categories = response.all;
            },function(response){
                courseCategory.saving = false;
                toaster.pop('error','Course Category','Failed to Add');
            });
        };

        $scope.createCourse  = function(course){
            var parcel = {
                'name': course.name,
                'code': course.code,
                'course_category_id': course.course_category.id
            };

            course.saving = true;

            CoursesSettingsService.save(parcel,function(response){
                toaster.pop('success', 'Course','Added Successfully');
                course.saving = false;
                $scope.courses = response.all;
                $scope.$emit('refreshSchoolData');
                course = {};
            },function(response){
                toaster.pop('error','Course','Failed to Add');
                course.saving = false;
            });
        };

        $scope.$on('refreshSchoolDataComplete',function(event){
            $scope.school_categories = SchoolDataService.getCourseCategories();
        });

        function inArray(array,item){
            var response = false;

            if(angular.isArray(array) && array.length > 0) {
                console.log('looping');
                for (var i = 0; i < array.length; i++) {
                    if (array[i] === item) {
                        response = true;
                        break;
                    }
                }
            }
            console.log('inarray');
            console.log(response);

            return response;
        }
    }
]);

/**
 * Academics Settings Controller
 */

app.controller('SettingsAcademicsController',
    [ '$scope', 'GradingSystemService', 'GradeAssessmentSystemService','SchoolDataService','toaster',
       'BehaviourSkillSystemService', 'BehaviourAssessmentSystemService','SkillAssessmentSystemService',
    function ($scope, GradingSystemService, GradeAssessmentSystemService,SchoolDataService,toaster,
              BehaviourSkillSystemService, BehaviourAssessmentSystemService, SkillAssessmentSystemService) {

        //Grading Systems

        $scope.schoolCategories = SchoolDataService.school.school_type.school_categories;

        console.log( $scope.schoolCategories );

        $scope.assignedGradingSystem = GradingSystemService.getAssignedGradingSystem();

        
        $scope.gradingSystems = 
        {
            loading: true,
            data: [],
            empty: false,
            isAddingNewGradingSystem: false
        };

        GradingSystemService.query({},function(response){
            $scope.gradingSystems.loading = false;
            if(response.length > 0){
                 $scope.gradingSystems.data = response;
            }else{
                $scope.gradingSystems.empty = true;
            }
        },function(error){
            toaster.pop('error', "Grading System", "Failed to Load Grading Systems, Try Again");
        });

        $scope.setGradingSystemEditMode = function ($event, gradingSystem, isEdit) {
            gradingSystem.edit = isEdit;
            $scope.preventDefaultAction($event);
        };

        $scope.preventDefaultAction = function ($event) {
            $event.stopPropagation();
            $event.preventDefault();
        };

        $scope.addGrade = function (gradingSystem) {
            if (angular.isDefined(gradingSystem) && angular.isDefined(gradingSystem.grades)) {
                gradingSystem.grades.push({
                    symbol: '',
                    lowerRange: 0,
                    upperRange: 0,
                    remark: ''
                });
            }
        };

        $scope.removeGrade = function (gradingSystem, index) {
            if (angular.isDefined(gradingSystem) && parseInt(index) >= 0) {
                gradingSystem.grades.splice(index, 1);
            }
        };

        $scope.addNewGradingSystem = function () {
            $scope.gradingSystems.isAddingNewGradingSystem = true;
            var clone = {
                name: 'Default Grading System',
                grades: [
                    {
                        symbol: 'A',
                        lowerRange: 75,
                        upperRange: 100,
                        remark: 'Excellent'
                    },
                    {
                        symbol: 'B',
                        lowerRange: 60,
                        upperRange: 74,
                        remark: 'Very Good'
                    },
                    {
                        symbol: 'C',
                        lowerRange: 55,
                        upperRange: 59,
                        remark: 'Good'
                    },
                    {
                        symbol: 'E',
                        lowerRange: 50,
                        upperRange: 54,
                        remark: 'Pass'
                    },
                    {
                        symbol: 'F',
                        lowerRange: 0,
                        upperRange: 49,
                        remark: 'Fail'
                    }
                ]
            };
            clone.name += ' ' + $scope.gradingSystems.data.length;
            //$scope.gradingSystems.push(clone);
            GradingSystemService.save(clone, function (response) {
                if (response.success) {
                    $scope.gradingSystems.data = response.all;
                    toaster.pop('success', "New Grading System", "Added Successfully");
                    $scope.gradingSystems.isAddingNewGradingSystem = false;
                    $scope.$emit('refreshSchoolData');
                }
            }, function (data) {
                $scope.gradingSystems.isAddingNewGradingSystem = false;
                toaster.pop('error', "New Grading System", "Failed to Add, Try Again");
            });
        };

        $scope.deleteGradingSystem = function ($event, gradingSystems, index) {
            var gradingSystem = gradingSystems[index];

            GradingSystemService.delete(gradingSystem, function (data) {
                console.log('delete success');
                toaster.pop('success', "Grading System", "Deleted Successfully");
                gradingSystems.splice(index, 1);
                $scope.$emit('refreshSchoolData');
            }, function () {
                console.log('delete failure');
                toaster.pop('error', "Grading System", "Failed to Delete, Try Again");
            });
            $scope.preventDefaultAction($event);
        };

        $scope.saveGradingSystemChanges = function (gradingSystem) {
            GradingSystemService.update({id: gradingSystem.id}, gradingSystem).$promise.then(function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "Grading System", "Changes Saved Succesfully");
                $scope.$emit('refreshSchoolData');
            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "Grading System", "Failed to save changes, Try Again");
            });
        };

        $scope.saveAssignedGradingSystem = function (assignedGradingSystem){
            GradingSystemService.assignGradingSystem(assignedGradingSystem).$promise.then(function(){
                toaster.pop('success', "Assign Grading System", "Assignments Saved Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                toaster.pop('error', "Assign Grading System", "Failed to save assignments");
            });
        };

        $scope.saveGradingSystemAssignment  = function (classItem){
            GradingSystemService.assignGradingSystemToClass(classItem).$promise.then(function(){
                toaster.pop('success', "Assign Grading System", "Assignments Saved Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                toaster.pop('error', "Assign Grading System", "Failed to save assignments");
            });
        };
        
        

        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------
        //Grade Assessment Systems
        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------
        
        $scope.assignedGradeAssignmentSystem = GradeAssessmentSystemService.getAssignedGradeAssessmentSystem();
                
        $scope.gradeAssessmentSystems = 
        {
            loading: true,
            data: [],
            empty: false,
            isAddingNewGradeAssessmentSystem: false
        };

        GradeAssessmentSystemService.query({},function(response){
            $scope.gradeAssessmentSystems.loading = false;
            if(response.length > 0){
                 $scope.gradeAssessmentSystems.data = response;
            }else{
                $scope.gradeAssessmentSystems.empty = true;
            }
        },function(error){
            toaster.pop('error', "Grading System", "Failed to Load Grading Systems, Try Again");
        });

        $scope.setGradeAssessmentEditMode = function ($event, gradeAssessmentSystem, isEdit) {
            gradeAssessmentSystem.edit = isEdit;
            $scope.preventDefaultAction($event);
        };

        $scope.preventDefaultAction = function ($event) {
            $event.stopPropagation();
            $event.preventDefault();
        };

        $scope.addDivision = function (gradeAssessmentSystem) {
            if (angular.isDefined(gradeAssessmentSystem) && angular.isDefined(gradeAssessmentSystem.divisions)) {
                gradeAssessmentSystem.divisions.push({
                    name: '',
                    score: 0
                });
                gradeAssessmentSystem.total_divisions = gradeAssessmentSystem.divisions.length;
            }
        };

        $scope.removeDivision = function (gradeAssessmentSystem, index) {
            if (angular.isDefined(gradeAssessmentSystem) && parseInt(index) >= 0) {
                gradeAssessmentSystem.divisions.splice(index, 1);
                gradeAssessmentSystem.total_divisions = gradeAssessmentSystem.divisions.length;
            }
        };

        $scope.addNewGradeAssessmentSystem = function () {
            $scope.gradeAssessmentSystems.isAddingNewGradeAssessmentSystem = true;
            var clone = {
                name: 'Default Grade Assessment System',
                total_score: 100,
                divisions: [
                    {
                        name: 'First Test',
                        score: 15
                    },
                    {
                        name: 'Second Test',
                        score: 15
                    },
                    {
                        name: 'Assignment',
                        score: 10
                    },
                    {
                        name: 'Examination',
                        score: 60
                    }
                ]
            };
            clone.name += ' ' + $scope.gradeAssessmentSystems.data.length;
            //$scope.gradingSystems.push(clone);
            GradeAssessmentSystemService.save(clone, function (response) {
                $scope.gradeAssessmentSystems.isAddingNewGradeAssessmentSystem = false;
                if (response.success) {
                    $scope.gradeAssessmentSystems.data = response.all;
                    $scope.$emit('refreshSchoolData');
                }
            }, function (data) {
                $scope.gradeAssessmentSystems.isAddingNewGradeAssessmentSystem = false;
                //$scope.gradingSystems.splice($scope.gradingSystems.length -1 ,1);
            });
        };

        $scope.deleteGradeAssessmentSystem = function ($event, gradeAssessmentSystems, index) {
            var gradeAssessmentSystem = gradeAssessmentSystems[index];

            GradeAssessmentSystemService.delete(gradeAssessmentSystem, function (data) {
                console.log('delete success');
                gradeAssessmentSystems.splice(index, 1);
                $scope.$emit('refreshSchoolData');
            }, function () {
                console.log('delete failure');
            });
            $scope.preventDefaultAction($event);
        };

        $scope.saveGradeAssessmentSystemChanges = function (gradeAssessmentSystem) {
            var isValid =  validateGradeAssessmentSystem(gradeAssessmentSystem);
            if(isValid){
                gradeAssessmentSystem.errors = null;
                GradeAssessmentSystemService.update({id: gradeAssessmentSystem.id}, gradeAssessmentSystem).$promise.then(function (response) {
                    console.log('Saved Changes');
                    toaster.pop('success', "Grade Assessment System", "Changes Saved Succesfully");
                    $scope.$emit('refreshSchoolData');
                }, function (data) {
                    console.log('could not save changes');
                    toaster.pop('error', "Grade Assessment System", "Changes Failed");
                });
            }else{
                gradeAssessmentSystem.errors = {sum: true};
                toaster.pop('error', "Grade Assessment System", "Validation Failed");
            }
        };

        $scope.updateGradeDivisions = function (count, gradeAssessmentSystem) {
            var num = parseInt(count);
            if (num < 0 || angular.isUndefined(gradeAssessmentSystem) || angular.isUndefined(gradeAssessmentSystem.divisions))
                return null;

            if (num > gradeAssessmentSystem.divisions.length) {
                var difference = num - gradeAssessmentSystem.divisions.length;
                for (var i = 0; i < difference; i++) {
                    $scope.addDivision(gradeAssessmentSystem);
                }
                return true;
            }
            if (num < gradeAssessmentSystem.divisions.length) {
                var diff = gradeAssessmentSystem.divisions.length - num;
                for (var j = 0; j <= diff; j++) {
                    $scope.removeDivision(gradeAssessmentSystem, j);
                }
                return true;
            }
        };

        $scope.saveAssignedGradeAssessmentSystem = function (assignedGradeAssessmentSystem){

            GradeAssessmentSystemService.assignGradeAssessmentSystem(assignedGradeAssessmentSystem).$promise.then(function(){
                toaster.pop('success', "Assign Grade Assessment System", "Assignments Saved Succesfully");
            },function(){
                toaster.pop('error', "Assign Grade Assessment System", "Failed to save assignments");
            });
        };


        $scope.saveGradeAssessmentSystemAssignment  = function (classItem){
            GradeAssessmentSystemService.assignGradeAssessmentSystemToClass(classItem).$promise.then(function(){
                toaster.pop('success', "Assign Grade Assessment System", "Assignments Saved Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                toaster.pop('error', "Assign Grade Assessment System", "Failed to save assignments");
            });
        };

        //assignGradeAssessmentSystemToClass


        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------
        //Behaviour and Skill System
        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------

        $scope.assignedBehaviourSkillSystem  = BehaviourSkillSystemService.getAssignedBehaviourSkillSystem();
        
        $scope.behaviourSkillSystems  = {data: null, loading: true,empty: false};
        
        BehaviourSkillSystemService.query({},function(response){
            $scope.behaviourSkillSystems.data  = response;
            $scope.behaviourSkillSystems.loading  = false;
            if(angular.isArray(response) && response.length < 1){
                $scope.behaviourSkillSystems.empty  = true;
            }

        },function(err){
            $scope.behaviourSkillSystems.loading  = false;
        });

        $scope.behaviourCategories  = BehaviourAssessmentSystemService.query({'action': 'categories',behaviourSkillSystemId: 0});
        //$scope.behaviours  = BehaviourAssessmentSystemService.query();
        $scope.skillCategories  = SkillAssessmentSystemService.query({'action': 'categories',behaviourSkillSystemId: 0});
        //$scope.skills  = SkillAssessmentSystemService.query();
        
        $scope.addNewBehaviourSkillSystem = function(){
            $scope.behaviourSkillSystems.isAddingNewBehaviourSkillSystem =  true;
            var system = {
                name: generateBehaviourSkillSystemName()
            };
            
            BehaviourSkillSystemService.save(system,function(data){
                $scope.behaviourSkillSystems.data.push(data);
                
                toaster.pop('success', "Behaviour Assessment System", "Added Succesfully");
                $scope.behaviourSkillSystems.isAddingNewBehaviourSkillSystem = false;
                system.name = '';
            },function(){
                $scope.behaviourSkillSystems.isAddingNewBehaviourSkillSystem = false;
                toaster.pop('error', "behaviour Assessment System", "Failed to add");
            });
        };
        
        $scope.removeBehaviourSkillSystem = function(system,$index){
            system.deleting =  true;
            BehaviourSkillSystemService.delete(system,function(data){
                $scope.behaviourSkillSystems.data.splice($index,1);
                
                toaster.pop('success', "Behaviour Assessment System", "Removed Succesfully");
                system.deleting = false;
            },function(){
                system.adding = false;
                toaster.pop('error', "behaviour Assessment System", "Failed to remove");
            });
        };
        
        $scope.addBehaviour = function(behaviour,behaviourSkillSystem){
            behaviour.adding =  true;
            behaviour.scoped_behaviour_skill_system_id =  behaviourSkillSystem.id;
            
            BehaviourAssessmentSystemService.save(behaviour,function(data){
                behaviourSkillSystem.behaviours  = data.all;
                toaster.pop('success', "Behaviour Assessment System", "New Behaviour Added Succesfully");
                behaviour.adding = false;
                behaviour.name = '';
                $scope.$emit('refreshSchoolData');
            },function(){
                behaviour.adding = false;
                toaster.pop('error', "behaviour Assessment System", "Failed to add behaviour");
            });
        };

        $scope.removeBehaviour = function(behaviour,behaviourSkillSystem){
            behaviour.removing =  true;
            
            BehaviourAssessmentSystemService.delete(behaviour,function(data){
                behaviour.removing =  false;
                behaviourSkillSystem.behaviours  = data.all;
                toaster.pop('success', "Behaviour Assessment System", "Behaviour removed Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                behaviour.removing =  false;
                toaster.pop('error', "behaviour Assessment System", "Failed to remove behaviour");
            });
        };

        $scope.updateBehaviour = function(behaviour){
            BehaviourAssessmentSystemService.update({id: behaviour.id},behaviour).$promise.then(function(data){
                $scope.behaviours  = data.all;
                toaster.pop('success', "Behaviour Assessment System", "New Behaviour Added Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                toaster.pop('error', "behaviour Assessment System", "Failed to add behaviour");
            });
        };

        $scope.addSkill = function(skill,behaviourSkillSystem){
            skill.adding =  true;
            skill.scoped_behaviour_skill_system_id =  behaviourSkillSystem.id;
            
            SkillAssessmentSystemService.save(skill,function(data){
                skill.adding =  false;
                skill.name =  '';
                behaviourSkillSystem.skills  = data.all;
                toaster.pop('success', "Skill Assessment System", "Added Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                skill.adding =  false;
                toaster.pop('error', "Skill Assessment System", "Failed to Add");
            });
        };

        $scope.removeSkill = function(skill,behaviourSkillSystem){
            skill.removing =  true;
            SkillAssessmentSystemService.delete(skill,function(data){
                behaviourSkillSystem.skills  = data.all;
                skill.removing =  false;
                toaster.pop('success', "Skill Assessment System", "Removed Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                skill.removing =  false;
                toaster.pop('error', "Skill Assessment System", "Failed to remove");
            });
        };

        $scope.updateSkill = function(skill){
            SkillAssessmentSystemService.update({id: skill.id},skill).$promise.then(function(data){
                $scope.skills  = data.all;
                toaster.pop('success', "Skill Assessment System", "Updated Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                toaster.pop('error', "Skill Assessment System", "Failed to update");
            });
        };
        
        $scope.saveAssignedBehaviourSkillSystem = function (assignedBehaviourSkillSystem){
            BehaviourSkillSystemService.assignBehaviourSkillSystem(assignedBehaviourSkillSystem).$promise.then(function(){
                toaster.pop('success', "Assign Grade Assessment System", "Assignments Saved Succesfully");
            },function(){
                toaster.pop('error', "Assign Grade Assessment System", "Failed to save assignments");
            });
        };
        
        $scope.saveBehaviourSkillSystemAssignment = function (classItem){
            BehaviourSkillSystemService.assignBehaviourSkillSystemToClass(classItem).$promise.then(function(){
                toaster.pop('success', "Assign Behaviour Skill System", "Assignments Saved Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                toaster.pop('error', "Assign Behaviour Skill System", "Failed to save assignments");
            });
        };
        
        

        function generateBehaviourSkillSystemName(){
           if($scope.behaviourSkillSystems.data === null || $scope.behaviourSkillSystems.data.length < 1 ){
               return "Default Behaviour Skill System";
           }else{
                return "Default Behaviour Skill System "+ $scope.behaviourSkillSystems.data.length;
           }
        }
            
            
        function validateGradeAssessmentSystem(gradeAssessmentSystem){
            var total_score = parseInt(gradeAssessmentSystem.total_score);
            var sum =  0;

            angular.forEach(gradeAssessmentSystem.divisions,function(grade,key){
                sum += parseInt(grade.score);
            });

            return sum === total_score; 
        }
    }
]);

/**
 * Report Settings Controller
 */

app.controller('SettingsReportController', ['$scope', 'SchoolDataService',
    function ($scope, SchoolDataService) {
        $scope.sessions = getSessionsFrom(SchoolDataService);
        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.form = {
            school_category: null
        };


        function getSessionsFrom(SchoolDataService) {
            return SchoolDataService.school.sessions.sort(function (a, b) {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        }
    }
]);


app.controller('SettingsFinancialController', ['$scope', 'SchoolDataService',
    function ($scope, SchoolDataService) {
        $scope.sessions = getSessionsFrom(SchoolDataService);
        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.form = {
            school_category: null
        };


        function getSessionsFrom(SchoolDataService) {
            return SchoolDataService.school.sessions.sort(function (a, b) {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        }
    }
]);


/**
 * Notification Settings Controller
 */
app.controller('SettingsNotificationController', ['$scope', 'SchoolDataService',
    function ($scope, SchoolDataService) {
        $scope.sessions = getSessionsFrom(SchoolDataService);
        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.form = {
            school_category: null
        };


        function getSessionsFrom(SchoolDataService) {
            return SchoolDataService.school.sessions.sort(function (a, b) {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        }
    }
]);


app.controller('SettingsAdministratorsController', ['$scope', 'SchoolDataService',
    function ($scope, SchoolDataService) {
        $scope.sessions = getSessionsFrom(SchoolDataService);
        $scope.sub_sessions = SchoolDataService.school.session_type.sub_sessions;
        $scope.form = {
            school_category: null
        };


        function getSessionsFrom(SchoolDataService) {
            return SchoolDataService.school.sessions.sort(function (a, b) {
                if (a.name < b.name) {
                    return -1;
                }
                if (a.name > b.name) {
                    return 1;
                }
                return 0;
            });
        }
    }
]);

/**=========================================================
 * Module: filestyle.js
 * Initializes the fielstyle plugin
 =========================================================*/

App.directive('filestyle', function() {
  return {
    restrict: 'A',
    controller: function($scope, $element) {
      var options = $element.data();
      
      // old usage support
        options.classInput = $element.data('classinput') || options.classInput;
      
      $element.filestyle(options);
    }
  };
});

/**=========================================================
 * Module: form-wizard.js
 * Handles form wizard plugin and validation
 =========================================================*/

App.directive('formWizard', function($parse){
  'use strict';

  return {
    restrict: 'A',
    scope: true,
    link: function(scope, element, attribute) {
      var validate = $parse(attribute.validateSteps)(scope),
          wiz = new Wizard(attribute.steps, !!validate, element);
      scope.wizard = wiz.init();

    }
  };

  function Wizard (quantity, validate, element) {
    
    var self = this;
    self.quantity = parseInt(quantity,10);
    self.validate = validate;
    self.element = element;
    
    self.init = function() {
      self.createsteps(self.quantity);
      self.go(1); // always start at fist step
      return self;
    };

    self.go = function(step) {
      
      if ( angular.isDefined(self.steps[step]) ) {

        if(self.validate && step !== 1) {
          var form = $(self.element),
              group = form.children().children('div').get(step - 2);

          if (false === form.parsley().validate( group.id )) {
            return false;
          }
        }

        self.cleanall();
        self.steps[step] = true;
      }
    };

    self.active = function(step) {
      return !!self.steps[step];
    };

    self.cleanall = function() {
      for(var i in self.steps){
        self.steps[i] = false;
      }
    };

    self.createsteps = function(q) {
      self.steps = [];
      for(var i = 1; i <= q; i++) self.steps[i] = false;
    };

  }

});

App.directive('image', function($q) {
        'use strict'

        var URL = window.URL || window.webkitURL;

        var getResizeArea = function () {
            var resizeAreaId = 'fileupload-resize-area';

            var resizeArea = document.getElementById(resizeAreaId);

            if (!resizeArea) {
                resizeArea = document.createElement('canvas');
                resizeArea.id = resizeAreaId;
                resizeArea.style.visibility = 'hidden';
                document.body.appendChild(resizeArea);
            }

            return resizeArea;
        }

        var resizeImage = function (origImage, options) {
            var maxHeight = options.resizeMaxHeight || 300;
            var maxWidth = options.resizeMaxWidth || 250;
            var quality = options.resizeQuality || 0.7;
            var type = options.resizeType || 'image/jpg';

            var canvas = getResizeArea();

            var height = origImage.height;
            var width = origImage.width;

            // calculate the width and height, constraining the proportions
            if (width > height) {
                if (width > maxWidth) {
                    height = Math.round(height *= maxWidth / width);
                    width = maxWidth;
                }
            } else {
                if (height > maxHeight) {
                    width = Math.round(width *= maxHeight / height);
                    height = maxHeight;
                }
            }

            canvas.width = width;
            canvas.height = height;

            //draw image on canvas
            var ctx = canvas.getContext("2d");
            ctx.drawImage(origImage, 0, 0, width, height);

            // get the data from canvas as 70% jpg (or specified type).
            return canvas.toDataURL(type, quality);
        };

        var createImage = function(url, callback) {
            var image = new Image();
            image.onload = function() {
                callback(image);
            };
            image.src = url;
        };

        var fileToDataURL = function (file) {
            var deferred = $q.defer();
            var reader = new FileReader();
            reader.onload = function (e) {
                deferred.resolve(e.target.result);
            };
            reader.readAsDataURL(file);
            return deferred.promise;
        };


        return {
            restrict: 'A',
            scope: {
                image: '=',
                resizeMaxHeight: '@?',
                resizeMaxWidth: '@?',
                resizeQuality: '@?',
                resizeType: '@?',
            },
            link: function postLink(scope, element, attrs, ctrl) {

                var doResizing = function(imageResult, callback) {
                    createImage(imageResult.url, function(image) {
                        var dataURL = resizeImage(image, scope);
                        imageResult.resized = {
                            dataURL: dataURL,
                            type: dataURL.match(/:(.+\/.+);/)[1],
                        };
                        callback(imageResult);
                    });
                };

                var applyScope = function(imageResult) {
                    scope.$apply(function() {
                        //console.log(imageResult);
                        if(attrs.multiple)
                            scope.image.push(imageResult);
                        else
                            scope.image = imageResult;
                    });
                };


                element.bind('change', function (evt) {
                    //when multiple always return an array of images
                    if(attrs.multiple)
                        scope.image = [];

                    var files = evt.target.files;
                    for(var i = 0; i < files.length; i++) {
                        //create a result object for each file in files
                        var imageResult = {
                            file: files[i],
                            url: URL.createObjectURL(files[i])
                        };

                        fileToDataURL(files[i]).then(function (dataURL) {
                            imageResult.dataURL = dataURL;
                        });

                        if(scope.resizeMaxHeight || scope.resizeMaxWidth) { //resize image
                            doResizing(imageResult, function(imageResult) {
                                applyScope(imageResult);
                            });
                        }
                        else { //no resizing
                            applyScope(imageResult);
                        }
                    }
                });
            }
        };
    });
/**=========================================================
 * Module: masked,js
 * Initializes the masked inputs
 =========================================================*/

App.directive('masked', function() {
  return {
    restrict: 'A',
    controller: function($scope, $element) {
      var $elem = $($element);
      if($.fn.inputmask)
        $elem.inputmask();
    }
  };
});

/**
 * Created by Ak on 4/4/2015.
 */
/**=========================================================
 * Module: scroll.js
 * Make a content box scrollable
 =========================================================*/

App.directive('scrollable', function(){
    return {
        restrict: 'EA',
        link: function(scope, elem, attrs) {
            var defaultHeight = 250;
            elem.slimScroll({
                height: (attrs.height || defaultHeight)
            });
        }
    };
});
/**=========================================================
 * Module panel-tools.js
 * Directive tools to control panels. 
 * Allows collapse, refresh and dismiss (remove)
 * Saves panel state in browser storage
 =========================================================*/
App.directive('paneltool', function($compile, $timeout){
  var templates = {
    /* jshint multistr: true */
    collapse:"<a href='#' panel-collapse='' tooltip='Collapse Panel' ng-click='{{panelId}} = !{{panelId}}'> \
                <em ng-show='{{panelId}}' class='fa fa-plus'></em> \
                <em ng-show='!{{panelId}}' class='fa fa-minus'></em> \
              </a>",
    dismiss: "<a href='#' panel-dismiss='' tooltip='Close Panel'>\
               <em class='fa fa-times'></em>\
             </a>",
    refresh: "<a href='#' panel-refresh='' data-spinner='{{spinner}}' tooltip='Refresh Panel'>\
               <em class='fa fa-refresh'></em>\
             </a>"
  };

  function getTemplate( elem, attrs ){
    var temp = '';
    attrs = attrs || {};
    if(attrs.toolCollapse)
      temp += templates.collapse.replace(/{{panelId}}/g, (elem.parent().parent().attr('id')) );
    if(attrs.toolDismiss)
      temp += templates.dismiss;
    if(attrs.toolRefresh)
      temp += templates.refresh.replace(/{{spinner}}/g, attrs.toolRefresh);
    return temp;
  }
  
  return {
    restrict: 'E',
    scope: false,
    link: function (scope, element, attrs) {

      var tools = scope.panelTools || attrs;
  
      $timeout(function() {
        element.html(getTemplate(element, tools )).show();
        $compile(element.contents())(scope);
        
        element.addClass('pull-right');
      });

    }
  };
})
/**=========================================================
 * Dismiss panels * [panel-dismiss]
 =========================================================*/
.directive('panelDismiss', function($q, Utils){
  'use strict';
  return {
    restrict: 'A',
    controller: function ($scope, $element) {
      var removeEvent   = 'panel-remove',
          removedEvent  = 'panel-removed';

      $element.on('click', function () {

        // find the first parent panel
        var parent = $(this).closest('.panel');

        removeElement();

        function removeElement() {
          var deferred = $q.defer();
          var promise = deferred.promise;
          
          // Communicate event destroying panel
          $scope.$emit(removeEvent, parent.attr('id'), deferred);
          promise.then(destroyMiddleware);
        }

        // Run the animation before destroy the panel
        function destroyMiddleware() {
          if(Utils.support.animation) {
            parent.animo({animation: 'bounceOut'}, destroyPanel);
          }
          else destroyPanel();
        }

        function destroyPanel() {

          var col = parent.parent();
          parent.remove();
          // remove the parent if it is a row and is empty and not a sortable (portlet)
          col
            .filter(function() {
            var el = $(this);
            return (el.is('[class*="col-"]:not(.sortable)') && el.children('*').length === 0);
          }).remove();

          // Communicate event destroyed panel
          $scope.$emit(removedEvent, parent.attr('id'));

        }
      });
    }
  };
})
/**=========================================================
 * Collapse panels * [panel-collapse]
 =========================================================*/
.directive('panelCollapse', ['$timeout', function($timeout){
  'use strict';
  
  var storageKeyName = 'panelState',
      storage;
  
  return {
    restrict: 'A',
    scope: false,
    controller: function ($scope, $element) {

      // Prepare the panel to be collapsible
      var $elem   = $($element),
          parent  = $elem.closest('.panel'), // find the first parent panel
          panelId = parent.attr('id');

      storage = $scope.$storage;

      // Load the saved state if exists
      var currentState = loadPanelState( panelId );
      if ( typeof currentState !== 'undefined') {
        $timeout(function(){
            $scope[panelId] = currentState; },
          10);
      }

      // bind events to switch icons
      $element.bind('click', function() {

        savePanelState( panelId, !$scope[panelId] );

      });
    }
  };

  function savePanelState(id, state) {
    if(!id) return false;
    var data = angular.fromJson(storage[storageKeyName]);
    if(!data) { data = {}; }
    data[id] = state;
    storage[storageKeyName] = angular.toJson(data);
  }

  function loadPanelState(id) {
    if(!id) return false;
    var data = angular.fromJson(storage[storageKeyName]);
    if(data) {
      return data[id];
    }
  }

}])
/**=========================================================
 * Refresh panels
 * [panel-refresh] * [data-spinner="standard"]
 =========================================================*/
.directive('panelRefresh', function($q){
  'use strict';
  
  return {
    restrict: 'A',
    scope: false,
    controller: function ($scope, $element) {
      
      var refreshEvent   = 'panel-refresh',
          whirlClass     = 'whirl',
          defaultSpinner = 'standard';


      // catch clicks to toggle panel refresh
      $element.on('click', function () {
        var $this   = $(this),
            panel   = $this.parents('.panel').eq(0),
            spinner = $this.data('spinner') || defaultSpinner
            ;

        // start showing the spinner
        panel.addClass(whirlClass + ' ' + spinner);

        // Emit event when refresh clicked
        $scope.$emit(refreshEvent, panel.attr('id'));

      });

      // listen to remove spinner
      $scope.$on('removeSpinner', removeSpinner);

      // method to clear the spinner when done
      function removeSpinner (ev, id) {
        if (!id) return;
        var newid = id.charAt(0) == '#' ? id : ('#'+id);
        angular
          .element(newid)
          .removeClass(whirlClass);
      }
    }
  };
});

/**=========================================================
 * Module: tags-input.js
 * Initializes the tag inputs plugin
 =========================================================*/

App.directive('tagsinput', function($timeout) {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {

      element.on('itemAdded itemRemoved', function(){
        // check if view value is not empty and is a string
        // and update the view from string to an array of tags
        if(ngModel.$viewValue && ngModel.$viewValue.split) {
          ngModel.$setViewValue( ngModel.$viewValue.split(',') );
          ngModel.$render();
        }
      });

      $timeout(function(){
        element.tagsinput();
      });

    }
  };
});

/**=========================================================
 * Module: validate-form.js
 * Initializes the validation plugin Parsley
 =========================================================*/

App.directive('validateForm', function() {
  return {
    restrict: 'A',
    controller: function($scope, $element) {
      var $elem = $($element);
      if($.fn.parsley)
        $elem.parsley();
    }
  };
});

//# sourceMappingURL=app.js.map