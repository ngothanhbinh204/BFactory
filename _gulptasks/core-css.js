import { src, dest } from "gulp";
const sass = require("gulp-sass")(require("node-sass"));
import concat from "gulp-concat";
import postcss from "gulp-postcss";
import autoprefixer from "autoprefixer";
import cssnano from "cssnano";
import cssSort from "css-declaration-sorter";
import plumber from "gulp-plumber";
import { readFileSync } from "fs";
import del from "del";

export const cssCore = () => {
	let glob = JSON.parse(readFileSync("config.json"));

	// Step 1: Compile the SASS files to CSS
	const compiledSass = src("src/_util/**.sass", {
		allowEmpty: true,
	})
		.pipe(concat("util.min.sass"))
		.pipe(sass().on("error", sass.logError))
		.pipe(
			postcss([
				autoprefixer({
					browsers: ["last 4 version", "IE 9"],
					cascade: false,
				}),
				cssnano(),
				cssSort({
					order: "concentric-css",
				}),
			])
		)
		.pipe(dest("styles"));

	// Step 2: Grab all CSS files from glob and add the compiled SASS to the stream
	return compiledSass
		.pipe(
			src(["styles/util.min.css", ...glob.css], {
				allowEmpty: true,
			})
		)
		.pipe(concat("core.min.css"))
		.pipe(
			postcss([
				autoprefixer({
					overrideBrowserslist: ["last 4 versions", "IE 9"],
					cascade: false,
				}),
				cssnano(),
				cssSort({
					order: "concentric-css",
				}),
			])
		)
		.pipe(dest("styles"))
		.on("end", () => del("styles/util.min.css"));
};

module.exports = cssCore;
