<?php

namespace App\Ua;

class MobileDetect
{
    protected string $userAgent;

    public function __construct()
    {
        $this->userAgent = request()->userAgent() ?? '';
    }

    public function isMobile(): bool
    {
        return (bool) preg_match(
            '/(android|iphone|ipad|ipod|blackberry|windows phone|opera mini|mobile)/i',
            $this->userAgent
        );
    }

    public function isTablet(): bool
    {
        return (bool) preg_match('/(ipad|tablet|kindle|playbook|silk)/i', $this->userAgent);
    }

    public function isDesktop(): bool
    {
        return !$this->isMobile() && !$this->isTablet();
    }
}
