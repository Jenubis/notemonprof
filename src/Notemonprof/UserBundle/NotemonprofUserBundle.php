<?php

namespace Notemonprof\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NotemonprofUserBundle extends Bundle
{
    function getParent(){
        return 'FOSUserBundle';
    }
}
