<?php

namespace FloBen\AnatomEasyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FloBenAnatomEasyBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
