<?php
namespace Censam\LaraScaffold\Http\Controllers;

use Censam\LaraAjax\LaraAjax;
use Censam\LaraScaffold\AutoArray;
use Censam\LaraScaffold\Generators\HomePageGenerator\HomePageGenerator;
use Illuminate\Database\Schema\Blueprint;
use Censam\LaraScaffold\Generators\LayoutGenerator\LayoutGenerator;
use Censam\LaraScaffold\Scaffold;
use Censam\LaraScaffold\LaraScaffold;
use Censam\LaraScaffold\Generators\NamesGenerate;
use AppController;
use Illuminate\Support\Facades\Artisan;
use Request;
use Session;
use URL;
use File;
use Directory;
use DB;
use Schema;
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

          try
        {
           $scaffold = LaraScaffold::paginate(6);
           $scaffold = LaraScaffold::paginate(6);
           $scaffoldList = LaraScaffold::all()->lists('id', 'tablename');
           return view('lara-scaffold::scaffoldApp', compact('scaffold', 'scaffoldList'));

        } catch (\Exception $e) {

            return $this->freshsite();
        }

       

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

        $laraScaffold = new LaraScaffold();

        $laraScaffold->migration = $scaffold->paths->MigrationPath();
        $laraScaffold->model = $scaffold->paths->ModelPath();
        $laraScaffold->controller = $scaffold->paths->ControllerPath();
        $laraScaffold->views = $scaffold->paths->DirPath();
        $laraScaffold->tablename = $scaffold->names->TableNames();

        $laraScaffold->save();

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
        $laraScaffold = LaraScaffold::FindOrFail($id);

        unlink($laraScaffold->model);
        unlink($laraScaffold->controller);
        unlink($laraScaffold->views . '/index.blade.php');
        unlink($laraScaffold->views . '/create.blade.php');
        unlink($laraScaffold->views . '/show.blade.php');
        unlink($laraScaffold->views . '/edit.blade.php');
        unlink($laraScaffold->migration);
        rmdir($laraScaffold->views);

        $laraScaffold->delete();

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

            return "Lara-Scaffold : " . $e->getMessage();
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
     * @throws Exception
     */
    public function rollback()
    {
        try {
            
            if(!LaraScaffold::all()->count()){
                throw new \Exception("Nothing to rollback");
            }
            $exitCode = Artisan::call('migrate:rollback');

        } catch (Exception $e) {

            return $e->getMessage();
        }

        Session::flash('status', Artisan::output());

        return redirect('scaffold');
    }


    public function layout()
    {
         try {
            
            if(!LaraScaffold::all()->count()){
                throw new \Exception("Nothing to rollback");
            }
           
            $scaffoldList = LaraScaffold::all();
        
        $layout = new LayoutGenerator($scaffoldList);

        $layout->Burn();
        

        Session::flash('status', 'Layout Generated Successfully');

        return redirect('scaffold');

        } catch (Exception $e) {
            return $e->getMessage();
        }

       
        
    }

    public function freshsite()
    {

        $exitCode = $this->migrate();
        //  try {
            
        //     if(!LaraScaffold::all()->count()){
        //         throw new \Exception("Nothing to rollback");
        //     }
        //     $scaffoldList = LaraScaffold::all();
        //     foreach ($scaffoldList as $key => $scaffold) {
           
        //     File::delete($scaffold->migration);
        //     File::delete($scaffold->model);
        //     File::delete($scaffold->controller);
        //     File::deleteDirectory($scaffold->views);
        //     // Schema::drop($scaffold->tablename);
        //     }

        //     // Schema::drop('lara_scaffolds');
        //     DB::table('migrations')->truncate();
            

             

        // } catch (Exception $e) {

        //     return $e->getMessage();
        // }

        // Session::flash('status', Artisan::output());

        return redirect('scaffold');
    }

}
