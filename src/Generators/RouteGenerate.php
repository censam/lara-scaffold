<?php
namespace Censam\LaraScaffold\Generators;

use Censam\LaraScaffold\Generators\NamesGenerate;

/**
 * Class RouteGenerate
 *
 * @package lara-scaffold/Generators
 * @author Amrani Houssian <wgsampath@gmailcom>
 */
class RouteGenerate
{
    /**
     * @var NamesGenerate
     */
    public $names;


    /**
     * Create new RouteGenerate instance
     *
     * @param NamesGenerate
     */
    public function __construct(NamesGenerate $names)
    {
        $this->names = $names;
    }

    /**
     * Compile route template
     *
     * @return String
     */
    public function generate()
    {

        $names = $this->names;
        return "\n" . view('lara-scaffold::template.routes', compact('names'))->render();

    }

}
