<?php

namespace Censam\LaraScaffold\Generators\HomePageGenerator;

use Censam\LaraScaffold\Filesystem\Filesystem;

class HomePageGenerator extends Filesystem
{
    private $Parse;

    public function __construct($Parse)
    {
        $this->Parse = $Parse;
    }

    private function Generate()
    {
        $Parse = $this->Parse;

        return view('lara-scaffold::template.HomePage.HomePage', compact('Parse'))->render();
    }

    public function Burn()
    {
        $this->make(base_path() . '/resources/views/HomePageScaffold.blade.php', $this->Generate());
    }

}
