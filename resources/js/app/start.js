/**
 * Created by kaso on 11/6/2014.
 */

var app = angular.module('UnifySchoolApp',
    [
        'ui.router',
        'ui.checkbox',
        'ui.bootstrap',
        'ngCookies',
        'ngAnimate',
        'ngSanitize',
        'UnifySchoolApp.Controllers',
        'UnifySchoolApp.Services',
        'UnifySchoolApp.directives'
    ]);

app.constant('ViewBaseURL', '/wizard/partials');

app.config(function ($stateProvider, $urlRouterProvider, ViewBaseURL) {

    $urlRouterProvider.otherwise("/setup/step-one");

    $stateProvider
        .state('base', {
            url: "/setup",
            abstract: true,
            template: '<div ui-view></div>',
            controller: ['$scope', function ($scope) {
                $scope.school = {
                    'name': '',
                    'selected_school_type': '',
                    'school_types': [
                        {
                            name: 'tertiary',
                            display_name: 'Tertiary (Universities, Poly etc)',
                            session: {
                                session_type: 'two',
                                session_name: 'session',
                                session_display_name: 'Session',
                                session_divisions_name: 'sub_session',
                                session_divisions_display_name: 'Semester',
                                full_display_name: this.session_type + ' ' + this.session_divisions_display_name + ' ' + this.session_display_name
                            },
                            school_categories: [
                                {
                                    'display_name': 'Arts',
                                    'name': 'arts',
                                    'arms': [
                                        {
                                            display_name: 'Mass Communication',
                                            name: 'mass_communication',
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'English Language',
                                            name: 'english',
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Physical Sciences',
                                    'name': 'physical_sciences',
                                    'arms': [
                                        {
                                            display_name: 'Computer Science',
                                            name: 'computer_science',
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Engineering',
                                    'name': 'engineering',
                                    'arms': [
                                        {
                                            display_name: 'Electronics and Computer',
                                            name: 'electronics_and_computer',
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Environmental Sciences',
                                    'name': 'environmental',
                                    'arms': [
                                        {
                                            display_name: 'Architecture',
                                            name: 'architecture',
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            name: 'non_tertiary',
                            display_name: 'Non Tertiary (Nursery, Primary etc )',
                            session: {
                                session_type: 'three',
                                session_name: 'session',
                                session_display_name: 'Session',
                                session_divisions_name: 'sub_session',
                                session_divisions_display_name: 'Term',
                                full_display_name: this.session_type + ' ' + this.session_divisions_display_name + ' ' + this.session_display_name
                            },
                            school_categories: [
                                {
                                    'display_name': 'Nursery',
                                    'name': 'nursery',
                                    'arms': [
                                        {
                                            display_name: 'one',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'two',
                                            name: 2,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'three',
                                            name: 3,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'four',
                                            name: 4,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Primary',
                                    'name': 'primary',
                                    'arms': [
                                        {
                                            display_name: 'one',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'two',
                                            name: 2,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'three',
                                            name: 3,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'four',
                                            name: 4,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'five',
                                            name: 5,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'six',
                                            name: 6,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Junior Secondary',
                                    'name': 'junior_secondary',
                                    'arms': [
                                        {
                                            display_name: 'One',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'Two',
                                            name: 2,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'Three',
                                            name: 3,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Senior Secondary',
                                    'name': 'senior_secondary',
                                    'arms': [
                                        {
                                            display_name: 'One',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'Two',
                                            name: 2,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'Three',
                                            name: 3,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            name: 'custom',
                            display_name: 'Other Schools (Business School, etc)',
                            session: {
                                session_type: 'three',
                                session_name: 'session',
                                session_display_name: 'Session',
                                session_divisions_name: 'sub_session',
                                session_divisions_display_name: 'Term',
                                full_display_name: this.session_type + ' ' + this.session_divisions_display_name + ' ' + this.session_display_name
                            },
                            school_categories: [
                                {
                                    'display_name': 'default',
                                    'name': 'default',
                                    'arms': [
                                        {
                                            display_name: 'one',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                }
                            ]
                        }
                    ],
                    'admin_email': '',
                    'admin_password': '',
                    'admin_password_confirmation': ''
                };

                $scope.removeCategory = function (selectedCategory, indexToRemove) {
                    $scope.school.school_types[selectedCategory].school_categories.splice(indexToRemove, 1);
                };

                $scope.addCategory = function (selectedCategory, school_category_name) {
                    $scope.school.school_types[selectedCategory].school_categories.push({
                        'display_name': school_category_name,
                        'name': school_category_name,
                        'arms': [
                            {
                                display_name: 'Default',
                                name: 'default',
                                arms: {
                                    default: {}
                                }
                            }
                        ]
                    });
                }
            }]
        })
        .state('base.step_one', {
            url: "/step-one",
            templateUrl: ViewBaseURL + "/step-one.html",
            controller: ['$scope', '$state', function ($scope, $state) {
                $scope.next = function () {
                    $state.go('base.step_two');
                }
            }]
        })
        .state('base.step_two', {
            url: "/step-two",
            templateUrl: ViewBaseURL + "/step-two.html",
            controller: ['$scope', function ($scope) {

            }]
        });
});