<script>
    $(function() {
        $( ".button" )
        .button()
        .click(function( event ) {
            event.preventDefault();
        });
    });

    $(document).ready(function() {
        $('#add').click(function() {           
            window.location.href = '<?php echo $this->base ?>/admins/addPost';
        });
        
        $('#searchBtn').click(function() {  
            $('#searchForm').attr('action', '<?php echo $this->base ?>/admins/index');
            $('#searchForm').submit();
        });
    });   

</script>

<h1>Blog posts</h1>

<div id="searchBox" class="searchBox">
    <form id="searchForm" id="searchForm" name="searchForm" action="" method="post">
        <label>Search Field</lable>
            <select name="lstField" id="lstField">
                <option value="title">Title</option>
                <option value ="archive">Archive</option>
            </select>
            <input type="text" id="searchValue" name="searchValue" />
            <input type="button" id="searchBtn" value="Search" class="button" />
    </form>
</div>

<table class="table_list">
    <tr>
        <th>Title</th>
        <th>Body</th>        
        <th>Created Date</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>

    <?php
    if (sizeof($posts) > 0) {
        $c = 0;
        ?>
        <?php foreach ($posts as $post): ?>
            <tr class="<?= ($c++ % 2 == 1) ? 'odd' : 'even' ?>">
                <td width="320"><?php echo $post['Post']['title']; ?></td>
                <td width="360">
                    <?php
                    $data = substr($post['Post']['body'], 0, 35);
                    echo $data;
                    ?>
                </td>
                <td><?php echo date('Y-m-d', strtotime($post['Post']['created_date'])); ?></td>
                <td><?php echo $this->Html->link($this->Html->image('edit.png'), array('controller' => 'admins', 'action' => 'viewPost', $post['Post']['id']), array('escape' => false)); ?></td>
                <td> 
                    <?php
                    echo $this->Form->postLink(
                            $this->Html->image('delete.png', array('alt' => __('Effacer'))), //le image
                            array('controller' => 'admins', 'action' => 'deletePost', $post['Post']['id']), array('escape' => false), //le escape
                            __('Are you sure want to delete this post?', $post['Post']['id']) //le confirm
                    )
                    ?>
                </td>
                <td> <?php
            echo $this->Form->postLink(
                    $this->Html->image('archive.png', array('alt' => __('Effacer'))), //le image
                    array('controller' => 'admins', 'action' => 'archivePost', $post['Post']['id']), array('escape' => false), //le escape
                    __('Are you sure want to archive this post?', $post['Post']['id']) //le confirm
            )
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php
        unset($post);
    }
    ?>
</table>
<div id="action_bar" class="action_bar" style="float: right">    
    <input id="add" class="button" type="button" value="New Post" />
</div>