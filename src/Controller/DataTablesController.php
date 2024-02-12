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

        $this->loadComponent('Csrf');
    } 


    public function data(){

        $this->autoRender = false;
        $this->loadModel('Users');
    
        $requestData = $this->request->getData();

        // echo($requestData);
    

        $query = $this->Users->find();
    
        // Search
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $query->where(function ($exp, $q) use ($searchValue) {
                $orConditions = [
                    'username LIKE' => '%' . $searchValue . '%',
                    'email LIKE' => '%' . $searchValue . '%',
                    'position LIKE' => '%' . $searchValue . '%',
                ];
                if (is_numeric($searchValue)) {
                    $orConditions['id'] = $searchValue;
                }
                return $exp->or_($orConditions);
            });
        }
        
    
        $totalFiltered = $query->count();
    
        // Sorting
        if (isset($requestData['order'])) {
            $columns = ['id', 'username', 'email', 'position']; 
            $sortColumnIndex = $requestData['order'][0]['column']; 
            $sortDirection = $requestData['order'][0]['dir']; 
            $sortColumn = $columns[$sortColumnIndex];
            $query->order([$sortColumn => $sortDirection]);
        }
    
        // Pagination
        $start = (int) $requestData['start']; 
        $length = (int) $requestData['length']; 
        $query->limit($length)->offset($start);
    

        $data = [];
        foreach ($query as $row) {
            $nestedData = []; 

            $nestedData[] = $row->id;
            $nestedData[] = $row->username;
            $nestedData[] = $row->email;
            $nestedData[] = $row->position;
            $nestedData[] = $row->image;

            $data[] = $nestedData; 
        }
    

        $totalData = $this->Users->find()->count();

        $json_data = [
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];
    
        echo json_encode($json_data);
    }

    public function test() 
    {
        
    }
}
