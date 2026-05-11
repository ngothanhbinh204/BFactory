import { src, dest } from "gulp";
var googleWebFonts = require("gulp-google-webfonts");

var options = {
	fontsDir: "../fonts",
	cssDir: "../_plugins/",
	cssFilename: "fonts.css",
};

export const downloadFonts = () => {
	return src("./fonts.list")
		.pipe(googleWebFonts(options))
		.pipe(dest("src/fonts"));
};

module.exports = downloadFonts;
