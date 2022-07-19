<?php

namespace App;

class Response{
    static $messages = [
        100 => [
            'status' => true,
            'message' => 'Continue',            
        ],
        101 => [
            'status' => true,
            'message' => 'Switching Protocols',            
        ],
        102 => [
            'status' => true,
            'message' => 'Processing (WebDAV)',            
        ],
        200 => [
            'status' => true,
            'message' => 'OK',            
        ],
        201 => [
            'status' => true,
            'message' => 'Created',            
        ],
        202 => [
            'status' => true,
            'message' => 'Accepted',            
        ],
        203 => [
            'status' => true,
            'message' => 'Non-Authoritative Information',            
        ],
        204 => [
            'status' => true,
            'message' => 'No Content',            
        ],
        205 => [
            'status' => true,
            'message' => 'Reset Content',            
        ],
        206 => [
            'status' => true,
            'message' => 'Partial Content',            
        ],
        207 => [
            'status' => true,
            'message' => 'Multi-Status (WebDAV)',            
        ],
        208 => [
            'status' => true,
            'message' => 'Already Reported (WebDAV)',            
        ],
        226 => [
            'status' => true,
            'message' => 'IM Used',            
        ],
        300 => [
            'status' => true,
            'message' => 'Multiple Choices',            
        ],
        301 => [
            'status' => true,
            'message' => 'Moved Permanently',            
        ],
        302 => [
            'status' => true,
            'message' => 'Found',            
        ],
        303 => [
            'status' => true,
            'message' => 'See Other',            
        ],
        304 => [
            'status' => true,
            'message' => 'Not Modified',            
        ],
        305 => [
            'status' => true,
            'message' => 'Use Proxy',            
        ],
        306 => [
            'status' => true,
            'message' => '(Unused)',            
        ],
        307 => [
            'status' => true,
            'message' => 'Temporary Redirect',            
        ],
        308 => [
            'status' => true,
            'message' => 'Permanent Redirect (experimental)',            
        ],
        400 => [
            'status' => false,
            'message' => 'Bad Request',            
        ],
        401 => [
            'status' => false,
            'message' => 'Unauthorized',            
        ],
        402 => [
            'status' => false,
            'message' => 'Payment Required',            
        ],
        403 => [
            'status' => false,
            'message' => 'Forbidden',            
        ],
        404 => [
            'status' => false,
            'message' => 'Not Found',            
        ],
        405 => [
            'status' => false,
            'message' => 'Method Not Allowed',            
        ],
        406 => [
            'status' => false,
            'message' => 'Not Acceptable',            
        ],
        407 => [
            'status' => false,
            'message' => 'Proxy Authentication Required',            
        ],
        408 => [
            'status' => false,
            'message' => 'Request Timeout',            
        ],
        409 => [
            'status' => false,
            'message' => 'Conflict',            
        ],
        410 => [
            'status' => false,
            'message' => 'Gone',            
        ],
        411 => [
            'status' => false,
            'message' => 'Length Required',            
        ],
        412 => [
            'status' => false,
            'message' => 'Precondition Failed',            
        ],
        413 => [
            'status' => false,
            'message' => 'Request Entity Too Large',            
        ],
        414 => [
            'status' => false,
            'message' => 'Request-URI Too Long',            
        ],
        415 => [
            'status' => false,
            'message' => 'Unsupported Media Type',            
        ],
        416 => [
            'status' => false,
            'message' => 'Requested Range Not Satisfiable',            
        ],
        417 => [
            'status' => false,
            'message' => 'Expectation Failed',            
        ],
        418 => [
            'status' => false,
            'message' => 'I\'m a teapot (RFC 2324)',            
        ],
        420 => [
            'status' => false,
            'message' => 'Enhance Your Calm (Twitter)',            
        ],
        422 => [
            'status' => false,
            'message' => 'Unprocessable Entity (WebDAV)',            
        ],
        423 => [
            'status' => false,
            'message' => 'Locked (WebDAV)',            
        ],
        424 => [
            'status' => false,
            'message' => 'Failed Dependency (WebDAV)',            
        ],
        425 => [
            'status' => false,
            'message' => 'Reserved for WebDAV',
                
        ],
        426 => [
            'status' => false,
            'message' => 'Upgrade Required',            
        ],
        428 => [
            'status' => false,
            'message' => 'Precondition Required',            
        ],
        429 => [
            'status' => false,
            'message' => 'Too Many Requests',            
        ],
        431 => [
            'status' => false,
            'message' => 'Request Header Fields Too Large',            
        ],
        444 => [
            'status' => false,
            'message' => 'No Response (Nginx)',            
        ],
        449 => [
            'status' => false,
            'message' => 'Retry With (Microsoft)',            
        ],
        450 => [
            'status' => false,
            'message' => 'Blocked by Windows Parental Controls (Microsoft)',            
        ],
        451 => [
            'status' => false,
            'message' => 'Unavailable For Legal Reasons',            
        ],
        499 => [
            'status' => false,
            'message' => 'Client Closed Request (Nginx)',            
        ],
        500 => [
            'status' => false,
            'message' => 'Internal Server Error',            
        ],
        501 => [
            'status' => false,
            'message' => 'Not Implemented',            
        ],
        502 => [
            'status' => false,
            'message' => 'Bad Gateway',            
        ],
        503 => [
            'status' => false,
            'message' => 'Service Unavailable',            
        ],
        504 => [
            'status' => false,
            'message' => 'Gateway Timeout',            
        ],
        505 => [
            'status' => false,
            'message' => 'HTTP Version Not Supported',            
        ],
        506 => [
            'status' => false,
            'message' => 'Variant Also Negotiates (Experimental)',            
        ],
        507 => [
            'status' => false,
            'message' => 'Insufficient Storage (WebDAV)',            
        ],
        508 => [
            'status' => false,
            'message' => 'Loop Detected (WebDAV)',            
        ],
        509 => [
            'status' => false,
            'message' => 'Bandwidth Limit Exceeded (Apache)',            
        ],
        510 => [
            'status' => false,
            'message' => 'Not Extended',            
        ],
        511 => [
            'status' => false,
            'message' => 'Network Authentication Required',            
        ],
        598 => [
            'status' => false,
            'message' => 'Network read timeout error',
        ],
        599 => [
            'status' => false,
            'message' => 'Network connect timeout error'                
        ]
    ];

