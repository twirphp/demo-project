<?php

namespace Twirp\Demo;

use Twirp\Example\Haberdasher\Hat;
use Twirp\Example\Haberdasher\Size;

final class Haberdasher implements \Twirp\Example\Haberdasher\Haberdasher
{
    private $colors = ['golden', 'black', 'brown', 'blue', 'white', 'red'];

    private $hats = ['crown', 'baseball cap', 'fedora', 'flat cap', 'panama', 'helmet'];

    public function MakeHat(array $ctx, Size $size): Hat
    {
        $hat = new Hat();
        $hat->setInches($size->getInches());
        $hat->setColor($this->colors[array_rand($this->colors, 1)]);
        $hat->setName($this->hats[array_rand($this->hats, 1)]);

        return $hat;
    }
}
