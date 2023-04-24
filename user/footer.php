<?php
if (isset($_SESSION['folderstep']))
{
	$folderstep = $_SESSION['folderstep'];
}
else
{
	$folderstep = "";
}
if (isset($_SESSION['showhide']))
{
	$showhide = $_SESSION['showhide'];
}
else
{
	$showhide = 0;
}


?>

<?php
if(isset($_SESSION['a_id']))
{
	
?>

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section">
        
        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-content d-flex flex-wrap justify-content-between align-items-center">
                            <!-- Footer Logo -->
                            <a href="index.html" class="footer-logo"><img src="<?php echo $folderstep; ?>img/core-img/Ambrevia.png" alt="" style="height:80px; width:150px;"></a>

                            <!-- Copywrite Text -->
                            <p class="copywrite-text"><a href="#"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->
<?php
}

else if(isset($_SESSION['sid']))
{
	
?>
<!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section">
        
        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-content d-flex flex-wrap justify-content-between align-items-center">
                            <!-- Footer Logo -->
                            <a href="index.html" class="footer-logo"><img src="<?php echo $folderstep; ?>img/core-img/Ambrevia.png" alt="" style="height:80px; width:150px;"></a>

                            <!-- Copywrite Text -->
                            <p class="copywrite-text"><a href="#"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>	
	
<?php
}
	
else if(isset($_SESSION['u_id']))
{
?>

<!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section">
        
        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-content d-flex flex-wrap justify-content-between align-items-center">
                            <!-- Footer Logo -->
                            <a href="index.html" class="footer-logo"><img src="<?php echo $folderstep; ?>img/core-img/Ambrevia.png" alt="" style="height:80px; width:150px;"></a>

                            <!-- Copywrite Text -->
                            <p class="copywrite-text"><a href="#"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

	<?php
	}
else
{
?>	

<!-- ##### Footer Area Start ##### -->
    <footer class="footer-area section">
        
        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copywrite-content d-flex flex-wrap justify-content-between align-items-center">
                            <!-- Footer Logo -->
                            <a href="index.html" class="footer-logo"><img src="<?php echo $folderstep; ?>img/core-img/Ambrevia.png" alt="" style="height:80px; width:150px;"></a>

                            <!-- Copywrite Text -->
                            <p class="copywrite-text"><a href="#"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	<?php 
}
?>