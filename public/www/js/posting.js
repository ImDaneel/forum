angular.module('starter.posting', ['starter.forumService', 'starter.user'])
.controller('PostingController', function($scope, $ionicHistory, $state, forumService, Auth) {
    $scope.posting = {};

    $scope.postTopic = function(){
        $scope.posting._token = Auth.getToken();
        forumService.posting($scope.posting).then(function(result){
            if(result.code == "success"){
                forumService.setTopic(result.topic_id);
                $state.go('topicinfo', {topicID : result.topic_id});
            }else{
            
            }
        });
    };

    $scope.switchImage = function(){
    
    };

    $scope.switchImotion = function(){
    
    };

    $scope.goBack = function() {
            $ionicHistory.goBack();
    };
});
