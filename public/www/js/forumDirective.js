angular.module('starter.forumDirective',[])
//.directive('myTopic', function(){
//})
.directive('mytopicBody', function(){
    return {
        restrict : 'AE',
        transclude : true,
        template :'<div></div>',
        scope : false,
        replace :true,
        link : function(scope, iElement, iAttrs){
            scope.$on('topicok',function(e){
                iElement.append(scope.topic.body);
            });
        },
    };

})
.directive('topicBody', function(){
    return {
        restrict : 'AE',
        //transclude : true,
        template :'<div></div>',
        scope : {
            body :'@',
        },
        replace :true,
        link : function(scope, iElement, iAttrs){
            iElement.append(scope.body);
        },
    };

});
