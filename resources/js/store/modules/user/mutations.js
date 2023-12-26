export default {
    SET_USER (store, user) {
        store.user = user;
    },
    SET_ATTENDANCE (store, attendance) {
        store.attendance = attendance;
    },
    SET_PUNCH (store, punchLogs) {
        store.punchLog = punchLogs;
    },
    SET_USER_ATTENDANCE (store, userAttendance) {
        store.userAttendance = userAttendance;
    },
    SET_TIMESHEET (store, timesheet) {
        store.timesheet = timesheet;
    }
    
}