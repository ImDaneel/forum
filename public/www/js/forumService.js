angular.module('starter.forumService',[])
.factory('forumService', ['$q', '$http', 'Auth',function($q, $http, Auth){
    
    var getForumService = function(url){
        var deferred = $q.defer();
        $http({  
            method: 'GET',  
            url: url, //'http://182.92.115.17/topics?filter=excellent',  
            headers: {
                "Accept": "application/json, text/plain, */*"
            }
        }).success(function(data,status,headers,config){  
            deferred.resolve(data);
        }).error(function(data,status,headers,config){
            deferred.reject(data);
        });

        return deferred.promise;
    };
    
    var getNodeTopics = function(nodeIndex){
        return getForumService('http://182.92.115.17/nodes/'+nodeIndex);
    };
   
    var getEssence = function(){
        return getForumService('http://182.92.115.17/topics?filter=excellent');
    };

    var topicIndex = null;
    var setTopic = function(topicID){
        topicIndex = topicID;
    };
    var getTopicID = function(){
        return topicIndex;
    };

    var getTopicInfo = function(){
        return getForumService('http://182.92.115.17/topics/'+topicIndex);
    };

    var postService = function(url, data){
        var deferred = $q.defer();
        $http({  
            method: 'POST',  
            url: url,  
            headers: {
                'Content-Type': 'application/json',
                "Accept": "application/json"
            },
            data : data
        }).success(function(data,status,headers,config){  
            deferred.resolve(data);
        }).error(function(data,status,headers,config){
            deferred.reject(data);
        });

        return deferred.promise;

    };

    var upvote = function(topicID, data){
        return postService('http://182.92.115.17/topics/'+topicID+'/upvote', data);
    };
    
    var favorite = function(topicID, data){
        return postService('http://182.92.115.17/favorites/'+topicID, data);
    };

    var votereply = function(replyID, data){
        return postService('http://182.92.115.17/replies/'+replyID+'/vote', data);
    };

    var reply = function(data){
        return postService('http://182.92.115.17/replies', data);
    };
    
    var posting = function(data){
        return postService('http://182.92.115.17/topics', data);
    };

    return{
        getEssence : getEssence,
        getNodeTopics : getNodeTopics,
        getTopicInfo : getTopicInfo,
        setTopic : setTopic,
        getTopicID : getTopicID,
        upvote : upvote,
        favorite : favorite,
        votereply : votereply,
        reply : reply,
        posting : posting
    };

}]);

