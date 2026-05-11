import { src, dest } from "gulp";
import concat from "gulp-concat";
import plumber from "gulp-plumber";
import { readFileSync } from "graceful-fs";
const terser = require("gulp-terser");

export const jsCore = () => {
	let glob = JSON.parse(readFileSync("config.json"));
	return src(glob.js, {
		allowEmpty: true,
	})
		.pipe(plumber())
		.pipe(concat("core.min.js"))
		.pipe(terser())
		.pipe(dest("scripts"));
};

module.exports = jsCore;
