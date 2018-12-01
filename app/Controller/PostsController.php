<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController
{
    /**
     * 記事一覧
     *
     * @return void
     */
    public function index() : void
    {
        $this->set('posts', $this->Post->find('all'));
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

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    /**
     * 記事追加
     *
     * @return void
     */
    public function add() : void
    {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                $this->redirect(['action' => 'index']);
                return;
            }
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

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                $this->redirect(['action' => 'index']);
                return;
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
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

        if ($this->Post->delete($id)) {
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
