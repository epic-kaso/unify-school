<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/17/2015
 * Time: 1:14 PM
 */

namespace UnifySchool\Http\Controllers\SuperAdmin\Resources;


use UnifySchool\Http\Controllers\Controller;

class NavigationMenuController extends Controller
{

    public function index()
    {
        $menu = $this->getMenu();
        return \Response::json($menu);
    }

    private function getMenu()
    {
        $data = [
            [
                "text" => "Menu Heading",
                "heading" => "true",
                "translate" => "sidebar.heading.HEADER"
            ],
            [
                "text" => "Schools",
                "sref" => "app.schools",
                "icon" => "fa fa-file-o"
            ],
            [
                "text" => "Single View",
                "sref" => "app.singleview",
                "icon" => "fa fa-file-o",
                "translate" => "sidebar.nav.SINGLEVIEW"
            ],
            [
                "text" => "Menu",
                "sref" => "#",
                "icon" => "icon-folder",
                "submenu" => [
                    ["text" => "Sub Menu",
                        "sref" => "app.submenu",
                        "translate" => "sidebar.nav.menu.SUBMENU"
                    ]
                ],
                "translate" => "sidebar.nav.menu.MENU"
            ]
        ];

        $result = [];

        foreach ($data as $d) {
            $obj = new \stdClass();

            foreach ($d as $key => $value) {
                $obj->{$key} = $value;
            }
            $result[] = $obj;
        }

        return $result;
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
     * @param CreateSchoolRequest $request
     * @return Response
     */
    public function store()
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

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
     * @param CreateSchoolRequest $request
     * @return Response
     */
    public function update($id)
    {
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