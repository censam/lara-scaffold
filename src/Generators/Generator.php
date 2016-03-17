<?php
namespace Censam\LaraScaffold\Generators;

use Censam\LaraScaffold\DataSystem\DataSystem;
use Censam\LaraScaffold\Filesystem\Filesystem;
use Censam\LaraScaffold\Filesystem\Paths;
use Censam\LaraScaffold\Generators\ControllerGenerate;
use Censam\LaraScaffold\Generators\MigrationGenerate;
use Censam\LaraScaffold\Generators\ModelGenerate;
use Censam\LaraScaffold\Generators\NamesGenerate;
use Censam\LaraScaffold\Generators\RouteGenerate;
use Censam\LaraScaffold\Generators\ViewGenerate;

/**
 * Class     Generator
 *
 * @package  lara-scaffold/Generators
 * @author   Sampath Gunasekara <wgsampath@gmail.com>
 */
class Generator extends Filesystem
{

    /**
     * the DataSystem instance
     *
     * @var dataSystem
     */
    public $dataSystem;

    /**
     * @var ViewGenerate
     */
    public $view;

    /**
     * @var ModelGenerate
     */
    public $model;

    /**
     * @var MigrationGenerate
     */
    public $migration;

    /**
     * @var ControllerGenerate
     */
    public $controller;

    /**
     * @var RouteGenerate
     */
    public $route;

    /**
     * Create new Generator instance
     *
     * @param DataSystem $dataSystem
     * @param NamesGenerate
     * @param PathsGenerate
     */
    public function __construct(DataSystem $dataSystem, NamesGenerate $names, Paths $paths)
    {
    dd($names);
        $this->dataSystem = $dataSystem;
        $this->view = new ViewGenerate($dataSystem, $names);
        $this->model = new ModelGenerate($names, $dataSystem);
        $this->migration = new MigrationGenerate($dataSystem, $names);
        $this->controller = new ControllerGenerate($names, $dataSystem);
        $this->route = new RouteGenerate($names);
        $this->paths = $paths;
    }

    /**
     * Generate index
     */
    public function index()
    {
        $this->make($this->paths->IndexPath(), $this->view->GenerateIndex());
    }

    /**
     * Generate create
     */
    public function create()
    {
        $this->make($this->paths->CreatePath(), $this->view->GenerateCreate());
    }

    /**
     * Generate show
     */
    public function show()
    {
        $this->make($this->paths->ShowPath(), $this->view->GenerateShow());
    }

    /**
     * Generate edit
     */
    public function edit()
    {
        $this->make($this->paths->EditPath(), $this->view->GenerateEdit());
    }

    /**
     * Generate views directory
     */
    public function dir()
    {
        $this->makeDir($this->paths->DirPath());
    }

    /**
     * Generate Model
     */
    public function model()
    {
        $this->make($this->paths->ModelPath(), $this->model->generate());
    }

    /**
     * Generate Migration
     */
    public function migration()
    {
        $this->make($this->paths->MigrationPath(), $this->migration->generate());
    }

    /**
     * Generate Controller
     */
    public function controller()
    {
        $this->make($this->paths->ControllerPath(), $this->controller->generate());
    }

    /**
     * Generate route
     */
    public function route()
    {
        $this->append($this->paths->RoutePath(), $this->route->generate());
    }
}
