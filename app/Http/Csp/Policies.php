<?php

namespace App\Http\Csp;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Basic;

class Policies extends Basic
{
    public function configure()
    {
        parent::configure();

        return $this
        	->addDirective(Directive::FONT, 'fonts.gstatic.com')
            ->addDirective(Directive::SCRIPT, 'fonts.googleapis.com')
            ->addDirective(Directive::STYLE, 'fonts.googleapis.com')
            ->addDirective(Directive::SCRIPT, '*.google-analytics.com')
            ->addDirective(Directive::SCRIPT, '*.googletagmanager.com')
            ->addDirective(Directive::SCRIPT, '*.stripe.com');     
    }
}
