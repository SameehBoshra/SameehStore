<?php

namespace App\RepositoryInterface;

use App\Http\Interface\RepositoryInteface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInteface
{

    protected  $model;
    public function __construct(Model $model)
    {
        $this->model=$model;
    }

    public function index()
    {
        // TODO: Implement index() method.
        return $this->model->all();
    }

    public function create(array $data)
    {
        // TODO: Implement create() method.
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.
        $record=$this->find($id);
        return $record->update($data);


    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        return $this->model->destroy($id);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
        return $this->model->findOrFail($id);
    }


    public  function  getModel()
    {
        return $this->model;

    }
    public  function setModel($model)
    {
        $this->model=$model;
        return $this;
    }

    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
