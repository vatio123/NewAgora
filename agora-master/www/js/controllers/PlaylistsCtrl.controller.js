starterApp.controller('PlaylistsCtrl', function($scope, accessService, $stateParams, $state) {
  $scope.questions =[];
  $scope.insider;
  $scope.topics=[];
  $scope.valorationsq=[];
  $scope.theFilter="date";
  $scope.choice;
  $scope.insideQuestion = function(question){
    //console.log(question);
    $scope.$parent.insiderDaddy=question;
    //idquestion,nickname,topicname, input,dateIn
    /*$scope.insider.construct(question.idquestion, question.nickname, question.topicname, question.input, question.dateIn);
    alert($scope.insider.question.idquestion);
    /*console.log($scope.insider);*/
    $state.go('app.single');
  }


  $scope.loadInitData = function (){
	  $scope.questions=[];
    //Server conenction to verify user's data
    var promise = accessService.getData("php/controllers/MainController.php",
    true, "POST", {controllerType: 2, action: 10000, jsonData: ""});

    promise.then(function (outputData) {
      //alert("con done");
      //console.log(outputData);
      if(outputData[0] === true) {
        //console.log(outputData[1]);
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



    if(localStorage.getItem('user')!=undefined &&
    localStorage.getItem('user')!="removed"){
      var usersaved=JSON.parse(localStorage.getItem('user'));
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
    //else alert("user not found!");

      $scope.test = function(name){
        //console.log($scope.selectedTopic);
        ///alert(name);
        $scope.questions=[];
        if(name!="All"){
          //alert(name);

        var promise = accessService.getData("php/controllers/MainController.php",
        true, "POST", {controllerType: 2, action: 10000, jsonData: ""});
        promise.then(function (outputData) {
          //alert("con done");
          if(outputData[0] === true) {
            //console.log(outputData[1]);
            //console.log(outputData[1]);
            //id,idUser,dateReview, rate,description
            //alert(name+" "+outputData[1][i].topicname);
            for (var i = 0; i < outputData[1].length; i++) {
              //alert(name+" "+outputData[1][i].topicname);
              if(outputData[1][i].topicname==name){
                //console.log(name+" "+outputData[1][i].topicname);
              var question = new Question();
              question.setIdquestion(outputData[1][i].idquestion);
              question.setNickname(outputData[1][i].nickname);
              question.setTopicname(outputData[1][i].topicname);
              question.setInput(outputData[1][i].input);
              question.setDateIn(outputData[1][i].date);

              $scope.questions.push(question);
            }
            }
            $scope.loadValorations();
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
      else {
        $scope.loadInitData();
        $scope.loadValorations();
      }
    }

      $scope.loadTopics = function (){
		  $scope.topics=[];
        //Server conenction to verify user's data
        var promise = accessService.getData("php/controllers/MainController.php",
        true, "POST", {controllerType: 7, action: 10000, jsonData: ""});

        promise.then(function (outputData) {
          //alert("con done");
          if(outputData[0] === true) {
            //console.log(outputData[1]);
            //console.log(outputData[1]);
            //id,idUser,dateReview, rate,description
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
            $scope.selectedTopic=$scope.topics[0].topicname;
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

      $scope.loadValorations = function(){
        $scope.valorationsq=[];
        var promise = accessService.getData("php/controllers/MainController.php",
        true, "POST", {controllerType: 6, action: 10000, jsonData: ""});

        promise.then(function (outputData) {
          //alert("con done");
          if(outputData[0] === true) {
            var valoration = new Valorationq();

            for (var i = 0; i < outputData[1].length; i++) {
              var valoration = new Valorationq();
              valoration.setIdvalorationq(outputData[1][i].idvalorationq);
              valoration.setIdquestion(outputData[1][i].idquestion);
              valoration.setValoration(outputData[1][i].valoration);
              valoration.setNickname(outputData[1][i].nickname);
              $scope.valorationsq.push(valoration);
            }
            console.log($scope.valorationsq);
            //console.log("_________________bucle init____________________________");
            for(var i=0; i<$scope.questions.length;i++){
              var acumVal=0;
              for(var j=0; j<$scope.valorationsq.length; j++){

                if($scope.questions[i].idquestion==$scope.valorationsq[j].idquestion){
                  //console.log("entro "+j);
                  //console.log("INICIO primera pregunta____________________________");
                  acumVal+=parseInt($scope.valorationsq[j].valoration);
                  //console.log("sumando: "+$scope.valorationsq[j].valoration);
                  //console.log("valoration: "+$scope.valorationsq[j].nickname);
                  //console.log("FIN primera pregunta____________________________");
                }
                if(($scope.valorationsq[j].nickname==$scope.$parent.theuser.nickname &&
                $scope.valorationsq[j].idquestion==$scope.questions[i].idquestion)||
                $scope.questions[i].nickname==$scope.$parent.theuser.nickname){
                  $scope.questions[i].setRated(true);
                  //console.log($scope.questions[i]);
                }

                //console.log("the user->"+$scope.$parent.theuser.nickname);
                //console.log("valoration->"+$scope.valorationsq[j].nickname);
              }
              $scope.questions[i].setTotalvaloration(acumVal);
            }
            console.log("_______________bucle fin____________________________");
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

      function loadAll(){
        $scope.loadInitData();
        $scope.loadTopics();
        $scope.loadValorations();
      }

    $scope.loadInitData();
    $scope.loadTopics();
    $scope.loadValorations();
    $scope.$parent.reloadFunction=loadAll;

});
