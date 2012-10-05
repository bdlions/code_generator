<ul id="nav">
   <li>
        <a href="#">Projects</a>
        <ul>
            <?php
                echo anchor('auth/index', 'All Projects');
                echo anchor('welcome/create_project', 'Create Project');
                
            ?>
        </ul>
    </li>
    <li><?php echo anchor('auth/logout', 'Logout'); ?></li>
</ul>
