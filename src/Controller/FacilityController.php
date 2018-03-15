<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Facility Controller
 *
 * @property \App\Model\Table\FacilityTable $Facility
 *
 * @method \App\Model\Entity\Facility[] paginate($object = null, array $settings = [])
 */
class FacilityController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Station', 'Type']
        ];
        $facility = $this->paginate($this->Facility);

        $this->set(compact('facility'));
        $this->set('_serialize', ['facility']);
    }

    /**
     * View method
     *
     * @param string|null $id Facility id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $facility = $this->Facility->get($id, [
            'contain' => ['Station', 'Type', 'Category']
        ]);

        $this->set('facility', $facility);
        $this->set('_serialize', ['facility']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $facility = $this->Facility->newEntity();
        if ($this->request->is('post')) {
            $facility = $this->Facility->patchEntity($facility, $this->request->getData());
            if ($this->Facility->save($facility)) {
                $this->Flash->success(__('The facility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facility could not be saved. Please, try again.'));
        }
        $station = $this->Facility->Station->find('list', ['limit' => 200]);
        $type = $this->Facility->Type->find('list', ['limit' => 200]);
        $category = $this->Facility->Category->find('list', ['limit' => 200]);
        $this->set(compact('facility', 'station', 'type', 'category'));
        $this->set('_serialize', ['facility']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Facility id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facility = $this->Facility->get($id, [
            'contain' => ['Category']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facility = $this->Facility->patchEntity($facility, $this->request->getData());
            if ($this->Facility->save($facility)) {
                $this->Flash->success(__('The facility has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The facility could not be saved. Please, try again.'));
        }
        $station = $this->Facility->Station->find('list', ['limit' => 200]);
        $type = $this->Facility->Type->find('list', ['limit' => 200]);
        $category = $this->Facility->Category->find('list', ['limit' => 200]);
        $this->set(compact('facility', 'station', 'type', 'category'));
        $this->set('_serialize', ['facility']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Facility id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $facility = $this->Facility->get($id);
        if ($this->Facility->delete($facility)) {
            $this->Flash->success(__('The facility has been deleted.'));
        } else {
            $this->Flash->error(__('The facility could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
