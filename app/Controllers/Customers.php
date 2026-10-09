<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    protected CustomerModel $customers;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->customers = new CustomerModel();
    }

    public function index()
    {
        return view('customers/index', [
            'title' => 'Customer Accounts',
            'customers' => $this->customers->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function createForm()
    {
        return view('customers/form', [
            'title' => 'Add customer',
            'customer' => null,
            'editing' => false,
            'action' => site_url('customers'),
        ]);
    }

    public function create()
    {
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->customers->insert([
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')) ?: null,
            'created_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('customers'))->with('message', 'Customer account created.');
    }

    public function edit(int $id)
    {
        $customer = $this->customers->find($id);
        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound('Customer not found.');
        }

        return view('customers/form', [
            'title' => 'Edit customer',
            'customer' => $customer,
            'editing' => true,
            'action' => site_url('customers/' . $id),
        ]);
    }

    public function update(int $id)
    {
        if ($this->customers->find($id) === null) {
            throw PageNotFoundException::forPageNotFound('Customer not found.');
        }

        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->customers->update($id, [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'phone'     => trim((string) $this->request->getPost('phone')) ?: null,
        ]);

        return redirect()->to(site_url('customers'))->with('message', 'Customer account updated.');
    }
}
