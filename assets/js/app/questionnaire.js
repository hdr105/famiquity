(function ($) {
    var app = angular.module('questionApp', ['ngSanitize']);

    app.service('dataService', function ($http) {
        delete $http.defaults.headers.common['X-Requested-With'];
        this.getData = function () {
            // $http() returns a $promise that we can add handlers with .then()
            return $http({
                method: 'GET',
                url: base_url+'life-decisions',
            });
        }
    });

    app.controller('formController', ['$http', '$scope', '$sce', 'dataService',function ($http, $scope, $sce, dataService) {
        
            $scope.test = "test";
            dataService.getData().then(function(dataResponse) {
            $scope.test = $sce.trustAsHtml(dataResponse.data);
            $('select.fancyselect:not(.ignore)').niceSelect();
    });
            //alert(base_url);
        }]);
})(jQuery);


