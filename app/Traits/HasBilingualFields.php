<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait HasBilingualFields
{
    /**
     * Resolve a bilingual field: returns the Arabic value if the current locale is 'ar'
     * and the Arabic value is present; otherwise falls back to the default/English value.
     * When inside the admin dashboard or API admin, it returns the raw value to keep forms clean.
     */
    protected function getBilingualValue(string $field, $default = null)
    {
        if (request() && (request()->is('admin*') || request()->is('api/admin*'))) {
            return $this->attributes[$field] ?? $default;
        }

        if (App::getLocale() === 'ar') {
            $arField = $field . '_ar';
            if (!empty($this->attributes[$arField])) {
                return $this->attributes[$arField];
            }
        }

        return $this->attributes[$field] ?? $default;
    }
}

