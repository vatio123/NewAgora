starterApp.controller('InsideQuestionCtrl', function($ionicPopup, $scope, accessService, $stateParams, $state) {
  $scope.inQuestion;
  $scope.answer=false;
  $scope.answers=[];
  $scope.valorationsa=[];
  $scope.passa;
  $scope.confirma;
  $scope.finaltesta;
  $scope.theFilterA="dateIn";
  //console.log("reset");
  $scope.torate="rateme";
  $scope.torateanswer="rateme";
  function inQuestion(){
    $scope.inQuestion=$scope.$parent.insiderDaddy;
  }

  $scope.newAnswer = function(){
    $scope.passa=randomString(5, '¿%!@?¡Zx123456789');
    $scope.theanswer = new Answer();
    $scope.theanswer.setNickname($scope.$parent.theuser.getNickname());
    $scope.theanswer.setIdquestion($scope.inQuestion.getIdquestion());
    $scope.theanswer.setTopicname($scope.inQuestion.getTopicname());
    $scope.theanswer.setIdanswer(0);
    $scope.theanswer.setDateIn(0);
  }


  $scope.doAnswer = function(){
    //alert("hello");
    var theanswer=angular.copy($scope.theanswer);
    console.log(theanswer);
    var promise = accessService.getData("php/controllers/MainController.php",
    true, "POST", {controllerType: 1, action: 10020, jsonData: JSON.stringify(theanswer)});

    promise.then(function (outputData) {
      //alert("con done");
      console.log(outputData);
      if(outputData[0] === true) {
        console.log(outputData[1]);
        theanswer.dateIn="right now";
        $scope.answers.push(theanswer);
        $scope.newAnswer();
        $scope.showPopup("THANKS!","Your answer was send succesfully!");
        $state.go('app.playlists');
        //console.log(outputData[1]);
        //id,idUser,dateReview, rate,description
      }
      else {
        console.log(outputData);
        if(angular.isArray(outputData[1])) {
          $scope.showPopup("OMG!","Seems like your answer has too much wisdom for our database! Try later! ->"+outputData[1]);
        }
        else {
          alert("There has been an error in the server, try later");
        }
      }
    });
  }

  $scope.reportQuestion = function(){
    if(localStorage.getItem($scope.$parent.theuser.getNickname()+"reportQuestion"+$scope.inQuestion.idquestion)!=undefined)
        $scope.showPopup("Dont be cheater!","You already reported this question!");
    else{
      var reportq = new Reportq();
      reportq.construct(0,$scope.$parent.theuser.getNickname(),$scope.inQuestion.idquestion,"alert",0);
      var reportsend = angular.copy(reportq);
      alert("reporting"+$scope.inQuestion.idquestion);
      //id,nickname,idanswer,reporttext,date
      var promise = accessService.getData("php/controllers/MainController.php",
      true, "POST", {controllerType: 4, action: 10100, jsonData: JSON.stringify(reportsend)});

      promise.then(function (outputData) {
        //alert("con done");
        console.log(outputData);
        if(outputData[0] === true) {
          console.log(outputData[1]);
          localStorage.setItem($scope.$parent.theuser.getNickname()+"reportQuestion"+$scope.inQuestion.idquestion, "done");
          $scope.showPopup("THANKS!","Alert was send to administrator!");
          //$state.go('app.playlists');
          //console.log(outputData[1]);
          //id,idUser,dateReview, rate,description
        }
        else {
          console.log(outputData);
          if(angular.isArray(outputData[1])) {
            $scope.showPopup("OMG!","Seems like your answer has too much wisdom for our database! Try later! ->"+outputData[1]);
          }
          else {
            alert("There has been an error in the server, try later");
          }
        }
      });
    }
  }

  $scope.reportAnswer = function(answer){
    if(localStorage.getItem($scope.$parent.theuser.getNickname()+"reportAnswer"+answer.idanswer)!=undefined)
        $scope.showPopup("Dont be cheater!","You already reported this question!");
    else{
      var reporta = new Reporta();
      reporta.construct(0,$scope.$parent.theuser.getNickname(),answer.idanswer,"alert",0);
      var reportsend = angular.copy(reporta);
      alert("reporting"+$scope.inQuestion.idquestion);
      //id,nickname,idanswer,reporttext,date
      var promise = accessService.getData("php/controllers/MainController.php",
      true, "POST", {controllerType: 3, action: 10100, jsonData: JSON.stringify(reportsend)});

      promise.then(function (outputData) {
        //alert("con done");
        console.log(outputData);
        if(outputData[0] === true) {
          console.log(outputData[1]);
          localStorage.setItem($scope.$parent.theuser.getNickname()+"reportAnswer"+answer.idanswer, "done");
          $scope.showPopup("THANKS!","Alert was send to administrator!");
          //$state.go('app.playlists');
          //console.log(outputData[1]);
          //id,idUser,dateReview, rate,description
        }
        else {
          console.log(outputData);
          if(angular.isArray(outputData[1])) {
            $scope.showPopup("OMG!","Seems like your answer has too much wisdom for our database! Try later! ->"+outputData[1]);
          }
          else {
            alert("There has been an error in the server, try later");
          }
        }
      });
    }
  }


  $scope.doRate = function(){
    alert("rating");
    var rate= new Valorationq();
    //idvalorationq, nickname, idquestion, valoration, date
    rate.construct(0,$scope.$parent.theuser.getNickname(),$scope.inQuestion.idquestion,$scope.torate,0);
    var ratesend=angular.copy(rate);
    console.log(ratesend);
    //console.log(theanswer);
    var promise = accessService.getData("php/controllers/MainController.php",
    true, "POST", {controllerType: 6, action: 10100, jsonData: JSON.stringify(ratesend)});

    promise.then(function (outputData) {
      //alert("con done");
      console.log(outputData);
      if(outputData[0] === true) {
        console.log(outputData[1]);
        $scope.valorationsa.push(rate);
        $scope.showPopup("THANKS 4 RATE!");
        //location.reload();
        //console.log(outputData[1]);
        //id,idUser,dateReview, rate,description
      }
      else {
        console.log(outputData);
        if(angular.isArray(outputData[1])) {
          $scope.showPopup("OMG!","Seems like your answer has too much wisdom for our database! Try later! ->"+outputData[1]);
        }
        else {
          alert("There has been an error in the server, try later");
        }
      }
    });
  }

  $scope.doRateAnswer = function(answer){

    alert("rating answer");
    var rate= new Valorationa();
    //idvalorationa, nickname, idanswer, valoration, date
    rate.construct(0,$scope.$parent.theuser.getNickname(),answer.idanswer,$scope.torateanswer,0);
    var ratesend=angular.copy(rate);
    console.log(ratesend);
    //console.log(theanswer);
    var promise = accessService.getData("php/controllers/MainController.php",
    true, "POST", {controllerType: 5, action: 10100, jsonData: JSON.stringify(ratesend)});

    promise.then(function (outputData) {
      //alert("con done");
      console.log(outputData);
      if(outputData[0] === true) {
        console.log(outputData[1]);
        $scope.valorationsa.push(rate);
        $scope.showPopup("THANKS 4 RATE!");
        //location.reload();
        //console.log(outputData[1]);
        //id,idUser,dateReview, rate,description
      }
      else {
        console.log(outputData);
        if(angular.isArray(outputData[1])) {
          $scope.showPopup("OMG!","Seems like your answer has too much wisdom for our database! Try later! ->"+outputData[1]);
        }
        else {
          alert("There has been an error in the server, try later");
        }
      }
    });
  }

  $scope.loadAnswerValorations = function(){
    var promise = accessService.getData("php/controllers/MainController.php",
    true, "POST", {controllerType: 5, action: 10000, jsonData: ""});

    promise.then(function (outputData) {
      //alert("con done");
      if(outputData[0] === true) {
        //console.log("HERE");
        //console.log(outputData[1]);
        //console.log(outputData[1]);
        //id,idUser,dateReview, rate,description
        /*
        this.idvalorationq;
        this.nickname;
        this.idquestion;
        this.valoration;
        this.date;
        */
        var valoration = new Valorationa();
        for (var i = 0; i < outputData[1].length; i++) {
          var valoration = new Valorationa();
          valoration.setIdvalorationa(outputData[1][i].idvalorationa);
          valoration.setIdanswer(outputData[1][i].idanswer);
          valoration.setValoration(outputData[1][i].valoration);
          valoration.setNickname(outputData[1][i].nickname);
          //valoration.setValoration(outputData[1][i].valoration);
          $scope.valorationsa.push(valoration);
        }
        //console.log($scope.valorationsa);
        console.log("______entrando")
        for(var i=0; i<$scope.answers.length;i++){
          var acumVal=0;
          for(var j=0; j<$scope.valorationsa.length; j++){
            if($scope.answers[i].idanswer==$scope.valorationsa[j].idanswer){
              acumVal+=parseInt($scope.valorationsa[j].valoration);
              //console.log("coindice");
            }
            if(($scope.valorationsa[j].nickname==$scope.$parent.theuser.nickname &&
            $scope.valorationsa[j].idanswer==$scope.answers[i].idanswer)||
            $scope.answers[i].nickname==$scope.$parent.theuser.nickname){
              $scope.answers[i].setRated(true);
              console.log("coincide");
              //console.log($scope.questions[i]);
            }
            console.log()


          }
          console.log("____________revisada "+i);
          $scope.answers[i].setTotalvaloration(acumVal);
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


  function randomString(length, chars) {
      var result = '';
      for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
      return result;
    }

   function loadAnswers(){
    //Server conenction to verify user's data
    $scope.gimmeAnswers=angular.copy($scope.inQuestion);
    var promise = accessService.getData("php/controllers/MainController.php",
    true, "POST", {controllerType: 1, action: 10050, jsonData: JSON.stringify($scope.gimmeAnswers)});

    promise.then(function (outputData) {
      //alert("con done");
      //console.log(outputData);
      if(outputData[0] === true) {
        //console.log(outputData[1]);
        //console.log(outputData[1]);
        //id,idUser,dateReview, rate,description
        for (var i = 0; i < outputData[1].length; i++) {
          var answer = new Answer();
          answer.setIdanswer(outputData[1][i].idanswer);
          answer.setIdquestion(outputData[1][i].idquestion);
          answer.setNickname(outputData[1][i].nickname);
          answer.setTopicname(outputData[1][i].topicname);
          answer.setInput(outputData[1][i].input);
          answer.setDateIn(outputData[1][i].date);
          $scope.answers.push(answer);
        }
      }
      else {
        console.log(outputData);
        if(angular.isArray(outputData[1])) {
          $scope.showPopup("Amazingly it's happening!","This question doesn't have answers yet!");
        }
        else {
          alert("There has been an error in the server, try later");
        }
      }
    });
  }
  $scope.showPopup = function(header,msg) {
    var alertPopup = $ionicPopup.alert({
      title: header ,
      template: msg
    });
    alertPopup.then(function(res) {
      if(header=="THANKS 4 RATE!"){
        $state.go('app.playlists');
        $scope.$parent.reloadFunction();
        //location.reload();
      }
    });
  };

  inQuestion();
  loadAnswers();
  $scope.loadAnswerValorations();
});
