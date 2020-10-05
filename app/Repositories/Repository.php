<?php


namespace App\Repositories;
use \App\Http\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{

    protected $model;
    //Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
         return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
            $id = $this->model->find($id);
            return  $id->udpate($data);
    }

    public function delete($id)
    {
        return  $this->model->find($id)->destroy();
    }

    public function show($id)
    {
       return $this->model->findOrFail($id);
    }

    //Get associated model
    public function getModel()
    {
        return $this->model;
    }

    //set associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    //Eager load db relationship
    public function with($relation)
    {
        return $this->model->with($relation);
    }



}
