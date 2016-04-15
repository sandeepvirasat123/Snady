<?php
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers(['scrubber' => 'ScrubberController']);

Route::get('hello', function () {
    return "Hello World!";
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('names', function()
{
    return array(
        1 => "John",
        2 => "Mary",
        3 => "Steven"
    );
});

Route::get('names/{id}', function($id)
{
    $names = array(
        1 => "John",
        2 => "Mary",
        3 => "Steven"
    );
    return array($id => $names[$id]);
});

Route::post('scrubb_old/{id}', function($id)
{
    //$type = "application/json";
    $content = '{"result":"success","id":"'.$id.'"}';
    //$status = 200;
    echo $content;
    //header('Content-Type', $type);
    //header('Access-Control-Allow-Origin: *');
    //header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    //return $content;
    //return (new Response($content, $status))
    //->header("Content-Type", $type)
    //->header("Access-Control-Allow-Credentials", "true")
    //->header("Access-Control-Allow-Origin", "*")
    //->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
    //;
});

Route::get('scrubb/{id}',  'ScrubberController@Index')->middleware(['token.auth']);

Route::post('scrubb/{id}', 'ScrubberController@Index')->middleware(['token.auth']);

Route::get('xml',['uses' => 'ScrubberController@xml']);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/* Route::group(['middleware' => ['web']], function () {cli_set_process_title()
    //
}); */

class baz{}

class bar{
    public $baz;
    public function __construct(Baz $baz) {
        $this->baz = $baz;
    }
};

Route::get('bar', function(Bar $bar) {
   //dd($bar);
    dd(App\Helpers\ScrubberInit);
});
