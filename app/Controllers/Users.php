<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Throwable;

class Users extends BaseController
{
    protected UserModel $users;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->users = new UserModel();
    }

    public function index()
    {
        return view('users/index', [
            'title' => 'User Accounts',
            'users' => $this->users->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function createForm()
    {
        return view('users/form', [
            'title' => 'Add user',
            'user' => null,
            'editing' => false,
            'action' => site_url('users'),
        ]);
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->users->insert([
            'username'   => trim((string) $this->request->getPost('username')),
            'full_name'  => trim((string) $this->request->getPost('full_name')),
            'avatar'     => null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('users'))->with('message', 'User account created.');
    }

    public function edit(int $id)
    {
        $user = $this->users->find($id);
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        return view('users/form', [
            'title' => 'Edit user',
            'user' => $user,
            'editing' => true,
            'action' => site_url('users/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $user = $this->users->find($id);
        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        $rules = [
            'username'  => 'required|max_length[50]|is_unique[users.username,id,' . $id . ']',
            'full_name' => 'required|max_length[100]',
        ];

        $avatar = $this->request->getFile('avatar');
        $hasAvatar = $avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        if ($hasAvatar) {
            $rules['avatar'] = 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]|max_size[avatar,2048]';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $newAvatar = null;
        $avatarDirectory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

        if ($hasAvatar) {
            if (! $avatar->isValid() || $avatar->hasMoved()) {
                return redirect()->back()->withInput()->with('errors', [
                    'avatar' => 'The image upload failed. Please choose a JPG or PNG under 2 MB.',
                ]);
            }

            $mime = $avatar->getMimeType();
            $extension = $mime === 'image/png' ? 'png' : 'jpg';
            $newAvatar = bin2hex(random_bytes(16)) . '.' . $extension;

            if (! is_dir($avatarDirectory) && ! mkdir($avatarDirectory, 0755, true) && ! is_dir($avatarDirectory)) {
                return redirect()->back()->withInput()->with('errors', [
                    'avatar' => 'The avatar folder is not writable. Please try again.',
                ]);
            }

            try {
                service('image')
                    ->withFile($avatar->getTempName())
                    ->fit(256, 256, 'center')
                    ->save($avatarDirectory . DIRECTORY_SEPARATOR . $newAvatar);
            } catch (Throwable $exception) {
                return redirect()->back()->withInput()->with('errors', [
                    'avatar' => 'The image could not be prepared. Please choose another JPG or PNG.',
                ]);
            }
        }

        $data = [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        if ($newAvatar !== null) {
            $data['avatar'] = $newAvatar;
        }

        if (! $this->users->update($id, $data)) {
            if ($newAvatar !== null && is_file($avatarDirectory . DIRECTORY_SEPARATOR . $newAvatar)) {
                unlink($avatarDirectory . DIRECTORY_SEPARATOR . $newAvatar);
            }
            return redirect()->back()->withInput()->with('errors', [
                'form' => 'The user could not be saved. Please try again.',
            ]);
        }

        if ($newAvatar !== null && ! empty($user['avatar'])) {
            $oldAvatar = $avatarDirectory . DIRECTORY_SEPARATOR . basename($user['avatar']);
            if (is_file($oldAvatar)) {
                unlink($oldAvatar);
            }
        }

        return redirect()->to(site_url('users'))->with('message', 'User account updated.');
    }
}
