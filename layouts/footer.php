<footer>
  <div class="text-center p-2" style="background-color:#fff;border-top:1px solid #e7e7e7;">
     All rights reserved &copy;2022-<?php echo date("Y");?>
    <span class="text-muted">MyRecords</span>
  </div>
 </footer>
<script>

    function showMe(){
        var x = document.getElementById('Visible');
        var y = document.getElementById('Visible1');
        if (x.type === "password" ) {
            x.type = "text";
        }else{
            x.type = "password";
        }
        if (y.type === "password" ) {
            y.type = "text";
        }else{
            y.type = "password";
        }
    }
</script>
    <script src="<?=base_url('layouts/vendor/jquery-3.2.1.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/bootstrap-4.1/popper.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/bootstrap-4.1/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/slick/slick.min.js')?>">
    </script>
    <script src="<?=base_url('layouts/vendor/wow/wow.min.js')?>"></script>
    <script src="<?=base_url('layouts/vendor/animsition/animsition.min.js')?>"></script>
   
    <!-- Main JS-->
    <script src="<?=base_url('layouts/js/main.js')?>"></script>
    
<script
  src="<?=base_url('layouts/js/jquery-3.4.1.min.js')?>"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous')?>"></script>
</body>
</html>
