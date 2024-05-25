namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    // アップロードフォームを表示するメソッド
    public function showUploadForm()
    {
        return view('upload');
    }

    // ファイルを処理するメソッド
    public function uploadFile(Request $request)
    {
        // バリデーション
        <!-- $request->validate([
            'file' => 'required|file|mimes:jpg,png,jpeg,gif|max:2048',
        ]); -->
        dd($request->file('file'));
        // ファイルのアップロード
        if ($request->file('file')) {
            $file = $request->file('file');
            dd($file);
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            // 必要に応じてデータベースにファイルパスを保存
            // Example: File::create(['name' => $fileName, 'path' => '/storage/' . $filePath]);

            return back()->with('success', 'ファイルがアップロードされました。')->with('file', $fileName);
        }

        return back()->with('error', 'ファイルのアップロードに失敗しました。');
    }
}

