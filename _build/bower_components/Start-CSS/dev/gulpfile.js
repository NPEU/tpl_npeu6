const gulp        = require('gulp');
const runSequence = require('run-sequence');
const pump        = require('pump');


/*------------------------------------------------------------------------------------------------*\
    FTP
    
    Note: this always uploads everything (with obvious exceptions) DELIBERATELY.
    This is because not everything is watched all the time, and I may make changes to unwatched
    files without thinking or remembering to upload them.
    This method ensures that the host will always have the latest files, including THIS.
\*------------------------------------------------------------------------------------------------*/
const ftp         = require( 'vinyl-ftp' );
const ftpcrd      = require('./ftpcrd.json');

var ftp_src = './';


// Upload files
gulp.task('ftp', () => {
    console.log('Running FTP. See gulpfile.js for details.');

    var conn = ftp.create( {
        host:     ftpcrd.host,
        user:     ftpcrd.user,
        password: ftpcrd.pass,
        parallel: 10
    } );

    return gulp.src([
        '!node_modules', '!node_modules/**',
        '!media', '!media/**',
        '!ftpcrd.json',
        ftp_src + '/**/*'
        ], { base: '.', buffer: false })
        //.pipe(conn.newer(ftpcrd.dest));// only upload newer files
        .pipe(conn.dest(ftpcrd.dest));
});


/*------------------------------------------------------------------------------------------------*\
    CSS
\*------------------------------------------------------------------------------------------------*/
const sass   = require('gulp-sass');
const cssmin = require('gulp-cssmin');
const rename = require('gulp-rename');

var css_base = './';
var css_src  =  ['!node_modules', '!node_modules/**', css_base + '*.scss', css_base + '**/*.scss'];
var css_dest = './css/';


// Compile SCSS in expanded mode so it's easier to inspect the result.
gulp.task('sass', (cb) =>
    pump([
        gulp.src(css_src),
        sass({outputStyle: 'expanded'}),
        gulp.dest(css_dest)
    ],
    cb)
);

// Then create a minified version in the output folder.
gulp.task('cssmin', (cb) =>
    pump([
        gulp.src(css_dest + '**/!(*.min)*.css'),
        cssmin(),
        rename({extname: '.min.css'}),
        gulp.dest(css_dest)
    ],
    cb)
);

// This combined task makes it convenient to run all the steps together.
gulp.task('css', () => {
    console.log('Processing (S)CSS. See gulpfile.js for details.');
    runSequence('sass', 'cssmin', 'ftp');
})


/*------------------------------------------------------------------------------------------------*\
    WATCHERS
\*------------------------------------------------------------------------------------------------*/

// Watch CSS:
gulp.task('watch_css', function(){
    gulp.watch(css_src, ['css']);
});


// Watch FTP:
/*gulp.task('watch_ftp', function(){
    gulp.watch(ftp_src + '/** /*', ['ftp']);
});*/


// Watch PHP files:
gulp.task('watch_php', function(){
    gulp.watch('./**/*.php', ['ftp']);
});



// Watch all of the above:
gulp.task('watch_all', function(){
    gulp.watch(css_src, ['css']);
    //gulp.watch(css_base + '**/*.scss', ['css']);
    //gulp.watch(['!node_modules', '!node_modules/**', '!ftpcrd.json', ftp_src + '/**/*'], ['ftp']);
});