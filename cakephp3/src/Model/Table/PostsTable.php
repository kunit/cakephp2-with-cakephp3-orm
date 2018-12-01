<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PostsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('posts');
        $this->addBehavior('Timestamp');
    }

    /**
     * デフォルトのバリデーションルール
     *
     * @param Validator $validator
     * @return Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('title')
            ->notEmpty('title');

        $validator
            ->requirePresence('body')
            ->notEmpty('body');

        return $validator;
    }
}
