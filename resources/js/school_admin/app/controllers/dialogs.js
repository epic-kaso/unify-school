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