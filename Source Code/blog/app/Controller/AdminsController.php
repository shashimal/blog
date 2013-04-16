<?php

/*
 * AdminsController handle all the functions related to admin tasks
 * 
 */

class AdminsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
    public $uses = array('Post');

    /*
     * Display all the blog posts except the archived posts
     * 
     */

    public function index() {

        $posts = null;

        if ($this->request->is('post')) {

            $this->Post->create();

            $searchField = $this->request->data['lstField'];
            $searchValue = $this->request->data['searchValue'];

            if (!empty($searchField) && !empty($searchValue)) {
                $posts = $this->Post->search($searchField, $searchValue);
                $this->set('posts', $posts);
            }
        } else {
            $posts = $this->Post->viewPosts();
        }

        $this->set('posts', $posts);
    }

    /*
     * Add new blog post
     * 
     */

    public function addPost() {

        if ($this->request->is('post')) {

            $this->Post->create();

            $data = $this->getPreparedPostData($this->request);

            if ($this->Post->save($data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }

    /*
     * Edit blog post
     * 
     */

    public function editPost() {

        if ($this->request->is('post')) {

            $this->Post->create();

            $id = $this->request->data['Post']['id'];

            if (!$id) {
                throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->Post->findById($id);

            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }

            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Post->id = $id;
                $data = $this->getPreparedPostData($this->request);
                if ($this->Post->save($data)) {
                    $this->Session->setFlash('Your post has been updated.');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update your post.');
                }
            }

            if (!$this->request->data) {
                $this->request->data = $post;
            }
        }
    }

    /*
     * View blog post
     * 
     */

    public function viewPost($id = null) {

        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);

        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        $this->set('post', $post);
    }

    /*
     * Delete blog post
     * 
     */

    public function deletePost($id = null) {

        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash('The post has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
    }

    /*
     * Archive blog post
     * 
     */
    public function archivePost($id = null) {

        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->archivePost($id)) {
            $this->Session->setFlash('The post has been archived.');
            $this->redirect(array('action' => 'index'));
        }
    }

     /*
     * Prepare data for saving
     * 
     */
    private function getPreparedPostData($request) {

        $title = $request->data['Post']['title'];
        $body = $request->data['Post']['body'];
        $file = $request->data['Post']['image'];

        $imageContent = null;
        $tempName = $file['tmp_name'];
        $imageSize = $file['size'];
        $imageType = $file['type'];
        $imageName = $file['name'];

        if (!empty($tempName)) {
            $imageContent = addslashes(fread(fopen($tempName, "rb"), filesize($tempName)));
            move_uploaded_file($tempName, WWW_ROOT . 'img/' . $imageName);
        }

        $data = array(
            'title' => $title,
            'body' => $body,
            'image_name' => $imageName,
            'image_type' => $imageType,
            'image_size' => $imageSize,
            'image_content' => $imageContent,
            'created_date' => date('Y-m-d H:i:s')
        );

        return $data;
    }

}

?>
