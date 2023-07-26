<?php

namespace App\Providers;

use App\Macros\StrMixins;
use App\Repositories\AccountRepositoryInterface;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\HotelRepositoryInterface;
use App\Repositories\Impl\AccountRepository;
use App\Repositories\Impl\BaseRepository;
use App\Repositories\Impl\CourseRepository;
use App\Repositories\Impl\HotelRepository;
use App\Repositories\Impl\QuestionRepository;
use App\Repositories\Impl\TopicRepository;
use App\Repositories\QuestionRepositoryInterface;
use App\Repositories\TopicRepositoryInterface;
use App\Services\AccountSettingService;
use App\Repositories\Impl\TransmissionLogRepository;
use App\Repositories\TransmissionLogRepositoryInterface;
use App\Services\BaseService;
use App\Services\CourseService;
use App\Services\HotelService;
use App\Services\Impl\AccountSettingServiceImpl;
use App\Services\Impl\BaseServiceImpl;
use App\Services\Impl\CourseServiceImpl;
use App\Services\Impl\HotelServiceImpl;
use App\Services\Impl\QuestionServiceImpl;
use App\Services\Impl\TopicServiceImpl;
use App\Services\Impl\TransmissionLogServiceImpl;
use App\Services\QuestionService;
use App\Services\TopicService;
use App\Services\TransmissionLogService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindings($this->registerRepositories());
        $this->bindings($this->registerServices());
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindingMacros($this->registerMacros());
    }

    /**
     * Register services for binding
     *
     * @return string[]
     */
    private function registerServices(): array
    {
        return [
            BaseService::class => BaseServiceImpl::class,
            AccountSettingService::class => AccountSettingServiceImpl::class,
            HotelService::class => HotelServiceImpl::class,
            TransmissionLogService::class => TransmissionLogServiceImpl::class,
            QuestionService::class => QuestionServiceImpl::class,
            CourseService::class => CourseServiceImpl::class,
            TopicService::class => TopicServiceImpl::class,
        ];
    }

    /**
     * Register repositories for binding
     *
     * @return string[]
     */
    private function registerRepositories(): array
    {
        return [
            BaseRepositoryInterface::class => BaseRepository::class,
            AccountRepositoryInterface::class => AccountRepository::class,
            HotelRepositoryInterface::class => HotelRepository::class,
            TransmissionLogRepositoryInterface::class => TransmissionLogRepository::class,
            TopicRepositoryInterface::class => TopicRepository::class,
        ];
    }

    /**
     * Loop all register to binding
     *
     * @param array $classes
     */
    private function bindings(array $classes)
    {
        foreach ($classes as $interface => $implement) {
            $this->app->bind($interface, $implement);
        }
    }

    private function registerMacros(): array
    {
        return [
            Str::class => [StrMixins::class]
        ];
    }

    /**
     * Binding macros' helper utils
     * @param array $classes
     */
    private function bindingMacros(array $classes)
    {
        foreach ($classes as $interface => $implements) {
            $interfaceClass = app($interface);
            foreach ($implements as $implementClass) {
                $interfaceClass::mixin(new $implementClass());
            }
        }
    }
}
