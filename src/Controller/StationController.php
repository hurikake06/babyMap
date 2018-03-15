<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Station Controller
 *
 * @property \App\Model\Table\StationTable $Station
 *
 * @method \App\Model\Entity\Station[] paginate($object = null, array $settings = [])
 */
class StationController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $station = $this->paginate($this->Station);

        $this->set(compact('station'));
        $this->set('_serialize', ['station']);
    }

    public function listAll(){
        $page = 1;
        if(isset($this->request->query['page'])){
            $page = $this->request->query['page'];
        }
        $getData = $this->Station->find("all",[
            'contain' => ['Facility'],
            'page' => $page,
            'limit' => 10
        ]);
        $data = $getData;
        $this->viewClass = 'Json';
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }
    public function listCategory(){
        $page = 1;
        if(isset($this->request->query['page'])){
            $page = $this->request->query['page'];
        }
        $andDataTemplate = 'EXISTS(select 1 from facility join facility_category on facility_category.facility_id = facility.id WHERE station_id = Station.id AND facility_category.category_id =';
        $andData = array();
        if(isset($this->request->query['category'])){
            $category = $this->request->query['category'];
            foreach ($category as $value) {
                $andData[] = $andDataTemplate.$value.")";
            }
        }

        $getData = $this->Station->find("all",[
            'contain' => ['Facility'],
            'page' => $page,
            'limit' => 10,
            'conditions' =>[
                '1 = 1',
                'AND'=>$andData
            ]
        ]);
        $data = $getData;
        $this->viewClass = 'Json';
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    public function listCloseOrder(){
        $page = 1;
        $lat = 34.76292;
        $lng = 137.381921;
        if(isset($this->request->query['page'])){
            $page = $this->request->query['page'];
        }
        if(isset($this->request->query['lat'])){
            $lat = $this->request->query['lat'];
        }
        if(isset($this->request->query['lng'])){
            $lng = $this->request->query['lng'];
        }
        $getData = $this->Station->find("all",[
            'contain' => ['Facility'],
            'page' => $page,
            'limit' => 10,
            'order' => ['(6378 * acos(cos(radians('.$lat.')) * cos(radians(lat)) * cos(radians(lng) - radians('.$lng.')) + sin(radians('.$lat.')) * sin(radians(lat))))' => 'asc']
        ]);
        $data = $getData;
        $this->viewClass = 'Json';
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    public function listCategoryCloseOrder(){
        $page = 1;
        $lat = 34.76292;
        $lng = 137.381921;

        if(isset($this->request->query['page'])){
            $page = $this->request->query['page'];
        }
        if(isset($this->request->query['lat'])){
            $lat = $this->request->query['lat'];
        }
        if(isset($this->request->query['lng'])){
            $lng = $this->request->query['lng'];
        }
        //$andDataTemplate = 'EXISTS(select 1 from facility join facility_category on facility_category.facility_id = facility.id WHERE station_id = Station.id AND facility_category.category_id =';
        $andDataTemplate2 = ' IN (select distinct(category_id) from station_category WHERE station_id = Station.id)';
        $andData = array();
        if(isset($this->request->query['category'])){
            $category = $this->request->query['category'];
            foreach ($category as $value) {
                $andData[] = $value.$andDataTemplate2;
                //$andData[] = $andDataTemplate.$value.")";
            }
        }

        $getData = $this->Station->find("all",[
            'contain' => ['Facility'=>['FacilityCategory'=>'Category'],'StationCategory'],
            'conditions' =>[
                '1 = 1',
                'AND'=>$andData
            ],
            'page' => $page,
            'limit' => 10,
            'order' => [
                '(6378 * acos(cos(radians('.$lat.')) * cos(radians(lat)) * cos(radians(lng) - radians('.$lng.')) + sin(radians('.$lat.')) * sin(radians(lat))))' => 'asc'
            ]
        ]);
        $data = $getData;
        $this->viewClass = 'Json';
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    public function listLocation(){
        $lat = 34.7576383;
        $lng = 137.42680989999997;
        $range = 1;
        $getData = $this->Station->find("all",
        	['conditions' =>['(6378 * acos(cos(radians('.$lat.')) * cos(radians(lat)) * cos(radians(lng) - radians('.$lng.')) + sin(radians('.$lat.')) * sin(radians(lat)))) <' => $range]
        	]);
        $data = $getData;
        $this->viewClass = 'Json';
        $this->set(compact('data'));
        $this->set('_serialize', 'data');
    }

    /**
     * View method
     *
     * @param string|null $id Station id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $station = $this->Station->get($id, [
            'contain' => ['Facility']
        ]);

        $this->set('station', $station);
        $this->set('_serialize', ['station']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $station = $this->Station->newEntity();
        if ($this->request->is('post')) {
            $station = $this->Station->patchEntity($station, $this->request->getData());
            if ($this->Station->save($station)) {
                $this->Flash->success(__('The station has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The station could not be saved. Please, try again.'));
        }
        $this->set(compact('station'));
        $this->set('_serialize', ['station']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Station id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $station = $this->Station->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $station = $this->Station->patchEntity($station, $this->request->getData());
            if ($this->Station->save($station)) {
                $this->Flash->success(__('The station has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The station could not be saved. Please, try again.'));
        }
        $this->set(compact('station'));
        $this->set('_serialize', ['station']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Station id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $station = $this->Station->get($id);
        if ($this->Station->delete($station)) {
            $this->Flash->success(__('The station has been deleted.'));
        } else {
            $this->Flash->error(__('The station could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
