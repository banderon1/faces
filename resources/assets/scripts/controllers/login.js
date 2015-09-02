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
            password:'test1234'
        };

        $scope.submit = function() {

            $http.post('/auth/login', this.auth).
                then(function(response) {
                    console.log(response.data);
                    //if success
                    //$location.path('/dashboard');
                    //return false;
                    //else
                    //show errors
                }, function(response) {
                    console.error(response.data);
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                });
            return false;
        }

    });
