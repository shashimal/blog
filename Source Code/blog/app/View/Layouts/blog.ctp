<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo 'PHP & MySQL'; ?>
        </title>
        <?php
        echo $this->Html->css('blog');
        echo $this->Html->css('redmond/jquery-ui-1.10.0.custom');

        echo $this->Html->script('jquery-1.9.0');
        echo $this->Html->script('jquery.validate');
        echo $this->Html->script('jquery-ui-1.10.0.custom');
        echo $this->Html->script('tiny_mce/tiny_mce');
        ?>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>
                    <?php echo 'PHP & MySQL'; ?>
                </h1>
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact us</a></li>
                </ul>
            </div>
            <div id="content-container1">
                <div id="content-container2">
                    <div id="contents">                  
                        <?php echo $this->fetch('content'); ?>
                    </div>
                    <div id="footer">
                        Copyright ©  <?php echo 'PHP & MySQL'; ?>, 2013
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php // echo $this->element('sql_dump'); ?>