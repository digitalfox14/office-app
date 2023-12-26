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
                            <h5 class="card-title">Timesheet <small class="text-muted">{{ moment().format('DD MMM YYYY') }}</small></h5>
                            <div class="punch-det">
                                <h6>Punch In at</h6>
                                <p>{{ timesheet.timesheet_punchin && moment(timesheet.timesheet_punchin.punch_in).format('ddd, Do MMM YYYY HH:mm A') }}</p>
                            </div>
                            <div class="punch-info">
                                <div class="punch-hours">
                                    <span>{{ Math.floor(timesheet.loagged / 60) }}:{{ timesheet.loagged % 60 }} hrs</span>
                                </div>
                            </div>
                            <div class="punch-btn-section">
                                <button v-if="punchLog && !punchLog.punch_out && punchLog.id"
                                    class="btn btn-warning punch-btn" @click="punchOut(punchLog.id)">Punch Out</button>
                                <button v-else type="button" class="btn btn-primary punch-btn" @click="punchIn()">Punch
                                    In</button>
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
                        <select class="select floating" name="month" v-model="params.month" @change="handleFilter">
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus select-focus">
                        <label class="focus-label">Select Year</label>
                        <select class="select floating" name="year" v-model="params.year" @change="handleFilter">
                            <option>{{ currYear }}</option>
                            <option>{{ currYear - 1 }}</option>
                            <option>{{ currYear - 2 }}</option>
                            <option>{{ currYear - 3 }}</option>
                            <option>{{ currYear - 4 }}</option>
                            <option>{{ currYear - 5 }}</option>
                            <option>{{ currYear - 6 }}</option>
                            <option>{{ currYear - 7 }}</option>
                            <option>{{ currYear - 8 }}</option>
                            <option>{{ currYear - 9 }}</option>
                            <option>{{ currYear - 10 }}</option>
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
                            <tbody>
                                <tr v-for="data, index in attendance" :key="index">
                                    <td>{{ ++index }}</td>
                                    <td>{{ moment(data.date).format('DD MMM YYYY') }}</td>
                                    <td>{{ data.punch_in && data.punch_in.punch_in ? (moment(data.punch_in.punch_in).format('HH:mm A')) : '-' }}</td>
                                    <td>{{ data.punch_out && data.punch_out.punch_out ? (moment(data.punch_out.punch_out).format('HH:mm A')) : '-' }}</td>
                                    <td>{{ Math.floor( data.loagged / 60)}}:{{ data.loagged % 60 }} hrs</td>
                                    <td>{{ Math.floor(data.break / 60) }}:{{ data.break % 60 }} hrs</td>
                                    <td>{{ Math.floor(data.over_time / 60) }}:{{ data.over_time % 60 }} hrs</td>

                                </tr>
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
import moment from 'moment'


export default {
    data() {
        return {
            currYear: new Date().getFullYear(),
            moment,
             params: {
                month: new Date().getMonth() + 1,
                year: new Date().getFullYear(),
            },
        };
    },

    computed: mapState({
        user: state => state.userModule.user,
        attendance: state => state.userModule.attendance,
        punchLog: state => state.userModule.punchLog,
        timesheet: state => state.userModule.timesheet

    }),
    mounted() {
        this.getAttendanceLog()
        this.punch()
        this.getTimesheet()

        if ($('.floating').length > 0) {
            $('.floating').on('focus blur', function (e) {
                $(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
            }).trigger('blur');
        }
    },

    methods: {
        ...mapActions({
            punchIn: 'userModule/punchIn',
            getAttendanceLog: 'userModule/getAttendanceLog',
            punch: 'userModule/punch',
            punchOut: 'userModule/punchOut',
            getTimesheet: 'userModule/getTimesheet'
        }),
         handleFilter(event) {
            console.log(this.params);
            this.getAttendanceLog(this.params);
        },
    }

}
</script>