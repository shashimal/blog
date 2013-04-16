<?php

class Post extends AppModel {

    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'order' => 'Comment.created_date ASC'
        )
    );
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        ),
    );

    /*
     * View blog posts
     * 
     */

    public function viewPosts() {

        $posts = $this->find('all', array(
            'conditions' => array('Post.archive' => '0'),
            'order' => array('Post.created_date DESC'),
                ));

        return $posts;
    }

    /*
     * Get latest blog post
     * 
     */

    public function getLatestPosts() {

        $posts = $this->query("SELECT * FROM posts WHERE archive = '0' ORDER BY created_date DESC LIMIT 0,5");

        return $posts;
    }

    /*
     * Archive blog post
     * 
     */

    public function archivePost($id) {

        if (!empty($id)) {

            $this->query("UPDATE posts SET archive = '1' WHERE id='$id' ");

            return true;
        } else {
            return false;
        }
    }

    /*
     * Search blog post
     * 
     */

    public function search($searchField, $searchValue) {

        $posts = $this->query("SELECT * FROM posts WHERE $searchField LIKE '$searchValue%' ");
        return $posts;
    }

}

?>
