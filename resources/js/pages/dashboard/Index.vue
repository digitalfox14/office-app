<template>
    <div class="content">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a>Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card punch-status">
                        <div class="card-body">
                            <h5 class="card-title">Timesheet <small class="text-muted">11 Mar 2019</small></h5>
                            <div class="punch-det">
                                <h6>Punch In at</h6>
                                <p>Wed, 11th Mar 2019 10.00 AM</p>
                            </div>
                            <div class="punch-info">
                                <div class="punch-hours">
                                    <span>3.45 hrs</span>
                                </div>
                            </div>
                            <div class="punch-btn-section">
                                <button type="button" class="btn btn-primary punch-btn" @click="userAttendance()">Punch In</button>                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card att-statistics">
                        <div class="card-body">
                            <h5 class="card-title">Statistics</h5>
                            <div class="stats-list">
                                <div class="stats-info">
                                    <p>Today <strong>3.45 <small>/ 8 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 31%"
                                            aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 31%"
                                            aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Remaining <strong>90 <small>/ 160 hrs</small></strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 62%"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="stats-info">
                                    <p>Overtime <strong>4</strong></p>
                                    <div class="progress">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 22%"
                                            aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Employee</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="#" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add Employee</a>
                </div>
            </div>
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                         <label class="focus-label">Date</label>
                        <input type="date" class="form-control floating">
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <label class="focus-label">Select Month</label>
                        <select class="select floating form-control floating">
                            <option>-</option>
                            <option>Jun</option>
                            <option>Feb</option>
                            <option>Mar</option>
                            <option>Apr</option>
                            <option>May</option>
                            <option>Jun</option>
                            <option>Jul</option>
                            <option>Aug</option>
                            <option>Sep</option>
                            <option>Oct</option>
                            <option>Nov</option>
                            <option>Dec</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                         <label class="focus-label">Select Year</label>
                        <select class="select floating form-control floating">
                            <option>-</option>
                            <option>{{ currYear }}</option>
                            <option>{{ currYear + 1 }}</option>
                            <option>{{ currYear + 2 }}</option>
                            <option>{{ currYear + 3 }}</option>
                            <option>{{ currYear + 4 }}</option>
                            <option>{{ currYear + 5 }}</option>
                            <option>{{ currYear + 6 }}</option>
                            <option>{{ currYear + 7 }}</option>
                            <option>{{ currYear + 8 }}</option>
                            <option>{{ currYear + 9 }}</option>
                            <option>{{ currYear + 10 }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="#" class="btn btn-success btn-block"> Search </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Punch In</th>
                                    <th>Punch Out</th>
                                    <th>Production</th>
                                    <th>Break</th>
                                    <th>Overtime</th>
                                </tr>
                            </thead>
                                <tr v-for="att, i in attLog" :key="i">
                                    <td>{{ att.id }}</td>
                                    <td></td>
                                    <td>{{ att.punch_in }}</td>
                                    <td>{{ att.punc_out }}</td>
                                </tr>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapState, mapActions } from 'vuex'


export default {
    data() {
        return {
            currYear: new Date().getFullYear(),
        };
    },

    computed: mapState({
        user: state => state.userModule.user,
        attLog: state => state.userModule.attLog
        
    }),
    mounted () {
        this.getAttLog();
    },
    
    methods: {
        ...mapActions({
            userAttendance: 'userModule/userAttendance',
            getAttLog: 'userModule/getAttLog'
        }),
    }
}
</script>