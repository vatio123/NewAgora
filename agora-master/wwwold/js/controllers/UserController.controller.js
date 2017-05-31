starterApp.controller('UserController', function($scope, accessService, $stateParams) {

  $scope.user = new User();
  $scope.password2;
  $scope.validatePassword = function(){

  }

  $scope.validateNick = function(){

  }

  $scope.validateMail = function(){

  }

/*$scope.loadInitData = function (){
    //Server conenction to verify user's data
    var promise = accessService.getData("php/controllers/MainController.php",
    true, "POST", {controllerType: 2, action: 10000, jsonData: ""});

    promise.then(function (outputData) {
      if(outputData[0] === true) {
        console.log(outputData[1]);
        //console.log(outputData[1]);
        //id,idUser,dateReview, rate,description
        for (var i = 0; i < outputData[1].length; i++) {
          var question = new Question();
          question.setIdQuestion(outputData[1][i].idquestion);
          question.setNick(outputData[1][i].nick);
          question.setTopicName(outputData[1][i].topicname);
          question.setInput(outputData[1][i].input);
          question.setDateIn(outputData[1][i].date);
          $scope.questions.push(question);
        }
      }
      else {
        if(angular.isArray(outputData[1])) {
          alert(outputData[1]);
        }
        else {
          alert("There has been an error in the server, try later");
        }
      }
    });
  }*/
    $scope.loadInitData();
});
