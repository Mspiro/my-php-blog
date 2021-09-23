const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const minify = require('gulp-minify');

gulp.task('styles', () =>{
  return gulp.src('/assets/sass/*.scss').pipe(sass({outputStyle:'compressed'}).on('error', sass.logError)).pipe(gulp.dest('assets/css/'))
})

gulp.task('watch', ()=>{
  return gulp.watch('assets/scss/*.scss', (done) =>{
    gulp.series(['style']) (done)
  })
})