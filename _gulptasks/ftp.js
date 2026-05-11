var gulp = require("gulp");
var gutil = require("gulp-util");
var ftp = require("vinyl-ftp");

const HOST = "";
const USER = "";
const PASSWORD = "";

export const deployCSS = () => {
	var conn = ftp.create({
		host: HOST,
		user: USER,
		password: PASSWORD,
		parallel: 10,
		log: gutil.log,
	});

	var globs = ["styles/*.css"];

	// using base = '.' will transfer everything to /public_html correctly
	// turn off buffering in gulp.src for best performance

	return gulp
		.src(globs, { base: "./styles", buffer: false })
		.pipe(
			conn.newerOrDifferentSize(
				"/public_html/wp-content/themes/CanhCamTheme/styles"
			)
		) // only upload newer files
		.pipe(conn.dest("/public_html/wp-content/themes/CanhCamTheme/styles"));
};

export const deployJS = () => {
	var conn = ftp.create({
		host: HOST,
		user: USER,
		password: PASSWORD,
		parallel: 10,
		log: gutil.log,
	});

	var globs = ["scripts/*.js"];

	// using base = '.' will transfer everything to /public_html correctly
	// turn off buffering in gulp.src for best performance

	return gulp
		.src(globs, { base: "./scripts", buffer: false })
		.pipe(
			conn.newerOrDifferentSize(
				"/public_html/wp-content/themes/CanhCamTheme/scripts"
			)
		) // only upload newer files
		.pipe(conn.dest("/public_html/wp-content/themes/CanhCamTheme/scripts"));
};
export const deployPHP = () => {
	var conn = ftp.create({
		host: HOST,
		user: USER,
		password: PASSWORD,
		parallel: 10,
		log: gutil.log,
	});

	var globs = ["./**/*.php"];

	// using base = '.' will transfer everything to /public_html correctly
	// turn off buffering in gulp.src for best performance

	return gulp
		.src(globs, { base: ".", buffer: false })
		.pipe(conn.differentSize("/public_html/wp-content/themes/CanhCamTheme")) // only upload newer files
		.pipe(conn.dest("/public_html/wp-content/themes/CanhCamTheme"));
};

module.exports = { deployCSS, deployJS, deployPHP };
