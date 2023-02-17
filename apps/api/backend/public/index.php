<?php

use App\Apps\Api\Backend\ApiBackendKernel;

require_once dirname(__DIR__).'/../../../vendor/autoload_runtime.php';

return function (array $context) {
    return new ApiBackendKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
