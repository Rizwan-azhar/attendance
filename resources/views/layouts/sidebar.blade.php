<i class="fas fa-indent" style="color:#0FA3E0!important" id="nav-btn" onclick="showNav()"></i>
<aside id='side-nav'  class="">
    <div class="">
       
        
            <ul class="list-style-none">
                <li class=""><a href="/home" class="text-light  active">Attendance</a></li>
                <li class=""><a href="#" class="text-light">Example 1</a></li>
                <li class=""><a href="#" class="text-light">Example 1</a></li>
                
            </ul>
     
    </div>
</aside>
<script>
    const showNav = () => {
        (document.getElementById('side-nav').className === "") ? document.getElementById('side-nav').classList.add('nav-open'): document.getElementById('side-nav').classList.remove('nav-open');
        (document.getElementById('side-nav').className === "nav-open") ? document.getElementById('nav-btn').classList.add('rot-180'): document.getElementById('nav-btn').classList.remove('rot-180');
    }
</script>