<script>
    $(function() {
        $( ".button" )
        .button()
        .click(function( event ) {
            event.preventDefault();
        });
    });
    
    $(document).ready(function() {
        $('#btnSubmit').click(function() {   
            if($('#txtComment').val() != '') {
                $('#commentForm').attr('action', '<?php echo $this->base ?>/posts/submitComment');
                $('#commentForm').submit();
            }else {
                $( "#dialog" ).dialog( "open" );
            }
        });
    

        
        $(function() {
            $( "#dialog" ).dialog({
                autoOpen: false
            });
        });
    });

</script>
<?php
$post = $data['post'];
$comments = $post['Comment'];
$userDetails = $data['userDetails'];
$latestPosts = $data['latestPosts'];
?>
<div id="dialog" title="Comment">
    <p>Please enter a comment</p>
</div>
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

<div id="content">
    <h2>
        <?php echo $post['Post']['title']; ?>
    </h2>
    <br />
    <div style="float: left"><?php echo $this->Html->image($post['Post']['image_name'], array('width' => 150, 'height' => 150)); ?></div>
    <?php echo $post['Post']['body']; ?>
    <?php if (count($comments) > 0) { ?>
        <div><h3>Comments (<?php echo count($comments); ?>)</h3></div>
        <?php foreach ($comments as $comment): ?>
            <div id="comment_<?php echo $comment['id'] ?>" class="commentHeader">
                <?php echo $userDetails[$comment['user_id']]; ?>
            </div>
            <div class="userComment"> <?php echo $comment['comment']; ?></div>
            <?php
        endforeach;
    }
    ?>
    <div id="comment">
        Post a new comment
        <br />
        <form id="commentForm" action="" method="post">
            <textarea id="txtComment" name="txtComment" rows="5" cols="80" style="width: 80%"></textarea>
            <br />
            <input type="hidden" name="id" id="id" value="<?php echo $post['Post']['id'] ?>" />
            <input type="button" value="Submit Comment" id="btnSubmit" class="button"/>
        </form>
    </div>
</div>   

<?php unset($post); ?>
