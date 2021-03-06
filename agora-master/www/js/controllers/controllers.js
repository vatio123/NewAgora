

starterApp.controller('AppCtrl', function($scope, $ionicModal, $timeout, $state, accessService, $ionicPopup, $ionicHistory) {

  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //$scope.$on('$ionicView.enter', function(e) {
  //});



/*if(localStorage.getItem('user')!=undefined &&
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
}*/


  // Form data for the login modal
  //$scope.topics=[];
  $scope.howManyAnswers = 0;
  $scope.howManyQuestions = 0;
  $scope.users;
  $scope.msg="";
  $scope.reloadFunction;
  $scope.insiderDaddy;
  $scope.loginData = {};
  $scope.newUser = function(){
    $scope.theuser=new User();
    $scope.theusertologin= new User();
    $scope.theuser.nickname="anonymous";
    $scope.theuser.password="nothing";
  }
  $scope.newQuestion = function(){
    $scope.thequestion = new Question();
    $scope.confirm="";
    $scope.finaltest="";
  }

  $scope.registered=0;
  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });

/****/
$ionicModal.fromTemplateUrl('templates/login.html', {
      id: '1', // We need to use and ID to identify the modal that is firing the event!
      scope: $scope,
      backdropClickToClose: false,
      animation: 'slide-in-up'
    }).then(function(modal) {
      $scope.oModal1 = modal;
    });

    // Modal 2
    $ionicModal.fromTemplateUrl('templates/wizard.html', {
      id: '2', // We need to use and ID to identify the modal that is firing the event!
      scope: $scope,
      backdropClickToClose: false,
      animation: 'slide-in-up'
    }).then(function(modal) {
      $scope.oModal2 = modal;
    });

    $ionicModal.fromTemplateUrl('templates/question.html', {
      id: '3', // We need to use and ID to identify the modal that is firing the event!
      scope: $scope,
      backdropClickToClose: false,
      animation: 'slide-in-up'
    }).then(function(modal) {
      $scope.oModal3 = modal;
    });

    $ionicModal.fromTemplateUrl('templates/answer.html', {
          id: '4', // We need to use and ID to identify the modal that is firing the event!
          scope: $scope,
          backdropClickToClose: false,
          animation: 'slide-in-up'
        }).then(function(modal) {
          $scope.oModal4 = modal;
        });

        $ionicModal.fromTemplateUrl('templates/list.html', {
              id: '5', // We need to use and ID to identify the modal that is firing the event!
              scope: $scope,
              backdropClickToClose: false,
              animation: 'slide-in-up'
            }).then(function(modal) {
              $scope.oModal5 = modal;
            });

    $scope.openModal = function(index) {
      if (index == 1) $scope.oModal1.show();
      else if(index == 3) {
          $scope.newQuestion();
          if($scope.theuser.nickname!="anonymous")
            getAllTopics();
          else{
            $scope.topics=[];
            var topic = new Topic();
            topic.setTopicname("untopic");
            topic.setMaintopic("untopic");
            $scope.topics.push(topic);
            $scope.thequestion.topicname=$scope.topics[0].getTopicname();
          }
          $scope.pass=randomString(5, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
          $scope.oModal3.show();
      }
      else if(index == 4){
        $scope.newAnswer();
        $scope.pass=randomString(5, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $scope.oModal4.show();
      }
      else if(index == 5){
        $scope.ranking();
        //$scope.newAnswer();
        //$scope.pass=randomString(5, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $scope.oModal5.show();
      }
      else $scope.oModal2.show();
    };

    $scope.closeModal = function(index) {
      if (index == 1) $scope.oModal1.hide();
      else if(index == 3) {
        $scope.newQuestion();
        $scope.oModal3.hide();
      }
      else if(index == 4){
        $scope.oModal4.hide();
      }
      else if(index == 5){
        $scope.oModal5.hide();
      }
      else $scope.oModal2.hide();
    };

    /* Listen for broadcasted messages */

    $scope.$on('modal.shown', function(event, modal) {
      console.log('Modal ' + modal.id + ' is shown!');
    });

    $scope.$on('modal.hidden', function(event, modal) {
      console.log('Modal ' + modal.id + ' is hidden!');
    });

    // Cleanup the modals when we're done with them (i.e: state change)
    // Angular will broadcast a $destroy event just before tearing down a scope
    // and removing the scope from its parent.
    $scope.$on('$destroy', function() {
      console.log('Destroying modals...');
      $scope.oModal1.remove();
      $scope.oModal2.remove();
    });

    $scope.doQuestion = function(){
      $scope.thequestion.idquestion=0;
      $scope.thequestion.nickname=$scope.theuser.nickname;
      console.log("lanzando pregunta");
      console.log($scope.theuser);
      console.log($scope.thequestion);
      $scope.thequestion=angular.copy($scope.thequestion);
      var promise = accessService.getData("php/controllers/MainController.php",
      true, "POST", {controllerType: 2, action: 10010, jsonData: JSON.stringify($scope.thequestion)});

      promise.then(function (outputData) {
        //alert("con done");
        //console.log(outputData);
        if(outputData[0]===true) {
          $scope.showPopupWithReload("Question has done succesfully!","Stay alert for the answers!");
          //console.log(outputData[1]);
          //console.log(outputData[1]);
          //id,idUser,dateReview, rate,description
          /*for (var i = 0; i < outputData[1].length; i++) {
            var topic = new Topic();
            topic.setTopicname(outputData[1][i].topicname);
            topic.setMaintopic(outputData[1][i].maintopic);
            $scope.topics.push(topic);
          }
          $scope.thequestion.topicName=$scope.topics[0].getTopicname();

          console.log($scope.topics[0].getTopicname());*/
        }
        else {
          //console.log(outputData);
          if(angular.isArray(outputData[1])) {
            alert(outputData[1]);
          }
          else {
            alert("There has been an error in the server, try later");
          }
        }
      });
      //alert("Question done");
      //location.reload();
    }

    $scope.trump = function(){
      var promise = accessService.getData("https://api.whatdoestrumpthink.com/api/v1/quotes/random",
      true, "GET", {controllerType: 0, action: 00000, jsonData: ""});

      promise.then(function (outputData) {
        console.log(outputData);
        $scope.msg=outputData.message;
      });
    }

    function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
        return result;
      }

      function getAllTopics(){
        $scope.topics=[];
        var promise = accessService.getData("php/controllers/MainController.php",
        true, "POST", {controllerType: 7, action: 10000, jsonData: ""});

        promise.then(function (outputData) {
          //alert("con done");
          if(outputData[0] === true) {
            console.log(outputData[1]);
            //console.log(outputData[1]);
            //id,idUser,dateReview, rate,description
            for (var i = 0; i < outputData[1].length; i++) {
              var topic = new Topic();
              topic.setTopicname(outputData[1][i].topicname);
              topic.setMaintopic(outputData[1][i].maintopic);
              $scope.topics.push(topic);
            }
            $scope.thequestion.topicname=$scope.topics[0].getTopicname();

            console.log($scope.topics[0].getTopicname());
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
/***/
  // Perform the login action when the user submits the login form
  $scope.doLogin = function() {

    console.log($scope.theusertologin);
    $scope.theusertologin= angular.copy($scope.theusertologin);
    var promise = accessService.getData("php/controllers/MainController.php",
    true, "POST", {controllerType: 0, action: 10000, jsonData: JSON.stringify($scope.theusertologin)});

    promise.then(function (outputData) {
      console.log(outputData);
      if(outputData[0] === true) {
        console.log(outputData[1]);
        //console.log(outputData[1]);
        //id,idUser,dateReview, rate,description
        //deshabilitar botón back
        /*$ionicHistory.nextViewOptions({
            disableBack: true
          });*/
        //$scope.showPopup("Login succesfull", "its working!");
        $scope.theuser.nickname=outputData[1][0].nickname;
        $scope.theuser.email=outputData[1][0].email;
        $scope.theuser.postalcode=outputData[1][0].postalcode;
        $scope.theuser.userscore=outputData[1][0].userscore;
        $scope.theuser.firstname=outputData[1][0].firstname;
        $scope.theuser.lastname=outputData[1][0].lastname;
        localStorage.setItem('user', JSON.stringify($scope.theuser));
        /*$ionicHistory.nextViewOptions({
            disableBack: true
          });*/
        $state.go('app.playlists');
        $scope.closeModal(1);
        location.reload();
        //alert($scope.theuser.email);

      }
      else {
          $scope.showPopup("Login FAILED", "Incorrect user and or password!");
        if(angular.isArray(outputData[1])) {
          //alert(outputData[1]);
        }
        else {
          alert("There has been an error in the server, try later");
        }
      }
    });
  };


  $scope.logout = function(){
    $scope.newUser();
    localStorage.setItem('user', "removed");
    /*$ionicHistory.nextViewOptions({
        disableBack: true
      });*/
      var promise = accessService.getData("php/controllers/MainController.php",
      true, "POST", {controllerType: 0, action: 10040, jsonData: ""});

      promise.then(function (outputData) {
        console.log(outputData);
        if(outputData[0] === true) {
          console.log(outputData[1]);
          $state.go('app.playlists');
          $scope.closeModal(1);
          location.reload();
          //alert($scope.theuser.email);

        }
        else {
          if(angular.isArray(outputData[1])) {
            //alert(outputData[1]);
          }
          else {
            alert("There has been an error in the server, try later");
          }
        }
      });

    $state.go('app.playlists');
    //$scope.openModal(1);
    location.reload();
  }

  $scope.ranking = function(){
    $scope.users=[];
      var promise = accessService.getData("php/getUsers.php",
      true, "GET", {controllerType: 0, action: 10060, jsonData: ""});
      promise.then(function(patata) {
        //alert("succes!");
        console.log(patata);
        //console.log(outputData);
        if(patata.length>0) {
          //console.log(outputData[1]);
          for (var i = 0; i < patata.length; i++) {
            if(patata[i].nickname!="anonymous"){
            var question = new User();
            question.setNickname(patata[i].nickname);
            question.setUserscore(patata[i].userscore);
            $scope.users.push(question);
          }
          }
         }
        else {
            $scope.showPopup("Oops!", "Where are the users?");
        }
      });

    //$state.go('app.playlists');
    //$scope.openModal(1);
    //location.reload();
  }

//$scope.ranking();
$scope.newUser();
$scope.newQuestion();
  /*if(localStorage.getItem("wizard")==undefined)
    localStorage.setItem("wizard", "done");
    openModal(1);*/

    $scope.showPopup = function(header,msg) {
      var alertPopup = $ionicPopup.alert({
        title: header ,
        template: msg
      });
      alertPopup.then(function(res) {
        //$state.go('app.playlists');
        //$scope.$parent.openModal(1);
      });
    };

    $scope.showPopupWithReload = function(header,msg) {
      var alertPopup = $ionicPopup.alert({
        title: header ,
        template: msg
      });
      alertPopup.then(function(res) {
      $state.go('app.playlists');
      location.reload();
      });
    };

}) //end controller



/*starterApp.controller('PlaylistCtrl', function($scope, $stateParams) {
});*/
