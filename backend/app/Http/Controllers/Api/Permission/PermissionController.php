<?php

namespace App\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use App\Models\MasterMenusesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // versi hanya akses
    public function index(Request $request)
    {
        $menus = DB::table('m_permission_has_users as a')
            ->join('m_permissions as b', 'b.id', '=', 'a.id_permission')
            ->join('m_menuses as c', 'c.id', '=', 'b.id_menu')
            ->join('m_menu_details as d', 'd.id_menu', '=', 'c.id')
            ->where('a.id_user', $request->input('idUser'))
            ->select('c.name', 'c.icon', 'c.url', 'c.id', 'd.name as submenu_name', 'd.url as submenu_url', 'd.id as submenu_id')
            ->get();

        // Menyusun ulang data menjadi struktur yang sesuai untuk Vue
        $structuredMenus = [];
        foreach ($menus as $menu) {
            if (!isset($structuredMenus[$menu->id])) {
                $structuredMenus[$menu->id] = [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'icon' => $menu->icon,
                    'url' => $menu->url,
                    'submenus' => []
                ];
            }

            if ($menu->submenu_id) {
                $structuredMenus[$menu->id]['submenus'][] = [
                    'id' => $menu->submenu_id,
                    'name' => $menu->submenu_name,
                    'url' => $menu->submenu_url
                ];
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'get data menus success',
            'data' => array_values($structuredMenus)
        ]);
    }


    public function getMenus(Request $request)
    {
        $id_user = $request->input('idUser');

        $menus = DB::table('user_menu_permissions as a')
            ->join('menu_headers as b', 'a.id_menu_header', '=', 'b.id')
            ->leftJoin('user_menu_detail_permissions as c', 'a.id', '=', 'c.id_user_menu_permissions')
            ->leftJoin('menu_details as d', 'c.menu_detail_id', '=', 'd.id')
            ->select(
                'b.id as header_id',
                'b.name as header_name',
                'b.icon as header_icon',
                'b.url as header_url',
                'd.id as detail_id',
                'd.name as detail_name',
                'd.url as detail_url',
            )
            ->where('a.id_user', $id_user)
            ->get();

        // Organize the fetched data into a structured format
        $formattedMenus = [];
        foreach ($menus as $menu) {
            $headerId = $menu->header_id;
            if (!isset($formattedMenus[$headerId])) {
                $formattedMenus[$headerId] = [
                    'header_id' => $headerId,
                    'header_name' => $menu->header_name,
                    'header_icon' => $menu->header_icon,
                    'header_url' => $menu->header_url,
                    'submenus' => [],
                ];
            }

            if ($menu->detail_id) {
                $formattedMenus[$headerId]['submenus'][] = [
                    'detail_name' => $menu->detail_name,
                    'detail_url' => $menu->detail_url,
                    'access' => $menu->access,
                    'add_permission' => $menu->add_permission,
                    'delete_permission' => $menu->delete_permission,
                    'update_permission' => $menu->update_permission,
                ];
            }
        }

        return response()->json([
            'id_user' => $id_user,
            'data' => array_values($formattedMenus),
        ]);
    }

    public function getPermissions(Request $request)
    {
        $idUser = $request->input('idUser');
        $headerName = $request->input('headerName');
        $detailName = $request->input('detailName');

        $permissions = DB::table('user_menu_permissions as a')
            ->join('menu_headers as b', 'a.id_menu_header', '=', 'b.id')
            ->join('menu_details as c', 'b.id', '=', 'c.id_menu_header')
            ->join('user_menu_detail_permissions as d', function ($join) {
                $join->on('c.id', '=', 'd.menu_detail_id')
                    ->on('a.id', '=', 'd.id_user_menu_permissions');
            })
            ->select(
                'd.access',
                'd.add',
                'd.update',
                'd.delete'
            )
            ->where('a.id_user', $idUser)
            ->where('b.name', $headerName)
            ->where('c.name', $detailName)
            ->first();

        return response()->json(['data' => $permissions]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
