<namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function create() {
        return view('kelas.create');
    }

    public function store(Request $request) {
        Kelas::create([
            'nama_kelas' => $request->nama_kelas
        ]);
        return redirect('/absensi')->with('success', 'Kelas baru berhasil dibuat');
    }
}
