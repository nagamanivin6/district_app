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
app.service('CasteGroupListService', function ($http, $log,$q) {
    var  casteGroupData = [];
    function getCasteGroupList(casteId){
        var d = $q.defer();
        if(casteGroupData[casteId]){
            d.resolve(casteGroupData[casteId]);
        }
        else {
            $http({method: 'GET', url: 'index.php?r=api/caste-groups',params : {"caste_id":casteId}}).then(
                function success(response) {
                    casteGroupData[casteId] = response.data;
                    d.resolve(casteGroupData[casteId]);
                },
                function failure(reason) {
                    d.reject(reason);
                }
            );
        }
        return d.promise;
    }
    function clearCasteGroupList(){
        casteGroupData = [];
    }
    return {
        getCasteGroupList : getCasteGroupList,
        clearCasteGroupList:clearCasteGroupList
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
app.service('MandalListService', function ($http, $log,$q) {
    var mandalData;
    function getMandalList(){
        var d = $q.defer();
        if(mandalData){
            d.resolve(mandalData);
        }
        else {
            $http({method: 'GET', url: 'index.php?r=api/mandals'}).then(
                function success(response) {
                    mandalData = response.data;
                    d.resolve(mandalData);
                },
                function failure(reason) {
                    d.reject(reason);
                }
            );
        }
        return d.promise;
    }
    function clearMandalList(){
        mandalData = null;
    }
    return {
        getMandalList : getMandalList,
        clearMandalList:clearMandalList
    }
});
app.service('VillageListService', function ($http, $log,$q) {
    var  villagesData = [];
    function getVillageList(mandalId){
        var d = $q.defer();
        if(villagesData[mandalId]){
            d.resolve(villagesData[mandalId]);
        }
        else {
            $http({method: 'GET', url: 'index.php?r=api/villages',params : {"mandal":mandalId}}).then(
                function success(response) {
                    villagesData[mandalId] = response.data;
                    d.resolve(villagesData[mandalId]);
                },
                function failure(reason) {
                    d.reject(reason);
                }
            );
        }
        return d.promise;
    }
    function clearVillagesList(){
        villagesData = [];
    }
    return {
        getVillageList : getVillageList,
        clearVillagesList:clearVillagesList
    }
});
app.service('IssueListService', function ($http, $log,$q) {
    var  issuesList;
    function getIssuesList(){
        var d = $q.defer();
        if(issuesList){
            d.resolve(issuesList);
        }
        else {
            $http({method: 'GET', url: 'index.php?r=api/issues-list'}).then(
                function success(response) {
                    issuesList = response.data;
                    d.resolve(issuesList);
                },
                function failure(reason) {
                    d.reject(reason);
                }
            );
        }
        return d.promise;
    }
    function clearIssuesList(){
        issuesList = null;
    }
    return {
        getIssuesList : getIssuesList,
        clearIssuesList:clearIssuesList
    }
});