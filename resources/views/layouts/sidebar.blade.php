<i class="fas fa-indent" style="color:#0FA3E0!important" id="nav-btn" onclick="showNav()"></i>
<aside id='side-nav'  class="">
    <div class="">

  
            <ul class="list-style-none">
                <li class=""><a href="/home" class="text-light {{ Request::segment(1) === 'home' ? 'active' : null }} ">Attendance</a></li>
  
                <li class=""><a href="/progress" class="text-light {{ Request::segment(1) === 'progress' ? 'active' : null }} ">Daily Progress</a></li>
                <li class=""><a href="/salary" class="text-light {{ Request::segment(1) === 'salary' ? 'active' : null }}">Employee's Salary</a></li>
  
            </ul>
     
    </div>
</aside>
<script>
    const showNav = () => {
        (document.getElementById('side-nav').className === "") ? document.getElementById('side-nav').classList.add('nav-open'): document.getElementById('side-nav').classList.remove('nav-open');
        (document.getElementById('side-nav').className === "nav-open") ? document.getElementById('nav-btn').classList.add('rot-180'): document.getElementById('nav-btn').classList.remove('rot-180');
    }
</script>