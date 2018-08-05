<?php

if($_POST['id'] === "") {
	$mailto = "";

	$data_array = json_decode($_POST['data']);
	$message = "";
	foreach ($data_array as $key => $value) {
		if (isset($value->name) && $value->name !== "") {
			$message .= $value->name.': '.$value->value.'<br>';
		}
	}

	$subject = "";

	// a random hash will be necessary to send mixed content
	$separator = md5(time());

	// carriage return type (RFC)
	$eol = "\r\n";

	// main header (multipart mandatory)
	$headers = "From: $mailto" . $eol;
	$headers .= "Reply-To: $mailto" . $eol;
	$headers .= "MIME-Version: 1.0" . $eol;
	$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
	$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
	$headers .= "This is a MIME encoded message." . $eol;

	// message
	$body = "--" . $separator . $eol;
	$body .= "Content-Type: text/html; charset=iso-8859-1" . $eol;
	$body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
	$body .= "<div>" . $message . "</div>" . $eol . $eol;

	foreach( $_FILES as $file) {
		if ( !move_uploaded_file( $file['tmp_name'], dirname(__FILE__) . '/../tmp/' . $file['name'] ) ) {
			echo "error upload file: " . $file['name'];
			continue;
		}
		$filename = $file['name'];
		$path = dirname(__FILE__) . '/../tmp';
		$file = $path . "/" . $filename;

		$content = file_get_contents($file);
		$content = chunk_split(base64_encode($content));

		// attachment
		$body .= "--" . $separator . $eol;
		$body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
		$body .= "Content-Transfer-Encoding: base64" . $eol;
		$body .= "Content-Disposition: attachment" . $eol;
		$body .= $content . $eol . $eol;
	}

	$body .= "--" . $separator . "--";

	//SEND Mail
	if (mail($mailto, $subject, $body, $headers)) {
		echo "mail send ... OK"; // or use booleans here
	} else {
		echo "mail send ... ERROR!";
		print_r( error_get_last() );
	}
}
if($_POST['id'] === "") {
	$mailto = "";

	$data_array = json_decode($_POST['data']);
	$message = "";
	foreach ($data_array as $key => $value) {
		if (isset($value->name) && $value->name !== "") {
			$message .= $value->name.': '.$value->value.'<br>';
		}
	}

	$subject = "";

	// a random hash will be necessary to send mixed content
	$separator = md5(time());

	// carriage return type (RFC)
	$eol = "\r\n";

	// main header (multipart mandatory)
	$headers = "From: $mailto" . $eol;
	$headers .= "Reply-To: $mailto" . $eol;
	$headers .= "MIME-Version: 1.0" . $eol;
	$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
	$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
	$headers .= "This is a MIME encoded message." . $eol;

	// message
	$body = "--" . $separator . $eol;
	$body .= "Content-Type: text/html; charset=iso-8859-1" . $eol;
	$body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
	$body .= "<div>" . $message . "</div>" . $eol . $eol;

	foreach( $_FILES as $file) {
		if ( !move_uploaded_file( $file['tmp_name'], dirname(__FILE__) . '/../tmp/' . $file['name'] ) ) {
			echo "error upload file: " . $file['name'];
			continue;
		}
		$filename = $file['name'];
		$path = dirname(__FILE__) . '/../tmp';
		$file = $path . "/" . $filename;

		$content = file_get_contents($file);
		$content = chunk_split(base64_encode($content));

		// attachment
		$body .= "--" . $separator . $eol;
		$body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
		$body .= "Content-Transfer-Encoding: base64" . $eol;
		$body .= "Content-Disposition: attachment" . $eol;
		$body .= $content . $eol . $eol;
	}

	$body .= "--" . $separator . "--";

	//SEND Mail
	if (mail($mailto, $subject, $body, $headers)) {
		echo "mail send ... OK"; // or use booleans here
	} else {
		echo "mail send ... ERROR!";
		print_r( error_get_last() );
	}
}