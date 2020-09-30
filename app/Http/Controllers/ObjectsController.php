<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\ObjectsRepo as repo;
use App\Entities\Objects;
//use App\Validation\PostValidator;

class ObjectsController extends Controller
{
    //
    private $repo;

    public function __construct(repo $repo)
    {
        $this->repo = $repo;
    }


    public function index()
    {
        return View('admin.index');//->with(['Data' => $this->repo->retrieve()])
    }

    protected function create()//array $data
    {

        $data = [ 'category'=>1,'image'=>'imgonejpg','title'=>'ryryyrry','description'=>'first object' ];
//        $this->repo->create($this->repo->prepareData($data));
        //Session::flash('msg', 'add success');
        $user = new Objects($data);
//        $user->setTitle($data['title']);
//        $user->setCategory($data['category']);
//        $user->setImage($data['image']);
//        $user->setDescription($data['description']);
//        $user->setPassword(bcrypt($data['password']));
//
        \EntityManager::persist($user);
        \EntityManager::flush();

       // return $user;
    }

    public function edit($id=NULL)
    {
        return View('admin.index')->with(['data' => $this->repo->postOfId($id)]);
    }

    public function editPost()
    {
        $all = Input::all();
        $validate = PostValidator::validate($all);
        if (!$validate->passes()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $Id = $this->repo->postOfId($all['id']);
        if (!is_null($Id)) {
            $this->repo->update($Id, $all);
            Session::flash('msg', 'edit success');
        } else {
            $this->repo->create($this->repo->prepare_data($all));
            Session::flash('msg', 'add success');
        }
        return redirect()->back();
    }

    public function retrieve()
    {
        return View('admin.index')->with(['Data' => $this->repo->retrieve()]);
    }

    public function delete()
    {
        $id = Input::get('id');
        $data = $this->repo->postOfId($id);
        if (!is_null($data)) {
            $this->repo->delete($data);
            Session::flash('msg', 'operation Success');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('operationFails');
        }
    }
    
}
