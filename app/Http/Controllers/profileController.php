<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class profileController extends Controller
{

    public function index($encryptedId)
    {
        $id = decrypt($encryptedId);
        $profile = User::findOrFail($id);
        return view('pages.profile.index', compact('profile'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:10', 'unique:users,nip,' . $id],
            'no_hp' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'lowercase', 'email:dns', 'max:255', 'unique:users,email,' . $id],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],


        ]);

        $profile = User::findOrFail($id);
        $dataId = $profile->find($profile->id);
        $data = $request->all();
        if ($request->image) {
            Storage::delete('public/' . $dataId->image);
            $data['image'] = $request->file('image')->store('asset/profile', 'public');
        }

        $dataId->update($data);

        if ($dataId) {
            toast('Data berhasil diupdate', 'success');
        } else {
            toast('Data Gagal Diupdate', 'error');
        }
        return redirect()->route('profile.index', encrypt(auth()->user()->id));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'min:6', 'confirmed', 'string'],
        ]);

        $user = auth()->user();
        $current_password = $request->input('current_password');

        if (password_verify($current_password, $user->password)) {
            $user->update([
                'password' => password_hash($request->input('password'), PASSWORD_DEFAULT)
            ]);
            toast('Password berhasil diupdate', 'success');
        } else {
            toast('Password saat ini tidak sesuai', 'error');
        }

        return redirect()->route('profile.index', encrypt(auth()->user()->id));
    }
}
