namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class {{$names->TableName()}}Controller
 *
 * @author The lara-scaffold created at {{date("Y-m-d h:i:sa")}}
 * @link https://github.com/censam/lara-scaffold
 */
class {{$names->TableName()}} extends Model
{

    public $timestamps = false;

    protected $table = '{{$names->TableNames()}}';

	@foreach($foreignKeys as $key)

	public function {{lcfirst(str_singular($key))}}()
	{
		return $this->belongsTo('App\{{ucfirst(str_singular($key))}}');
	}

	@endforeach

}
