<?php

	function successResponse($msg = '', $data = [], $status = 200)
	{
		return response()->json(['error' => false, 'status' => $status, 'message' => $msg, 'data' => $data]);
	}

	function errorResponse($msg = '', $data = [], $status = 200)
	{
		return response()->json(['error' => true, 'status' => $status, 'message' => $msg, 'data' => $data]);
	}

	function sendMail($data, $templateName, $to, $subject)
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


	function imageUpload($image, $folder = 'image')
	{
		$random = randomGenerator();
		$image->move('upload/' . $folder . '/', $random . '.' . $image->getClientOriginalExtension());
		$imageurl = 'upload/' . $folder . '/' . $random . '.' . $image->getClientOriginalExtension();
		return $imageurl;
	}

	function generateUniqueAlphaNumeric($length = 8)
	{
		$random_string = '';
		for ($i = 0; $i < $length; $i++) {
			$number = random_int(0, 36);
			$character = base_convert($number, 10, 36);
			$random_string .= $character;
		}
		return $random_string;
	}

	function emptyCheck($string, $date = false)
	{
		if ($date) {
			return !empty($string) ? $string : '0000-00-00';
		}
		return !empty($string) ? $string : '';
	}

	function randomGenerator()
	{
		return uniqid() . '' . date('ymdhis') . '' . uniqid();
	}

	function moneyFormat($amount)
	{
		$amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
		return $amount;
	}

	function words($string, $words = 100)
	{
		return Str::limit($string, $words);
	}

	function strQuotationCheck($string = "")
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