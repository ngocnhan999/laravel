<?php

namespace App\Core\Base\Helpers;

use App\Core\Base\Events\SendMailEvent;
use App\Core\Base\Jobs\SendMailJob;
use Illuminate\Support\Arr;
use Exception;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

class MailVariable
{
    /**
     * @var array
     */
    protected $variables = [];

    /**
     * @var array
     */
    protected $variableValues = [];

    /**
     * @var string
     */
    protected $module = 'core';

    /**
     * MailVariable constructor.
     */
    public function initVariable()
    {
        $this->variables['core'] = [
            'header'           => __('Email template header'),
            'footer'           => __('Email template footer'),
            'site_title'       => __('Site title'),
            'site_url'         => __('Site URL'),
            'site_logo'        => __('Site Logo'),
            'date_time'        => __('Current date time'),
            'date_year'        => __('Current year'),
            'site_admin_email' => __('Site admin email'),
        ];
    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function initVariableValues()
    {
        $this->variableValues['core'] = [
            'header'           => get_setting_email_template_content('default', 'header'),
            'footer'           => get_setting_email_template_content('default', 'footer'),
            'site_title'       => env('MAIL_FROM_NAME'),
            'site_url'         => url(''),
            'site_logo'        => '',
            'date_time'        => now(config('app.timezone'))->toDateTimeString(),
            'date_year'        => now(config('app.timezone'))->format('Y'),
            'site_admin_email' => 'cjgmd@gmail.com',
        ];
    }

    /**
     * @param $module
     * @return MailVariable
     */
    public function setModule($module) : self
    {
        $this->module = $module;
        return $this;
    }

    /**
     * @param $name
     * @param null $description
     * @param string $module
     * @return MailVariable
     */
    public function addVariable($name, $description = null) : self
    {
        $this->variables[$this->module][$name] = $description;
        return $this;
    }

    /**
     * @param array $variables
     * @param string $module
     * @return MailVariable
     */
    public function addVariables(array $variables) : self
    {
        foreach ($variables as $name => $description) {
            $this->variables[$this->module][$name] = $description;
        }

        return $this;
    }

    /**
     * @param null $module
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getVariables($module = null) : array
    {
        $this->initVariable();

        if (!$module) {
            return $this->variables;
        }

        return Arr::get($this->variables, $module, []);
    }

    /**
     * @param $variable
     * @param $value
     * @param string $module
     * @return MailVariable
     */
    public function setVariableValue($variable, $value) : self
    {
        $this->variables[$this->module][$variable] = $value;
        return $this;
    }

    /**
     * @param array $data
     * @param string $module
     * @return MailVariable
     */
    public function setVariableValues(array $data) : self
    {
        foreach ($data as $name => $value) {
            $this->variableValues[$this->module][$name] = $value;
        }

        return $this;
    }

    /**
     * @param $variable
     * @param $module
     * @param string $default
     * @return string
     */
    public function getVariableValue($variable, $module, $default = '') : string
    {
        return (string)Arr::get($this->variableValues, $module . '.' . $variable, $default);
    }

    /**
     * @return array
     */
    public function getVariableValues($module = null)
    {
        if ($module) {
            return Arr::get($this->variableValues, $module, []);
        }

        return $this->variableValues;
    }

    /**
     * @param $content
     * @param null $module
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function prepareData($content, $variables = []) : string
    {
        $this->initVariable();
        $this->initVariableValues();

        if (!empty($content)) {
            $content = $this->replaceVariableValue(array_keys($this->variables['core']), 'core', $content);

            if ($this->module !== 'core') {
                if (empty($variables)) {
                    $variables = Arr::get($this->variables, $this->module, []);
                }
                $content = $this->replaceVariableValue(
                    array_keys($variables),
                    $this->module,
                    $content
                );
            }
        }

        return $content;
    }

    /**
     * @param array $variables
     * @param $module
     * @param $content
     * @return string
     */
    protected function replaceVariableValue(array $variables, $module, $content) : string
    {
        foreach ($variables as $variable) {
            $keys = [
                '{{ ' . $variable . ' }}',
                '{{' . $variable . '}}',
                '{{ ' . $variable . '}}',
                '{{' . $variable . ' }}',
                '<?php echo e(' . $variable . '); ?>',
            ];

            foreach ($keys as $key) {
                $content = str_replace($key, $this->getVariableValue($variable, $module), $content);
            }
        }

        return $content;
    }

    /**
     * @param string $content
     * @param string $title
     * @param string $to
     * @param array $args
     * @param bool $debug
     * @throws \Throwable
     */
    public function send(string $content, string $title, $to = null, $args = [], $debug = false)
    {
        try {

            if (empty($to)) {
                $to = get_admin_email()->toArray();
                if (empty($to)) {
                    $to = setting('email_from_address', config('mail.from.address'));
                }
            }

            $content = $this->prepareData($content);
            $title = $this->prepareData($title);

            if (setting('using_queue_to_send_mail', config('general.send_mail_using_job_queue'))) {
                dispatch(new SendMailJob($content, $title, $to, $args, $debug));
            } else {
                event(new SendMailEvent($content, $title, $to, $args, $debug));
            }
        } catch (Exception $exception) {
            if ($debug) {
                throw $exception;
            }
            info($exception->getMessage());
            $this->sendErrorException($exception);
        }
    }


    /**
     * Sends an email to the developer about the exception.
     *
     * @param Exception $exception
     * @throws \Throwable
     */
    public function sendErrorException(Exception $exception)
    {
        try {
            $ex = FlattenException::create($exception);

            $url = \URL::full();
            $error = $this->renderException($exception);

            $this->send(
                view('emails.error-reporting', compact('url', 'ex', 'error'))->render(),
                $exception->getFile(),
                !empty(config('general.error_reporting.to')) ?
                    config('general.error_reporting.to') :
                    get_admin_email()->toArray()
            );
        } catch (Exception $ex) {
            info($ex->getMessage());
        }
    }

    /**
     * @param $exception
     * @return string
     */
    protected function renderException($exception)
    {
        $renderer = new HtmlErrorRenderer(true);

        $exception = $renderer->render($exception);

        if (!headers_sent()) {
            http_response_code($exception->getStatusCode());

            foreach ($exception->getHeaders() as $name => $value) {
                header($name . ': ' . $value, false);
            }
        }

        return $exception->getAsString();
    }
}
