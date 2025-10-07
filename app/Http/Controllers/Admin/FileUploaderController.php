<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FileUploaderController extends Controller
{
    // List all files
    public function index()
    {
        $files = FileUploader::where('user_id', Auth::id())->get();
        return view('admin.fille-uploader.index', compact('files'));
    }

    // Store file
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048', // 2MB max
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        $upload = FileUploader::create([
            'filename' => $file->getClientOriginalName(),
            'filepath' => $path,
            'mimetype' => $file->getClientMimeType(),
            'size'     => $file->getSize(),
            'user_id' => Auth::id(),
            'assign_to' => 0,
        ]);

        Session::flash('success', 'File Upload successfully!');
        return "success";
    }

    // Show single file
    public function show($id)
    {
        $file = FileUploader::findOrFail($id);
        return response()->json($file);
    }

    // Update (replace file)
    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        $upload = FileUploader::findOrFail($id);

        // Delete old file
        if ($upload->filepath && Storage::disk('public')->exists($upload->filepath)) {
            Storage::disk('public')->delete($upload->filepath);
        }

        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        $upload->update([
            'filename' => $file->getClientOriginalName(),
            'filepath' => $path,
            'mimetype' => $file->getClientMimeType(),
            'size'     => $file->getSize(),
        ]);

        return response()->json([
            'message' => 'File updated successfully',
            'data' => $upload,
        ]);
    }

    // Delete file
    public function destroy($id)
    {
        $upload = FileUploader::findOrFail($id);

        if ($upload->filepath && Storage::disk('public')->exists($upload->filepath)) {
            Storage::disk('public')->delete($upload->filepath);
        }

        $upload->delete();

        Session::flash('success', 'File deleted successfully!');
        return back();
    }
}
