<?php
namespace Censam\LaraScaffold\Generators;

use Censam\LaraScaffold\DataSystem\DataSystem;
use Censam\LaraScaffold\Generators\NamesGenerate;

/**
 * Class ControllerGenerate
 *
 * @package lara-scaffold
 * @author Sampath Gunasekara <wgsampath@gmail.com>
 */
class ControllerGenerate
{

    /**
     * DataSystem Instance
     *
     * @var dataSystem
     */
    public $dataSystem;

    /**
     * @var NamesGenerate
     */
    public $names;

    /**
     * Create new ControllerGenerate instance
     *
     * @param $dataS Array
     * @param NamesGenerate
     */
    public function __construct(NamesGenerate $names, DataSystem $dataSystem)
    {
        $this->dataSystem = $dataSystem;
        $this->names = $names;
    }

    /**
     * compile controller tamplate
     *
     * @return String
     */
    public function generate()
    {

        $names = $this->names;
        $dataSystem = $this->dataSystem;

        return "<?php\n" . view('lara-scaffold::template.controller.controller', compact('names', 'dataSystem'))->render();

    }

}
