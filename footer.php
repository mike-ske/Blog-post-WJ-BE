    <!-- footer section -->
    <div class="down_indicator">
            <div class="arrow_up" id="arrow_up">
                <a href="#"><img src="img/arrow-up.png"></a>
            </div>
    </div>
    <div class="footer" id="foot">
        <div class="footer_text">
            <h3>Read<span class="base">it</span> Blog. Get Your Blog Online</h3>
            <div class="social_icon">
               <div class="logo_list">
                   <a class="list" href="https://www.facebook.com/micah.alumona"><img src="img/facebook-logo-1.png"></a>
                   <a class="list" href="https://www.linkedin.com/mwlite/in/micah-alumona-4012161b0"><img src="img/linkedin-sign.png"></a>
                   <a class="list" href="https://www.twitter.com/MicahAlumona"><img src="img/twitter-sign.png"></a>
                   <a class="list" href="https://github.com/mike-ske"><img src="img/github-logo.png"></a>
                   
                </div>
            </div>
            <h6>  Copyright  &copy; 2020 Created by Alumona Micah DEV <span class="cast">@Think Soft</span></h6>
        </div>
    </div>
    <script>
        var pointer = document.getElementById('arrow_up');
        var body = document.getElementById('body');

        pointer.onclick = function () {
            pointer.style.opacity =  0;
            pointer.style.display =  "none";
        }
        body.onscroll = function () {
            pointer.style.display =  "block";
        }
        body.onclick = function () {
            pointer.style.opacity =  0;
           
        }
    </script>
</body>
</html>
