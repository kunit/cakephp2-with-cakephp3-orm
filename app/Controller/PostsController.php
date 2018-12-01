<?php

App::uses('AppController', 'Controller');

/**
 * 記事を扱うコントローラー
 *
 * CakePHP2 のブログチュートリアルをベースにしている
 *
 * @see https://book.cakephp.org/2.0/ja/tutorials-and-examples/blog/blog.html
 *
 * @property Post $Post
 * @property EntityConverterComponent $EntityConverter
 */
class PostsController extends AppController
{
    public $components = [
        'EntityConverter',
    ];

    /** @var \App\Model\Table\PostsTable */
    private $PostsTable;

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->PostsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('posts');
    }

    /**
     * 記事一覧
     *
     * @return void
     */
    public function index() : void
    {
        $this->set('posts', $this->EntityConverter->toArray($this->PostsTable->find('all')));
    }

    /**
     * 記事詳細
     *
     * @param int $id
     * @return void
     * @throws NotFoundException
     */
    public function view($id = null) : void
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        /** @var \Cake\ORM\Entity $post */
        $post = $this->PostsTable->get($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $this->EntityConverter->toArray($post));
    }

    /**
     * 記事追加
     *
     * @return void
     */
    public function add() : void
    {
        if ($this->request->is('post')) {
            $post = $this->EntityConverter->toEntity($this->PostsTable, null, $this->request->data);
            if ($this->PostsTable->save($post)) {
                $this->Flash->success(__('Your post has been saved.'));
                $this->redirect(['action' => 'index']);
                return;
            }
            $this->Post->validationErrors = $post->getErrors();
            $this->Flash->error(__('Unable to add your post.'));
        }
    }

    /**
     * 記事編集
     *
     * @param int $id
     * @return void
     * @throws NotFoundException
     */
    public function edit($id = null) : void
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        /** @var \Cake\ORM\Entity $post */
        $post = $this->PostsTable->get($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(['post', 'put'])) {
            $post = $this->EntityConverter->toEntity($this->PostsTable, $post, $this->request->data);
            if ($this->PostsTable->save($post)) {
                $this->Flash->success(__('Your post has been updated.'));
                $this->redirect(['action' => 'index']);
                return;
            }
            $this->Post->validationErrors = $post->getErrors();
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $this->EntityConverter->toArray($post);
        }
    }

    /**
     * @param int $id
     * @return void
     * @throws MethodNotAllowedException
     */
    public function delete($id = null) : void
    {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        /** @var \Cake\ORM\Entity $post */
        $post = $this->PostsTable->get($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

         if ($this->PostsTable->delete($post)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        $this->redirect(['action' => 'index']);
    }
}
