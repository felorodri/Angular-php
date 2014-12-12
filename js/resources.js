
/**
* MyLims.api Module
*
* Description
*/
angular.module('MyLims.api', ['ngResource'])
    .factory('Projects', ['$resource', function ($resource) {
      return $resource( 'api/projects/:id',{}, {
        'query':  {method:'GET', isArray:false},
        'update': { method:'PUT' }
      });
    }])
    .factory('Users', ['$resource', function ($resource) {
      return $resource( 'api/user/:id',{}, {
        'query':  {method:'GET', isArray:false},
        'update': { method:'PUT' }
      });
    }])
    .factory('Photos', ['$resource', function ($resource) {
      return $resource( 'http://inmovis.com/servinformacion/:bucket/:id',{ bucket: 'photos' }, {
        'query':  {method:'GET', isArray:true},
        'update': { method:'PUT' }
      });
    }])
    ;