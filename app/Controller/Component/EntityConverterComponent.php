<?php

App::uses('Component', 'Controller');

class EntityConverterComponent extends Component
{
    /**
     * CakePHP3のクエリ結果をCakePHP2のfindの結果形式に変換する
     *
     * @param \Cake\ORM\Entity|\Cake\ORM\Query $entity
     * @param string $alias
     * @return array
     */
    public function toArray($entity, string $alias = null) : array
    {
        $result = [];

        if ($entity instanceof \Cake\Orm\Query) {
            foreach ($entity as $row) {
                $result[] = $this->toArray($row);
            }
        } else {
            if ($alias === null) {
                // TODO: もっとスマートな方法がないのか？
                $alias = str_replace('App\\Model\\Entity\\', '', get_class($entity));
            }
            $result[$alias] = $entity->toArray();
        }

        return $result;
    }

    /**
     * リクエストデータからCakePHP3のエンティティに変換
     *
     * @param \Cake\ORM\Table $model
     * @param \Cake\ORM\Entity|null $entity
     * @param array $data
     * @return \Cake\ORM\Entity
     */
    public function toEntity(\Cake\ORM\Table $model, ?\Cake\ORM\Entity $entity, array $data) : \Cake\ORM\Entity
    {
        $data = Hash::get($data, Inflector::classify($model->getAlias()));

        if ($entity === null) {
            $entity = $model->newEntity($data);
        } else {
            $entity = $model->patchEntity($entity, $data);
        }

        return $entity;
    }
}
