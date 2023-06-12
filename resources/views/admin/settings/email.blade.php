@extends('admin.layouts.master')
@section('breadcrumb')
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('dashboard.index') !!}">
                <i class="fal fa-home fa-w"></i> Dashboard
            </a>
        </li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
@stop

@section('header')
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-cog'></i> General Setting
        </h1>
    </div>
@stop

@section('content')
    {!! Form::open(['route' => ['settings.email.edit']]) !!}
    <div class="max-width-1200 email-settings">
        @if (config('core.setting.general.enable_email_smtp_settings', true))
            <div class="flexbox-annotated-section">

                <div class="flexbox-annotated-section-annotation">
                    <div class="annotated-section-title pd-all-20">
                        <h2>{{ trans('setting.email_setting_title') }}</h2>
                    </div>
                    <div class="annotated-section-description pd-all-20 p-none-t">
                        <p class="color-note">{{ trans('setting.email.description') }}</p>
                    </div>
                </div>

                <div class="flexbox-annotated-section-content">
                    <div class="wrapper-content pd-all-20" id="email-config-form">
                        <div class="form-group mb-3">
                            <label class="text-title-field"
                                   for="email_driver">{{ trans('setting.email.mailer') }}</label>
                            <div class="ui-select-wrapper">
                                <select name="email_driver" class="ui-select setting-select-options" id="email_driver">
                                    <option value="smtp"
                                            @if (setting('email_driver', config('mail.default')) == 'smtp') selected @endif>
                                        SMTP
                                    </option>
                                    <option value="sendmail"
                                            @if (setting('email_driver', config('mail.default')) == 'sendmail') selected @endif>
                                        Sendmail
                                    </option>
                                    <option value="mailgun"
                                            @if (setting('email_driver', config('mail.default')) == 'mailgun') selected @endif>
                                        Mailgun
                                    </option>
                                    <option value="ses"
                                            @if (setting('email_driver', config('mail.default')) == 'ses') selected @endif>
                                        SES
                                    </option>
                                    <option value="postmark"
                                            @if (setting('email_driver', config('mail.default')) == 'postmark') selected @endif>
                                        Postmark
                                    </option>
                                    <option value="log"
                                            @if (setting('email_driver', config('mail.default')) == 'log') selected @endif>
                                        Log
                                    </option>
                                    <option value="array"
                                            @if (setting('email_driver', config('mail.default')) == 'array') selected @endif>
                                        Array
                                    </option>
                                </select>
                                <svg class="svg-next-icon svg-next-icon-size-16">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                </svg>
                            </div>
                        </div>
                        <div data-type="smtp"
                             class="setting-wrapper @if (setting('email_driver', config('mail.default')) !== 'smtp') hidden @endif">
                            <div class="form-group mb-3">
                                <label class="text-title-field"
                                       for="email_port">{{ trans('setting.email.port') }}</label>
                                <input data-counter="10" type="number" class="next-input" name="email_port"
                                       id="email_port"
                                       value="{{ setting('email_port', config('mail.mailers.smtp.port')) }}"
                                       placeholder="{{ trans('setting.email.port_placeholder') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-title-field"
                                       for="email_host">{{ trans('setting.email.host') }}</label>
                                <input data-counter="60" type="text" class="next-input" name="email_host"
                                       id="email_host"
                                       value="{{ setting('email_host', config('mail.mailers.smtp.host')) }}"
                                       placeholder="{{ trans('setting.email.host_placeholder') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-title-field"
                                       for="email_username">{{ trans('setting.email.username') }}</label>
                                <input data-counter="120" type="text" class="next-input" name="email_username"
                                       id="email_username"
                                       value="{{ setting('email_username', config('mail.mailers.smtp.username')) }}"
                                       placeholder="{{ trans('setting.email.username_placeholder') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="text-title-field"
                                       for="email_password">{{ trans('setting.email.password')  }}</label>
                                <input data-counter="120" type="password" class="next-input" name="email_password"
                                       id="email_password"
                                       value="{{ setting('email_password', config('mail.mailers.smtp.password')) }}"
                                       placeholder="{{ trans('setting.email.password_placeholder') }}">
                            </div>
                            <div class="form-group mb-3" style="margin-bottom: 1em;">
                                <label class="text-title-field"
                                       for="email_encryption">{{ trans('setting.email.encryption') }}</label>
                                <input data-counter="20" type="text" class="next-input" name="email_encryption"
                                       id="email_encryption"
                                       value="{{ setting('email_encryption', config('mail.mailers.smtp.encryption')) }}"
                                       placeholder="{{ trans('setting.email.encryption_placeholder') }}">
                            </div>
                        </div>

                        <div data-type="mailgun"
                             class="setting-wrapper @if (setting('email_driver', config('mail.default')) !== 'mailgun') hidden @endif">
                            <div class="form-group mb-3">
                                <label class="text-title-field"
                                       for="email_mail_gun_domain">{{ trans('setting.email.mail_gun_domain') }}</label>
                                <input data-counter="120" type="text" class="next-input" name="email_mail_gun_domain"
                                       id="email_mail_gun_domain"
                                       value="{{ setting('email_mail_gun_domain', config('services.mailgun.domain')) }}"
                                       placeholder="{{ trans('setting.email.mail_gun_domain_placeholder') }}">
                            </div>
                            @if (!app()->environment('demo'))
                                <div class="form-group mb-3">
                                    <label class="text-title-field"
                                           for="email_mail_gun_secret">{{ trans('setting.email.mail_gun_secret')  }}</label>
                                    <input data-counter="120" type="text" class="next-input"
                                           name="email_mail_gun_secret" id="email_mail_gun_secret"
                                           value="{{ setting('email_mail_gun_secret', config('services.mailgun.secret')) }}"
                                           placeholder="{{ trans('setting.email.mail_gun_secret_placeholder') }}">
                                </div>
                            @endif
                            <div class="form-group mb-3" style="margin-bottom: 1em;">
                                <label class="text-title-field"
                                       for="email_mail_gun_endpoint">{{ trans('setting.email.mail_gun_endpoint') }}</label>
                                <input data-counter="120" type="text" class="next-input" name="email_mail_gun_endpoint"
                                       id="email_mail_gun_endpoint"
                                       value="{{ setting('email_mail_gun_endpoint', config('services.mailgun.endpoint')) }}"
                                       placeholder="{{ trans('setting.email.mail_gun_endpoint_placeholder') }}">
                            </div>
                        </div>

                        <div data-type="ses"
                             class="setting-wrapper @if (setting('email_driver', config('mail.default')) !== 'ses') hidden @endif">
                            <div class="form-group mb-3">
                                <label class="text-title-field"
                                       for="email_ses_key">{{ trans('setting.email.ses_key') }}</label>
                                <input data-counter="120" type="text" class="next-input" name="email_ses_key"
                                       id="email_ses_key"
                                       value="{{ setting('email_ses_key', config('services.ses.key')) }}"
                                       placeholder="{{ trans('setting.email.ses_key_placeholder') }}">
                            </div>
                            @if (!app()->environment('demo'))
                                <div class="form-group mb-3">
                                    <label class="text-title-field"
                                           for="email_ses_secret">{{ trans('setting.email.ses_secret')  }}</label>
                                    <input data-counter="120" type="text" class="next-input" name="email_ses_secret"
                                           id="email_ses_secret"
                                           value="{{ setting('email_ses_secret', config('services.ses.secret')) }}"
                                           placeholder="{{ trans('setting.email.ses_secret_placeholder') }}">
                                </div>
                            @endif
                            <div class="form-group mb-3" style="margin-bottom: 1em;">
                                <label class="text-title-field"
                                       for="email_ses_region">{{ trans('setting.email.ses_region') }}</label>
                                <input data-counter="120" type="text" class="next-input" name="email_ses_region"
                                       id="email_ses_region"
                                       value="{{ setting('email_ses_region', config('services.ses.region')) }}"
                                       placeholder="{{ trans('setting.email.ses_region_placeholder') }}">
                            </div>
                        </div>

                        <div data-type="postmark"
                             class="setting-wrapper @if (setting('email_driver', config('mail.default')) !== 'postmark') hidden @endif">
                            @if (!app()->environment('demo'))
                                <div class="form-group mb-3">
                                    <label class="text-title-field"
                                           for="email_postmark_token">{{ trans('setting.email.postmark_token')  }}</label>
                                    <input data-counter="120" type="text" class="next-input" name="email_postmark_token"
                                           id="email_postmark_token"
                                           value="{{ setting('email_postmark_token', config('services.postmark.token')) }}"
                                           placeholder="{{ trans('setting.email.postmark_token_placeholder') }}">
                                </div>
                            @endif
                        </div>

                        <div data-type="sendmail"
                             class="setting-wrapper @if (setting('email_driver', config('mail.default')) !== 'sendmail') hidden @endif">
                            <div class="form-group mb-3">
                                <label class="text-title-field"
                                       for="email_sendmail_path">{{ trans('setting.email.sendmail_path')  }}</label>
                                <input type="text" class="next-input" name="email_sendmail_path"
                                       id="email_sendmail_path"
                                       value="{{ setting('email_sendmail_path', config('mail.mailers.sendmail.path')) }}"
                                       placeholder="{{ trans('setting.email.sendmail_path') }}">
                                <span
                                    class="help-ts">{{ trans('setting.email.default') }}: <code>{{ config('mail.mailers.sendmail.path') }}</code></span>
                            </div>
                        </div>

                        <div data-type="log"
                             class="setting-wrapper @if (setting('email_driver', config('mail.default')) !== 'log') hidden @endif">
                            <div class="form-group mb-3" style="margin-bottom: 1em;">
                                <label class="text-title-field"
                                       for="email_log_channel">{{ trans('setting.email.log_channel') }}</label>
                                <input type="text" class="next-input" name="email_log_channel" id="email_log_channel"
                                       value="{{ setting('email_log_channel', config('mail.mailers.log.channel')) }}"
                                       placeholder="{{ trans('setting.email.log_channel') }}">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-title-field"
                                   for="email_from_name">{{ trans('setting.email.sender_name') }}</label>
                            <input data-counter="60" type="text" class="next-input" name="email_from_name"
                                   id="email_from_name"
                                   value="{{ setting('email_from_name', config('mail.from.name')) }}"
                                   placeholder="{{ trans('setting.email.sender_name_placeholder') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-title-field"
                                   for="email_from_address">{{ trans('setting.email.sender_email') }}</label>
                            <input data-counter="60" type="text" class="next-input" name="email_from_address"
                                   id="email_from_address"
                                   value="{{ setting('email_from_address', config('mail.from.address')) }}"
                                   placeholder="admin@example.com">
                        </div>

                        <div class="form-group mb-3">
                            <input type="hidden" name="using_queue_to_send_mail" value="0">
                            <label>
                                <input type="checkbox" value="1" @if (setting('using_queue_to_send_mail')) checked
                                       @endif name="using_queue_to_send_mail">
                                {{ trans('setting.email.using_queue_to_send_mail') }}
                            </label>
                        </div>

                        <div class="form-group mb-3">
                            <button class="btn btn-info send-test-email-trigger-button"
                                    data-action="{!! route('settings.email.edit') !!}" type="button"
                                    data-saving="{{ trans('setting.saving') }}">{{ trans('setting.test_send_mail') }}</button>
                        </div>

                    </div>
                </div>
            </div>
        @endif

        <div class="flexbox-annotated-section" style="border: none">
            <div class="flexbox-annotated-section-annotation">
                &nbsp;
            </div>
            <div class="flexbox-annotated-section-content">
                <button class="btn btn-info" type="submit">{{ trans('setting.save_settings') }}</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    {!! Form::modalAction('send-test-email-modal', trans('setting.test_email_modal_title'), 'info', view('admin.settings.test-email')->render(), 'send-test-email-btn', trans('setting.send'), route('setting.email.send.test')) !!}
@stop
