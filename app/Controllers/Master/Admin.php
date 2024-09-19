<?php

namespace App\Controllers\Master;

use App\Models\Master\Madmin;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Admin extends ResourceController
{
    protected $modelName = 'App\Models\Master\Madmin';
    protected $format    = 'json';

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index(): string
    {
        $this->view->setData(['menu_master' => 'active', 'submenu_admin' => 'active']);
        $this->data['menu'] = 'Master data admin';
        return view('master/admin/index', $this->data);
    }

    public function getData() {
        $param = $this->request->getPost();
        // return $this->respond($this->request->getPost());
        $data = $this->model->limit(intval($param['length'] ?? 10), intval($param['start'] ?? 0))->orderBy('username', 'asc');
        if (!empty($param['search']['value'])) {
            $data = $this->model->like('username', $param['search']['value']);
        }
        if (!empty($param['order'][0]['column'])) {
            $data = $this->model->orderBy($param['columns'][$param['order'][0]['column']]['data'], $param['order'][0]['dir']);
        }
        $filtered = $data->countAllResults(false);
        $datas = $data->find();
        $return = array(
            "draw" => $param['draw'] ?? 1,
            "recordsFiltered" => $filtered,
            "recordsTotal" => $this->model->countAllResults(),
            "data" => $datas
        );
        return isset($param['mobile']) ? $this->respond($return) : json_encode($return);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        try {
            $admin = $this->model->find($id);
            if (!$admin) {
                return $this->respond(['message' => 'User not found'], 404);
            }

            return $this->respond($admin);
        } catch (\Exception $e) {
            return $this->respond(['code' => $e->getCode(), 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        try {
            $data = $this->request->getPost('param');

            // Check if an image is uploaded
            $image = $this->request->getFile('image');
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $imageName = $image->getRandomName(); // Generate a random name for the image
                $image->move(WRITEPATH . 'uploads/admin', $imageName); // Move the image to the upload directory
                $data['image'] = $imageName;
            }

            // Hash the password before saving
            // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

            if (!$this->model->insert($data)) {
                return $this->failValidationErrors($this->model->errors());
            }

            return $this->respondCreated($data);
        } catch (\Exception $e) {
            // Catch any exception and respond with a failure message
            return $this->failServerError('Failed to create admin user: ' . $e->getMessage());
        }
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        try {
            $data = $this->request->getRawInput();
            return $this->respond($data);

            // Check if an image is uploaded
            $image = $this->request->getFile('image');
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $imageName = $image->getRandomName(); // Generate a random name for the image
                $image->move(WRITEPATH . 'uploads/admin', $imageName); // Move the image to the upload directory
                $data['image'] = $imageName;

                // Optionally, delete the old image from the server
                $oldImage = $this->model->find($id)['image'];
                if ($oldImage && file_exists(WRITEPATH . 'uploads/admin/' . $oldImage)) {
                    unlink(WRITEPATH . 'uploads/admin/' . $oldImage);
                }
            }

            // Check if the password needs to be updated and hash it
            if (isset($data['password']) && !empty($data['password'])) {
                // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            } else {
                unset($data['password']); // Remove password field if not updating
            }

            if (!$this->model->update($id, $data)) {
                return $this->failValidationErrors($this->model->errors());
            }

            return $this->respond($data);
        } catch (\Exception $e) {
            // Catch any exception and respond with a failure message
            return $this->failServerError('Failed to update admin user: ' . $e->getMessage());
        }
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        try {
            $admin = $this->model->find($id);
            if (!$admin) {
                return $this->respond(['message' => 'User not found'], 404);
            }

            // Optionally, delete the associated image from the server
            if ($admin['image'] && file_exists(WRITEPATH . 'uploads/admin/' . $admin['image'])) {
                unlink(WRITEPATH . 'uploads/admin/' . $admin['image']);
            }

            // Perform the deletion (soft delete)
            if (!$this->model->delete($id)) {
                return $this->respond(['message' => 'Failed to delete the admin user'], 400);
            }

            return $this->respondDeleted(['id' => $id, 'message' => 'Admin user deleted successfully']);
        } catch (\Exception $e) {
            return $this->respond(['code' => $e->getCode(), 'message ' => $e->getMessage()], 500);
        }
    }
}
