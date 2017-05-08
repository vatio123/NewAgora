

starterApp.controller('AppCtrl', function($scope, $ionicModal, $timeout, $state, accessService, $ionicPopup, $ionicHistory) {

  // With the new view caching in Ionic, Controllers are only called
  // when they are recreated or on app start, instead of every page change.
  // To listen for when this page is active (for example, to refresh data),
  // listen for the $ionicView.enter event:
  //$scope.$on('$ionicView.enter', function(e) {
  //});

/****




*////
  // Form data for the login modal
  $scope.loginData = {};
  $scope.newUser = function(){
    $scope.theuser=new User();
    $scope.theusertologin= new User();
    $scope.theuser.nickname="anonymous";
    $scope.theuser.password="nothing";
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

    $scope.openModal = function(index) {
      if (index == 1) $scope.oModal1.show();
      else $scope.oModal2.show();
    };

    $scope.closeModal = function(index) {
      if (index == 1) $scope.oModal1.hide();
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
        $ionicHistory.nextViewOptions({
            disableBack: true
          });
        $state.go('app.playlists');
        $scope.closeModal(1);
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
    $ionicHistory.nextViewOptions({
        disableBack: true
      });
    $state.go('app.playlists');
    $scope.openModal(1);
  }
$scope.newUser();
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

}) //end controller



/*starterApp.controller('PlaylistCtrl', function($scope, $stateParams) {
});*/
