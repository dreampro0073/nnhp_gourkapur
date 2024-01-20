var app = angular.module('app', [
	'jcs-autoValidate',
  // 'ngFileUpload',
  // 'selectize'
]);

angular.module('jcs-autoValidate')
    .run([
    'defaultErrorMessageResolver',
    function (defaultErrorMessageResolver) {
        defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
          errorMessages['patternInt'] = 'Please fill a numeric value';
          errorMessages['patternFloat'] = 'Please fill a numeric/decimal value';
        });
    }
]);

app.directive('convertToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(val) {
        return val != null ? parseInt(val, 10) : null;
      });
      ngModel.$formatters.push(function(val) {
        return val != null ? '' + val : null;
      });
    }
  };
});

// angular.module('app').directive('dateTimePicker', function() {
//     var link = function(scope, element, attrs) {
//       // var modelName = attrs['ngModel'];
//       var dataobj = attrs["dataobj"];
//       var dataitem = attrs["dataitem"];
//       var id = attrs["id"];

//       $(element).datetimepicker(
//           {
//             format: 'HH:mm:ss'
//           }
//       );

//       $(element).on("dp.change", function() {

//           scope[dataobj][dataitem] = $("#"+id).val();
//           scope.$apply();
//           scope.calCheck();

//       });
//     };
//     return {
//         require: 'ngModel',
//         restrict: 'A',
//         link: link
//     }
// });