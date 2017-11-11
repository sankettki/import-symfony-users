<!doctype html>
<html lang="en">
	<head>
		<title>Git Users</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	</head>
	<body>
		
		<div class="container">
			<h3>Showing Symfony Users</h3>
			<div ng-app="git" ng-controller="gitcontroller">
				<p>Showing from {{gitUsers.from}} to {{gitUsers.to}} of {{gitUsers.total}}</p>
				<table class="table">
					<tr>
						<th>Git ID</th>
						<th>Name</th>
						<th>Url</th>
					</tr>
					<tr ng-repeat="x in gitUsers.data">
						<td>{{ x.git_id }}</td>
						<td>{{ x.name }}</td>
						<td>{{ x.url }}</td>
					</tr>
				</table>
				<button class="btn btn-default" ng-click="getPreviousPage(gitUsers.current_page);">Previous</button>&nbsp;&nbsp;
				<button class="btn btn-default" ng-click="getNextPage(gitUsers.current_page);">Next</button>
			</div>
		</div>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
		
		<script>
			var app = angular.module("git", []);
			app.controller("gitcontroller", function ($scope, $http) {

				$http.get('api/v1/get-listings').
					then(function(response) {
						$scope.gitUsers = response.data;
						console.log(response.data);
					});
				
				$scope.getNextPage = function($current_page) {
					if( $current_page == $scope.gitUsers.last_page ) {
						alert("No next page");
						return;
					}
					
					$http.get('api/v1/get-listings?page='+($current_page+1)).
					then(function(response) {
						$scope.gitUsers = response.data;
						console.log(response.data);
					});
				};
				
				$scope.getPreviousPage = function($current_page) {
					if( $current_page == 1 ) {
						alert("No previous page");
						return;
					}
					$http.get('api/v1/get-listings?page='+($current_page-1)).
					then(function(response) {
						$scope.gitUsers = response.data;
						console.log(response.data);
					});
				};

			});
		</script>
		
  </body>
</html>