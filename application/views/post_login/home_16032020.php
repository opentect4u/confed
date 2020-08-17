<div class="container">

    <div class="w3-content w3-section" style="margin-left: 8%; width: 85%;">
        <img class="mySlides" src="<?php echo base_url('img1.jpg'); ?>" style="width:100%; height: 555px;">
        <img class="mySlides" src="<?php echo base_url('img2.jpg'); ?>" style="width:100%; height: 555px;">
        <img class="mySlides" src="<?php echo base_url('img3.jpg'); ?>" style="width:100%; height: 555px;">
        <img class="mySlides" src="<?php echo base_url('img6.jpg'); ?>" style="width:100%; height: 555px;">
        <img class="mySlides" src="<?php echo base_url('icds.jpg'); ?>" style="width:100%; height: 555px;">
        <img class="mySlides" src="<?php echo base_url('img5.jpg'); ?>" style="width:100%; height: 555px;">
    </div>

</div>

<br>

<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 3000); // Change image every 2 seconds
    }
</script>