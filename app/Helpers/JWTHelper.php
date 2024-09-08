<?php

namespace App\Helpers;
use Illuminate\Http\Request;

class JwtHelper
{
    private static $secretKey = 'your_secret_key'; // Replace with your actual secret key
    private static $algorithm = 'HS256';

    public static function checkID(Request $request){
        // dd($request);
        $authHeader = $request->header('Authorization');
        if (!$authHeader) {
            return ['error' => 'Authorization header missing', 'error_code'=> 401];
        }

        $token = str_replace('Bearer ', '', $authHeader);
        $decoded = JwtHelper::decode($token);

        if (isset($decoded->error)) {
            return ['error' => 'Authorization header missing', 'error_code'=> 401];
        }
        return $decoded;
    }

    public static function encode(array $data)
    {
        $header = [
            'alg' => self::$algorithm,
            'typ' => 'JWT'
        ];

        $headerEncoded = self::base64UrlEncode(json_encode($header));
        $payloadEncoded = self::base64UrlEncode(json_encode($data));
        $signature = self::generateSignature($headerEncoded, $payloadEncoded);

        return $headerEncoded . '.' . $payloadEncoded . '.' . $signature;
    }

    public static function decode($token)
    {
        list($headerEncoded, $payloadEncoded, $signature) = explode('.', $token);

        if (self::generateSignature($headerEncoded, $payloadEncoded) !== $signature) {
            return (object) ['error' => 'Invalid token signature'];
        }

        $payload = self::base64UrlDecode($payloadEncoded);
        $decodedPayload = json_decode($payload);

        if ($decodedPayload->exp < time()) {
            return (object) ['error' => 'Token expired'];
        }

        return $decodedPayload;
    }

    private static function generateSignature($headerEncoded, $payloadEncoded)
    {
        $data = $headerEncoded . '.' . $payloadEncoded;
        return self::base64UrlEncode(hash_hmac('sha256', $data, self::$secretKey, true));
    }

    private static function base64UrlEncode($data)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    private static function base64UrlDecode($data)
    {
        $data = str_replace(['-', '_'], ['+', '/'], $data);
        return base64_decode($data);
    }
}
