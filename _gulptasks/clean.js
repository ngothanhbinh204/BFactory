import del from "del";
import cache from "gulp-cache";

export const cleanDist = () => {
    return del("dist");
};

export const clearCache = () => {
    return cache.clearAll();
};

export const cleanDistDev = () => {
    return del([
        "dist",
        "!dist/**",
        "!dist/**/core.min.css",
        "!dist/**/core.min.js",
    ]);
};

export const cleanImage = () => {
    return del("dist/img");
};

module.exports = {
    cleanDist,
    cleanImage,
    cleanDistDev,
	clearCache
};
