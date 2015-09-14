// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic',/* 'starter.plangraph',*/'starter.homeRobot', 'starter.forum','starter.forumService', 'starter.forumDirective', 'starter.user', 'starter.posting', 'starter.reply'])
.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})
.run(['$rootScope', '$state', 'Auth', function ($rootScope, $state, Auth) {

    $rootScope.$on("$stateChangeStart", function (event, toState, toParams, fromState, fromParams) {
        
        if(toState.name === 'login'){
            Auth.storeState(fromState, fromParams);
        }
    });

}])
.config(function($stateProvider, $urlRouterProvider, $ionicConfigProvider) {
    $ionicConfigProvider.backButton.icon('ion-ios-arrow-back');
    $ionicConfigProvider.backButton.text('');
    $ionicConfigProvider.backButton.previousTitleText(false);
                    
    $stateProvider
    .state('main', {
            url: '/main',
            abstract: true,
            templateUrl: 'templates/sidemenu.html',
            controller: 'MainController',
    })
   // .state('main.robot', {
     //       url: '/robot',
       //     views : {
         //       'menuContent' : {
           //         templateUrl: 'templates/homerobot.html',
             //       controller: 'RobotController',
               // }
           // }
   // })
    .state('main.forum', {
            url: '/forum',
            views : {
                'menuContent' : {
                    templateUrl: 'templates/robotforum.html',
                    controller: 'ForumController',
                }
            }
    })
   .state('main.mine', {
            url: '/mine',
            views : {
                'menuContent' : {
                    templateUrl: 'templates/homerobot.html',
                    controller: 'RobotController',
                }
            }
    })
   .state('topicinfo', {
        cache : false,
        url : '/topicinfo',
        templateUrl: 'templates/topicInfo.html',
        controller: 'TopicController',
    })  
   .state('login', {
        url : '/login',
        templateUrl: 'templates/login.html',
        controller: 'UserController',
    })
   .state('posting', {
        url : '/posting',
        templateUrl: 'templates/posting.html',
        controller: 'PostingController',
    })
   .state('reply', {
        url : '/reply',
        templateUrl: 'templates/reply.html',
        controller: 'ReplyController',
    })
   .state('register', {
        url : '/register',
        templateUrl: 'templates/register.html',
        controller: 'RegisterController',
    });
    $urlRouterProvider.otherwise('/main/forum');
    //$urlRouterProvider.otherwise('/main/robot');
})
.factory('myInterceptor', function($q, $timeout, $location, Auth){
    var interceptor = {
        'request':function(config){
            //var re = /upvote/;
            //if(re.test(config.url) && !Auth.isAuth()){
             //   var defer = $q.defer();
              //  currentRequests.push(defer);
              //  config.timeout = defer.promise;
                //$location.path('/login');
           // }
            return config;
        },
        
        'response':function(response){
            if(response.data._token){
                Auth.setToken(response.data._token);
            }
            return response;
        },

        'requestError':function(rejection){
            return $q.reject(rejection);
        },
        'responseError':function(response){
            
            var status = response.status;
            if( status == 401 || status == 403){
                $timeout(function(){
                    $location.path('/login');
                }, 1000);
            }
            
            return $q.reject(response);
        }
    }
    return interceptor;
})
.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.withCredentials = true;
    $httpProvider.interceptors.push('myInterceptor');
}]);


