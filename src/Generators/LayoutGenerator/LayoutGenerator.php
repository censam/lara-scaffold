<?php

namespace Censam\LaraScaffold\Generators\LayoutGenerator;

use Censam\LaraScaffold\Filesystem\Filesystem;
use Censam\LaraScaffold\Generators\NamesGenerate;

class LayoutGenerator extends Filesystem
{
    private $Parse;

    public function __construct($Parse)
    {
        $this->Parse = $Parse;
        $this->names = new NamesGenerate($this->Parse);
    }

    private function Generate()
    {
         $Parse = $this->Parse;
         $names = $this->names;
         return view('lara-scaffold::template.Layout.Layout',compact('Parse','names'))->render();
    }

    public function Burn()
    {   
         try
        {    
             $this->make(base_path() . '/resources/views/Layout.blade.php', $this->Generate());

        } catch (\Exception $e) {
               
              unlink(base_path() . '/resources/views/Layout.blade.php');
              return $this->Burn();
        }
    }

}
