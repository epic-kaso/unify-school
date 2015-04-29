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

            $scope.schoolCategories =  SchoolDataService.school.school_type.school_categories;
            $scope.selectedSchoolCategory = $scope.schoolCategories[0];
            $scope.classItems = {
                submenu: $scope.selectedSchoolCategory.school_category_arms,
                selected: $scope.selectedSchoolCategory.school_category_arms[0]
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
                    $scope.classItems.selected = obj.value.school_category_arms[0];
                    context.school_category = obj.value;
                    context.category_level = obj.value.school_category_arms[0];
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
        }

        $scope.openStartDate = function($event,sub_session){
            $event.stopPropagation();
            $event.preventDefault();
            sub_session.startDateOpened = true;
        };

        $scope.openEndDate = function($event,sub_session){
            $event.stopPropagation();
            $event.preventDefault();
            sub_session.endDateOpened = true;
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
        }

        $scope.saveStaff = function (staff) {
            console.log(staff);
            StaffService.save(staff,function(response){
                toaster.pop('success', "Add Staff", "Changes Saved Succesfully");
            },function(error){
                toaster.pop('error', "Add Staff", "failed to Save Changes");
            })
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
        }
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
                }
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

            CategoryClassSettingsService.updateCategoryArmSubDivision({id: arm},arm).$promise.then(function (response) {
                console.log('Saved Changes');
                toaster.pop('success', "School Sub-Arm", "Changes Saved Succesfully");
                $scope.$emit('refreshSchoolData');

                arm.saving = false;

            }, function (data) {
                console.log('could not save changes');
                toaster.pop('error', "School Sub-Arm", "Failed to save changes, Try Again");
                arm.saving = false;
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
        
        function indexToChar(index){
            var chars = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
            return chars[index-1];
        }

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
        'BehaviourAssessmentSystemService','SkillAssessmentSystemService',
    function ($scope, GradingSystemService, GradeAssessmentSystemService,SchoolDataService,toaster,BehaviourAssessmentSystemService,
              SkillAssessmentSystemService) {

        //Grading Systems

        $scope.schoolCategories = SchoolDataService.school.school_type.school_categories;
        $scope.assignedGradingSystem = GradingSystemService.getAssignedGradingSystem();
        $scope.assignedGradeAssignmentSystem = GradeAssessmentSystemService.getAssignedGradeAssessmentSystem();
        
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
        console.log(GradingSystemService.query());

        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------
        //Grade Assessment Systems
        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------

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



        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------
        //Behaviour and Skill System
        //---------------------------------------------------------------------------------------
        //---------------------------------------------------------------------------------------

        $scope.behaviourCategories  = BehaviourAssessmentSystemService.query({'action': 'categories'});
        $scope.behaviours  = BehaviourAssessmentSystemService.query();
        $scope.skillCategories  = SkillAssessmentSystemService.query({'action': 'categories'});
        $scope.skills  = SkillAssessmentSystemService.query();

        $scope.addBehaviour = function(behaviour){
            behaviour.adding =  true;
            BehaviourAssessmentSystemService.save(behaviour,function(data){
                $scope.behaviours  = data.all;
                toaster.pop('success', "Behaviour Assessment System", "New Behaviour Added Succesfully");
                behaviour.adding = false;
                behaviour.name = '';
                $scope.$emit('refreshSchoolData');
            },function(){
                behaviour.adding = false;
                toaster.pop('error', "behaviour Assessment System", "Failed to add behaviour");
            });
        };

        $scope.removeBehaviour = function(behaviour){
            behaviour.removing =  true;
            BehaviourAssessmentSystemService.delete(behaviour,function(data){
                behaviour.removing =  false;
                $scope.behaviours  = data.all;
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

        $scope.addSkill = function(skill){
            skill.adding =  true;
            SkillAssessmentSystemService.save(skill,function(data){
                skill.adding =  false;
                skill.name =  '';
                $scope.skills  = data.all;
                toaster.pop('success', "Skill Assessment System", "Added Succesfully");
                $scope.$emit('refreshSchoolData');
            },function(){
                skill.adding =  false;
                toaster.pop('error', "Skill Assessment System", "Failed to Add");
            });
        };

        $scope.removeSkill = function(skill){
            skill.removing =  true;
            SkillAssessmentSystemService.delete(skill,function(data){
                $scope.skills  = data.all;
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
