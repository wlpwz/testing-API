<?php
class ErrorHandler extends CErrorHandler
{
    public $maxSourceLines = 15;
    public $maxTraceSourceLines = 6;
    private $_error;

    public function init()
    {
        parent::init();
        register_shutdown_function(array($this,'handerOtherError'));
    }

    protected function handleException($exception)
    {
        if (!YII_DEBUG && (!($exception instanceof CHttpException) || $exception->statusCode == 500)) {
            $msg = "Exception";
            Yii::log($msg, CLogger::LEVEL_ERROR, 'alert');
            if (Yii::app() instanceof CConsoleApplication) {
                $this->_error = $this->getExceptionInfo($exception);
                return;
            }
        }
        /**
         * below code is same as parent::handleException($exception);
         * only change the header when request is ajax
         */
        $app=Yii::app();
        if($app instanceof CWebApplication)
        {
            if(($trace=$this->getExactTrace($exception))===null)
            {
                $fileName=$exception->getFile();
                $errorLine=$exception->getLine();
            }
            else
            {
                $fileName=$trace['file'];
                $errorLine=$trace['line'];
            }

            $trace = $exception->getTrace();

            foreach($trace as $i=>$t)
            {
                if(!isset($t['file']))
                    $trace[$i]['file']='unknown';

                if(!isset($t['line']))
                    $trace[$i]['line']=0;

                if(!isset($t['function']))
                    $trace[$i]['function']='unknown';

                unset($trace[$i]['object']);
            }

            $this->_error=$data=array(
                'code'=>($exception instanceof CHttpException)?$exception->statusCode:500,
                'type'=>get_class($exception),
                'errorCode'=>$exception->getCode(),
                'message'=>$exception->getMessage(),
                'file'=>$fileName,
                'line'=>$errorLine,
                'trace'=>$exception->getTraceAsString(),
                'traces'=>$trace,
            );

            if(!headers_sent())
                header("HTTP/1.0 {$data['code']} ".$exception->getMessage());
            if($this->isAjaxRequest())
                $app->displayException($exception);
            else if($exception instanceof CHttpException || !YII_DEBUG)
                $this->render('error',$data);
            else
                $this->render('exception',$data);
        }
        else
            $app->displayException($exception);
    }

    /**
     * Handles the PHP error.
     * @param CErrorEvent $event the PHP error event
     */
    protected function handleError($event)
    {
        if (!YII_DEBUG) {
            $msg = "Error";
            Yii::log($msg, CLogger::LEVEL_ERROR, 'alert');
            if (Yii::app() instanceof CConsoleApplication) {
                $this->_error = $this->getErrorInfo($event);
                return;
            }
        }
        parent::handleError($event);
    }

    public function getErrorInfo($event)
    {
        $trace = debug_backtrace();
        // skip the first 3 stacks as they do not tell the error position
        if (count($trace) > 3)
            $trace = array_slice($trace, 3);
        $traceString = '';
        foreach ($trace as $i => $t)
        {
            if (!isset($t['file']))
                $trace[$i]['file'] = 'unknown';

            if (!isset($t['line']))
                $trace[$i]['line'] = 0;

            if (!isset($t['function']))
                $trace[$i]['function'] = 'unknown';

            $traceString .= "#$i {$trace[$i]['file']}({$trace[$i]['line']}): ";
            if (isset($t['object']) && is_object($t['object']))
                $traceString .= get_class($t['object']) . '->';
            $traceString .= "{$trace[$i]['function']}()\n";

            unset($trace[$i]['object']);
        }

        $data = array(
            'code' => 500,
            'type' => 'PHP Error',
            'message' => $event->message,
            'file' => $event->file,
            'line' => $event->line,
            'trace' => $traceString,
            'traces' => $trace,
        );
        return $data;
    }

    public function getExceptionInfo($exception)
    {
        if (($trace = $this->getExactTrace($exception)) === null) {
            $fileName = $exception->getFile();
            $errorLine = $exception->getLine();
        }
        else
        {
            $fileName = $trace['file'];
            $errorLine = $trace['line'];
        }

        $trace = $exception->getTrace();

        foreach ($trace as $i => $t)
        {
            if (!isset($t['file']))
                $trace[$i]['file'] = 'unknown';

            if (!isset($t['line']))
                $trace[$i]['line'] = 0;

            if (!isset($t['function']))
                $trace[$i]['function'] = 'unknown';

            unset($trace[$i]['object']);
        }

        $data = array(
            'code' => ($exception instanceof CHttpException) ? $exception->statusCode : $exception->getCode,
            'type' => get_class($exception),
            'errorCode' => $exception->getCode(),
            'message' => $exception->getMessage(),
            'file' => $fileName,
            'line' => $errorLine,
            'trace' => $exception->getTraceAsString(),
            'traces' => $trace,
        );
        return $data;
    }

    public function getError()
    {
        if ($this->_error) {
            return $this->_error;
        } else {
            return parent::getError();
        }
    }

    public function argumentsToString($args)
    {
        return parent::argumentsToString($args);
    }

    public function isCoreCode($trace)
    {
        return parent::isCoreCode($trace);
    }

    public function renderSourceCode($file, $errorLine, $maxLines)
    {
        return parent::renderSourceCode($file, $errorLine, $maxLines);
    }

    public static function handerOtherError()
    {
        $error = error_get_last();
        if ($error) {
            switch ($error['type']) {
                case E_ERROR :
                case E_PARSE:
                case E_CORE_ERROR:
                case E_CORE_WARNING:
                case E_COMPILE_ERROR:
                case E_COMPILE_WARNING:
                    Yii::app()->handleError($error['type'], $error['message'], $error['file'], $error['line']);
            }
        }
    }
}
