<?php

namespace VNCore\Horicon\Services;

class SmsService extends HoriconService
{
    /**
     * @param $msisdn
     * @param $message
     *
     * @return bool
     */
    public function sendSms($msisdn, $message)
    {
        if (!$msisdn) {
            return FALSE;
        }

        $client = new \SoapClient("http://brandsms.vn:8018/VMGAPI.asmx?wsdl");

        //Then set and pass the parameters:
        $params = [
            'msisdn' => $msisdn,
            'alias' => 'TTLDNN',
            'message' => $message,
            'sendTime' => '',
            'authenticateUser' => 'ttldnn',
            'authenticatePass' => 'vmg123456',
        ];

        $response = $client->__soapCall('BulkSendSms', [$params]);
    }
}
