<?php
namespace Censam\LaraScaffold\Generators;

use Censam\LaraScaffold\DataSystem\DataSystem;
use Censam\LaraScaffold\Generators\NamesGenerate;

/**
 * Class ViewGenerate
 *
 * @package lara-scaffold/Generators
 * @author Sampath Gunasekara <wgsampath@gmail.com>
 */
class ViewGenerate
{
    /**
     * The DataSystem instance
     *
     * @var $dataSystem
     */
    public $dataSystem;

    /**
     * @var NamesGenerate
     */
    public $names;

    /**
     * Create new ViewGenerate instance
     *
     * @param $data Array
     * @param NamesGenerate
     */
    public function __construct(DataSystem $dataSystem, NamesGenerate $names)
    {   
        // dd($dataSystem);
        $this->dataSystem = $dataSystem;
        $this->names = $names;
    }

    /**
     * compile index view
     *
     * @return String
     */
    public function GenerateIndex()
    {

        $names = $this->names;
        $dataSystem = $this->dataSystem;

        return view('lara-scaffold::template.views.index', compact('names', 'dataSystem'))->render();
    }

    /**
     * compile create view
     *
     * @return String
     */
    public function GenerateCreate()
    {

        $names = $this->names;
        $dataSystem = $this->dataSystem;

        return view('lara-scaffold::template.views.create', compact('names', 'dataSystem'))->render();
    }

    /**
     * compile show view
     *
     * @return String
     */
    public function GenerateShow()
    {

        $names = $this->names;
        $dataSystem = $this->dataSystem;

        return view('lara-scaffold::template.views.show', compact('names', 'dataSystem'))->render();
    }

    /**
     * compile edit view
     *
     * @return String
     */
    public function GenerateEdit()
    {

        $names = $this->names;
        $dataSystem = $this->dataSystem;

        return view('lara-scaffold::template.views.edit', compact('names', 'dataSystem'))->render();
    }
}
