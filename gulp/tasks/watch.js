module.exports =()=>{
    $.gulp.task('watch',()=>{
        $.gulp.watch('assets/css/**/*.styl',$.gulp.series('stylus'))
    });
}