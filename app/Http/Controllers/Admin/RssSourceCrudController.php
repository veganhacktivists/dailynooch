<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RssSourceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class RssSourceCrudController.
 *
 * @property \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RssSourceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\RssSource');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/rss-source');
        $this->crud->setEntityNameStrings('rss source', 'RSS Sources');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(RssSourceRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
