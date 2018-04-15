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
        $forms = Form::all();
        return response($forms);

    }

    public function search(Request $request, Form $form)
    {

        $out = "";

        if ($request->ajax()) {
            $posts = $form->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('text', 'LIKE', '%' . $request->search . '%')->get();

            if (count($posts) > 0) {
                foreach ($posts as $key => $pos) {
                    $out .= '<tr>' .
                        '<td>' . $pos->id . '</td>' .
                        '<td>' . $pos->name . '</td>' .
                        '<td>' . $pos->text . '</td>' .
                        '<td>' . "<form action=\"http://localhost:8000/admin/form/$pos->id\"
                                                   method=\"post\">
                                                       " . method_field('DELETE') . csrf_field() . "
                                                        <button>
                                                                <span data-id=\"$pos->id\"
                                                                      data-title=\"delete_news\"
                                                                      class=\"flaticon-trash-2 delete_news_button \"
                                                                      data-toggle=\"tooltip\" title=\"حذف\"></span>
                                                        </button>
                                                    </form>" . '</td>' . '</tr>';
                }
                return response($out);
            } else {
                return response("not");
            }

        }

    }

}
