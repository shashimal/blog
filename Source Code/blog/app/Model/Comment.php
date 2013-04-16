<?php

class Comment extends AppModel {

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
           
            '//order' => 'Comment.created_date DESC'
        )
    );
    public $validate = array(
        'comment' => array(
            'rule' => 'notEmpty'
        )
    );

}

?>
