<?php

namespace App\View\Composers;

use App\Http\Services\Admin\Settings\ImpersonateService;
use Illuminate\View\View;

class ImpersonateComposer
{
    public function __construct(protected ImpersonateService $impersonateService)
    {
    }

    public function compose(View $view): void
    {
        $isImpersonating = $this->impersonateService->isImpersonating();
        
        $view->with('impersonate_data', [
            'is_impersonating'    => $isImpersonating,
            'impersonated_user'   => $isImpersonating ? $this->impersonateService->getImpersonatedUserData() : null,
            'impersonator_user'   => $isImpersonating ? $this->impersonateService->getImpersonatorUserData() : null,
        ]);
    }
}