    static function response($message = null,$error_code = null,$data = null,$code = null){
        $arrs = [
            'status' => self::$messages[$code]['status'],
            'message' => ($message == null) ? self::$messages[$code]['message'] : $message,
        ];

        if($error_code !== null){
            $arrs = array_merge($arrs,['error_code' => $error_code]);
        }

        if($data !== null){
            $arrs = array_merge($arrs,['data' => $data]);
        }

        return $arrs;
    }

    static function true($message = null,$data = null,$code = 200){
        $arrs = [
            'status' => true,
            'message' => ($message == null) ? self::$messages[$code]['message'] : $message,
        ];

        if($data !== null){
            $arrs = array_merge($arrs,['data' => $data]);
        }

        return response()->json($arrs,$code);
    }

    static function false($message = null,$error_code = null,$data = null,$code = 500){

        $arrs = [
            'status' => false,
            'message' => ($message == null) ? self::$messages[$code]['message'] : $message,
        ];

        if($error_code !== null){
            $arrs = array_merge($arrs,['error_code' => $error_code]);
        }

        if($data !== null){
            $arrs = array_merge($arrs,['data' => $data]);
        }

        return response()->json($arrs,$code);
    }
   
    static function _100($message = null,$error_code = null,$data = null,$code = 100){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }

    static function _101($message = null,$error_code = null,$data = null,$code = 101){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }

