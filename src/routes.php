<?php

namespace PHPMaker2022\STUDENTT;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // hobby3
    $app->map(["GET","POST","OPTIONS"], '/hobby3list[/{id}]', Hobby3Controller::class . ':list')->add(PermissionMiddleware::class)->setName('hobby3list-hobby3-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/hobby3add[/{id}]', Hobby3Controller::class . ':add')->add(PermissionMiddleware::class)->setName('hobby3add-hobby3-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/hobby3view[/{id}]', Hobby3Controller::class . ':view')->add(PermissionMiddleware::class)->setName('hobby3view-hobby3-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/hobby3edit[/{id}]', Hobby3Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('hobby3edit-hobby3-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/hobby3delete[/{id}]', Hobby3Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('hobby3delete-hobby3-delete'); // delete
    $app->group(
        '/hobby3',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', Hobby3Controller::class . ':list')->add(PermissionMiddleware::class)->setName('hobby3/list-hobby3-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', Hobby3Controller::class . ':add')->add(PermissionMiddleware::class)->setName('hobby3/add-hobby3-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', Hobby3Controller::class . ':view')->add(PermissionMiddleware::class)->setName('hobby3/view-hobby3-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', Hobby3Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('hobby3/edit-hobby3-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', Hobby3Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('hobby3/delete-hobby3-delete-2'); // delete
        }
    );

    // students
    $app->map(["GET","POST","OPTIONS"], '/studentslist[/{id}]', StudentsController::class . ':list')->add(PermissionMiddleware::class)->setName('studentslist-students-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/studentsadd[/{id}]', StudentsController::class . ':add')->add(PermissionMiddleware::class)->setName('studentsadd-students-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/studentsview[/{id}]', StudentsController::class . ':view')->add(PermissionMiddleware::class)->setName('studentsview-students-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/studentsedit[/{id}]', StudentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('studentsedit-students-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/studentsdelete[/{id}]', StudentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('studentsdelete-students-delete'); // delete
    $app->group(
        '/students',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', StudentsController::class . ':list')->add(PermissionMiddleware::class)->setName('students/list-students-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', StudentsController::class . ':add')->add(PermissionMiddleware::class)->setName('students/add-students-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', StudentsController::class . ':view')->add(PermissionMiddleware::class)->setName('students/view-students-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', StudentsController::class . ':edit')->add(PermissionMiddleware::class)->setName('students/edit-students-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', StudentsController::class . ':delete')->add(PermissionMiddleware::class)->setName('students/delete-students-delete-2'); // delete
        }
    );

    // tbstudy
    $app->map(["GET","POST","OPTIONS"], '/tbstudylist[/{study_id}]', TbstudyController::class . ':list')->add(PermissionMiddleware::class)->setName('tbstudylist-tbstudy-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/tbstudyadd[/{study_id}]', TbstudyController::class . ':add')->add(PermissionMiddleware::class)->setName('tbstudyadd-tbstudy-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/tbstudyview[/{study_id}]', TbstudyController::class . ':view')->add(PermissionMiddleware::class)->setName('tbstudyview-tbstudy-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/tbstudyedit[/{study_id}]', TbstudyController::class . ':edit')->add(PermissionMiddleware::class)->setName('tbstudyedit-tbstudy-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/tbstudydelete[/{study_id}]', TbstudyController::class . ':delete')->add(PermissionMiddleware::class)->setName('tbstudydelete-tbstudy-delete'); // delete
    $app->group(
        '/tbstudy',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{study_id}]', TbstudyController::class . ':list')->add(PermissionMiddleware::class)->setName('tbstudy/list-tbstudy-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{study_id}]', TbstudyController::class . ':add')->add(PermissionMiddleware::class)->setName('tbstudy/add-tbstudy-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{study_id}]', TbstudyController::class . ':view')->add(PermissionMiddleware::class)->setName('tbstudy/view-tbstudy-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{study_id}]', TbstudyController::class . ':edit')->add(PermissionMiddleware::class)->setName('tbstudy/edit-tbstudy-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{study_id}]', TbstudyController::class . ':delete')->add(PermissionMiddleware::class)->setName('tbstudy/delete-tbstudy-delete-2'); // delete
        }
    );

    // address
    $app->map(["GET","POST","OPTIONS"], '/addresslist[/{address_id}]', AddressController::class . ':list')->add(PermissionMiddleware::class)->setName('addresslist-address-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/addressadd[/{address_id}]', AddressController::class . ':add')->add(PermissionMiddleware::class)->setName('addressadd-address-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/addressview[/{address_id}]', AddressController::class . ':view')->add(PermissionMiddleware::class)->setName('addressview-address-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/addressedit[/{address_id}]', AddressController::class . ':edit')->add(PermissionMiddleware::class)->setName('addressedit-address-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/addressdelete[/{address_id}]', AddressController::class . ':delete')->add(PermissionMiddleware::class)->setName('addressdelete-address-delete'); // delete
    $app->group(
        '/address',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{address_id}]', AddressController::class . ':list')->add(PermissionMiddleware::class)->setName('address/list-address-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{address_id}]', AddressController::class . ':add')->add(PermissionMiddleware::class)->setName('address/add-address-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{address_id}]', AddressController::class . ':view')->add(PermissionMiddleware::class)->setName('address/view-address-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{address_id}]', AddressController::class . ':edit')->add(PermissionMiddleware::class)->setName('address/edit-address-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{address_id}]', AddressController::class . ':delete')->add(PermissionMiddleware::class)->setName('address/delete-address-delete-2'); // delete
        }
    );

    // tb_ta
    $app->map(["GET","POST","OPTIONS"], '/tbtalist[/{ta_id}]', TbTaController::class . ':list')->add(PermissionMiddleware::class)->setName('tbtalist-tb_ta-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/tbtaadd[/{ta_id}]', TbTaController::class . ':add')->add(PermissionMiddleware::class)->setName('tbtaadd-tb_ta-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/tbtaview[/{ta_id}]', TbTaController::class . ':view')->add(PermissionMiddleware::class)->setName('tbtaview-tb_ta-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/tbtaedit[/{ta_id}]', TbTaController::class . ':edit')->add(PermissionMiddleware::class)->setName('tbtaedit-tb_ta-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/tbtadelete[/{ta_id}]', TbTaController::class . ':delete')->add(PermissionMiddleware::class)->setName('tbtadelete-tb_ta-delete'); // delete
    $app->group(
        '/tb_ta',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{ta_id}]', TbTaController::class . ':list')->add(PermissionMiddleware::class)->setName('tb_ta/list-tb_ta-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{ta_id}]', TbTaController::class . ':add')->add(PermissionMiddleware::class)->setName('tb_ta/add-tb_ta-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{ta_id}]', TbTaController::class . ':view')->add(PermissionMiddleware::class)->setName('tb_ta/view-tb_ta-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{ta_id}]', TbTaController::class . ':edit')->add(PermissionMiddleware::class)->setName('tb_ta/edit-tb_ta-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{ta_id}]', TbTaController::class . ':delete')->add(PermissionMiddleware::class)->setName('tb_ta/delete-tb_ta-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
