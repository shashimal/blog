<script>
    
  
    $(document).ready(function() {
        
        $('#PostBody').css('width', '80%');
        
        //        tinyMCE.init({
        //            mode : "textareas", 
        //            theme : "simple", 
        //            editor_selector :"mceEditor",
        //            theme : "advanced",
        //            skin : "o2k7"
        //        });
        
        $('#save').click(function() {
            $('#post').submit();
        })
        
        $(function() {
            $( "#tabs" ).tabs();
        });
    
        $(function() {
            $( "#save" )
            .button()
            .click(function( event ) {
                event.preventDefault();
            });
        });
        
        $('#post').validate({
    
            rules: {
                'data[Post][title]': {
                    required:true,                    
                    maxlength: 100
                },
                
                'data[Post][body]': {
                    required:true                 
                    
                }
            },
            
            messages: {
                
                'data[Post][title]' : {
                    required: 'Title can not be empty',                  
                    maxlength: 'Maximum number of characters is 100'
                },
                
                'data[Post][body]' : {
                    required: 'Message body can not be empty'             
                    
                }
            }
        }
        
   
    );
        
    });
</script>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Add Post</a></li>
    </ul>
    <div id="tabs-1">
        <div id="form" class="form">
            <?php
            echo $this->Form->create(null, array('id' => 'post', 'url' => '/admins/editPost', 'type' => 'file'));
            echo $this->Form->input('title', array('id' => 'title', 'value' => $post['Post']['title']));
            echo $this->Form->input('body', array('rows' => '10', 'cols' => '20', 'class' => 'mceEditor', 'value' => $post['Post']['body']));
            echo $this->Form->input('image', array('type' => 'file'));
            echo $this->Form->input('id', array('type' => 'hidden', 'value' => $post['Post']['id']));
            echo $this->Form->end(array('label' => 'Save', 'value' => 'Save!', 'id' => 'save',));
            ?>
        </div>
    </div>

</div>
