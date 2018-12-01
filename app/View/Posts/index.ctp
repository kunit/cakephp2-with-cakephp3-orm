<h1>Blog posts</h1>
<p><?php echo $this->Html->link('Add Post', ['action' => 'add']); ?></p>
<table>
  <tr>
    <th>Id</th>
    <th>Title</th>
    <th>Actions</th>
    <th>Created</th>
  </tr>

  <!-- ここで $posts 配列をループして、投稿情報を表示 -->

    <?php foreach ($posts as $post): ?>
      <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php
            echo $this->Html->link(
                $post['Post']['title'],
                ['action' => 'view', $post['Post']['id']]
            );
            ?>
        </td>
        <td>
            <?php
            echo $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $post['Post']['id']],
                ['confirm' => 'Are you sure?']
            );
            ?>
            <?php
            echo $this->Html->link(
                'Edit', ['action' => 'edit', $post['Post']['id']]
            );
            ?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
      </tr>
    <?php endforeach; ?>

</table>
