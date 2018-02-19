<?php
/**
 * Created by PhpStorm.
 * User: milad
 * Date: 2/11/2018
 * Time: 11:37 AM
 */

namespace App\Classes\Search\admin;


use App\Form;

class formclass_comment
{
    public function search($item, Form $form)
    {
        try {
            $search = $form->where('text', 'LIKE', '%' . $item . '%')
                            ->orwhere('name', 'LIKE', '%' . $item . '%')
                            ->orderBy('id', 'desc')->get();
            if ($search->isEmpty()) {
                return (array('status' => '300'));
            } else {
                return (array('status' => '350', 'search' => $search));
            }
        } catch (Exception $e) {
            return (array('status' => '400'));
        }
    }

}