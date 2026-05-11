import { src, dest } from "gulp";
import plumber from "gulp-plumber";
import uglifyBabel from "gulp-terser";
const rollup = require("gulp-better-rollup");
const babel = require("rollup-plugin-babel");
const resolve = require("rollup-plugin-node-resolve");
const commonjs = require("rollup-plugin-commonjs");
import rename from "gulp-rename";
import sourcemap from "gulp-sourcemaps";

export const jsTask = () => {
	return src(["src/js/main.js"])
		.pipe(plumber())
		.pipe(sourcemap.init())
		.pipe(rollup({ plugins: [babel(), resolve(), commonjs()] }, "iife"))
		.pipe(uglifyBabel())
		.pipe(rename("main.min.js"))
		.pipe(sourcemap.write("."))
		.pipe(dest("scripts"));
};

module.exports = jsTask;
