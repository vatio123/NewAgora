// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.controllers' is found in controllers.js
var starterApp=angular.module('starter', ['ionic']);

starterApp.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
})

starterApp.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider

    .state('app', {
    url: '/app',
    abstract: true,
    templateUrl: 'templates/menu.html',
    controller: 'AppCtrl'
  })

  .state('app.search', {
    url: '/search',
    views: {
      'menuContent': {
        templateUrl: 'templates/search.html'
      }
    }
  })

  .state('app.signin', {
    url: '/signin',
    views: {
      'menuContent': {
        templateUrl: 'templates/signin.html',
        controller: 'UserCtrl'
      }
    }
  })


    .state('app.playlists', {
      url: '/playlists',
      views: {
        'menuContent': {
          templateUrl: 'templates/playlists.html',
          controller: 'PlaylistsCtrl'
        }
      }
    })

  .state('app.single', {
    url: '/inside_question',
    views: {
      'menuContent': {
        templateUrl: 'templates/playlist.html',
        controller: 'InsideQuestionCtrl'
      }
    }
  })

  .state('app.profile', {
    url: '/my_account',
    views: {
      'menuContent': {
        templateUrl: 'templates/search.html',
      }
    }
  })
  .state('app.manage', {
                url: '/manage',
                views: {
                    'menuContent': {
                        templateUrl: 'templates/manage.html',
                        controller: 'ManageCtrl'
                    }
                }
            })
            .state('app.manageReportQ', {
                url: '/manageReportQ',
                views: {
                    'menuContent': {
                        templateUrl: 'templates/manageReportQ.html',
                        controller: 'ManageReportQCtrl'
                    }
                }
            })
            .state('app.manageReportA', {
                url: '/manageReportA',
                views: {
                    'menuContent': {
                        templateUrl: 'templates/manageReportA.html',
                        controller: 'ManageReportACtrl'
                    }
                }
            })

        
            .state('app.reportlistQ', {
                url: '/inside_reported_question',
                views: {
                    'menuContent': {
                        templateUrl: 'templates/reportlistQ.html',
                        controller: 'InsideReportedQuestionCtrl'
                    }
                }
            })
            .state('app.reportlistA', {
                url: '/inside_reported_answer',
                views: {
                    'menuContent': {
                        templateUrl: 'templates/reportlistA.html',
                        controller: 'InsideReportedAnswerCtrl'
                    }
                }
            });

  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/app/playlists');
});
