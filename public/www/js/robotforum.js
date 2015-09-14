angular.module('starter.forum', ['starter.forumService', 'starter.user'])
.controller('ForumController', function($scope, $state, forumService, Auth) {
    

    $scope.nodeInfo = [{index : null, bgcolor : '#cccccc'},
                        {index : 47, bgcolor : 'white'},{index : 48, bgcolor : 'white'},{index : 49, bgcolor : 'white'},{index : 50, bgcolor : 'white'}];
    
    $scope.getNode = function(nodeIndex){
        for (var i in $scope.nodeInfo){
            $scope.nodeInfo[i].bgcolor = 'white';
        }
        $scope.nodeInfo[nodeIndex].bgcolor = '#cccccc';
        if(nodeIndex == 0){
            $scope.getEssence();
        }else{
            forumService.getNodeTopics($scope.nodeInfo[nodeIndex].index).then(function(data){
                $scope.topics = data.topics;
                $scope.nodeName = data.current_node;
            }, function(err){
            });
        }
    };

    $scope.gotoTopic = function(topicID){
        forumService.setTopic(topicID);
        $state.go('topicinfo', {topicID : topicID});
    };

    $scope.getEssence = function(){
        forumService.getEssence().then(function(data){
            $scope.topics = data.topics;
            $scope.nodes = data.nodes;
        }, function(err){
        });
    };

    $scope.getEssence();

})
.controller('TopicController', function($scope, $state, $stateParams, $ionicHistory, forumService, Auth) {
    forumService.getTopicInfo().then(function(data){
        $scope.topic = data.topic;
        $scope.replies = data.replies;
        $scope.$broadcast('topicok');
    });

    $scope.goBack = function() {
            $ionicHistory.goBack();
    };

    $scope.upvote = function(topicID){
        var data = {_token : Auth.getToken()};
        forumService.upvote(topicID, data).then(function(data){
            //update number of upvote
            if(data.code == "success"){
                $scope.topic.vote_count = data.vote_count;
            }
        });
    };
    $scope.favorite = function(topicID){
        var data = {_token : Auth.getToken()};
        forumService.favorite(topicID, data).then(function(data){
            //update number of favorite
            if(data.code == "success"){
                $scope.topic.favorite_count = data.favorite_count;
            }
        });
    };
    $scope.votereply = function(replyID){
    
        var data = {_token : Auth.getToken()};
        forumService.votereply(replyID, data).then(function(data){
            //update number of vote?

        });
    
    };

    $scope.reply = function(topicID){
        $state.go('reply');
    };
    $scope.replyreply = function(replyID){
        $state.go('reply');
    };
});
