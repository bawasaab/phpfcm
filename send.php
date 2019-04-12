<?php	
	// AIzaSyDMJqJA9h3QpXjH0cuINWSt3FslAOlUpbU
	define('SERVER_API_KEY', '');

	$tokens = ['fy7RDsw5UQM:APA91bGcImYMvEj5uCwQFNk4VUPH2hacf80qNwp37njG9P4GqQjALZHoMGJJ3OifwQOdePjEx83bA9rBzGdwJPmNq2f91kuVOqCYCaYwvzjicKGN-hnhLFHzyXmT5dGLccYYMJLWPubC'];
	// $tokens = 'cAr2q3AkD_k:APA91bFam7VpKoAFLLjtmlcLlHYNUYPhKCHxqo0MFEPxR62w6LXHitTe_CHKC9wUrJk_3QQ6Y6j_eB34zVNpr5XxVv-eRVNUfPD6zrVoOw_oniYk1x2pXmUG5k33GtuaoYGZlsrQM6KU';

	$header = [
		'Authorization: Key='. SERVER_API_KEY,
		'Content-Type: Application/json'
	];

	$msg = [
		'title'	=>	'Testing notification',
		'body'	=>	'Testing notification from localhost',
		'icon'	=>	'images/icon.png',
		'image'	=>	'user.png'
	];

	$payload = [
		'registration_ids' 	=> $tokens,
		// 'to' 	=> $tokens,
		'data'				=>	$msg
	];

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode($payload),
	  CURLOPT_HTTPHEADER => $header,
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}
?>
