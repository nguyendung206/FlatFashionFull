<?php

namespace App\Http\Controllers;

use App\Models\Sizes;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function Index(Request $request)
    {
        if ($request->search !== null) {
            $data = Sizes::where('SizeName', 'like', '%' . $request->search . '%')->get();
        } else {
            $data = Sizes::all();
        }
        return view('admin.Size.Index', [
            'title' => 'Quản lý Size'
        ], compact('data'));
    }

    public function Create()
    {
        $size = new Sizes();
        $size->SizeId = 0;
        return view('admin.Size.Edit', [
            'title' => 'Thêm Size'
        ], compact('size'));
    }
    public function Edit($SizeId)
    {
        $size = Sizes::where('SizeId', $SizeId)->first();
        return view('admin.Size.Edit', [
            'title' => 'Cập nhật thông tin Size',
        ], compact('size'));
    }
    public function Save(Request $request)
    {
        if ($request->SizeId == 0) {
            $size = new Sizes();
            $size->SizeName = $request->SizeName;
            $size->SizeDescription = $request->SizeDescription;
            $size->save();
            return redirect('size')->with('message', 'Thêm Size thành công');
        } else {
            $size = Sizes::where('SizeId', $request->SizeId)->first();
            if ($size) {
                $size->SizeName = $request->SizeName;
                $size->SizeDescription = $request->SizeDescription;
                $size->save();
                return redirect('size')->with('message', 'Cập nhật thành công');
            }
        }
    }
    public function showDeleteForm($SizeId)
    {
        $size = Sizes::where('SizeId', $SizeId)->first();
        return view('admin.Size.Delete', [
            'title' => 'Xóa Size',
        ], compact('size'));
    }
    public function delete(Request $request, $SizeId)
    {
        $size = Sizes::find($SizeId);

        if (!$size) {
            return redirect()->back()->with('error', 'Không tìm thấy Size để xóa');
        }

        $size->delete();
        return redirect('size')->with('message', 'Xóa Size thành công');
    }
}