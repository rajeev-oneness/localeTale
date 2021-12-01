<?php

	// api hit success response
	function successResponse(string $msg = '', array $data = [], int $status = 200)
	{
		return response()->json(['error' => false, 'status' => $status, 'message' => $msg, 'data' => $data]);
	}

	// api hit error response
	function errorResponse(string $msg = '', array $data = [], int $status = 200)
	{
		return response()->json(['error' => true, 'status' => $status, 'message' => $msg, 'data' => $data]);
	}

	// mail send helper
	function sendMail(array $data, string $templateName, string $to, string $subject)
	{
		$newMail = new \App\Models\EmailLog();
		$newMail->from = 'onenesstechsolution@gmail.com';
		$newMail->to = $to;
		$newMail->subject = $subject;
		$newMail->view_file = $templateName;
		$newMail->payload = json_encode($data);
		$newMail->save();
		Mail::send('emails/' . $templateName, $data, function ($message) use ($data, $to, $subject) {
			$message->to($to, $data['name'])->subject($subject);
			$message->from('onenesstechsolution@gmail.com', 'Pro Music Tutor');
		});
	}

	// file upload
	function imageUpload(object $image, string $folder = 'image')
	{
		$random = randomGenerator();
		$image->move('upload/' . $folder . '/', $random . '.' . $image->getClientOriginalExtension());
		$imageurl = 'upload/' . $folder . '/' . $random . '.' . $image->getClientOriginalExtension();
		return $imageurl;
	}

	// generate alpha numeric unique string
	function generateUniqueAlphaNumeric(int $length = 8)
	{
		$random_string = '';
		for ($i = 0; $i < $length; $i++) {
			$number = random_int(0, 36);
			$character = base_convert($number, 10, 36);
			$random_string .= $character;
		}
		return $random_string;
	}

	// field empty check 
	function emptyCheck(string $string, bool $date = false)
	{
		if ($date) {
			return !empty($string) ? $string : '0000-00-00';
		}
		return !empty($string) ? $string : '';
	}

	// random string generate
	function randomGenerator()
	{
		return uniqid() . '' . date('ymdhis') . '' . uniqid();
	}

	function moneyFormat($amount)
	{
		$amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
		return $amount;
	}

	// limit words
	function words(string $string, int $words = 100)
	{
		return Str::limit($string, $words);
	}

	function strQuotationCheck(string $string = "")
	{
		$returnString = '';
		for ($i = 0; $i < strlen($string); $i++) {
			if ($string[$i] == '"') {
				$returnString .= '&#34;';
			} else if ($string[$i] == "'") {
				$returnString .= '&#39;';
			} else {
				$returnString .= $string[$i];
			}
		}
		return $returnString;
	}

?>