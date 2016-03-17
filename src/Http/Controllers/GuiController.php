<?php
namespace Censam\LaraScaffold\Http\Controllers;

use Censam\LaraAjax\LaraAjax;
use Censam\LaraScaffold\AutoArray;
use Censam\LaraScaffold\Generators\HomePageGenerator\HomePageGenerator;
use Censam\LaraScaffold\Scaffold;
use Censam\LaraScaffold\LaraScaffold;
use AppController;
use Illuminate\Support\Facades\Artisan;
use Request;
use Session;
use URL;

/**
 * Class GuiController
 *
 * @package lara-scaffold/Http/Controllers
 * @author  Sampath Gunasekara <wgsampath@gmail.com>
 *
 * @todo Testing
 */
class GuiController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $scaffold = LaraScaffold::paginate(6);
        $scaffoldList = LaraScaffold::all()->lists('id', 'tablename');

        return view('lara-scaffold::scaffoldApp', compact('scaffold', 'scaffoldList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Request::except('_token');

        $scaffold = new Scaffold($data);

        $scaffold->Migration()->Model()->Views()->Controller()->Route();

        $scaffoldInterface = new LaraScaffold();

        $scaffoldInterface->migration = $scaffold->paths->MigrationPath();
        $scaffoldInterface->model = $scaffold->paths->ModelPath();
        $scaffoldInterface->controller = $scaffold->paths->ControllerPath();
        $scaffoldInterface->views = $scaffold->paths->DirPath();
        $scaffoldInterface->tablename = $scaffold->names->TableNames();

        $scaffoldInterface->save();

        Session::flash('status', ' Successfully created ' . $scaffold->names->TableName() . '. To complete your scaffold. go ahead and migrate the schema.');

        return redirect('scaffold');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scaffoldInterface = LaraScaffold::FindOrFail($id);

        unlink($scaffoldInterface->model);
        unlink($scaffoldInterface->controller);
        unlink($scaffoldInterface->views . '/index.blade.php');
        unlink($scaffoldInterface->views . '/create.blade.php');
        unlink($scaffoldInterface->views . '/show.blade.php');
        unlink($scaffoldInterface->views . '/edit.blade.php');
        unlink($scaffoldInterface->migration);
        rmdir($scaffoldInterface->views);

        $scaffoldInterface->delete();

        Session::flash('status', 'Successfully deleted');

        return URL::to('scaffold');
    }

    /**
     * Delete confirmation message by LaraAjax
     *
     * @link https://github.com/censam/lara-ajax
     *
     * @return String
     */
    public function deleteMsg($id)
    {
        $scaffold = LaraScaffold::FindOrFail($id);

        $msg = LaraAjax::Mtdeleting("Warning!!", "Would you like to rollback '" . $scaffold->tablename . "' ?? by rollbacking this, make sure that you have rollbacked " . $scaffold->tablename . " from database. and avoid to keep routes recoureces.", '/scaffold/guirollback/' . $id);

        if (Request::ajax()) {

            return $msg;
        }
    }

    /**
     * get Attributes from
     *
     * @param String $table
     *
     * @return Array
     */
    public function GetResult($table)
    {
        $attributes = new AutoArray($table);

        if (Request::ajax()) {

            return $attributes->getResult();
        }
    }

    /**
     * Generate Home Page for app
     *
     * @return \Illuminate\Http\Response
     */
    public function homePage()
    {
        $scaffoldList = LaraScaffold::all();

        $home = new HomePageGenerator($scaffoldList);

        $home->Burn();

        Session::flash('status', 'Home Page Generated Successfully');

        return redirect('scaffold/scaffoldHomePageIndex');
    }

    /**
     * get index page for the app
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('HomePageScaffold');
    }

    /**
     * delete index page
     *
     * @return \Illuminate\Http\Response
     */
    public function homePageDelete()
    {
        try
        {
            unlink(base_path() . '/resources/views/HomePageScaffold.blade.php');

        } catch (\Exception $e) {

            return "Scaffold-Interface : " . $e->getMessage();
        }

        Session::flash('status', 'Home Page Successfully deleted');

        return redirect('scaffold');
    }

    /**
     * Migrate table ORM
     *
     * @return \Illuminate\Http\Response
     */
    public function migrate()
    {
        try {

            $exitCode = Artisan::call('migrate');

            exec('cd ' . base_path() . ' && composer dump-autoload');

        } catch (Exception $e) {

            return $e->getMessage();
        }

        Session::flash('status', Artisan::output());

        return redirect('scaffold');
    }

    /**
     * Rollback a table from database
     *
     * @return \Illuminate\Http\Response
     */
    public function rollback()
    {
        try {

            $exitCode = Artisan::call('migrate:rollback');

        } catch (Exception $e) {

            return $e->getMessage();
        }

        Session::flash('status', Artisan::output());

        return redirect('scaffold');
    }

}
