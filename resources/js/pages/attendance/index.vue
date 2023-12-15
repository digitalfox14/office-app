<template>
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Attendance Sheet</h4>
            </div>
        </div>
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">Employee Name</label>
                    <input type="text" class="form-control floating">
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <label class="focus-label">Select Month</label>
                    <select class="select floating">
                        <option>-</option>
                        <option>Jan</option>
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
                    <select class="select floating">
                        <option>-</option>
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
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th v-for="days in userAttendance.days" :key="days"> {{ days }} </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="data, index in userAttendance.attendances" :key="index">
                                <td>{{ data.user }}</td>
                                <td v-for="value, key in data.attendances">
                                    <span v-if="key <= currentDate">
                                        <span v-if="value"><i class="fa fa-check text-success"></i></span>
                                        <span v-else><i class="fa fa-close text-danger"></i></span>
                                    </span>
                                    <span v-else>-</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapActions, mapState } from 'vuex';

export default {
    name: 'index',
    data() {
        return {
            currYear: new Date().getFullYear(),
            currentDate: new Date().getDate()

        };
    },

    computed: mapState({
        userAttendance: state => state.userModule.userAttendance,
    }),

    mounted() {
        this.getUserAttendance()

        if ($('.floating').length > 0) {
            $('.floating').on('focus blur', function (e) {
                $(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
            }).trigger('blur');
        }
    },

    methods: {
        ...mapActions({
            getUserAttendance: 'userModule/getUserAttendance'
        }),
    }

}
</script>