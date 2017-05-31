starterApp.controller('InsideReportedQuestionCtrl', function ($ionicPopup, $scope, accessService, $stateParams, $state) {
    $scope.inReportedQuestion;
    $scope.reportq = false;
    $scope.reportqs = [];
    $scope.valorationsa = [];
    $scope.passa;
    $scope.confirma;
    $scope.finaltesta;
    $scope.theFilterA = "dateIn";
    function inReportedQuestion() {
        $scope.inReportedQuestion = $scope.$parent.insiderMommy;
    }

    function loadReports() {
        $scope.reportqs = [];
        $scope.gimmeReports = angular.copy($scope.inReportedQuestion);
        var promise = accessService.getData("adminphp/controllers/MainController.php",
                true, "POST", {controllerType: 4, action: 10060, jsonData: JSON.stringify($scope.gimmeReports)});
        promise.then(function (outputData) {
            if (outputData[0] == true) {
                for (var i = 0; i < outputData[1].length; i++) {
                    var reportq = new Reportq();
                    reportq.setIdreport(outputData[1][i].idreport);
                    reportq.setNickname(outputData[1][i].nickname);
                    reportq.setIdquestion(outputData[1][i].idquestion);
                    reportq.setReporttext(outputData[1][i].reporttext);
                    reportq.setDate(outputData[1][i].date);
                    $scope.reportqs.push(reportq);
                    console.log("LLLLLLLLLLLLL"+$scope.reportqs);
                }
            } else {
                if (angular.isArray(outputData[1])) {
                    $scope.showPopup("Amazingly it's happening!", "This question doesn't have reportqs yet!");
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
    $scope.removeReport = function (reportq) {
        $scope.reportqToDelete = [];
        $scope.reportqToDelete.push(reportq);
        $scope.reportqToDelete= angular.copy($scope.reportqToDelete);
        //Server conenction to verify user's data
        var promise = accessService.getData("adminphp/controllers/MainController.php",
                true, "POST", {controllerType: 4, action: 10030,
                    jsonData: JSON.stringify($scope.reportqToDelete)});
        promise.then(function (outputData) {
            if (outputData[0] === true) {
                $scope.showPopup("Report removed :)");
                loadReports();
                $state.go('app.manage');
                $scope.reloadReports();
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


    inReportedQuestion();
    loadReports();
});
