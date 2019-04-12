<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.json">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>

    <script src="https://www.gstatic.com/firebasejs/5.9.3/firebase.js"></script>
    <script>
	    // 1087504565670
	    // Initialize Firebase
	    var config = {
	        apiKey: "AIzaSyDEf1I6Jo3nhJJa2VVpGD58PH1f4y-LLco",
	        authDomain: "crudios-492c7.firebaseapp.com",
	        databaseURL: "https://crudios-492c7.firebaseio.com",
	        projectId: "crudios-492c7",
	        storageBucket: "crudios-492c7.appspot.com",
	        messagingSenderId: ""
	    };
	    firebase.initializeApp(config);

	    // Retrieve Firebase Messaging object.
		const messaging = firebase.messaging();

		messaging.requestPermission().then(function() {
		  console.log('Notification permission granted.');
		  // TODO(developer): Retrieve an Instance ID token for use with FCM.
		  if( isTokenSentToServer() ) {
		  	console.log('Token already saved');
		  } else {
		  	getRegToken();
		  }
		}).catch(function(err) {
		  console.log('Unable to get permission to notify.', err);
		});

		function setTokenSentToServer(sent) {
		    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
		}

		function isTokenSentToServer() {
		    return window.localStorage.getItem('sentToServer') === '1';
		}

		function saveToken( token ) {

			$.ajax({
					url: 'action.php',
					method: 'POST',
					dataType: 'JSON',
					data: {
						token: token
					},
				success: function( retdata ) {
					//function name would be the name of your same function as in this example is main_unit_master
					console.log('retdata', retdata);
				},
				error: function(e){
					console.log(e);
				}
			});
		}

		function getRegToken() {

			// Get Instance ID token. Initially this makes a network call, once retrieved
			// subsequent calls to getToken will return from cache.
			messaging.getToken().then(function(currentToken) {
			  if (currentToken) {
			    saveToken(currentToken);
			    console.log(currentToken);
			  	setTokenSentToServer(true);
			  } else {
			    // Show permission request.
			    console.log('No Instance ID token available. Request permission to generate one.');
			    setTokenSentToServer(false);
			  }
			}).catch(function(err) {
			  console.log('An error occurred while retrieving token. ', err);
			  // showToken('Error retrieving Instance ID token. ', err);
			  setTokenSentToServer(false);
			});
		}

		messaging.onMessage( function( payload ) {
			console.log('payload', payload);

			notificationTitle = payload.data.title;
			notificationOptions = {
				body: payload.data.body,
				icon: payload.data.icon
			}
			var notification = new Notification( notificationTitle, notificationOptions );
		} );
    </script>
</head>
<body>
</body>
</html>
