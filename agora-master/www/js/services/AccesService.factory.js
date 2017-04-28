starterApp.factory('accessService', function($http, $log, $q) {
  	return {
  		getData: function(url, async, method, params, data) {
  			var deferred = $q.defer();
  			$http({
  				url: url,
  				method: method,
  				asyn: async,
  				params: params,
  				data: data
  			})
  			.success(function(response, status, headers, config)  {
  				deferred.resolve(response);
  			})
  			.error(function(msg, code) {
  				deferred.reject(msg);
  				$log.error(msg, code);
  				alert("There has been an error in the server, try later");
  			});

  			return deferred.promise;
  		}
  	}
  });
