angular.module('starter.homeRobot', [])
.controller('RobotController', function($scope, $ionicPopover, 
            $state, $ionicSideMenuDelegate) {

    $ionicPopover.fromTemplateUrl('templates/dropdown.html', {
        scope: $scope,
    }).then(function(popover) {
        $scope.popover = popover;
    });

    $scope.openPopover = function($event) {
        $scope.popover.show($event);
    };
    $scope.closePopover = function() {
        $scope.popover.hide();
    };
    $scope.$on('$destroy', function() {
        $scope.popover.remove();
    });


})
.controller('MainController', function($scope){
});
