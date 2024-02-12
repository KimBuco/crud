<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;
use Faker;

/**
 * DataTables Controller
 *
 *
 * @method \App\Model\Entity\DataTable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DataTablesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function initialize()
    {
        // Always enable the CSRF component.
        $this->loadComponent('Csrf');
    } 

    public function testTable ()
    {
        $this->viewBuilder()->setLayout('datatables');

    }

    public function ajaxTableTest(){

        $this->autoRender = false; // We won't use a view file for this response
        $this->loadModel('Users');
    
        $requestData = $this->request->getData();
    
        // Basic query for all users
        $query = $this->Users->find();
    
        // Search functionality
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $query->where([
                'OR' => [
                    'Users.id LIKE' => '%' . $searchValue . '%',
                    'Users.username LIKE' => '%' . $searchValue . '%',
                    'Users.email LIKE' => '%' . $searchValue . '%',
                    'Users.position LIKE' => '%' . $searchValue . '%',
                ],
            ]);
        }
    
        // Count filtered results (for pagination)
        $totalFiltered = $query->count();
    
        // Sorting
        if (isset($requestData['order'])) {
            $columns = ['id', 'username', 'email', 'position']; // Adjust based on the columns you're displaying
            $sortColumnIndex = $requestData['order'][0]['column']; // Column index
            $sortDirection = $requestData['order'][0]['dir']; // asc or desc
            $sortColumn = $columns[$sortColumnIndex]; // Map index to column name
            $query->order([$sortColumn => $sortDirection]);
        }
    
        // Pagination
        $start = (int) $requestData['start']; // Starting offset
        $length = (int) $requestData['length']; // Page size
        $query->limit($length)->offset($start);
    
        // Execute query and format results
        $data = [];
        foreach ($query as $row) {
            $nestedData = []; // This array holds data for a single row
            // Adjust these based on your actual columns
            $nestedData[] = $row->id;
            $nestedData[] = $row->username;
            $nestedData[] = $row->email;
            $nestedData[] = $row->position;
            $nestedData[] = $row->image;
            // Add more columns as needed

            $viewButton = '<a href="' . Router::url(['controller' => 'Users', 'action' => 'view', $row->id]) . '" class="btn btn-primary mb-2 mb-md-0 text-decoration-none text-light">View</a>';
            $editButton = '<a href="' . Router::url(['controller' => 'Users', 'action' => 'edit', $row->id]) . '" class="btn btn-warning mb-2 mb-md-0 text-decoration-none text-light">Edit</a>';
            $deleteButton = '<button class="btn btn-danger delete-btn" data-id="' . $row->id . '">Delete</button>';
    
            $buttons = $viewButton . ' ' . $editButton . ' '. $deleteButton;
            $nestedData[] = $buttons;

    
            $data[] = $nestedData; // Add row data to the overall data array
        }
    
        // Total number of records in the table, without any filters
        $totalData = $this->Users->find()->count();
    
        // Prepare the JSON response for DataTables
        $json_data = [
            "draw" => intval($requestData['draw']), // Cast for safety
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];
    
        echo json_encode($json_data);

    }
}