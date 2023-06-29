<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class NotesController extends ResourceController
{
    protected $modelName = 'App\Models\Notes';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'message' => 'success',
            'data_notes' => $this->model->orderBy('id', 'DESC')->findALl()
        ];

        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = [
            'message' => 'success',
            'notes_byid' => $this->model->find($id)
        ];

        if ($data['notes_byid'] == null) {
            return $this->failNotFound('Data catatan tidak ditemukan');
        }

        return $this->respond($data, 200);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $rules = $this->validate(
            [
                'title'     => 'required',
                'content'   => 'required',
            ]
        );

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->model->insert([
            'title' => esc($this->request->getVar('title')),
            'content' => esc($this->request->getVar('content')),
        ]);

        $response = [
            'message' => 'Data catatan berhasil ditambahkan'
        ];

        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        $rules = $this->validate(
            [

                'title'      => 'required',
                'content'   => 'required',
            ]
        );

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->model->update($id, [
            'title' => esc($this->request->getVar('title')),
            'content' => esc($this->request->getVar('content')),
        ]);

        $response = [
            'message' => 'Data catatan berhasil diubah'
        ];

        return $this->respondCreated($response, 200);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);

        $response = [
            'message' => 'Data catatan berhasil dihapus'
        ];

        return $this->respondDeleted($response, 200);
    }
}