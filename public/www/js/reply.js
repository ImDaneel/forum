angular.module('starter.reply', ['starter.forumService', 'starter.user'])
.controller('ReplyController', function($scope, $ionicHistory, $state, forumService, Auth) {
    $scope.reply = {};

    $scope.replyTopic = function(){
        $scope.reply._token = Auth.getToken();
        $scope.reply.topic_id = forumService.getTopicID();
        forumService.reply($scope.reply).then(function(result){
            if(result.code == "success"){
                $state.go('topicinfo');
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
