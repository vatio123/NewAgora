starterApp.controller('InsideReportedAnswerCtrl', function ($ionicPopup, $scope, accessService, $stateParams, $state) {
    $scope.inReportedAnswer;
    $scope.reporta = false;
    $scope.reportas = [];
    $scope.valorationsa = [];
    $scope.passa;
    $scope.confirma;
    $scope.finaltesta;
    $scope.theFilterA = "dateIn";
    function inReportedAnswer() {
        $scope.inReportedAnswer = $scope.$parent.insiderMommyAnwsers;
    }

    function loadReports() {
        $scope.reportas = [];
        $scope.gimmeReports = angular.copy($scope.inReportedAnswer);
        var promise = accessService.getData("adminphp/controllers/MainController.php",
                true, "POST", {controllerType: 3, action: 10060, jsonData: JSON.stringify($scope.gimmeReports)});
        promise.then(function (outputData) {
            if (outputData[0] == true) {
                for (var i = 0; i < outputData[1].length; i++) {
                    var reporta = new Reporta();
                    reporta.setIdreporta(outputData[1][i].idreporta);
                    reporta.setNickname(outputData[1][i].nickname);
                    reporta.setIdanswer(outputData[1][i].idanswer);
                    reporta.setReporttext(outputData[1][i].reporttext);
                    reporta.setDate(outputData[1][i].date);
                    $scope.reportas.push(reporta);
                    console.log("LLLLLLLLLLLLL"+$scope.reportas);
                }
            } else {
                if (angular.isArray(outputData[1])) {
                    $scope.showPopup("Amazingly it's happening!", "This answer doesn't have reportas yet!");
                    $state.go('app.manage');
                    $scope.$parent.reloadReports();
                } else {
                    alert("There has been an error in the server, try later");
                }
            }
        });
    }

    /**
     * removeReport
     * @param {type} report
     * @returns {undefined}
     */
    $scope.removeReport = function (reporta) {
        $scope.reportaToDelete = [];
        $scope.reportaToDelete.push(reporta);
        $scope.reportaToDelete= angular.copy($scope.reportaToDelete);
        //Server conenction to verify user's data
        var promise = accessService.getData("adminphp/controllers/MainController.php",
                true, "POST", {controllerType: 3, action: 10030,
                    jsonData: JSON.stringify($scope.reportaToDelete)});
        promise.then(function (outputData) {
            if (outputData[0] === true) {
                $scope.showPopup("Report removed :)");
                loadReports();
            } else {
                if (angular.isArray(outputData[1])) {
                    console.log(outputData);
                } else {
                    alert("There has been an error in the server, try later");
                }
            }
        });
    };

    $scope.showPopup = function (header, msg) {
        var alertPopup = $ionicPopup.alert({
            title: header,
            template: msg
        });
        alertPopup.then(function (res) {
            //$state.go('app.playlists');
            //$scope.$parent.openModal(1);
            //$state.go('app.report');
        });
    };


    inReportedAnswer();
    loadReports();
});
