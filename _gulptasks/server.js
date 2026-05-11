import { watch, series, parallel } from "gulp";
import bSync from "browser-sync";

import jsCore from "./core-js";
import jsTask from "./script";
import pugTask from "./html";
import cssCore from "./core-css";
import sassTask from "./css";
import { copyImage } from "./copy";
import { cleanImage } from "./clean";

export const server = () => {
	bSync.init({
		proxy: "bfactory.demo",
		open: true,
		files: ["**/*.php", "styles/*.css", "scripts/*.js"],
	});

	watch(["src/js/**/*.js"], series(jsTask));

	// watch(["src/**/**.pug"], series(pugTask));

	watch(
		["src/components/**/**.sass", "src/components/_core/**/**.sass"],
		series(sassTask)
	);

	watch(
		["src/img/**/**.{svg,png,jpg,speg,gif}"],
		series(cleanImage, copyImage)
	);

	watch(
		["src/_plugins/**/**.css", "src/_plugins/**/**.js", "config.json"],
		parallel(jsCore, cssCore)
	);

	watch(["dist"]).on("change", bSync.reload);
};

module.exports = server;
