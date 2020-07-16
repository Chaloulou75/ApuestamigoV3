<?php

namespace App\Services\Csp\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class Extended extends Basic
{
    public function configure()
    {
        parent::configure();
        
        $this
        	->addDirectivesForGoogleFonts()
        	->addDirectivesForStripe()
            ->addDirectivesForGoogleAnalytics()
            ->addDirectivesForGoogleTagManager()
            ->addDirective(Directive::IMG, ['*'])
            ->addDirective(Directive::SCRIPT, 'self')
	        ->addDirective(Directive::STYLE, 'self')
	        ->addNonceForDirective(Directive::SCRIPT)
	        ->addNonceForDirective(Directive::STYLE);
    }

    protected function addDirectivesForGoogleFonts(): self
    {
        return $this
            ->addDirective(Directive::FONT, 'fonts.gstatic.com')
            ->addDirective(Directive::SCRIPT, 'fonts.googleapis.com')
            ->addDirective(Directive::STYLE, 'fonts.googleapis.com');
    }

    protected function addDirectivesForGoogleAnalytics(): self
    {
        return $this->addDirective(Directive::SCRIPT, '*.google-analytics.com');
    }

    protected function addDirectivesForStripe(): self
    {
        return $this->addDirective(Directive::SCRIPT, '*.stripe.com')
        			->addDirective(Directive::FRAME, '*.stripe.com');
    }

    protected function addDirectivesForGoogleTagManager(): self
    {
        return $this->addDirective(Directive::SCRIPT, '*.googletagmanager.com');
    }
}
