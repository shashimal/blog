<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo 'PHP & MySQL'; ?>
        </title>
        <?php
        echo $this->Html->css('style');
        echo $this->Html->css('layout');
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
                    <li><?php echo $this->Html->link('Home', array('controller' => 'admins', 'action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link('Posts', array('controller' => 'admins', 'action' => 'index')); ?></li>
                    <li><a href="#">Users</a></li>
                    <li style="float:right"><a href="#">Logout</a></li>
                </ul>
            </div>
            <div id="content-container">
                <div id="content">
                    <div class="div-message"><div><?php echo $this->Session->flash(); ?></div></div>
                    <?php echo $this->fetch('content'); ?>
                </div>
                <div id="footer">
                    Copyright ©  <?php echo 'PHP & MySQL'; ?>, 2013
                </div>
            </div>
        </div>
    </body>
</html>
