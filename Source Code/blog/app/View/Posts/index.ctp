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
            alert('f');
            //window.location.href = '/admins/addPost';
        });
    });

</script>
<?php
$allPosts = $data['allPosts'];
$latestPosts = $data['latestPosts'];
?>

<div id="aside">
    <div style="font-weight: bold;background-color: #BBB;margin-bottom: 8px;">Latest Posts</div>

    <?php foreach ($latestPosts as $latestPost): ?>
        <h3 style="font-size: 12px;">
            <?php
            echo $this->Html->link(substr($latestPost['posts']['title'], 0, 50), array('controller' => 'posts', 'action' => 'readPost', $latestPost['posts']['id']), array('escape' => false));
            ?>
        </h3>
        <p>
            <?php echo $this->Html->image($latestPost['posts']['image_name'], array('width' => 60, 'height' => 60)); ?>
        </p>
    <?php endforeach; ?>
</div>
<?php foreach ($allPosts as $post): ?>
    <div id="content">
        <h2 >
            <?php
            echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'readPost', $post['Post']['id']), array('escape' => false));
            ?>
        </h2>
        <div class="postedDate">Posted <?php echo date("Y-M-d", strtotime($post['Post']['created_date'])); ?></div>
        <br />
        <div style="float: left"><?php echo $this->Html->image($post['Post']['image_name'], array('width' => 150, 'height' => 150)); ?></div>
        <?php echo substr($post['Post']['body'], 0, 600) . '...'; ?>
        <span style="font-size: 11px;font-weight: bold;color: #62c462;">
            <?php echo $this->Html->link('Read More', array('controller' => 'posts', 'action' => 'readPost', $post['Post']['id']), array('escape' => false)); ?>
        </span>
        <div id="comment" style="text-align: right;"><h4>Comments(<?php echo count($post['Comment']); ?>)</h4></div>
    </div>  
<?php endforeach; ?>
<?php unset($allPosts); ?>
