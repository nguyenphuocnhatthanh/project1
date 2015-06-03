<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Impl\User\UserInterface;
use Illuminate\Http\Request;

class UsersController extends Controller {


    /**
     * @var UserInterface
     */
    private $user;

    public function __construct(UserInterface $user){

        $this->user = $user;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request){
        $users = $this->user->paginate(10);


        if($request->has('search'))
            $users = $this->user->search($request->get('search'), 10);
        $users->setPath('/public/admin/users');
        $users->appends($request->query());
        return view('admin.users.index', compact('users'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getCreate(){
        return view('admin.users.create');
    }

    /**
     * @param Requests\FormUsersRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCreate(Requests\FormUsersRequest $request){
        if($this->user->save($request)) {
            \Session::flash('statusAction' , 'success');
            \Session::flash('messageAction', 'Create successfully');
            return redirect('/admin/users');
        }

        \Session::flash('statusAction' , 'danger');
        \Session::flash('messageAction', 'Create failed');
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id){
        $user = $this->user->getByID($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param Requests\FormUsersRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postEdit(Requests\FormUsersRequest $request){
        if($this->user->save($request)) {
            \Session::flash('statusAction' , 'success');
            \Session::flash('messageAction', 'Edit successfully');
            return redirect('/admin/users');
        }

        \Session::flash('statusAction' , 'danger');
        \Session::flash('messageAction', 'Edit failed');
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id){
        if($this->user->delete($id)){
            \Session::flash('statusAction' , 'success');
            \Session::flash('messageAction', 'Delete successfully');
            return redirect('/admin/users');
        }

        \Session::flash('statusAction' , 'danger');
        \Session::flash('messageAction', 'Delete failed');
        return redirect()->back();

    }

}