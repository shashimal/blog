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
            $('#PostBody').tinymce().save()
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
        <li><a href="#tabs-1">Post</a></li>
    </ul>
    <div id="tabs-1">
        <div id="form" class="form">
            <?php
            echo $this->Form->create('Post', array('id' => 'post', 'type' => 'file'));
            echo $this->Form->input('title', array('id' => 'title'));
            echo $this->Form->input('body', array('rows' => '10', 'cols' => '20', 'class' => 'mceEditor'));
            echo $this->Form->input('image', array('type' => 'file'));
            echo $this->Form->input('id', array('type' => 'hidden', 'value' => ''));
            echo $this->Form->end(array('label' => 'Save', 'value' => 'Save!', 'id' => 'save',));
            ?>
        </div>
    </div>
</div>
