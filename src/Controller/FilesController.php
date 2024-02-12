<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

/**
 * Files Controller
 *
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    
    public function export()
    {
        $this->loadModel('Users');
        $this->setResponse($this->getResponse()->withDownload('my-file.csv'));
        $_header = array('id', 'username', 'email', 'position');
        $data = $this->Users->find('all');
        $_serialize = 'data';

        if(!$_serialize){
            $this->Flash->error(__('Unable to process request'));
        } else {
            $this->set(compact('data', '_header', '_serialize' ));
            $this->viewBuilder()->setClassName('CsvView.Csv');
        }
    }


    public function import()
    {

        $this->loadModel('Users');
        if ($this->request->is('post')){

        $file = $this->request->getData('csv_file');

        if ($file['name'] != NULL) {
            $filename = explode('.', $file['name']);
            if(end($filename) == 'csv'){
                $handle = fopen($file['tmp_name'], "r");

                fgetcsv($handle);

                $data = [];

                while ($row = fgetcsv($handle)) {
                    $data[] = [
                        'username' => $row[0],
                        'email' => $row[1],
                        'position' => $row[2],
                    ];
                } 

                dd($data);
                fclose($handle);
 
                if(count($data) > 0){
                    foreach ($data as $rowData) {
                        $user = $this->Users->newEntity($rowData);
                        $this->Users->save($user);
                    }
                    $this->Flash->success(__('Data imported successfully.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                } else {
                    $this->Flash->error(__('There is no data to upload.'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                }
            } else {
                $this->Flash->error(__('Please import a csv file.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'index']);
            }
        } else {
            $this->Flash->error(__('Invalid request.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
        
        } else {
            $this->Flash->error(__('Invalid request.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }  
    }

}
