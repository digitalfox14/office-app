<template>
    <div class="sidebar" id="sidebar">
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 393px;">
            <div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 393px;">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <router-link class="fa fa-dashboard" to="/home"><span>Dashboard</span></router-link>
                            <!-- <a><i class="fa fa-dashboard"></i> <span>Dashboard</span></a> -->
                        </li>
                        <li>
                             <router-link class="fa fa-clock-o" to="/attendanceTable"><span>Attendance</span></router-link>
                            <!-- <a><i class="fa fa-clock-o"></i> <span>Attendance</span></a> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "side-bar"
    }
</script>