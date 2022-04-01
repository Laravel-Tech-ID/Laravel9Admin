<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Arr;

class JsonResponse
{
    public $status;
    public $success;
    public $locale;
    public $message;
    public $data;

    public function success($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 200;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    
    public function error($attr = null, $datas = null)
    {
        $this->success = false;
        $this->locale = config('app.locale');
        $this->status = 500;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function index($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 200;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function show($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 200;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function edit($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 200;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function store($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 201;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function update($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 200;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function notFound($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 404;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function process($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 204;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function noContent($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 204;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function delete($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 200;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function put($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 200;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function patch($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 200;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }        
    public function get($attr = null, $datas = null)
    {
        $this->success = true;
        $this->locale = config('app.locale');
        $this->status = 200;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            $this->data = $attr;
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }
        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    public function exception($attr = null, $datas = null)
    {
        $this->success = false;
        $this->locale = config('app.locale');
        $code = 500;
        $this->status = $code;
        $this->data = $datas;
        $str = str_replace('\'','',Response::$statusTexts[$this->status]);
        $str1 = str_replace([' ', '-'],'_',$str);
        $str2 = strtolower($str1);
        $this->message = __('apiresponse.'.$str2);
        if(is_array($attr))
        {
            $attrs = Arr::flatten($attr);
            if(sizeof($attrs) == 1)
            {
                if(is_numeric($attr[0]) && is_int(intval($attr[0])))
                {
                    $this->status =  $attr[0];
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message = $attr[0];
                }
            } elseif(sizeof($attrs) == 2) {
                foreach($attrs as $attr){
                    if(is_numeric($attr) && is_int(intval($attr)))
                    {
                        $this->status =  $attr;
                    } else {
                        $this->message = $attr;
                    }
                }
            }
        } elseif(is_object($attr)) {
            if($attr->getCode())
            {
                $this->status =  $attr->getCode();
            }
            if($attr->getMessage())
            {
                if(is_numeric($attr->getMessage()) && is_int(intval($attr->getMessage())))
                {
                    $this->status =  $attr->getMessage();
                    $this->message = $this->getMessage($this->status);
                } else {
                    $this->message =  $attr->getMessage();
                }
            }
        } else {
            if(is_numeric($attr) && is_int(intval($attr)))
            {
                $this->status =  $attr;
                $this->message = $this->getMessage($this->status);
            } else {
                $this->message = $attr;
            }
        }
        if(!is_numeric($this->status) && !is_int($this->status))
        {
            $this->status = $code;
        }
        if(empty($this->message) || $this->message == null)
        {
            $this->message = $this->getMessage($this->status);
        }

        $arr = [
            'status' => $this->status,
            'success' => $this->success,
            'locale' => $this->locale,
            'message' => $this->message,
            'data' => $this->data         
        ];
        return response()->json($arr)->setStatusCode($this->status);    
    }
    private function getMessage($status){
        if(isset(Response::$statusTexts[$status]))
        {
            $str = str_replace('\'','',Response::$statusTexts[$this->status]);
            $str1 = str_replace([' ', '-'],'_',$str);
            $str2 = strtolower($str1);
            return __('apiresponse.'.$str2);
        } else {
            return __('apiresponse.unknown_status');    
        }   
    }
}