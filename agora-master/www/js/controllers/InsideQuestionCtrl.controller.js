starterApp.controller('InsideQuestionCtrl', function($scope, accessService, $stateParams, $state) {
  $scope.inQuestion;
  $scope.allAnswers;
  function inQuestion(){
    $scope.inQuestion=$scope.$parent.insiderDaddy;
  }
   function loadAnswers(){
    //Server conenction to verify user's data
    $scope.gimmeAnswers=angular.copy($scope.inQuestion);
    var promise = accessService.getData("php/controllers/MainController.php",
    true, "POST", {controllerType: 1, action: 10050, jsonData: JSON.stringify($scope.inQuestion)});

    promise.then(function (outputData) {
      //alert("con done");
      if(outputData[0] === true) {
        console.log(outputData[1]);
        //console.log(outputData[1]);
        //id,idUser,dateReview, rate,description
        for (var i = 0; i < outputData[1].length; i++) {
          var question = new Question();
          question.setIdquestion(outputData[1][i].idquestion);
          question.setNickname(outputData[1][i].nickname);
          question.setTopicname(outputData[1][i].topicname);
          question.setInput(outputData[1][i].input);
          question.setDateIn(outputData[1][i].date);
          $scope.questions.push(question);
        }
      }
      else {
        console.log(outputData);
        if(angular.isArray(outputData[1])) {
          alert(outputData[1]);
        }
        else {
          alert("There has been an error in the server, try later");
        }
      }
    });
  }
  inQuestion();
  loadAnswers();
});