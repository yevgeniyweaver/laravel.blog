<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\ObjectsRepo as repo;
use App\Entities\Objects;
use Doctrine\ORM\EntityManager;
use function MongoDB\BSON\toJSON;

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
        $data =[];
        $data['title'] = 'ryryyrry';
        $data['image'] = '/img/one.jpg';
        $data['category' ]= 1;
        $data['description'] = 'first object';
        //$data = [ 'category'=>1,'title'=>'ryryyrry','image'=>'imgonejpg','description'=>'first object' ];

        //Session::flash('msg', 'add success');
        $re = new \ArrayObject($data);
        $this->repo->create($this->repo->prepareData($data));
//        $user = new Objects($re);
//        $user->setTitle($data['title']);
//        $user->setCategory($data['category']);
//        $user->setImage($data['image']);
//        $user->setDescription($data['description']);
//        $user->setPassword(bcrypt($data['password']));
//        EntityManager::persist($user);
//        EntityManager::flush();
       // return $user;
    }

    public function edit($id=NULL)
    {
        //var_dump($this->repo->postOfId($id));
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


    // show list of all objects
    public function showAll()
    {
        $objects = $this->repo->showAll();
        return view('admin.showAll', compact('objects') );
    }


    // if id is empty redirect to showAll action with list of all objects
    public function show($id){
        if(!empty($id)){
            $object = $this->repo->show($id);
//            $re = new \ArrayObject($this->repo->show($id));
//            $b[] = json_decode(json_encode($this->repo->show($id)), true);
            return view('admin.show', compact('object') );
        }else{
            return redirect()->action($this->showAll());
        }
    }
}
