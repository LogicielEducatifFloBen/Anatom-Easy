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

//TODO suivre un éleve => adapter le niveau de l'exercice
// avatar
// puzzle
// page exercice + validation du devoir
