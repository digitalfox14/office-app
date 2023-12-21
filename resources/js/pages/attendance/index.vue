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
                                    <span v-if="params.year == currYear && params.month == currentMonth">
                                        <span v-if="key <= currentDate">
                                            <span v-if="value"><i class="fa fa-check text-success"></i></span>
                                            <span v-else><i class="fa fa-close text-danger"></i></span>
                                        </span>
                                        <span v-else>-</span>
                                    </span>
                                    <span v-else>
                                        <span v-if="value"><i class="fa fa-check text-success"></i></span>
                                        <span v-else><i class="fa fa-close text-danger"></i></span>
                                    </span>
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
            currentDate: new Date().getDate(),
            currentMonth: new Date().getMonth()+1,
            params: {
                month: new Date().getMonth()+1,
                year: new Date().getFullYear(),
            },
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
            getUserAttendance: 'userModule/getUserAttendance',

            }),

        handleFilter (event) {
            this.getUserAttendance(this.params);
        },
    }

}
</script>