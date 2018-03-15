<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Category Controller
 *
 * @property \App\Model\Table\CategoryTable $Category
 *
 * @method \App\Model\Entity\Category[] paginate($object = null, array $settings = [])
 */
class CategoryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
      $category = $this->Category->find("all");
      $this->set('category', $category);
      $this->set('_serialize', ['category']);
      $this->viewBuilder()->autoLayout(false);
    }

    public function info(){
      $this->paginate = [
          'maxLimit' => 300,
          'limit' => 1,
      ];
      $category = $this->paginate($this->Category);

      $this->set('category', $category);
      $this->set('_serialize', ['category']);
    }

    public function help(){
      //$this->loadModel("Category");
      $category = $this->Category->find("all");
      $this->set('category', $category);
      $this->set('_serialize', ['category']);
    }

    public function conf(){
      $this->paginate = [
          'maxLimit' => 300,
          'limit' => 1,
      ];
      $category = $this->paginate($this->Category);

      $this->set('category', $category);
      $this->set('_serialize', ['category']);
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $category = $this->Category->get($id, [
            'contain' => ['Facility']
        ]);

        $this->set('category', $category);
        $this->set('_serialize', ['category']);
    }

}
