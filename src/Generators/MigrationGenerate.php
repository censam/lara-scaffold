<?php
namespace Censam\LaraScaffold\Generators;

use Censam\LaraScaffold\DataSystem\DataSystem;
use Censam\LaraScaffold\Generators\NamesGenerate;

/**
 * Class MigrationGenerate
 *
 * @package lara-scaffold/Generators
 * @author Amrani Houssian <wgsampath@gmail.com>
 */
class MigrationGenerate
{

    /**
     * DataSystem instance
     *
     * @var $dataSystem
     */
    public $dataSystem;

    /**
     * NamesGenerate instance
     *
     * @var NamesGenerate
     */
    public $names;

    /**
     * Create New MigrationGenerate instance
     *
     * @param DataSystem
     * @param NamesGenerate
     */
    public function __construct(DataSystem $dataSystem, NamesGenerate $names)
    {

        $this->dataSystem = $dataSystem;
        $this->names = $names;

    }

    /**
     * fetch migration template
     *
     * @return String
     */
    public function generate()
    {

        $names = $this->names;
        $dataSystem = $this->dataSystem;

        return "<?php\n" . view('lara-scaffold::template.migration.migration', compact('dataSystem', 'names'))->render();
    }

}
