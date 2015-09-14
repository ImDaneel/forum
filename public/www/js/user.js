angular.module('starter.user', [])
.controller('UserController', function($scope, $state, UserService, Auth) {
    $scope.errAuth = false;

    $scope.login = function(usr, password){
        var data = {'name' : usr, 'password' : password, '_token' : Auth.getToken()};
        $scope.errAuth = false;
        UserService.login(data).then(function(result){
            if(result.code == "success"){
                Auth.setToken(result._token);
                Auth.setAuth(usr);
                $state.go(Auth.getStoreState());
            }else if(result.code == "error"){
                Auth.clearAuth();
                $scope.errAuth = true;
            }
        }, function(err){
            Auth.clearAuth();
            $scope.errAuth = true;
        });
    };
    $scope.gotoRegister = function(){
        $state.go("register");
    };
})
.controller('RegisterController', function($scope, $state, UserService, Auth) {
    $scope.errRegister = false;
    $scope.errMsg = null;

    $scope.register = function(usr, password, confirmpassword){
        var data = {'name' : usr, 'password' : password, 'password_confirmation' : confirmpassword, '_token' : Auth.getToken()};
        $scope.errRegister = false;
        UserService.register(data).then(function(result){
            if(result.code == "success"){
                Auth.setToken(result._token);
                Auth.setAuth(usr);
                $state.go(Auth.getStoreState());
            }else if(result.code == "error"){
                Auth.clearAuth();
                $scope.errRegister = true;
            }
        }, function(err){
            Auth.clearAuth();
            $scope.errRegister = true;
        });
    };
})
.factory('UserService', function($q, $http){
    var login = function(data){
        var deferred = $q.defer();
        $http({  
            method: 'POST',  
            url: 'http://182.92.115.17/login',  
            headers: {
                'Content-Type': 'application/json',
                "Accept": "application/json, text/plain, */*"
            },
            data : data
        }).success(function(data,status,headers,config){  
            deferred.resolve(data);
        }).error(function(data,status,headers,config){
            deferred.reject(data);
        });

        return deferred.promise;
    };
    
    var register = function(data){
        var deferred = $q.defer();
        $http({  
            method: 'POST',  
            url: 'http://182.92.115.17/signup',  
            headers: {
                'Content-Type': 'application/json',
                "Accept": "application/json, text/plain, */*"
            },
            data : data
        }).success(function(data,status,headers,config){  
            deferred.resolve(data);
        }).error(function(data,status,headers,config){
            deferred.reject(data);
        });

        return deferred.promise;
    };


    return {
        login :login,
        register : register
    };


})
.factory('Auth', function(){
    
    var isAuth = false;
    var usr = null;
    var _token = null;
    var state, params;

    var setAuth = function(usr){
        isAuth = true;
        usr = usr;
    };
    var clearAuth = function(){
        isAuth = false;
        usr = null;
    };

    var isAuth = function(){
        return isAuth;
    };

    var setToken = function(token){
        _token = token;
    };
    var getToken = function(){
        return _token;
    };

    var storeState = function(fromState, fromParams){
        state = fromState;
        params = fromParams;
    };

    var getStoreState = function(){
        return state.name;
    };

    return {
        //login : login,
        setAuth : setAuth,
        clearAuth : clearAuth,
        isAuth : isAuth,
        setToken : setToken,
        getToken : getToken,
        storeState : storeState,
        getStoreState : getStoreState
    };

});
