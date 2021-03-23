module.exports =()=>{
    $.gulp.task('scripts:lib', ()=>{
        return $.gulp.src(['./assets/js/library/jquery-3.5.1.min.js','./assets/js/library/slick.min.js','./assets/js/library/owl.carousel.js'])// библиотеки
            .pipe($.gp.concat('libs.min.js'))
            .pipe($.gulp.dest('assets/js/'))
    })
}