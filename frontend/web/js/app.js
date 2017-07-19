var app = angular.module('districtApp', [
    'ngRoute'
]);
app.factory('authInterceptor', function ($q, $window, $location) {
    return {
        request: function (config) {
            if ($window.sessionStorage.access_token) {
                //HttpBearerAuth
                config.headers.Authorization = 'Bearer ' + $window.sessionStorage.access_token;
            }
            return config;
        },
        responseError: function (rejection) {
            if (rejection.status === 401) {
                $location.path('/login').replace();
            }
            return $q.reject(rejection);
        }
    };
});
app.config(['$routeProvider','$httpProvider',
    function($routeProvider,$httpProvider) {
        $routeProvider.
            when('/', {
                templateUrl: 'partials/index.html'
            }).
            when('/about', {
                templateUrl: 'partials/about.html'
            }).
            when('/contact', {
                templateUrl: 'partials/contact.html'
            }).
            when('/login', {
                templateUrl: 'partials/login.html',
                controller : 'LoginController',
                controllerAs: 'login'
            }).
            when('/signup', {
                templateUrl: 'partials/signup.html',
                controller : 'SignupController',
                controllerAs : 'signup'
            }).
            when('/dashboard', {
                templateUrl: 'partials/dashboard.html',
                controller : 'DashboardController',
                resolve : {
                    authorize : ['$window','$location',function($window,$location){
                        if(Boolean($window.sessionStorage.access_token)){
                            return true;
                        }
                        else {
                            $location.path('/login').replace();
                        }
                    }]
                }
            }).
            when('/complaint', {
                templateUrl: 'partials/complaint.html',
                controller : 'ComplaintController',
                resolve : {
                    authorize : ['$window','$location',function($window,$location){
                        if(Boolean($window.sessionStorage.access_token)){
                            return true;
                        }
                        else {
                            $location.path('/login').replace();
                        }
                    }]
                }
            }).
            otherwise({
                templateUrl: 'partials/404.html'
            });
             $httpProvider.interceptors.push('authInterceptor');
    }
]);

app.controller('MainController',['$scope','$location','$window','$log','UserService',function($scope,$location,$window,$log,UserService){
    $scope.loggedIn = function() {
        return Boolean($window.sessionStorage.access_token);
    };
    $scope.logout = function () {
        delete $window.sessionStorage.access_token;
        $location.path('/login').replace();
    };
    
}]);

app.controller('DashboardController',['$scope','$http','$rootScope','UserService',function($scope,$http,$rootScope,UserService){
    UserService.userInfo().then(function(data){
        $rootScope.loggedInUser = data;
    })
}]);
app.controller('ComplaintController',['$scope','$http','$location','MandalListService','VillageListService','IssueListService',function($scope,$http,$location,MandalListService,VillageListService,IssueListService){
    var complaint = this;
    MandalListService.mandalList().then(function(data){
         $scope.mandals =data;
    });
    IssueListService.issuesList().then(function(data){
        $scope.issues =data;
    });
    $scope.getVillages = function(){
        VillageListService.villageList(complaint.complaintInfo.mandal).then(function(data){
             $scope.villages =data;
        });
    }
    $scope.raiseComplaint = function(){
        return $http({
            method: 'POST',
            url: 'index.php?r=api/raise-complaint',
            data : complaint.complaintInfo,
        })
        .then(function(response) {
            if(response.data.type === 'success') {
                 $location.path('/dashboard').replace();
            }
        })
        .catch(function(error) {
            console.log(error)
            $log.error('ERROR:', error);
            throw error;
        });
    }
    
}])

app.controller('SignupController',['$scope','$http','$log','$location','DistrictListService','ReligionListService','CastListService',function($scope,$http,$log,$location,DistrictListService,ReligionListService,CastListService){
    var signup = this;
    //$scope.religions =  ReligionListService.getReligionList();
    ReligionListService.getReligionList().then(function(data){
         $scope.religions =data;
    });
    CastListService.getCasteList().then(function(data){
         $scope.castes =data;
    });
     $scope.register = function(){
        $scope.submitted = true;
        $scope.error = {};
        return $http({
            method: 'POST',
            url: 'index.php?r=api/register',
            data : signup.user,
        })
        .then(function(response) {
            if(response.data.type === 'success') {
                 $location.path('/login').replace();
            }
            else {
                angular.forEach(response.data.errors,function(value,key){
                    $scope.error[key] = value[0];
                });
            }
        })
        .catch(function(error) {
            console.log(error)
            $log.error('ERROR:', error);
            throw error;
        });
     };
}])

app.controller('LoginController',['$scope','$http','$log','$window','$location',function($scope,$http,$log,$window,$location){
    var login = this;
    $scope.signin = function(){
        return $http({
            method: 'POST',
            url: 'index.php?r=api/login',
            data : login.userModel,
        })
        .then(function(response) {
            if(response.data.type === 'success') {
                $window.sessionStorage.access_token = response.data.access_token;
                $location.path('/dashboard').replace();
            }
            else {
                angular.forEach(response.data.errors,function(value,key){
                    $scope.LoginForm[key].$error.serverError = true;
                    $scope.LoginForm[key].$error.serverMessage = value[0];
                });
            }
        })
        .catch(function(error) {
            console.log(error)
            $log.error('ERROR:', error);
            throw error;
        });
     };
}]);

app.run(['$rootScope', '$location','$window', function ($rootScope, $location,$window) {
    $rootScope.$on('$routeChangeStart', function (event,next,current) {
        
        
    });
}]);