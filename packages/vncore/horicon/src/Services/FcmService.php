<?php

namespace VNCore\Horicon\Services;

use Illuminate\Database\Eloquent\Model;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

class FcmService extends HoriconService
{
    const TOPIC_SOS = 'has_sos';
    const TOPIC_NOTIFICATION = 'has_notification';

    /**
     * @param null  $title
     * @param null  $body
     * @param Model $model
     * @param       $tokenDevice
     *
     * @return bool
     */
    public function sendTo($title = NULL, $body = NULL, Model $model, $tokenDevice)
    {
        if(!$tokenDevice) {
            return false;
        }

        $title = str_limit($title, 29);
        $body = str_limit($body, 99);

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['sos_data' => $model->toArray()]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = $tokenDevice;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        //$downstreamResponse->numberSuccess();
        //$downstreamResponse->numberFailure();
        //$downstreamResponse->numberModification();
    }

    /**
     * @param null   $title
     * @param null   $body
     * @param Model  $model
     * @param string $tp
     */
    public function sendToTopic($title = NULL, $body = NULL, Model $model, string $tp = self::TOPIC_SOS)
    {
        $title = str_limit($title, 29);
        $body = str_limit($body, 99);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['sos_data' => $model->toArray()]);

        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $topic = new Topics();
        $topic->topic($tp);

        $topicResponse = FCM::sendToTopic($topic, null, $notification, $data);
        //$topicResponse->isSuccess();
        //$topicResponse->shouldRetry();
        //$topicResponse->error();
    }
}
