<?php

namespace App\Http\Controllers;

use App\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function show(Form $form, Request $request)
    {
        $forms = Form::all();
        return view('form.form', ['active' => 'form', 'forms' => $forms]);
    }

    public function store(Request $request)
    {
        $form = new Form;
        $form->name = $request->name;
        $form->email = $request->email;
        $form->text = $request->text;
        $form->save();

        session()->flash('flash_message', 'save');
        return back();
    }

    public function delete($id)
    {
        $forms = Form::find($id);
        $forms->delete();
        return back();
    }

    public function searchFunction(Form $form, Request $request)
    {
        $forms=Form::all();
        return response($forms);

//          $search = $request->input('search');
//        dd($search);
//        $formss=$form->search([$search])->get();

//        $formss = $form->where('text', 'LIKE', '%' . $search . '%');
//        dd($formss);
//        return view('form.sea', compact('formss'));
//        $form->where('name','like','%'.$search.'%')
//            ->orWhere('text','like','%'.$search.'%')
//            ->orWhere('email','like','%'.$search.'%')
//        ;
    }
    public function search(Request $request,Form $form)
    {

//        $item = $request->input('item');
//        $manage = new formclass_comment();
//        $search = $manage->search($item);
//        if ($search['status'] == '350') {
//            return response()->json(array('status' => true,
//                'data' => $search['search']));
//        } else if ($search['status'] == '300') {
//            return response()->json(array('status' => false));
//        } else {
//            return response()->json(array('status' => false, 'msg' => 'خطایی در سیستم رخ داده است لطفا هر چه سریعتر این موضوع را به بخش فنی گزارش دهید.'));
//        }
        $out="";
        $sex="";
        if ($request->ajax()){
            $posts=$form->where('name','LIKE','%'.$request->search.'%')

                ->orWhere('id','LIKE','%'.$request->search.'%')
                ->orWhere('text','LIKE','%'.$request->search.'%')->get();
//            $posts=DB::table('posts')->where('title','LIKE','%'.$request->search.'%')
//                                     ->orWhere('content','LIKE','%'.$request->search.'%')->get();

            if ($posts){
                foreach ($posts as $key=>$pos){
                    if ($pos->sex==0){
                        $sex="Male";
                    }else{
                        $sex="Female";
                    }
                    $out='<tr>'.
                        '<td>'.$pos->id.'</td>'.
                        '<td>'.$pos->name.'</td>'.
                        '<td>'.$pos->text.'</td>'.
                        '</tr>';
                }
                return response($out);
            }else{
                return response("not");
            }

        }

    }

}
