//'use strict';
////doc for dialog: https://github.com/m-e-conroy/angular-dialog-service
//angular.module('mytodoApp')
//  .controller('MainCtrl', function($scope, Todo, dialogs) {
//
//    //fetch all todos'
//    $scope.todos = Todo.query(
//      function() {},
//      function(error) { //error
//          dialogs.error('Error', 'server error');
//          console.log(error.data);
//        }
//    );
//
//    //$scope.alerts = alertService.get();
//
//    $scope.delete = function(index) {
//      var todo = $scope.todos[index];
//      Todo.delete(todo, function() {
//        dialogs.notify('delete', 'cool');
//        $scope.todos.splice($scope.todos.indexOf(todo), 1);
//      }, function(error) {
//        dialogs.error('Error', 'server error');
//        console.log(error.data);
//      });
//
//    };
//
//
//    $scope.add = function() {
//      var todo = new Todo();
//      todo.name = $scope.name;
//      todo.$save();
//      $scope.todos.push(todo);
//    };
//
//
//    $scope.update = function(name, index) {
//      var todo = $scope.todos[index];
//      todo.name = name;
//      Todo.update(todo,
//        function() {},
//        function(error) { //error
//          dialogs.error('Error', 'server error');
//          console.log(error.data);
//        }
//      );
//    };
//  });