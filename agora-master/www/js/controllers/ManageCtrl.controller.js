starterApp.controller('ManageCtrl', function ($scope, accessService, $stateParams, $state) {
    $scope.questions = [];
    $scope.answers = [];
    $scope.insider;
    $scope.topics = [];
    $scope.valorationsq = [];
    $scope.theFilter = "date";
    $scope.choice;

    $scope.insideQuestion = function (question) {
        $scope.$parent.insiderMommy = question;
        $state.go('app.report');
    };
    $scope.goToReportedQuestions = function () {
        $state.go('app.manageReportQ');
    };
    $scope.goToReportedAnswers = function () {
        $state.go('app.manageReportA');
    };

    $scope.loadInitData = function () {
        $scope.answers = [];
        //Server conenction to verify user's data
        var promise = accessService.getData("adminphp/controllers/MainController.php",
                true, "POST", {controllerType: 2, action: 10050, jsonData: ""});
        promise.then(function (outputData) {
            $scope.$parent.howManyQuestions = 0;
            if (outputData[0] === true) {
                for (var i = 0; i < outputData[1].length; i++) {
                    var question = new Question();
                    question.setIdquestion(outputData[1][i].idquestion);
                    question.setNickname(outputData[1][i].nickname);
                    question.setTopicname(outputData[1][i].topicname);
                    question.setInput(outputData[1][i].input);
                    question.setDateIn(outputData[1][i].date);
                    $scope.questions.push(question);
                    $scope.$parent.howManyQuestions = $scope.$parent.howManyQuestions + 1;
                }
            } else {
                console.log(outputData);
                if (angular.isArray(outputData[1])) {
                    $scope.showPopup("INFO", "There aren't any reported questions.");
                    console.log(outputData[1]);
                } else {
                    alert("There has been an error in the server, try later");
                }
            }
        });
        alert("hello");
        var promise = accessService.getData("adminphp/controllers/MainController.php",
                true, "POST", {controllerType: 1, action: 10060, jsonData: ""});
        promise.then(function (outputData) {
            if (outputData[0] === true) {
                console.log(outputData);
                //INSERT INTO `answers`(`idanswer`, `nickname`, `idquestion`, `input`, `date`
                for (var i = 0; i < outputData[1].length; i++) {
                    var answer = new Answer();
                    answer.setIdanswer(outputData[1][i].idanswer);
                    answer.setNickname(outputData[1][i].nickname);
                    answer.setIdquestion(outputData[1][i].idquestion);
                    answer.setInput(outputData[1][i].input);
                    answer.setDateIn(outputData[1][i].date);
                    $scope.answers.push(answer);
                }
                console.log("Answerssssssss"+$scope.answers);
            } else {
                console.log(outputData);
                if (angular.isArray(outputData[1])) {
                    $scope.showPopup("INFO", "There aren't any reported answers.");
                    console.log(outputData[1]);
                } else {
                    alert("There has been an error in the server, try later");
                }
            }
        });
    };
    
    if (localStorage.getItem('user') != undefined &&
            localStorage.getItem('user') != "removed") {
        var usersaved = JSON.parse(localStorage.getItem('user'));
        //nickname, userscore, firstname, lastname, email, password, postalcode
        $scope.theuser.construct(
                usersaved.nickname,
                usersaved.userscore,
                usersaved.firstname,
                usersaved.lastname,
                usersaved.email,
                usersaved.password,
                usersaved.postalcode
                );

        //alert("user found");
    }
   
    $scope.loadTopics = function () {
        //Server conenction to verify user's data
        var promise = accessService.getData("adminphp/controllers/MainController.php",
                true, "POST", {controllerType: 7, action: 10000, jsonData: ""});
        promise.then(function (outputData) {
            if (outputData[0] === true) {
                var topic = new Topic();
                topic.setTopicname("All");
                topic.setMaintopic("All");
                $scope.topics.push(topic);
                for (var i = 0; i < outputData[1].length; i++) {
                    var topic = new Topic();
                    topic.setTopicname(outputData[1][i].topicname);
                    topic.setMaintopic(outputData[1][i].maintopic);
                    $scope.topics.push(topic);
                }
                $scope.selectedTopic = $scope.topics[0].topicname;
            } else {
                console.log(outputData);
                if (angular.isArray(outputData[1])) {
                    alert(outputData[1]);
                } else {
                    alert("There has been an error in the server, try later");
                }
            }
        });
    };


    /**
     * removeQuestion
     * renove a review
     * @param {type} indexQuestion
     * @returns {undefined}
     */
    $scope.removeQuestion = function (question) {
        console.log(question);
        $scope.question= angular.copy(question);
        //Server conenction to verify user's data
        var promise = accessService.getData("adminphp/controllers/MainController.php",
                true, "POST", {controllerType: 2, action: 10020,
                    jsonData: JSON.stringify($scope.question)});
        promise.then(function (outputData) {
            if (outputData[0] === true) {
                $scope.showPopup("Question removed :)");
                $scope.loadInitData();
                $scope.$parent.howManyQuestions = $scope.$parent.howManyQuestions - 1;
            } else {
                if (angular.isArray(outputData[1])) {
                    console.log(outputData);
                } else {
                    alert("There has been an error in the server, try later");
                }
            }
        });
    };

    
    $scope.loadValorations = function () {
        var promise = accessService.getData("adminphp/controllers/MainController.php",
                true, "POST", {controllerType: 6, action: 10000, jsonData: ""});
        promise.then(function (outputData) {
            if (outputData[0] === true) {
                var valoration = new Valorationq();
                for (var i = 0; i < outputData[1].length; i++) {
                    var valoration = new Valorationq();
                    valoration.setIdvalorationq(outputData[1][i].idvalorationq);
                    valoration.setIdquestion(outputData[1][i].idquestion);
                    valoration.setValoration(outputData[1][i].valoration);
                    valoration.setNickname(outputData[1][i].nickname);
                    $scope.valorationsq.push(valoration);
                }
                for (var i = 0; i < $scope.questions.length; i++) {
                    var acumVal = 0;
                    for (var j = 0; j < $scope.valorationsq.length; j++) {
                        if ($scope.questions[i].idquestion == $scope.valorationsq[j].idquestion) {
                            acumVal += parseInt($scope.valorationsq[j].valoration);
                        }
                        if ($scope.valorationsq[j].nickname == $scope.$parent.theuser.nickname &&
                                $scope.valorationsq[j].idquestion == $scope.questions[i].idquestion) {
                            $scope.questions[i].setRated(true);
                        }
                    }
                    $scope.questions[i].setTotalvaloration(acumVal);
                }
            } else {
                if (angular.isArray(outputData[1])) {
                    alert(outputData[1]);
                } else {
                    alert("There has been an error in the server, try later");
                }
            }
        });
    }; // END loadValorations

    $scope.loadInitData();
    $scope.loadTopics();
    $scope.loadValorations();
    
});
