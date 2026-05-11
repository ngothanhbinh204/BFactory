import { series, parallel } from "gulp";

// Import tasks
import server from "./_gulptasks/server";
import jsTask from "./_gulptasks/script";
import pugTask from "./_gulptasks/html";
import sassTask from "./_gulptasks/css";
import jsCore from "./_gulptasks/core-js";
import cssCore from "./_gulptasks/core-css";
import deploy from "./_gulptasks/deploy";
import { cleanDist, clearCache } from "./_gulptasks/clean";
import { copyFonts, copyImage, copyFavicon } from "./_gulptasks/copy";
import downloadFonts from "./_gulptasks/downloadFonts";

exports.default = series(server);

exports.init = series(
	cleanDist,
	clearCache,
	// downloadFonts,
	parallel(jsCore, cssCore),
	sassTask,
	jsTask,
	pugTask
);

exports.upload = series(parallel(copyImage), deploy);
