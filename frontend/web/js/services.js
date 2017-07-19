app.service('DistrictListService', function ($http, $log) {
    var districtsData;
    
    this.districtList = function () {
        if(districtsData) {
            return istrictsData;
        }
        else {
            return $http({
                method: 'GET',
                url: 'index.php?r=api/districts',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
            .then(function(response) {
                districtsData = response.data; 
                return districtsData;
            })
            .catch(function(error) {
                $log.error('ERROR:', error);
                throw error;
            });
        }
        
    }
});
app.service('CastListService', function ($http, $log,$q) {
    var  casteData;
    function getCasteList(){
        var d = $q.defer();
        if(casteData){
            d.resolve(casteData);
        }
        else {
            $http({method: 'GET', url: 'index.php?r=api/castes'}).then(
                function success(response) {
                    casteData = response.data;
                    d.resolve(casteData);
                },
                function failure(reason) {
                    d.reject(reason);
                }
            );
        }
        return d.promise;
    }
    function clearCasteList(){
        casteData = null;
    }
    return {
        getCasteList : getCasteList,
        clearCasteList:clearCasteList
    }
});
app.service('ReligionListService', function ($http, $log,$q) {
    var religionData;
    function getReligionList(){
        var d = $q.defer();
        if(religionData){
            d.resolve(religionData);
        }
        else {
            $http({method: 'GET', url: 'index.php?r=api/religions'}).then(
                function success(response) {
                    religionData = response.data;
                    d.resolve(religionData);
                },
                function failure(reason) {
                    d.reject(reason);
                }
            );
        }
        return d.promise;
    }
    function clearReligionList(){
        religionData = null;
    }
    return {
        getReligionList : getReligionList,
        clearReligionList:clearReligionList
    }
    // this.getReligionList = function () {
    //     if(religionData) {
    //         return religionData;
    //     }
    //     else {
    //         return $http({
    //             method: 'GET',
    //             url: 'index.php?r=api/religions',
    //             headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    //         })
    //         .then(function(response) {
    //             religionData = response.data;
    //             return religionData;
    //         })
    //         .catch(function(error) {
    //             $log.error('ERROR:', error);
    //             throw error;
    //         });
    //     }
        
    // }
});
app.service('UserService', function ($http, $log) {
    this.userData;
    this.userInfo = function () {
        if(this.userData) {
            return this.userData;
        }
        else {
            return $http({
                method: 'POST',
                url: 'index.php?r=api/user-details',
            })
            .then(function(response) {
                this.userData = response.data
                return this.userData;
            })
            .catch(function(error) {
                console.log(error)
                $log.error('ERROR:', error);
                throw error;
            });
        }
    }
});
app.service('MandalListService', function ($http, $log) {
    this.mandalList = function () {
        return $http({
            method: 'GET',
            url: 'index.php?r=api/mandals',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {
            return response.data;
        })
        .catch(function(error) {
            $log.error('ERROR:', error);
            throw error;
        });
    }
});
app.service('VillageListService', function ($http, $log) {
    this.villageList = function (mandal) {
        return $http({
            method: 'GET',
            url: 'index.php?r=api/villages',
            params : {"mandal":mandal},
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {
            return response.data;
        })
        .catch(function(error) {
            $log.error('ERROR:', error);
            throw error;
        });
    }
});
app.service('IssueListService', function ($http, $log) {
    this.issuesList = function (mandal) {
        return $http({
            method: 'GET',
            url: 'index.php?r=api/issues-list',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .then(function(response) {
            return response.data;
        })
        .catch(function(error) {
            $log.error('ERROR:', error);
            throw error;
        });
    }
});