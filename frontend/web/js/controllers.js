var controllers = angular.module('controllers',[]);

controllers.controller('MainController',['$scope','$location','$window',function($scope,$location,$window){
    $scope.loggedIn = function(){
        return Boolean($window.sessionStorage.access_token);
    };
    $scope.logout = function(){
        delete $window.sessionStorage.access_token;
        $location.path('/login').replace();
    }
}]);

controllers.controller('DashboardController',['$scope','$http',function($scope,$http){
    $http.get('api/dashboard').success(function(data){
        $scope.dashboard = data;
    })
}])