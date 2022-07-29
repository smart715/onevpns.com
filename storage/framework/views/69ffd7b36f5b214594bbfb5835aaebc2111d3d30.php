<?php if(Session::has('sweet_alert.alert')): ?>
    <script>
        <?php if(Session::has('sweet_alert.content')): ?>
            var config = <?php echo Session::pull('sweet_alert.alert'); ?>

            var content = document.createElement('div');
            content.insertAdjacentHTML('afterbegin', config.content);
            config.content = content;
            swal(config);
        <?php else: ?>
            swal(<?php echo Session::pull('sweet_alert.alert'); ?>);
        <?php endif; ?>
    </script>
<?php endif; ?>
