/**
*  Dashboard Controller
**/

app.controller('DashboardCtrl', function($scope, Projects, Users, Photos){
    
    $scope.projects = {};
    $scope.user = {};
    $scope.photos = {};
    $scope.message = false;

    var $projects = Projects.query();
    $projects.$promise.then(function (rs) {
        $scope.projects = rs.data;
    });

    var $user = Users.query({id:5});
    $user.$promise.then(function (rs) {
        $scope.user = rs.data;
    });

    var $photos = Photos.query({id:26});
    $photos.$promise.then(function (rs) {
        $scope.photos = rs;
    });

    $scope.sendForm = function () {
        Users.update({id: $scope.user.id}, $scope.user, function (rs) {
            if (typeof rs.message !== 'undefined') {
                $scope.message = rs.message;
            }
            $scope.user = rs.data;
        });
    }


});