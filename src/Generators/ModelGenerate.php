<?php
namespace Censam\LaraScaffold\Generators;

use Censam\LaraScaffold\DataSystem\DataSystem;
use Censam\LaraScaffold\Generators\NamesGenerate;

/**
 * Class ModelGenerate
 *
 * @package lara-scaffold/Generators
 * @author Amrani Houssian <wgsampath@gmail.com>
 */
class ModelGenerate
{
    public $dataSystem;

    /**
     * @var NamesGenerate
     */
    public $names;

    /**
     * Create new ModelGenerate instance
     *
     * @param NameGenerate
     */
    public function __construct(NamesGenerate $names, DataSystem $dataSystem)
    {
        $this->names = $names;
        $this->dataSystem = $dataSystem;
    }

    /**
     * Compile Model template
     *
     * @return String
     */
    public function generate()
    {
        $names = $this->names;
        $foreignKeys = $this->dataSystem->foreignKeys;
        return "<?php\n" . view('lara-scaffold::template.model.model', compact('names', 'foreignKeys'))->render();
    }
}
