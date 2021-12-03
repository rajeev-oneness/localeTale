<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Notification;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendNotificationToUser($user,$titleNotification = [],$fromUser = null,$notificationType = [])
    {
        if($user && count($titleNotification) > 0){
            $newNotification = new Notification();
            $newNotification->userId = $user->id;
            $newNotification->title = emptyCheck($titleNotification['title']);
            $newNotification->message = emptyCheck($titleNotification['message']);
            if($fromUser){
                $newNotification->fromUserId = $fromUser->id;
            }
            if(count($notificationType) > 0){
                $newNotification->type = $notificationType['type'];
                $newNotification->type_name = emptyCheck($notificationType['type_name']);
                $newNotification->payload = emptyCheck($notificationType['payload']);
            }
            $newNotification->timestamp = date('M d, Y h:i:s A');
            $newNotification->save();
            $payload = [
                'id' => $newNotification->id,
                'userId' => $newNotification->userId,
                'title' => $newNotification->title,
                'message' => $newNotification->message,
                'fromUserId' => $newNotification->fromUserId,
                'read' => $newNotification->read,
                'type' => $newNotification->type,
                'type_name' => $newNotification->type_name,
                'payload' => emptyCheck(json_decode($newNotification->payload)),
                'timestamp' => $newNotification->timestamp,
            ];
            $deviceTokens = getUserDeviceTokens($user);
            sendPushNotification('ios',$deviceTokens,$payload);
            return $newNotification;
        }
    }
}
