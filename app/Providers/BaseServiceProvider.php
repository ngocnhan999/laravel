<?php

namespace App\Providers;

use App\Core\Base\Facades\BaseHelperFacade;
use App\Core\Base\Facades\MailVariableFacade;
use App\Core\Support\Helper;
use App\Core\Support\Routes\CustomResourceRegistrar;
use App\Facades\AuditLogFacade;
use App\Http\Middleware\Admin\Authenticate;
use App\Http\Middleware\HttpsProtocolMiddleware;
use App\Http\Middleware\Admin\RedirectIfAuthenticated;
use App\Http\Middleware\Student\RedirectIfMember;
use App\Http\Middleware\Student\RedirectIfNotMember;
use App\Http\Middleware\Mentor\RedirectIfMentor;
use App\Http\Middleware\Mentor\RedirectIfNotMentor;
use App\Models\Activation;
use App\Models\AuditHistory;
use App\Models\Province;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Student;
use App\Models\StudentImage;
use App\Models\StudentInformation;
use App\Models\Mentor;
use App\Models\MentorInformation;
use App\Models\User;
use App\Repositories\AuditHistory\Caches\AuditHistoryCacheDecorator;
use App\Repositories\AuditHistory\Eloquent\AuditHistoryRepository;
use App\Repositories\AuditHistory\Interfaces\AuditHistoryInterface;
use App\Repositories\Province\Caches\ProvinceCacheDecorator;
use App\Repositories\Province\Eloquent\ProvinceRepository;
use App\Repositories\Province\Interfaces\ProvinceInterface;
use App\Repositories\Setting\Caches\SettingCacheDecorator;
use App\Repositories\Setting\Eloquent\SettingRepository;
use App\Repositories\Setting\Interfaces\SettingInterface;
use App\Repositories\Student\Caches\StudentCacheDecorator;
use App\Repositories\Student\Caches\StudentInformationCacheDecorator;
use App\Repositories\Student\Eloquent\StudentImageRepository;
use App\Repositories\Student\Eloquent\StudentInformationRepository;
use App\Repositories\Student\Eloquent\StudentRepository;
use App\Repositories\Student\Interfaces\StudentImageInterface;
use App\Repositories\Student\Interfaces\StudentInformationInterface;
use App\Repositories\Student\Interfaces\StudentInterface;

use App\Repositories\Mentor\Caches\MentorCacheDecorator;
use App\Repositories\Mentor\Caches\MentorInformationCacheDecorator;
use App\Repositories\Mentor\Eloquent\MentorRepository;
use App\Repositories\Mentor\Eloquent\MentorInformationRepository;
use App\Repositories\Mentor\Interfaces\MentorInterface;
use App\Repositories\Mentor\Interfaces\MentorInformationInterface;

use App\Repositories\User\Caches\RoleCacheDecorator;
use App\Repositories\User\Eloquent\ActivationRepository;
use App\Repositories\User\Eloquent\RoleRepository;
use App\Repositories\User\Eloquent\UserRepository;
use App\Repositories\User\Interfaces\ActivationInterface;
use App\Repositories\User\Interfaces\RoleInterface;
use App\Repositories\User\Interfaces\UserInterface;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\ResourceRegistrar;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ResourceRegistrar::class, function ($app) {
            return new CustomResourceRegistrar($app['router']);
        });
        $router = $this->app['router'];

        $router->pushMiddlewareToGroup('web', HttpsProtocolMiddleware::class);

        $router->aliasMiddleware('student', RedirectIfNotMember::class);
        $router->aliasMiddleware('student.guest', RedirectIfMember::class);

        $router->aliasMiddleware('mentor', RedirectIfNotMentor::class);
        $router->aliasMiddleware('mentor.guest', RedirectIfMentor::class);

        $router->aliasMiddleware('admin', Authenticate::class);
        $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);

        AliasLoader::getInstance()->alias('MailVariable', MailVariableFacade::class);
        AliasLoader::getInstance()->alias('BaseHelper', BaseHelperFacade::class);
        AliasLoader::getInstance()->alias('AuditLog', AuditLogFacade::class);


        $this->app->bind(SettingInterface::class, function () {
            return new SettingCacheDecorator(new SettingRepository(new Setting));
        });

        $this->app->bind(UserInterface::class, function () {
            return new UserRepository(new User);
        });
        $this->app->bind(UserInterface::class, function () {
            return new UserRepository(new User);
        });
        $this->app->bind(ActivationInterface::class, function () {
            return new ActivationRepository(new Activation);
        });

        $this->app->bind(RoleInterface::class, function () {
            return new RoleCacheDecorator(new RoleRepository(new Role));
        });

        $this->app->bind(AuditHistoryInterface::class, function () {
            return new AuditHistoryCacheDecorator(new AuditHistoryRepository(new AuditHistory));
        });

        $this->app->bind(ProvinceInterface::class, function () {
            return new ProvinceCacheDecorator(
                new ProvinceRepository(
                    new Province
                )
            );
        });

        $this->app->bind(StudentInterface::class, function () {
            return new StudentCacheDecorator(
                new StudentRepository(
                    new Student
                )
            );
        });

        $this->app->bind(StudentImageInterface::class, function () {
            return new StudentImageRepository(new StudentImage);
        });

        $this->app->bind(StudentInformationInterface::class, function () {
            return new StudentInformationCacheDecorator(
                new StudentInformationRepository(
                    new StudentInformation
                )
            );
        });
        //mentor
        $this->app->bind(MentorInterface::class, function () {
            return new MentorCacheDecorator(
                new MentorRepository(
                    new Mentor
                )
            );
        });
        $this->app->bind(MentorInformationInterface::class, function () {
            return new MentorInformationCacheDecorator(
                new MentorInformationRepository(
                    new MentorInformation
                )
            );
        });
        //
        Helper::autoload(__DIR__ . '/../Helpers');

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $config = $this->app->make('config');
        $this->app->booted(function () use ($config) {
            $timezone = $config->get('app.timezone');
            $locale = $config->get('general.locale', $config->get('app.locale'));

            $config->set([
                'app.locale'   => $locale,
                'app.timezone' => $timezone,
            ]);
            $this->app->setLocale($locale);
        });
    }
}
