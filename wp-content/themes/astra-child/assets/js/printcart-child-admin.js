jQuery(document).ready(function(){
    nbOption = '[ng-controller="optionCtrl"]';
    var $scope = angular.element(document.querySelector(nbOption)).scope();
    var page3Index = $scope.options.fields.findIndex(p => p.nbd_type == "page3");
    delete $scope.options.fields[page3Index].general.attributes.remove_att;
});

