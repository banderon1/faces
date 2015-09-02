'use strict';

/**
 * @ngdoc function
 * @name yapp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of yapp
 */
angular
    .module('yapp')
    .controller('LoginCtrl', function($scope, $location, $http) {

        $http.defaults.headers.common['X-CSRF-TOKEN'] = document.getElementById('csrf').getAttribute('value');

        $scope.auth = {
            email:'foo@bar.com',
            password:'test1234',
            errorMsg:''
        };

        $scope.submit = function() {

            $http.post('/auth/login-ajax', this.auth).
                then(function(response) {

                    //success
                    $location.path('/dashboard');
                    return false;

                }, function(response) {
                    //show errors
                    $scope.auth.errorMsg = response.data.error;
                });
            return false;
        }

    });
