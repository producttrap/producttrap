<?php

namespace ProductTrap\Contracts;

interface RequiresBrowser
{
    public function setBrowser(BrowserDriver $browser): self;
}
