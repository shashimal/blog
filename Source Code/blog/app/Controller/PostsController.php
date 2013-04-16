<?php

/*
 * PostsController handle all the functions related to the posts.
 * 
 */

class PostsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
    public $uses = array('Post', 'Comment', 'User');

    /*
     * Display all the blog posts
     * Display latest blog posts
     */

    public function index() {

        $this->layout = 'blog';

        $allPosts = $this->Post->viewPosts();
        $latestPosts = $this->Post->getLatestPosts();

        $data['allPosts'] = $allPosts;
        $data['latestPosts'] = $latestPosts;
        
        $this->set('data', $data);
    }

    /*
     * Read the full content of the blog post
     * $id: post id
     */

    public function readPost($id = null) {


        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);

        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        $this->layout = 'blog';

        $latestPosts = $this->Post->getLatestPosts();

        $users = $this->User->getUsers();
        $userDetails = $this->getUsersDetails($users);

        $data['post'] = $post;
        $data['latestPosts'] = $latestPosts;
        $data['userDetails'] = $userDetails;

        $this->set('data', $data);
    }

    /*
     * Submit a comment for the blog post
     * 
     */

    public function submitComment() {

        if ($this->request->is('post')) {

            $this->Comment->create();

            $id = $this->request->data['id'];

            $data = array(
                'post_id' => $id,
                'comment' => $this->request->data['txtComment'],
                'user_id' => 2,
                'created_date' => date('Y-m-d H:i:s')
            );

            if ($this->Comment->save($data)) {
                $this->Session->setFlash('Your comment has been added.');
                $this->redirect(array('action' => 'readPost', $id));
            } else {
                $this->Session->setFlash('Unable to add your comment.');
            }
        }
    }

    /*
     * Get an array with user id and user name
     * 
     */

    private function getUsersDetails($arrUsers) {

        $arrData = array();

        if (!empty($arrUsers)) {
            foreach ($arrUsers as $user) {
                $arrData[$user['users']['id']] = $user['users']['user_name'];
            }
        }

        return $arrData;
    }

}

?>