    static function _102($message = null,$error_code = null,$data = null,$code = 102){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _200($message = null,$error_code = null,$data = null,$code = 200){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _201($message = null,$error_code = null,$data = null,$code = 201){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _202($message = null,$error_code = null,$data = null,$code = 202){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _203($message = null,$error_code = null,$data = null,$code = 203){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _204($message = null,$error_code = null,$data = null,$code = 204){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _205($message = null,$error_code = null,$data = null,$code = 205){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _206($message = null,$error_code = null,$data = null,$code = 206){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _207($message = null,$error_code = null,$data = null,$code = 207){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _208($message = null,$error_code = null,$data = null,$code = 208){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _226($message = null,$error_code = null,$data = null,$code = 226){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _300($message = null,$error_code = null,$data = null,$code = 300){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _301($message = null,$error_code = null,$data = null,$code = 301){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _302($message = null,$error_code = null,$data = null,$code = 302){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _303($message = null,$error_code = null,$data = null,$code = 303){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _304($message = null,$error_code = null,$data = null,$code = 304){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _305($message = null,$error_code = null,$data = null,$code = 305){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _306($message = null,$error_code = null,$data = null,$code = 306){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _307($message = null,$error_code = null,$data = null,$code = 307){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _308($message = null,$error_code = null,$data = null,$code = 308){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _400($message = null,$error_code = null,$data = null,$code = 400){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _401($message = null,$error_code = null,$data = null,$code = 401){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _402($message = null,$error_code = null,$data = null,$code = 402){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _403($message = null,$error_code = null,$data = null,$code = 403){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _404($message = null,$error_code = null,$data = null,$code = 404){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _405($message = null,$error_code = null,$data = null,$code = 405){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _406($message = null,$error_code = null,$data = null,$code = 406){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _407($message = null,$error_code = null,$data = null,$code = 407){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _408($message = null,$error_code = null,$data = null,$code = 408){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _409($message = null,$error_code = null,$data = null,$code = 409){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _410($message = null,$error_code = null,$data = null,$code = 410){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _411($message = null,$error_code = null,$data = null,$code = 411){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _412($message = null,$error_code = null,$data = null,$code = 412){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _413($message = null,$error_code = null,$data = null,$code = 413){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _414($message = null,$error_code = null,$data = null,$code = 414){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _415($message = null,$error_code = null,$data = null,$code = 415){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _416($message = null,$error_code = null,$data = null,$code = 416){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _417($message = null,$error_code = null,$data = null,$code = 417){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _418($message = null,$error_code = null,$data = null,$code = 418){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _420($message = null,$error_code = null,$data = null,$code = 420){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _422($message = null,$error_code = null,$data = null,$code = 422){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _423($message = null,$error_code = null,$data = null,$code = 423){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _424($message = null,$error_code = null,$data = null,$code = 424){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _425($message = null,$error_code = null,$data = null,$code = 425){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _426($message = null,$error_code = null,$data = null,$code = 426){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _428($message = null,$error_code = null,$data = null,$code = 428){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _429($message = null,$error_code = null,$data = null,$code = 429){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _431($message = null,$error_code = null,$data = null,$code = 431){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _444($message = null,$error_code = null,$data = null,$code = 444){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _449($message = null,$error_code = null,$data = null,$code = 449){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _450($message = null,$error_code = null,$data = null,$code = 450){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _451($message = null,$error_code = null,$data = null,$code = 451){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _499($message = null,$error_code = null,$data = null,$code = 499){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _500($message = null,$error_code = null,$data = null,$code = 500){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _501($message = null,$error_code = null,$data = null,$code = 501){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _502($message = null,$error_code = null,$data = null,$code = 502){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _503($message = null,$error_code = null,$data = null,$code = 503){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _504($message = null,$error_code = null,$data = null,$code = 504){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _505($message = null,$error_code = null,$data = null,$code = 505){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _506($message = null,$error_code = null,$data = null,$code = 506){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _507($message = null,$error_code = null,$data = null,$code = 507){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _508($message = null,$error_code = null,$data = null,$code = 508){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _509($message = null,$error_code = null,$data = null,$code = 509){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _510($message = null,$error_code = null,$data = null,$code = 510){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _511($message = null,$error_code = null,$data = null,$code = 511){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _598($message = null,$error_code = null,$data = null,$code = 598){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
    
    static function _599($message = null,$error_code = null,$data = null,$code = 599){
        return response()->json(self::response(message: $message,error_code: $error_code,data: $data,code: $code),$code);
    }
}