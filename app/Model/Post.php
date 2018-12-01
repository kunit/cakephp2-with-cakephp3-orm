<?php
App::uses('AppModel', 'Model');

class Post extends AppModel
{
    public $validate = [
        'title' => [
            'rule' => 'notBlank'
        ],
        'body' => [
            'rule' => 'notBlank'
        ]
    ];
}
