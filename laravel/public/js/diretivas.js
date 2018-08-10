angular.module('diretivas', [])
	
		.directive('item', function() {
			return {
				restrict: 'E',
				transclude: true,
				scope: isolate,
				templateUrl: 'diretivas/diretivaItens.html',

			}
		})