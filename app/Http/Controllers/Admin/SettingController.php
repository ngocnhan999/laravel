<?php

namespace App\Http\Controllers\Admin;

use App\Core\Support\Http\Responses\BaseHttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\SendTestEmailRequest;
use App\Http\Requests\Setting\SettingRequest;
use App\Repositories\Setting\Interfaces\SettingInterface;
use Assets;
use Exception;
use MailVariable;

class SettingController extends Controller
{
    /**
     * @var SettingInterface
     */
    protected $settingRepository;

    protected $settingStore;

    public function __construct(SettingInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    //

    public function getOptions()
    {
        page_title()->setTitle('Setting');
        return view('admin.settings.general');
    }


    public function getEmailConfig()
    {
        page_title()->setTitle(trans('layouts.setting_email'));
        Assets::addScriptsDirectly('js/setting.js');

        return view('admin.settings.email');
    }

    /**
     * @param SettingRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function postEditEmailConfig(SettingRequest $request, BaseHttpResponse $response)
    {
        $this->saveSettings($request->except(['_token']));

        return $response
            ->setPreviousUrl(route('settings.email'))
            ->setMessage(trans('notices.update_success_message'));
    }

    /**
     * @param BaseHttpResponse $response
     * @param SendTestEmailRequest $request
     * @return BaseHttpResponse
     * @throws \Throwable
     */
    public function postSendTestEmail(BaseHttpResponse $response, SendTestEmailRequest $request)
    {
        try {
            MailVariable::send(
                file_get_contents('setting/email-templates/test.tpl'),
                'Test',
                $request->input('email'),
                [],
                true
            );

            return $response->setMessage(trans('setting.test_email_send_success'));
        } catch (Exception $exception) {
            return $response->setError()
                ->setMessage($exception->getMessage());
        }
    }


    /**
     * @param array $data
     */
    protected function saveSettings(array $data)
    {
        foreach ($data as $settingKey => $settingValue) {
            if (is_array($settingValue)) {
                $settingValue = json_encode(array_filter($settingValue));
            }

            setting()->set($settingKey, (string)$settingValue);
        }

        setting()->save();
    }
}
