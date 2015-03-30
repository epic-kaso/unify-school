var app = angular.module('SchoolAdminApp');
/**
 * Controllers
 *
 */

app.controller('NavBarController', [
        '$scope', '$rootScope', 'SchoolDataService',
        function ($scope, $rootScope, SchoolDataService) {
            $scope.schoolCategories = SchoolDataService.school.school_type.school_categories;
            $scope.selectedSchoolCategory = $scope.schoolCategories[0];

            $scope.prepareSchoolCategory = function ($event, category) {
                $scope.selectedSchoolCategory = category;
                $event.preventDefault();
            };

            $scope.$watch('selectedSchoolCategory', function (newV, oldV) {
                console.log('selectedSchoolCategoryChanged event');
                $rootScope.$broadcast('selectedSchoolCategoryChanged', {value: newV});
                console.log('selectedSchoolCategoryChanged raised');
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

app.controller('SettingsSessionTermController', ['$scope', 'SchoolDataService',
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

app.controller('SettingsSchoolController', ['$scope', 'SchoolDataService', 'editableOptions', 'editableThemes',
    function ($scope, SchoolDataService, editableOptions, editableThemes) {

        //template start
        editableOptions.theme = 'bs3';

        editableThemes.bs3.inputClass = 'input-sm';
        editableThemes.bs3.buttonsClass = 'btn-sm';
        editableThemes.bs3.submitTpl = '<button type="submit" class="btn btn-success"><span class="fa fa-check"></span></button>';
        editableThemes.bs3.cancelTpl = '<button type="button" class="btn btn-default" ng-click="$form.$cancel()">' +
        '<span class="fa fa-times text-muted"></span>' +
        '</button>';

        $scope.user = {
            email: 'email@example.com',
            tel: '123-45-67',
            number: 29,
            range: 10,
            url: 'http://example.com',
            search: 'blabla',
            color: '#6a4415',
            date: null,
            time: '12:30',
            datetime: null,
            month: null,
            week: null,
            desc: 'Sed pharetra euismod dolor, id feugiat ante volutpat eget. '
        };

        // Local select
        // -----------------------------------

        $scope.user2 = {
            status: 2
        };

        $scope.statuses = [
            {value: 1, text: 'status1'},
            {value: 2, text: 'status2'},
            {value: 3, text: 'status3'},
            {value: 4, text: 'status4'}
        ];

        $scope.showStatus = function () {
            var selected = $filter('filter')($scope.statuses, {value: $scope.user2.status});
            return ($scope.user2.status && selected.length) ? selected[0].text : 'Not set';
        };

        // select remote
        // -----------------------------------

        $scope.user3 = {
            id: 4,
            text: 'admin' // original value
        };

        $scope.groups = [];

        $scope.loadGroups = function () {
            return $scope.groups.length ? null : $http.get('server/xeditable-groups.json').success(function (data) {
                $scope.groups = data;
            });
        };

        $scope.$watch('user3.id', function (newVal, oldVal) {
            if (newVal !== oldVal) {
                var selected = $filter('filter')($scope.groups, {id: $scope.user3.id});
                $scope.user3.text = selected.length ? selected[0].text : null;
            }
        });

        // Typeahead
        // -----------------------------------

        $scope.user4 = {
            state: 'Arizona'
        };

        $scope.states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Dakota', 'North Carolina', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'];

        //template stop


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
])

/**
 * Staff Settings Controller
 */


app.controller('SettingsStaffController', ['$scope', 'SchoolDataService',
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
 * Classes Settings Controller
 */

app.controller('SettingsClassesController', ['$scope', 'SchoolDataService',
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

 Courses Settings Controller
 */

app.controller('SettingsCoursesController', ['$scope', 'SchoolDataService',
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
 * Academics Settings Controller
 */

app.controller('SettingsAcademicsController', ['$scope', 'GradingSystemService', 'GradeAssessmentSystemService','SchoolDataService',
    function ($scope, GradingSystemService, GradeAssessmentSystemService,SchoolDataService) {

        //Grading Systems

        $scope.schoolCategories = SchoolDataService.school.school_type.school_categories;
        $scope.assignedGradingSystem = {};

        $scope.gradingSystems = GradingSystemService.query();

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
            $scope.isAddingNewGradingSystem = true;
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
            clone.name += ' ' + $scope.gradingSystems.length;
            //$scope.gradingSystems.push(clone);

            $scope.isAddingNewGradingSystem = false;
            GradingSystemService.save(clone, function (response) {
                if (response.success) {
                    $scope.gradingSystems = response.all;
                }
            }, function (data) {
                //$scope.gradingSystems.splice($scope.gradingSystems.length -1 ,1);
            });
        };

        $scope.deleteGradingSystem = function ($event, gradingSystems, index) {
            var gradingSystem = gradingSystems[index];

            GradingSystemService.delete(gradingSystem, function (data) {
                console.log('delete success');
                gradingSystems.splice(index, 1);
            }, function () {
                console.log('delete failure');
            });
            $scope.preventDefaultAction($event);
        };

        $scope.saveGradingSystemChanges = function (gradingSystem) {
            GradingSystemService.update({id: gradingSystem.id}, gradingSystem).$promise.then(function (response) {
                console.log('Saved Changes')
            }, function (data) {
                console.log('could not save changes')
            });
        };
        console.log(GradingSystemService.query());

        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------
        //Grade Assessment Systems
        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------

        $scope.gradeAssessmentSystems = GradeAssessmentSystemService.query();

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
            $scope.isAddingNewGradeAssessmentSystem = true;
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
            clone.name += ' ' + $scope.gradeAssessmentSystems.length;
            //$scope.gradingSystems.push(clone);

            $scope.isAddingNewGradeAssessmentSystem = false;
            GradeAssessmentSystemService.save(clone, function (response) {
                if (response.success) {
                    $scope.gradeAssessmentSystems = response.all;
                }
            }, function (data) {
                //$scope.gradingSystems.splice($scope.gradingSystems.length -1 ,1);
            });
        };

        $scope.deleteGradeAssessmentSystem = function ($event, gradeAssessmentSystems, index) {
            var gradeAssessmentSystem = gradeAssessmentSystems[index];

            GradeAssessmentSystemService.delete(gradeAssessmentSystem, function (data) {
                console.log('delete success');
                gradeAssessmentSystems.splice(index, 1);
            }, function () {
                console.log('delete failure');
            });
            $scope.preventDefaultAction($event);
        };

        $scope.saveGradeAssessmentSystemChanges = function (gradeAssessmentSystem) {
            GradeAssessmentSystemService.update({id: gradeAssessmentSystem.id}, gradeAssessmentSystem).$promise.then(function (response) {
                console.log('Saved Changes')
            }, function (data) {
                console.log('could not save changes')
            });
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


        console.log(GradeAssessmentSystemService.query());
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
