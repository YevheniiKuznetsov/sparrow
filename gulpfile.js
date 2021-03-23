"use strict"
global.$ = {
    gulp : require('gulp'),
    gp : require('gulp-load-plugins')(),
    path: {
        tasks:require("./gulp/config/tasks.js")
    }
}
$.path.tasks.forEach((taskPath)=>{
    require(taskPath)()
})

$.gulp.task('default', $.gulp.series(
    $.gulp.parallel("stylus"),
    $.gulp.parallel('watch',),
));

