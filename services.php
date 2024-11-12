<!DOCTYPE html>
<html lang="en">
<title>Our Services</title>

<?php include('shared/navbar.html'); ?>
  
       <div class="service">
           <div class="row-1">
           <div class="service-col-1">
                <img src="images/service.jpeg" alt="">
           </div>
           <div class="service-col-2">
                <p>Kimata Grains Company provide varous services to our customers in different areas around the country  
                 with the objective of promote quality services to our customers. The main services of Kimata Grains Company includes;
                </p>               
                    <ul>
                        <li>Selling of grain especially beans, corn flour and rice around various region in the country</li>
                        <li>Distributing of our commodities in various areas around various region in the country</li>
                    </ul>
                <div class="tab-titles">
                    <p class="tab-links active-link" onclick="opentab('vision')">OUR VISION</p>
                    <p class="tab-links" onclick="opentab('mission')">OUR MISSION</p>
                </div>
                <div class="tab-contents active-tab" id="vision">
                    <p>To become a reliable and sustainable tertiary grain services distributor in Tanzania</p>
                </div>
                <div class="tab-contents" id="mission">
                    <p>To sustainably manage issuance of grain services distribution through innovation and skilled workforce</p>
                </div>
            </div>
            </div>
        </div>

    <script>
       let tablinks = document.getElementsByClassName('tab-links');
       let tabcontents = document.getElementsByClassName('tab-contents');

       function opentab(tabname){
       for(tablink of tablinks){
        tablink.classList.remove('active-link');
       }
       for(tabcontent of tabcontents){
        tabcontent.classList.remove('active-tab');
       }
       event.currentTarget.classList.add('active-link');
       document.getElementById(tabname).classList.add('active-tab');
    }
    </script> 
    
<?php include('shared/footer.html'); ?> 

</html>