<!DOCTYPE html>
<html>
<head>
	<title>Sample Code of Honglei</title>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-animate.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-route.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-aria.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular-messages.min.js"></script>
	<script src="https://cdn.gitcdn.xyz/cdn/angular/bower-material/v1.0.9/angular-material.js"></script>
	<script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.3.3.js"></script>
	<!-- UI-Router -->
	<script src="https://angular-ui.github.io/ui-router/release/angular-ui-router.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://ngmaterial.assets.s3.amazonaws.com/svg-assets-cache.js"></script>
	<!--upload file control-->
	<script type="text/javascript" src="{{ URL::asset('lib/angular-uploadfile/ng-file-upload.js')}}"></script>
	<script type="text/javascript" src="{{ URL::asset('lib/angular-uploadfile/ng-file-upload-shim.js') }}"></script>
	<!-- angular material library -->
	<link rel="stylesheet" href="https://cdn.gitcdn.xyz/cdn/angular/bower-material/v1.0.9/angular-material.css"></link>
	<!-- font awesome, for menu icons -->
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://material.angularjs.org/1.0.9/docs.css"></link>
	<link rel="stylesheet" href="{{ URL::asset('css/dashboard.css') }}">
</head>

<body ng-app="SampleCodeHonglei" layout="column">
	
	<md-toolbar class="md-whiteframe-4dp">
		
		<div class="md-toolbar-tools">
			<!-- section divider -->
			<md-button ui-sref="Dashboard">
				<i class="fa fa-th-large fa-2x"></i>
				<h3>Dashboard</h3>
			</md-button>
			<md-button ui-sref="filterEmployee">
				<i class="fa fa-cog fa-2x"></i>
				<h3>Filter Employee</h3>
			</md-button>
			<md-button ui-sref="batchAdd">
				<i class="fa fa-user fa-2x"></i>
				<h3>Add Employee</h3>
			</md-button>
		</div>
		
	</md-toolbar>
	<div ui-view></div>
	<script src="{{ URL::asset('js/dashboard.js') }}"></script>
</body>
</html>