/**
 * Gulp JS for Glide Design WordPress Projects.
 */

 const config = require("./wpgulp.config.js");

 /**
  * Load Plugins.
  */
 const gulp = require("gulp");

 // CSS related plugins.
 const sass = require("gulp-sass")(require("sass"));
 const postcss = require("gulp-postcss");
 const autoprefixer = require("autoprefixer");
 const cssnano = require("gulp-cssnano");
 const sourcemaps = require("gulp-sourcemaps");

 // JS related plugins.
 const concat = require("gulp-concat");

 // Utility related plugins.
 const rename = require("gulp-rename");
 const lineec = require("gulp-line-ending-corrector");
 const filter = require("gulp-filter");
 const notify = require("gulp-notify");
 const browserSync = require("browser-sync").create();
 const remember = require("gulp-remember");
 const plumber = require("gulp-plumber");
 const beep = require("beepbeep");
 const count = require("gulp-count");
 const zip = require('gulp-zip'); // Zip plugin or theme file.


 /**
  * Custom Error Handler.
  */
 const errorHandler = (r) => {
	 notify.onError("\n\n❌  ===> ERROR: <%= error.message %>\n")(r); // Message to be displayed when error function is called
	 beep(2); // Beep two times on error
	 // this.emit('end');
 };

 /**
  * Task: `browser-sync`.
  */
 const browsersync = (done) => {
	 browserSync.init({
		 proxy: config.projectURL,
		 open: config.browserAutoOpen,
		 injectChanges: config.injectChanges,
		 watchEvents: ["change", "add", "unlink", "addDir", "unlinkDir"],
	 });
	 done();
 };
 const reload = (done) => {
	 browserSync.reload();
	 done();
 };

 /**
  * Task: `styles`.
  */
 gulp.task("styles", () => {
	 const plugins = [
		 autoprefixer({
			 overrideBrowserslist: config.BROWSERS_LIST,
		 }),
	 ];
	 return gulp
		 .src(config.styleSRC, {
			 allowEmpty: false,
		 })
		 .pipe(plumber(errorHandler))
		 .pipe(sourcemaps.init())
		 .pipe(
			 sass({
				 errLogToConsole: config.errLogToConsole,
				 precision: config.precision,
			 }),
		 )
		 .on("error", sass.logError)
		 .pipe(postcss(plugins))
		 .pipe(sourcemaps.write("./"))
		 .pipe(lineec())
		 .pipe(gulp.dest(config.styleDestination))
		 .pipe(filter("**/*.css"))
		 .pipe(browserSync.stream())
		 .pipe(sourcemaps.init({loadMaps: true}))
		 .pipe(cssnano())
		 .pipe(
			rename({
				suffix: ".min",
		   }),
	   	 )
		.pipe(sourcemaps.write("./"))
		.pipe(lineec())
		.pipe(gulp.dest(config.styleDestination))
		.pipe(filter("**/*.css"))
		.pipe(browserSync.stream())
		 .pipe(
			 notify({
				 message: "\n\n✅ ===> Styles ✅ completed!\n",
				 onLast: true,
			 }),
		 );
 });

 /**
  * Task: `Scripts`.
  */
 gulp.task("scripts", () => {
	 return (
		 gulp
			 .src(config.jsSRC, {

			 })
			 .pipe(count("## number of JS files selected"))
			 .pipe(plumber(errorHandler))
			 .pipe(remember(config.jsVendorSRC))
			 .pipe(
				 concat(config.jsFile + ".js", {
					 newLine: ";",
				 }),
			 )
			 .pipe(lineec())
			 .pipe(gulp.dest(config.jsDestination))
			 .pipe(
				 rename({
					 basename: config.jsFile,
					 suffix: ".min",
				 }),
			 )
			 .pipe(lineec())
			 .pipe(gulp.dest(config.jsDestination))
			 .pipe(
				 notify({
					 message: "\n\n✅ ===> Scripts ✅ completed!\n",
					 onLast: true,
				 }),
			 )
	 );
 });

 /**
  * Watch Tasks.
  */
 gulp.task(
	 "default",
	 gulp.series("styles", "scripts", browsersync, () => {
		 gulp.watch(config.watchPhp, reload);
		 gulp.watch(
			 [config.watchStyles, "!assets/css/bundle.css", "!assets/css/bundle.css.map", "!assets/css/bundle.min.css",  "!assets/css/bundle.min.css.map"],
			 gulp.parallel("styles"),
		 );
		 gulp.watch(
			 [config.watchJs, "!assets/js/bundle.js", "!assets/js/bundle.min.js"],
			 gulp.series("scripts", reload),
		 );
		 gulp.watch(config.watchHtml, reload);
	 }),
 );
/**
 * Zips theme or plugin and places in the parent directory
 *
 * zipIncludeGlob: Files to be included in the zip file
 * zipIgnoreGlob: Files to be ignored from the zip file
 * zipDestination: Must be a folder outside of the zip folder.
 * zipName: theme.zip or plugin.zip
 */
 gulp.task('zip', () => {
	const src = [...config.zipIncludeGlob, ...config.zipIgnoreGlob];
	return gulp.src(src).pipe(zip(config.zipName)).pipe(gulp.dest(config.zipDestination));
});

/**
 * Watch Tasks.
 */
gulp.task(
	 'default',
	 gulp.series( 'styles', 'scripts', browsersync, () => {
		 gulp.watch( config.watchPhp, reload );
		 gulp.watch(
			 [ config.watchStyles, '!assets/css/bundle.css', '!assets/css/bundle.css.map', '!assets/css/bundle.min.css', '!assets/css/bundle.min.css.map' ],
			 gulp.parallel( 'styles' ),
		 );
		 gulp.watch(
			 [ config.watchJs, '!assets/js/bundle.js', '!assets/js/bundle.min.js' ],
			 gulp.series( 'scripts', reload ),
		 );
		 gulp.watch( config.watchHtml, reload );
	 } ),
);
