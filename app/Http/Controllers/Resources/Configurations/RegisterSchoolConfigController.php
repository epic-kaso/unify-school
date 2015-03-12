<?php namespace SupergeeksGadgetSwap\Http\Controllers\Resources\Configurations;

use SupergeeksGadgetSwap\Http\Controllers\Controller;
use SupergeeksGadgetSwap\Http\Requests;

class RegisterSchoolConfigController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return \Response::json("{'school': {
                    'name': '',
                    'selected_school_type': '',
                    'school_types': [
                        {
                            name: 'tertiary',
                            display_name: 'Tertiary (Universities, Poly etc)',
                            session: {
                                session_type: 'two',
                                session_name: 'session',
                                session_display_name: 'Session',
                                session_divisions_name: 'sub_session',
                                session_divisions_display_name: 'Semester',
                                full_display_name: this.session_type + ' ' + this.session_divisions_display_name + ' ' + this.session_display_name
                            },
                            school_categories: [
                                {
                                    'display_name': 'Arts',
                                    'name': 'arts',
                                    'arms': [
                                        {
                                            display_name: 'Mass Communication',
                                            name: 'mass_communication',
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'English Language',
                                            name: 'english',
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Physical Sciences',
                                    'name': 'physical_sciences',
                                    'arms': [
                                        {
                                            display_name: 'Computer Science',
                                            name: 'computer_science',
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Engineering',
                                    'name': 'engineering',
                                    'arms': [
                                        {
                                            display_name: 'Electronics and Computer',
                                            name: 'electronics_and_computer',
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Environmental Sciences',
                                    'name': 'environmental',
                                    'arms': [
                                        {
                                            display_name: 'Architecture',
                                            name: 'architecture',
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            name: 'non_tertiary',
                            display_name: 'Non Tertiary (Nursery, Primary etc )',
                            session: {
                                session_type: 'three',
                                session_name: 'session',
                                session_display_name: 'Session',
                                session_divisions_name: 'sub_session',
                                session_divisions_display_name: 'Term',
                                full_display_name: this.session_type + ' ' + this.session_divisions_display_name + ' ' + this.session_display_name
                            },
                            school_categories: [
                                {
                                    'display_name': 'Nursery',
                                    'name': 'nursery',
                                    'arms': [
                                        {
                                            display_name: 'one',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'two',
                                            name: 2,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'three',
                                            name: 3,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'four',
                                            name: 4,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Primary',
                                    'name': 'primary',
                                    'arms': [
                                        {
                                            display_name: 'one',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'two',
                                            name: 2,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'three',
                                            name: 3,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'four',
                                            name: 4,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'five',
                                            name: 5,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'six',
                                            name: 6,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Junior Secondary',
                                    'name': 'junior_secondary',
                                    'arms': [
                                        {
                                            display_name: 'One',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'Two',
                                            name: 2,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'Three',
                                            name: 3,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                },
                                {
                                    'display_name': 'Senior Secondary',
                                    'name': 'senior_secondary',
                                    'arms': [
                                        {
                                            display_name: 'One',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'Two',
                                            name: 2,
                                            arms: {
                                                default: {}
                                            }
                                        },
                                        {
                                            display_name: 'Three',
                                            name: 3,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            name: 'custom',
                            display_name: 'Other Schools (Business School, etc)',
                            session: {
                                session_type: 'three',
                                session_name: 'session',
                                session_display_name: 'Session',
                                session_divisions_name: 'sub_session',
                                session_divisions_display_name: 'Term',
                                full_display_name: this.session_type + ' ' + this.session_divisions_display_name + ' ' + this.session_display_name
                            },
                            school_categories: [
                                {
                                    'display_name': 'default',
                                    'name': 'default',
                                    'arms': [
                                        {
                                            display_name: 'one',
                                            name: 1,
                                            arms: {
                                                default: {}
                                            }
                                        }
                                    ]
                                }
                            ]
                        }
                    ],
                    'admin_email': '',
                    'admin_password': '',
                    'admin_password_confirmation': ''
                }}");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
