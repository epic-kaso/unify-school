<?php namespace UnifySchool\Http\Controllers\School;

use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests;

class RegistrationWizardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('school.register.wizard.index');
    }

    public function partial($name)
    {
        return view('school.register.wizard.partial.' . $name);
    }

}
