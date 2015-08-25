<?php

namespace SanMax\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SanMaxUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
